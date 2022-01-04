<?php

namespace Accu\Postmen\Events;

use Accu\Postmen\Entities\Label;

class LabelCreated implements Event
{
    /** @var Label */
    private $label;

    public function __construct(Label $label)
    {
        $this->label = $label;
    }

    public function data(): Label
    {
        return $this->label;
    }
}
