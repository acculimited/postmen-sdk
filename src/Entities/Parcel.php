<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;

/**
 * Parcel
 *
 * a box or envelope representing a parcel to be delivered
 *
 * @package Parcel
 * @see https://docs.postmen.com/api.html#parcel
 */
final class Parcel extends PostmenEntity
{
    use JsonSchema;

    /** @var string Type of box / envelope for packaging */
    private $box_type;

    /** @var Dimension Represents physical properties of the parcel */
    private $dimension;

    /** @var Item[] */
    private $items = [];

    /** @var string The description of the parcel */
    private $description;

    /** @var Weight */
    private $weight;

    public function getBoxType(): string
    {
        return $this->box_type;
    }

    public function setBoxType(string $box_type): Parcel
    {
        $this->box_type = $box_type;
        return $this;
    }

    public function getDimension(): Dimension
    {
        return $this->dimension;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getWeight(): Weight
    {
        return $this->weight;
    }

    public function setWeight(Weight $weight): Parcel
    {
        $this->weight = $weight;
        return $this;
    }

    public function setDimension(Dimension $dimension): Parcel
    {
        $this->dimension = $dimension;
        return $this;
    }

    public function setDescription(string $description): Parcel
    {
        $this->description = $description;
        return $this;
    }

    public function addItem(Item $item): Parcel
    {
        $this->items[] = $item;
        return $this;
    }
}
