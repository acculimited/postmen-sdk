<?php

namespace Accu\Postmen;

use Accu\Postmen\Middleware\ErrorHandler;
use Accu\Postmen\Requests\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;

class Client
{
    /** @var ClientInterface */
    private $client;

    /** @var array */
    private $options;

    public function __construct(Configuration $configuration, ClientInterface $client = null)
    {
        $stack = HandlerStack::create();
        $stack->push(new ErrorHandler());

        $this->options = [
            'base_uri' => $configuration->getBaseURI(),
            'handler' => $stack,
            'headers' => [
                'Content-Type' => 'application/json',
                'postmen-api-key' => $configuration->getApiKey(),
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
