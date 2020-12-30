<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Utility\JsonSerializer;
use Accu\Postmen\Utility\PostmenEntity;
use InvalidArgumentException;

/**
 * Weight
 *
 * weight object specifying the parcel physical properties
 *
 * @package Weight
 * @see https://docs.postmen.com/api.html#weight
 */
final class Weight extends PostmenEntity
{
    use JsonSerializer;

    public const ACCEPTABLE_UNITS = [
        'lb',
        'kg',
        'oz',
        'g',
    ];

    /** @var string Unit of measure */
    private $unit;

    /** @var float */
    private $value;

    /**
     * @return string
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     * @return Weight
     */
    public function setUnit(?string $unit): Weight
    {
        if (! in_array($unit, self::ACCEPTABLE_UNITS, true)) {
            throw new InvalidArgumentException('Invalid unit specified, please use one of the predefined options');
        }

        $this->unit = $unit;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return Weight
     */
    public function setValue(float $value): Weight
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Weight must have a positive value');
        }

        $this->value = $value;
        return $this;
    }

    public static function fromData(array $data): Weight
    {
        return (new self)
            ->setValue($data['value'] ?? null)
            ->setUnit($data['unit'] ?? null);
    }
}
