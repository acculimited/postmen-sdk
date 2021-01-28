<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;
use InvalidArgumentException;

/**
 * Dimension
 *
 * dimensions object specifying the parcel physical properties
 *
 * @package Dimension
 * @see https://docs.postmen.com/api.html#dimension
 */
final class Dimension extends PostmenEntity
{
    use JsonSchema;

    public const UNITS = [
        'cm' => 10,
        'in' => 25.4,
        'mm' => 1,
        'm' => 1000,
        'ft' => 304.8,
        'yd' => 914.4,
    ];

    /** @var float */
    private $width;

    /** @var float */
    private $height;

    /** @var float */
    private $depth;

    /** @var string Unit of measure */
    private $unit;

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @return float
     */
    public function getDepth(): float
    {
        return $this->depth;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @param float $width
     * @return Dimension
     */
    public function setWidth(float $width): Dimension
    {
        if ($width <= 0) {
            throw new InvalidArgumentException('Width must be a positive number.');
        }

        $this->width = $width;
        return $this;
    }

    /**
     * @param float $height
     * @return Dimension
     */
    public function setHeight(float $height): Dimension
    {
        if ($height <= 0) {
            throw new InvalidArgumentException('Height must be a positive number.');
        }

        $this->height = $height;
        return $this;
    }

    /**
     * @param float $depth
     * @return Dimension
     */
    public function setDepth(float $depth): Dimension
    {
        if ($depth <= 0) {
            throw new InvalidArgumentException('Depth must be a positive number.');
        }

        $this->depth = $depth;
        return $this;
    }

    /**
     * @param string $unit
     * @return Dimension
     */
    public function setUnit(string $unit): Dimension
    {
        if (! isset(self::UNITS[$unit])) {
            throw new InvalidArgumentException('Invalid unit specified, please use one from predefined options');
        }

        $this->unit = $unit;
        return $this;
    }
}
