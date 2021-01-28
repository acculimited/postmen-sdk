<?php

namespace Accu\Postmen\Schema;

use Swaggest\JsonSchema\RemoteRef\BasicFetcher;

class RefProvider extends BasicFetcher
{
    /** @var string */
    private $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public function getSchemaData($url)
    {
        [$url, $path] = array_pad(
            explode('#', $url, 2),
            2,
            null
        );

        return parent::getSchemaData("{$this->basePath}{$url}.json");
    }
}
