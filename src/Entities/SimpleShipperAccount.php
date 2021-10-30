<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Schema\JsonSchema;
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
    use JsonSchema;

    public const JSON_SCHEMA = '/shipper_account_info';

    /** @var string Shipper ID */
    private $id;

    /** @var string Slug / shipper name */
    private $slug;

    /** @var string Shipper account description */
    private $description;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): SimpleShipperAccount
    {
        $this->id = $id;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): SimpleShipperAccount
    {
        $this->slug = $slug;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): SimpleShipperAccount
    {
        $this->description = $description;
        return $this;
    }

    public static function fromData(array $data): SimpleShipperAccount
    {
        return (new self())
            ->setId($data['id'] ?? [])
            ->setSlug($data['slug'] ?? [])
            ->setDescription($data['description'] ?? []);
    }
}
