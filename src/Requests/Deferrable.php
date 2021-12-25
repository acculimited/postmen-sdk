<?php

namespace Accu\Postmen\Requests;

interface Deferrable
{
    public function isDeferred(): bool;
    public function shouldDefer(bool $defer): Deferrable;
}
