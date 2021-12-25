<?php

namespace Accu\Postmen\Requests;

trait Deferred
{
    /** @var bool */
    private $async = false;

    public function isDeferred(): bool
    {
        return $this->async;
    }

    public function shouldDefer(bool $defer): Deferrable
    {
        $this->async = $defer;
        return $this;
    }
}
