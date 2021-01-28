<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Utility\PostmenEntity;
use Accu\Postmen\Schema\JsonSchema;

/**
 * ShipperAccount
 *
 * Shipper details returned with rates
 *
 * @package ShipperAccount
 * https://docs.postmen.com/api.html#a-shipper_account-object
 */
final class ShipperAccount extends PostmenEntity
{
    use JsonSchema;

    public const JSON_SCHEMA = '/shipper_account';

    /** @var string Shipper ID */
    private $id;

    /** @var Address The address of the shipper */
    private $address;

    /** @var string Slug / shipper name */
    private $slug;

    /** @var string */
    private $status;

    /** @var string */
    private $description;

    /** @var string */
    private $type;

    /** @var string */
    private $timezone;

    /** @var string */
    private $created_at;

    /** @var string */
    private $updated_at;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(?string $id): ShipperAccount
    {
        $this->id = $id;
        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): ShipperAccount
    {
        $this->address = $address;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): ShipperAccount
    {
        $this->slug = $slug;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): ShipperAccount
    {
        $this->status = $status;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): ShipperAccount
    {
        $this->description = $description;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): ShipperAccount
    {
        $this->type = $type;
        return $this;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(?string $timezone): ShipperAccount
    {
        $this->timezone = $timezone;
        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(?string $created_at): ShipperAccount
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?string $updated_at): ShipperAccount
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public static function fromData(array $data): ShipperAccount
    {
        return (new self)
            ->setId($data['id'] ?? null)
            ->setAddress(Address::fromData($data['address'] ?? []))
            ->setSlug($data['slug'] ?? null)
            ->setStatus($data['status'] ?? null)
            ->setDescription($data['description'] ?? null)
            ->setType($data['type'] ?? null)
            ->setTimezone($data['timezone'] ?? null)
            ->setCreatedAt($data['created_at'] ?? null)
            ->setUpdatedAt($data['updated_at'] ?? null);
    }
}
