<?php

namespace Accu\Postmen\Requests\Labels;

use Accu\Postmen\Entities\Label;
use Accu\Postmen\Requests\Request;
use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;

class Retrieve extends Request
{
    use JsonSchema;

    public const METHOD = 'GET';
    public const URI = 'labels';

    public function __construct(string $reference)
    {
        parent::__construct(
            static::METHOD,
            static::URI . '/' . $reference
        );
    }

    /**
     * @param array $json
     * @return PostmenEntity|Label
     */
    public function mapResponseData(array $json): PostmenEntity
    {
        return Label::fromData($json['data'] ?? []);
    }
}
