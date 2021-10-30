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
    /** @var int */
    private $maxRetries;

    public function __construct(int $maxRetries)
    {
        $this->maxRetries = $maxRetries;
    }

    public function __invoke(int $retries, RequestInterface $request, ResponseInterface $response)
    {
        try {
            $responseData = \GuzzleHttp\Utils::jsonDecode($response->getBody()->getContents());
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

            if ($retries < $this->maxRetries && ($responseData->meta->retryable ?? false)) {
                return true;
            }

            InvalidRequestException::handle($responseData, $request, $response);
        }

        // No need to retry the request, all looks good.
        return false;
    }
}
