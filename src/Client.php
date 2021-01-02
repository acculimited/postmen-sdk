<?php

namespace Accu\Postmen;

use Accu\Postmen\Middleware\ErrorHandler;
use Accu\Postmen\Requests\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class Client
{
    /** @var ClientInterface */
    private $client;

    /** @var array */
    private $options;

    public function __construct(Configuration $configuration, ClientInterface $client = null)
    {
        $stack = $configuration->getHandlerStack() ?? HandlerStack::create();
        $stack->remove('http_errors');
        $stack->push(Middleware::retry(new ErrorHandler()), 'postmen_api_errors');

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
