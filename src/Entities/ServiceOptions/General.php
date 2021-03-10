<?php

namespace Accu\Postmen\Entities\ServiceOptions;

class General extends ServiceOption
{
    /** @var string */
    protected $type;

    /** @var bool */
    protected $enabled = true;

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): General
    {
        $this->type = $type;
        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): General
    {
        $this->enabled = $enabled;
        return $this;
    }
}
