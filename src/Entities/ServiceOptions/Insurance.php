<?php

namespace Accu\Postmen\Entities\ServiceOptions;

use Accu\Postmen\Entities\Money;

final class Insurance extends ServiceOption
{
    public const JSON_SCHEMA = '/service_option_insurance';

    /** @var string */
    protected $type = 'insurance';

    /** @var Money */
    protected $insured_value;

    public function getInsuredValue(): Money
    {
        return $this->insured_value;
    }

    public function setInsuredValue(Money $insuredValue): Insurance
    {
        $this->insured_value = $insuredValue;
        return $this;
    }
}
