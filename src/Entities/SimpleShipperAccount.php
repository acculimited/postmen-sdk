<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Utility\JsonSerializer;
use Accu\Postmen\Utility\PostmenEntity;

/**
 * SimpleShipperAccount
 *
 * Shipper details returned with rates
 *
 * @package SimpleShipperAccount
 * https://docs.postmen.com/api.html#shipper-account-information
 */
final class SimpleShipperAccount extends PostmenEntity
{
    use JsonSerializer;

    /** @var string Shipper ID */
    private $id;

    /** @var string Slug / shipper name */
    private $slug;

    /** @var string Shipper account description */
    private $description;

    /**
     * @return string
     */
    function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string
     * @return SimpleShipperAccount
     */
    public function setId(?string $id): SimpleShipperAccount
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string
     * @return SimpleShipperAccount
     */
    public function setSlug(?string $slug): SimpleShipperAccount
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return SimpleShipperAccount
     */
    public function setDescription(?string $description): SimpleShipperAccount
    {
        $this->description = $description;
        return $this;
    }

    public static function fromData(array $data): SimpleShipperAccount
    {
        return (new self)
            ->setId($data['id'] ?? [])
            ->setSlug($data['slug'] ?? [])
            ->setDescription($data['description'] ?? []);
    }
}
