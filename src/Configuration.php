<?php

namespace Accu\Postmen;

use GuzzleHttp\HandlerStack;

class Configuration
{
    public const PRODUCTION_URL = 'https://production-api.postmen.com/v3/';
    public const SANDBOX_URL = 'https://sandbox-api.postmen.com/v3/';

    /** @var string */
    private $apiKey;

    /** @var bool */
    private $testMode;

    /** @var HandlerStack|null */
    private $handlerStack;

    public function __construct(string $apiKey, bool $testMode = true)
    {
        $this->apiKey = $apiKey;
        $this->testMode = $testMode;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getBaseURI(): string
    {
        if ($this->testMode) {
            return self::SANDBOX_URL;
        }

        return self::PRODUCTION_URL;
    }

    public function getHandlerStack(): ?HandlerStack
    {
        return $this->handlerStack;
    }

    public function setHandlerStack(HandlerStack $handlerStack = null): Configuration
    {
        $this->handlerStack = $handlerStack;
        return $this;
    }
}
