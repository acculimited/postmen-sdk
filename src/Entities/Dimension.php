<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;

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

    public const JSON_SCHEMA = '/dimension';

    /** @var float */
    private $width;

    /** @var float */
    private $height;

    /** @var float */
    private $depth;

    /** @var string Unit of measure */
    private $unit;

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getDepth(): float
    {
        return $this->depth;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setWidth(float $width): Dimension
    {
        $this->width = $width;
        return $this;
    }

    public function setHeight(float $height): Dimension
    {
        $this->height = $height;
        return $this;
    }

    public function setDepth(float $depth): Dimension
    {
        $this->depth = $depth;
        return $this;
    }

    public function setUnit(string $unit): Dimension
    {
        $this->unit = $unit;
        return $this;
    }
}
