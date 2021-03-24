<?php

namespace Accu\Postmen\Entities\Customs;

/**
 * NoEEI - Electronic Export Information
 * @package Accu\Postmen\Entities\Customs
 * @see https://docs.postmen.com/api.html#no_eei
 */
final class NoEEI extends CustomsType
{
    public const JSON_SCHEMA = '/eei_no_eei';

    /** @var string */
    private $type = 'no_eei';

    /** @var string */
    private $ftr_exemption;

    public function getFtrExemption(): string
    {
        return $this->ftr_exemption;
    }

    public function setFtrExemption(string $ftr_exemption): NoEEI
    {
        $this->ftr_exemption = $ftr_exemption;
        return $this;
    }
}
