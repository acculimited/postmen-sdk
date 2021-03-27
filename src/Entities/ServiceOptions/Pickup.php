<?php

namespace Accu\Postmen\Entities\ServiceOptions;

final class Pickup extends ServiceOption
{
    public const JSON_SCHEMA = '/service_option_pickup';

    /** @var string */
    protected $type = 'pickup';

    /** @var string */
    protected $start_time;

    /** @var string */
    protected $end_time;

    public function getStartTime(): string
    {
        return $this->start_time;
    }

    public function setStartTime(string $startTime): Pickup
    {
        $this->start_time = $startTime;
        return $this;
    }

    public function getEndTime(): string
    {
        return $this->end_time;
    }

    public function setEndTime(string $endTime): Pickup
    {
        $this->end_time = $endTime;
        return $this;
    }
}
