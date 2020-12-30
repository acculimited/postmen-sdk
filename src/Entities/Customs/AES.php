<?php

namespace Accu\Postmen\Entities\Customs;

/**
 * Automated Export System
 * @package Accu\Postmen\Entities\Customs
 * @see https://docs.postmen.com/api.html#aes
 */
final class AES extends CustomsType
{
    /** @var string */
    private $type = 'aes';

    /** @var string */
    private $itn_number;
}
