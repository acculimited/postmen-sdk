<?php

namespace Accu\Postmen\Entities\Customs;

/**
 * NoEEI - Electronic Export Information
 * @package Accu\Postmen\Entities\Customs
 * @see https://docs.postmen.com/api.html#no_eei
 */
final class NoEEI extends CustomsType
{
    public const EXEMPTION_CODES = [
        'noeei_30_37_a',
        'noeei_30_37_h',
        'noeei_30_36',
    ];

    /** @var string */
    private $type = 'no_eei';

    /** @var string */
    private $ftr_exemption;
}
