<?php

namespace Accu\Postmen\Middleware;

use Accu\Postmen\Exceptions\InvalidRequestException;
use Accu\Postmen\Exceptions\ServerErrorException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

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
                if (in_array($response->getStatusCode(), ServerErrorException::SERVER_ERRORS)) {
                    throw new ServerErrorException("Something went wrong on Postmen's end");
                }

                $raw = $response->getBody()->getContents();

                if (! $raw) {
                    throw new ServerErrorException('Response body is empty');
                }

                // Allow the body to be read again downstream.
                $request->getBody()->rewind();

                $responseData = \GuzzleHttp\json_decode($raw);

                if (! isset($responseData->meta->code)) {
                    throw new ServerErrorException('Postmen API response malformed: meta data is missing');
                }

                if (in_array((int) $responseData->meta->code, InvalidRequestException::INVALID_REQUEST_ERRORS)) {
                    $request->getBody()->rewind();

                    throw new InvalidRequestException(
                        $responseData->meta->message ?? "Encountered error code: {$responseData->meta->code}",
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
