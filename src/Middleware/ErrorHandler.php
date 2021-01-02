<?php

namespace Accu\Postmen\Middleware;

use Accu\Postmen\Exceptions\InvalidRequestException;
use Accu\Postmen\Exceptions\ServerErrorException;
use GuzzleHttp\Exception\InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Error handling for documented API responses.
 * @package Accu\Postmen\Middleware
 * @see https://docs.postmen.com/errors.html
 */
class ErrorHandler
{
    /**
     * @param callable $handler
     * @return callable
     */
    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            return $handler($request, $options)->then(function (ResponseInterface $response) use ($request) {
                try {
                    $responseData = \GuzzleHttp\json_decode($response->getBody()->getContents());
                } catch (InvalidArgumentException $invalidArgumentException) {
                    throw new ServerErrorException(
                        'Postmen failed without a valid API response.',
                        $request,
                        $response
                    );
                } finally {
                    // Allow the body to be read again downstream.
                    $response->getBody()->rewind();
                }

                if (! isset($responseData->meta->code)) {
                    throw new ServerErrorException(
                        'Postmen API response malformed: meta data is missing.',
                        $request,
                        $response
                    );
                }

                if ((int) $responseData->meta->code > 200) {
                    $request->getBody()->rewind();

                    throw new InvalidRequestException(
                        $responseData->meta->message ?? "Encountered error code: {$responseData->meta->code}.",
                        $request,
                        $response,
                        $responseData->meta->code
                    );
                }

                return $response;
            });
        };
    }
}
