<?php

namespace Accu\Postmen\Requests\Labels;

use Accu\Postmen\Entities\Billing;
use Accu\Postmen\Entities\Customs;
use Accu\Postmen\Entities\Invoice;
use Accu\Postmen\Entities\Label;
use Accu\Postmen\Entities\ServiceOptions\ServiceOption;
use Accu\Postmen\Entities\Shipment;
use Accu\Postmen\Entities\ShipperAccount;
use Accu\Postmen\Requests\Request;
use Accu\Postmen\Utility\PostmenEntity;
use Accu\Postmen\Schema\JsonSchema;

/**
 * Builds a Label\Create request.
 * @package Accu\Postmen\Requests\Labels
 * @link https://docs.postmen.com/api.html#labels-create-a-label
 */
class Create extends Request
{
    use JsonSchema;

    public const JSON_SCHEMA = '/label#/links/0/schema';

    public const METHOD = 'POST';
    public const URI = 'labels';

    /** @var bool */
    private $async = false;

    /** @var bool */
    private $is_document = false;

    /** @var Billing */
    private $billing;

    /** @var string|null */
    private $order_number;

    /** @var string */
    private $paper_size = 'default';

    /** @var string[] */
    private $references = [];

    /** @var bool */
    private $return_shipment = false;

    /** @var string */
    private $service_type;

    /** @var ShipperAccount */
    private $shipper_account;

    /** @var Shipment */
    private $shipment;

    /** @var Customs */
    private $customs;

    /** @var Invoice */
    private $invoice;

    /** @var string */
    private $ship_date;

    /** @var array */
    private $service_options = [];

    public function getShipperAccount(): ShipperAccount
    {
        return $this->shipper_account;
    }

    public function setShipperAccount(ShipperAccount $shipper_account): Create
    {
        $this->shipper_account = $shipper_account;
        return $this;
    }

    public function getShipment(): ?Shipment
    {
        return $this->shipment;
    }

    public function setShipment(Shipment $shipment): Create
    {
        $this->shipment = $shipment;
        return $this;
    }

    public function isReturnShipment(): bool
    {
        return $this->return_shipment;
    }

    public function setReturnShipment(bool $return_shipment): Create
    {
        $this->return_shipment = $return_shipment;
        return $this;
    }

    public function isDocument(): bool
    {
        return $this->is_document;
    }

    public function setIsDocument(bool $is_document): Create
    {
        $this->is_document = $is_document;
        return $this;
    }

    public function getBilling(): ?Billing
    {
        return $this->billing;
    }

    public function setBilling(Billing $billing): Create
    {
        $this->billing = $billing;
        return $this;
    }

    public function getServiceType(): ?string
    {
        return $this->service_type;
    }

    public function setServiceType(string $service_type): Create
    {
        $this->service_type = $service_type;
        return $this;
    }

    public function getPaperSize(): string
    {
        return $this->paper_size;
    }

    public function setPaperSize(string $paper_size): Create
    {
        $this->paper_size = $paper_size;
        return $this;
    }

    public function getOrderNumber(): ?string
    {
        return $this->order_number;
    }

    public function setOrderNumber(string $order_number): Create
    {
        $this->order_number = $order_number;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getReferences(): array
    {
        return $this->references;
    }

    public function addReference(?string $reference): Create
    {
        if ($reference) {
            $this->references[] = $reference;
        }

        return $this;
    }

    public function getCustoms(): ?Customs
    {
        return $this->customs;
    }

    public function setCustoms(Customs $customs): Create
    {
        $this->customs = $customs;
        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(Invoice $invoice): Create
    {
        $this->invoice = $invoice;
        return $this;
    }

    public function getShipDate(): ?string
    {
        return $this->ship_date;
    }

    public function setShipDate(string $ship_date): Create
    {
        $this->ship_date = $ship_date;
        return $this;
    }

    public function addServiceOption(ServiceOption $serviceOption): Create
    {
        $this->service_options[] = $serviceOption;
        return $this;
    }

    /**
     * @return ServiceOption[]
     */
    public function getServiceOptions(): array
    {
        return $this->service_options;
    }

    /**
     * @param array $json
     * @return PostmenEntity|Label
     */
    public function mapResponseData(array $json): PostmenEntity
    {
        return Label::fromData($json['data'] ?? []);
    }
}
