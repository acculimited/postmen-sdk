<?php

namespace Accu\Postmen\Entities\ServiceOptions;

final class HoldForPickup extends ServiceOption
{
    public const JSON_SCHEMA = '/service_option_hold_for_pickup';

    /** @var string */
    protected $type = 'hold_for_pickup';

    /** @var bool */
    protected $enabled = true;

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): HoldForPickup
    {
        $this->enabled = $enabled;
        return $this;
    }
}
