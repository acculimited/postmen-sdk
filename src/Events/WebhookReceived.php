<?php

namespace Accu\Postmen\Events;

class WebhookReceived implements Event
{
    /** @var array */
    private $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function data(): array
    {
        return $this->payload;
    }
}
