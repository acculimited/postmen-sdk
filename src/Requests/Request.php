<?php

namespace Accu\Postmen\Requests;

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Utils;
use JsonSerializable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

abstract class Request extends Psr7Request implements JsonSerializable
{
    public const HEADERS = [];

    /** @var string */
    public const METHOD = null;

    /** @var string */
    public const URI = null;

    public function __construct(string $method = null, string $uri = null, array $headers = null)
    {
        parent::__construct(
            $method ?? static::METHOD,
            $uri ?? static::URI,
            $headers ?? static::HEADERS
        );
    }

    public function getBody(): StreamInterface
    {
        if (static::METHOD === 'POST' && $payload = $this->jsonSerialize()) {
            return Utils::streamFor(
                \GuzzleHttp\Utils::jsonEncode($payload, JSON_PRETTY_PRINT)
            );
        }

        return Utils::streamFor('');
    }

    public function hydrateResponse(ResponseInterface $response)
    {
        return $this->mapResponseData(
            \GuzzleHttp\json_decode($response->getBody()->getContents(), true)
        );
    }

    abstract public function mapResponseData(array $json);
}
