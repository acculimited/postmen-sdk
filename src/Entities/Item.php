<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;

/**
 * Item
 *
 * Item object describes products within parcel
 *
 * @package Item
 * @see https://docs.postmen.com/api.html#item
 */
final class Item extends PostmenEntity
{
    use JsonSchema;

    public const JSON_SCHEMA = '/item';

    /** @var string The description of the item */
    private $description;

    /** @var int The quantity for the item (Minimum: 1) */
    private $quantity;

    /** @var Money */
    private $price;

    /** @var Weight */
    private $weight;

    /** @var string The ID of the item */
    private $item_id;

    /** @var string Country in ISO 3166-1 alpha 3 code */
    private $origin_country;

    /** @var string The SKU of the item */
    private $sku;

    /** @var string The HS Code (Harmonized Commodity Description and Coding System) of the item */
    private $hs_code;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Item
    {
        $this->description = $description;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): Item
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function setPrice(Money $price): Item
    {
        $this->price = $price;
        return $this;
    }

    public function getWeight(): Weight
    {
        return $this->weight;
    }

    public function setWeight(Weight $weight): Item
    {
        $this->weight = $weight;
        return $this;
    }

    public function getItemId(): string
    {
        return $this->item_id;
    }

    public function setItemId(string $item_id): Item
    {
        $this->item_id = $item_id;
        return $this;
    }

    public function getOriginCountry(): string
    {
        return $this->origin_country;
    }

    public function setOriginCountry(string $origin_country): Item
    {
        $this->origin_country = $origin_country;
        return $this;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): Item
    {
        $this->sku = $sku;
        return $this;
    }

    public function getHsCode(): string
    {
        return $this->hs_code;
    }

    public function setHsCode(string $hs_code): Item
    {
        $this->hs_code = $hs_code;
        return $this;
    }
}
