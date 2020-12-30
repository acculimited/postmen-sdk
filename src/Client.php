<?php

namespace Accu\Postmen;

use Accu\Postmen\Middleware\ErrorHandler;
use Accu\Postmen\Requests\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;

class Client
{
    public const PRODUCTION = 'https://production-api.postmen.com/v3/';
    public const SANDBOX = 'https://sandbox-api.postmen.com/v3/';

    /** @var ClientInterface */
    private $client;

    /** @var array */
    private $options;

    public function __construct(string $apiKey, string $mode = self::SANDBOX, ClientInterface $client = null)
    {
        $stack = HandlerStack::create();
        $stack->push(new ErrorHandler());

        $this->options = [
            'base_uri' => $mode,
            'handler' => $stack,
            'headers' => [
                'Content-Type' => 'application/json',
                'postmen-api-key' => $apiKey,
            ],
        ];

        $this->client = $client ?? new GuzzleClient();
    }

    public function send(Request $request)
    {
        $response = $this->client->send($request, $this->options);

        // Map the response payload back into PHP objects.
        return $request->hydrateResponse($response);
    }
}
