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

    /**@var string The description of the item */
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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Item
     */
    public function setDescription(string $description): Item
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param integer $quantity
     * @return Item
     */
    public function setQuantity(int $quantity): Item
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return Money
     */
    public function getPrice(): Money
    {
        return $this->price;
    }

    /**
     * @param Money $price
     * @return Item
     */
    public function setPrice(Money $price): Item
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return Weight
     */
    public function getWeight(): Weight
    {
        return $this->weight;
    }

    /**
     * @param Weight $weight
     * @return Item
     */
    public function setWeight(Weight $weight): Item
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemId(): string
    {
        return $this->item_id;
    }

    /**
     * @param string $item_id
     * @return Item
     */
    public function setItemId(string $item_id): Item
    {
        $this->item_id = $item_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginCountry(): string
    {
        return $this->origin_country;
    }

    /**
     * @param string $origin_country
     * @return Item
     */
    public function setOriginCountry(string $origin_country): Item
    {
        $this->origin_country = $origin_country;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return Item
     */
    public function setSku(string $sku): Item
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getHsCode(): string
    {
        return $this->hs_code;
    }

    /**
     * @param string $hs_code
     * @return Item
     */
    public function setHsCode(string $hs_code): Item
    {
        $this->hs_code = $hs_code;
        return $this;
    }
}
