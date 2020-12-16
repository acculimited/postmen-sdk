<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Utility\JsonSerializer;
use Accu\Postmen\Utility\PostmenEntity;
use DateTimeInterface;

final class Invoice extends PostmenEntity
{
    use JsonSerializer;

    /** @var string */
    private $date;

    /** @var string */
    private $number;

    /** @var string */
    private $type;

    /** @var int */
    private $number_of_copies;

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): Invoice
    {
        $this->date = $date;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): Invoice
    {
        $this->number = $number;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Invoice
    {
        $this->type = $type;
        return $this;
    }

    public function getNumberOfCopies(): int
    {
        return $this->number_of_copies;
    }

    public function setNumberOfCopies(int $number_of_copies): Invoice
    {
        $this->number_of_copies = $number_of_copies;
        return $this;
    }
}
