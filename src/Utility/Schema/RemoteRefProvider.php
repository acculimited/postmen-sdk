<?php

namespace Accu\Postmen\Utility\Schema;

use Swaggest\JsonSchema\RemoteRef\BasicFetcher;

class RemoteRefProvider extends BasicFetcher
{
    /** @var string */
    private $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public function getSchemaData($url)
    {
        return parent::getSchemaData("{$this->basePath}/{$url}.json");
    }
}
