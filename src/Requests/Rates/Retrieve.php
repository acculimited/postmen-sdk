<?php

namespace Accu\Postmen\Requests\Rates;

use Accu\Postmen\Entities\Rate;
use Accu\Postmen\Requests\Request;
use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;

class Retrieve extends Request
{
    use JsonSchema;

    public const JSON_SCHEMA = '/rate#/links/2/schema';

    public const METHOD = 'GET';
    public const URI = 'rates';

    public function __construct(string $reference)
    {
        parent::__construct(
            static::METHOD,
            static::URI . '/' . $reference
        );
    }

    /**
     * @param array $json
     * @return PostmenEntity[]|Rate[]
     */
    public function mapResponseData(array $json): array
    {
        $rates = [];

        foreach ($json['data']['rates'] ?? [] as $rate) {
            $rates[] = Rate::fromData($rate);
        }

        return $rates;
    }
}
