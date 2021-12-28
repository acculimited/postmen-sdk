<?php

namespace Accu\Postmen\Events;

use Accu\Postmen\Entities\Rate;

class RatesCalculated implements Event
{
    /** @var Rate[] */
    private $rates;

    public function __construct(array $rates)
    {
        $this->rates = $rates;
    }

    /** @return Rate[] */
    public function data(): array
    {
        return $this->rates;
    }
}
