<?php

namespace Accu\Postmen\Tests\Unit;

use Accu\Postmen\Client;
use Accu\Postmen\Configuration;
use Accu\Postmen\Exceptions\InvalidRequestException;
use Accu\Postmen\Exceptions\ServerErrorException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * @dataProvider providerServerExceptions
     */
    public function testServerExceptions(Response $response, string $expected)
    {
        $client = $this->createMockedClient(new MockHandler([$response]));

        $this->expectException(ServerErrorException::class);
        $this->expectExceptionMessage($expected);

        $client->send(new \Accu\Postmen\Requests\Labels\Retrieve('dummy-label'));
    }

    public function providerServerExceptions()
    {
        return [
            [
                new Response(503, [], 'Service unavailable'),
                'Postmen failed without a valid API response.',
            ],
            [
                new Response(500, [], \GuzzleHttp\json_encode([
                    'data' => [],
                ])),
                'Postmen API response malformed: meta data is missing',
            ],
            [
                new Response(200, [], \GuzzleHttp\json_encode([
                    'meta' => [
                        'message' => 'What, no code?',
                        'details' => [],
                    ],
                ])),
                'Postmen API response malformed: meta data is missing.',
            ],
        ];
    }

    public function testWellFormedMetaError()
    {
        $client = $this->createMockedClient(new MockHandler([
            new Response(200, [], \GuzzleHttp\json_encode([
                'meta' => [
                    'code' => 4100,
                    'message' => 'Internal Error',
                    'details' => [],
                ],
            ]))
        ]));

        $this->expectException(InvalidRequestException::class);
        $this->expectExceptionMessage('Internal Error');

        $client->send(new \Accu\Postmen\Requests\Labels\Retrieve('dummy-label'));
    }

    private function createMockedClient(MockHandler $mockHandler): Client
    {
        return new Client(
            (new Configuration('dummy-key'))
                ->setHandlerStack(HandlerStack::create($mockHandler))
        );
    }
}
