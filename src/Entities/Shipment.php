<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Utility\JsonSerializer;
use Accu\Postmen\Utility\PostmenEntity;

/**
 * @package Shipment
 * @see https://docs.postmen.com/api.html#shipment
 */
final class Shipment extends PostmenEntity
{
    use JsonSerializer;

    /** @var Parcel[] */
    private $parcels = [];

    /** @var Address */
    private $ship_from;

    /** @var Address */
    private $ship_to;

    /** @var Address */
    private $return_to;

    /** @var string Delivery instruction for carrier */
    private $delivery_instructions;

    /**
     * @return Parcel[]
     */
    public function getParcels(): array
    {
        return $this->parcels;
    }

    public function addParcel(Parcel $parcel): Shipment
    {
        $this->parcels[] = $parcel;
        return $this;
    }

    public function getShipFrom(): Address
    {
        return $this->ship_from;
    }

    public function setShipFrom(Address $ship_from): Shipment
    {
        $this->ship_from = $ship_from;
        return $this;
    }

    public function getShipTo(): Address
    {
        return $this->ship_to;
    }

    public function setShipTo(Address $ship_to): Shipment
    {
        $this->ship_to = $ship_to;
        return $this;
    }

    public function getReturnTo(): Address
    {
        return $this->return_to;
    }

    public function setReturnTo(Address $return_to): Shipment
    {
        $this->return_to = $return_to;
        return $this;
    }

    public function getDeliveryInstructions(): ?string
    {
        return $this->delivery_instructions;
    }

    public function setDeliveryInstructions(string $delivery_instructions): Shipment
    {
        $this->delivery_instructions = $delivery_instructions ?: null;
        return $this;
    }
}
