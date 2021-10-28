<?php

namespace Accu\Postmen\Tests\Unit\Middleware;

use Accu\Postmen\Exceptions\InvalidRequestException;
use Accu\Postmen\Middleware\ErrorHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ErrorHandlerTest extends TestCase
{
    public function testMetaCodeExemptions()
    {
        $handler = new ErrorHandler(1);

        $body = \GuzzleHttp\Utils::jsonEncode([
            'meta' => [
                'code' => 4713,
            ],
        ]);

        $exceptionThrown = false;

        try {
            $handler(0, new Request('GET', '/'), new Response(200, [], $body));
        } catch (InvalidRequestException $exception) {
            $exceptionThrown = true;
        }

        self::assertFalse($exceptionThrown, 'Not expecting meta code to trigger exception');
    }
}
