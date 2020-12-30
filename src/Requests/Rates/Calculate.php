<?php

namespace Accu\Postmen\Requests\Rates;

use Accu\Postmen\Entities\Rate;
use Accu\Postmen\Entities\Reference;
use Accu\Postmen\Entities\Shipment;
use Accu\Postmen\Requests\Request;

class Calculate extends Request
{
    public const METHOD = 'POST';
    public const URI = 'rates';

    /** @var array */
    private $shipper_accounts;

    /** @var Shipment */
    private $shipment;

    public function __construct(Shipment $shipment, array $shippingAccounts = [])
    {
        parent::__construct();

        $this->shipment = $shipment;
        $this->shipper_accounts = $shippingAccounts;
    }

    public function jsonSerialize()
    {
        return [
            'async' => false,
            'is_document' => false,
            'shipper_accounts' => Reference::mapCollection($this->shipper_accounts),
            'shipment' => $this->shipment,
        ];
    }

    public function mapResponseData(array $json): array
    {
        $rates = [];

        foreach ($json['data']['rates'] ?? [] as $rate) {
            $rates[] = Rate::fromData($rate);
        }

        return $rates;
    }
}
