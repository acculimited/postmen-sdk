<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;

/**
 * Rate
 *
 * Quotes for delivery services
 *
 * @package Rate
 * @see https://docs.postmen.com/api.html#rate-type
 */
final class Rate extends PostmenEntity
{
    use JsonSchema;

    public const JSON_SCHEMA = '/rate';

    /** @var Weight Charge weight */
    private $charge_weight;

    /** @var Money Charge for this rate */
    private $total_charge;

    /** @var SimpleShipperAccount Simplified shipper info */
    private $simple_shipper_account;

    /** @var string Service type */
    private $service_type;

    /** @var string Service name */
    private $service_name;

    /** @var string Pickup deadline */
    private $pickup_deadline;

    /** @var string */
    private $booking_cut_off;

    /** @var string */
    private $delivery_date;

    /** @var int Number of days in transit */
    private $transit_time;

    /** @var DetailedCharge[] */
    private $detailed_charges = [];

    /** @var string */
    private $error_message;

    /** @var string */
    private $info_message;

    public function getChargeWeight(): ?Weight
    {
        return $this->charge_weight;
    }

    public function setChargeWeight(?Weight $charge_weight): Rate
    {
        $this->charge_weight = $charge_weight;
        return $this;
    }

    public function getTotalCharge(): ?Money
    {
        return $this->total_charge;
    }

    public function setTotalCharge(?Money $total_charge): Rate
    {
        $this->total_charge = $total_charge;
        return $this;
    }

    public function getSimpleShipperAccount(): ?SimpleShipperAccount
    {
        return $this->simple_shipper_account;
    }

    public function setSimpleShipperAccount(?SimpleShipperAccount $simple_shipper_account): Rate
    {
        $this->simple_shipper_account = $simple_shipper_account;
        return $this;
    }

    public function getServiceType(): ?string
    {
        return $this->service_type;
    }

    public function setServiceType(?string $service_type): Rate
    {
        $this->service_type = $service_type;
        return $this;
    }

    public function getServiceName(): ?string
    {
        return $this->service_name;
    }

    public function setServiceName(?string $service_name): Rate
    {
        $this->service_name = $service_name;
        return $this;
    }

    public function getPickupDeadline(): ?string
    {
        return $this->pickup_deadline;
    }

    public function setPickupDeadline(?string $pickup_deadline): Rate
    {
        $this->pickup_deadline = $pickup_deadline;
        return $this;
    }

    public function getBookingCutOff(): ?string
    {
        return $this->booking_cut_off;
    }

    public function setBookingCutOff(?string $booking_cut_off): Rate
    {
        $this->booking_cut_off = $booking_cut_off;
        return $this;
    }

    public function getDeliveryDate(): ?string
    {
        return $this->delivery_date;
    }

    public function setDeliveryDate(?string $delivery_date): Rate
    {
        $this->delivery_date = $delivery_date;
        return $this;
    }

    public function getTransitTime(): ?int
    {
        return $this->transit_time;
    }

    public function setTransitTime(?int $transit_time): Rate
    {
        $this->transit_time = $transit_time;
        return $this;
    }

    /**
     * @return DetailedCharge[]
     */
    public function getDetailedCharges(): array
    {
        return $this->detailed_charges;
    }

    public function addDetailedCharge(?DetailedCharge $detailed_charge): Rate
    {
        $this->detailed_charges[] = $detailed_charge;
        return $this;
    }

    public function getErrorMessage(): ?string
    {
        return $this->error_message;
    }

    public function setErrorMessage(?string $error_message): Rate
    {
        $this->error_message = $error_message;
        return $this;
    }

    public function getInfoMessage(): ?string
    {
        return $this->info_message;
    }

    public function setInfoMessage(?string $info_message): Rate
    {
        $this->info_message = $info_message;
        return $this;
    }

    public static function fromData(array $data): Rate
    {
        $entity = (new self)
            ->setSimpleShipperAccount(SimpleShipperAccount::fromData($data['shipper_account'] ?? []))
            ->setServiceType($data['service_type'] ?? null)
            ->setServiceName($data['service_name'] ?? null)
            ->setPickupDeadline($data['pickup_deadline'] ?? null)
            ->setBookingCutoff($data['booking_cut_off'] ?? null)
            ->setDeliveryDate($data['delivery_date'] ?? null)
            ->setTransitTime($data['transit_time'] ?? null)
            ->setErrorMessage($data['error_message'] ?? null)
            ->setInfoMessage($data['info_message'] ?? null);

        if ($data['charge_weight'] ?? false) {
            $entity->setChargeWeight(Weight::fromData($data['charge_weight']));
        }

        if ($data['total_charge'] ?? false) {
            $entity->setTotalCharge(Money::fromData($data['total_charge']));
        }

        foreach ($data['detailed_charges'] ?? [] as $detailed_charge) {
            $entity->addDetailedCharge(DetailedCharge::fromData($detailed_charge));
        }

        return $entity;
    }
}
