<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Utility\JsonSerializer;
use Accu\Postmen\Utility\PostmenEntity;

/**
 * Label
 *
 * @package Label
 * @see https://docs.postmen.com/api.html#a-label-object
 */
final class Label extends PostmenEntity
{
    use JsonSerializer;

    /**@var string Unique label identifier */
    private $id;

    /** @var string */
    private $status;

    /** @var string Date shipped in YYYY-MM-DD format */
    private $ship_date;

    /** @var string[] */
    private $tracking_numbers = [];

    /** @var Files */
    private $files;

    /** @var Rate */
    private $rate;

    /** @var string A formatted date */
    private $created_at;

    /** @var string A formatted date */
    private $updated_at;

    /** @var string[] */
    private $references = [];

    /** @var ShipperAccount */
    private $shipper_account;

    /** @var string */
    private $service_type;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Label
    {
        $this->id = $id;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): Label
    {
        $this->status = $status;
        return $this;
    }

    public function getShipDate(): string
    {
        return $this->ship_date;
    }

    public function setShipDate(string $ship_date): Label
    {
        $this->ship_date = $ship_date;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getTrackingNumbers(): array
    {
        return $this->tracking_numbers;
    }

    public function setTrackingNumbers(array $tracking_numbers): Label
    {
        $this->tracking_numbers = $tracking_numbers;
        return $this;
    }

    public function getFiles(): Files
    {
        return $this->files;
    }

    public function setFiles(Files $files): Label
    {
        $this->files = $files;
        return $this;
    }

    public function getRate(): Rate
    {
        return $this->rate;
    }

    public function setRate(Rate $rate): Label
    {
        $this->rate = $rate;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): Label
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): Label
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getReferences(): array
    {
        return $this->references;
    }

    public function addReference(string $reference): Label
    {
        $this->references[] = $reference;
        return $this;
    }

    public function getShipperAccount(): ShipperAccount
    {
        return $this->shipper_account;
    }

    public function setShipperAccount(ShipperAccount $shipper_account): Label
    {
        $this->shipper_account = $shipper_account;
        return $this;
    }

    public function getServiceType(): string
    {
        return $this->service_type;
    }

    public function setServiceType(string $service_type): Label
    {
        $this->service_type = $service_type;
        return $this;
    }

    public static function fromData(array $data): PostmenEntity
    {
        return (new self())
            ->setId($data['id'] ?? null)
            ->setStatus($data['status'] ?? null)
            ->setTrackingNumbers($data['tracking_numbers'] ?? null)
            ->setFiles(Files::fromData($data['files'] ?? []))
            ->setCreatedAt($data['created_at'] ?? null)
            ->setUpdatedAt($data['updated_at'] ?? null)
            ->setShipDate($data['ship_date'] ?? null)
            ->setShipperAccount((new ShipperAccount())
                ->setId($data['shipper_account']['id'] ?? null)
                ->setSlug($data['shipper_account']['slug'] ?? null)
                ->setDescription($data['shipper_account']['description'] ?? null)
            )
            ->setRate(Rate::fromData($data['rate'] ?? null))
            ->setServiceType($data['service_type'] ?? null);
    }
}
