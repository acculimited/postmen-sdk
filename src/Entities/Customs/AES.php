<?php

namespace Accu\Postmen\Entities\Customs;

use Accu\Postmen\Schema\JsonSchema;

/**
 * Automated Export System
 * @package Accu\Postmen\Entities\Customs
 * @see https://docs.postmen.com/api.html#aes
 */
final class AES extends CustomsType
{
    public const JSON_SCHEMA = '/eei';

    /** @var string */
    private $type = 'aes';

    /** @var string */
    private $itn_number;

    public function getItnNumber(): string
    {
        return $this->itn_number;
    }

    public function setItnNumber(string $itn_number): AES
    {
        $this->itn_number = $itn_number;
        return $this;
    }
}
