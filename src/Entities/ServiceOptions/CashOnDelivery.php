<?php

namespace Accu\Postmen\Entities\ServiceOptions;

use Accu\Postmen\Entities\Money;

final class CashOnDelivery extends ServiceOption
{
    public const JSON_SCHEMA = '/service_option_cod';

    /** @var string */
    protected $type = 'cod';

    /** @var Money */
    protected $cod_value;

    public function getCashOnDeliveryValue(): Money
    {
        return $this->cod_value;
    }

    public function setCashOnDeliveryValue(Money $cashOnDelivery): CashOnDelivery
    {
        $this->cod_value = $cashOnDelivery;
        return $this;
    }
}
