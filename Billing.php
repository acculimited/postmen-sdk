<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Utility\JsonSerializer;
use Accu\Postmen\Utility\PostmenEntity;
use InvalidArgumentException;

/**
 * @see https://docs.postmen.com/api.html#billing
 */
final class Billing extends PostmenEntity
{
    use JsonSerializer;

    public const PAID_BY_OPTIONS = [
        'shipper',
        'recipient',
        'third_party',
    ];

    /** @var string */
    private $paid_by;

    public function getPaidBy(): string
    {
        return $this->paid_by;
    }

    public function setPaidBy(string $paid_by): Billing
    {
        if (! in_array($paid_by, static::PAID_BY_OPTIONS)) {
            throw new InvalidArgumentException("Invalid paid by option: [$paid_by]");
        }

        $this->paid_by = $paid_by;
        return $this;
    }
}
