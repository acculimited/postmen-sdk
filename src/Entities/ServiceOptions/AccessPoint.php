<?php

namespace Accu\Postmen\Entities\ServiceOptions;

final class AccessPoint extends ServiceOption
{
    public const JSON_SCHEMA = '/service_option_access_point';

    /** @var string */
    protected $type = 'access_point';

    /** @var bool */
    protected $enabled = true;

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): AccessPoint
    {
        $this->enabled = $enabled;
        return $this;
    }
}
