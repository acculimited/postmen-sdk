<?php

namespace Accu\Postmen\Requests\ShipperAccounts;

use Accu\Postmen\Entities\ShipperAccount;
use Accu\Postmen\Requests\Request;
use Accu\Postmen\Schema\JsonSchema;

/**
 * List all available shipper accounts.
 * @link https://docs.postmen.com/api.html#shipper-accounts-list-all-shipper-accounts
 */
class ListAll extends Request
{
    use JsonSchema;

    public const METHOD = 'GET';
    public const URI = 'shipper-accounts';

    /** @var string */
    private $slug;

    /** @var string */
    private $limit;

    /** @var string */
    private $next_token;

    public function getUri()
    {
        return \GuzzleHttp\Psr7\Uri::withQueryValues(parent::getUri(), ['slug' => $this->slug]);
    }

    public function setSlug(?string $slug): ListAll
    {
        $this->slug = $slug;
        return $this;
    }

    public function mapResponseData(array $json): array
    {
        $shippingAccounts = [];

        foreach ($json['data']['shipper_accounts'] ?? [] as $data) {
            $shippingAccounts[] = ShipperAccount::fromData($data);
        }

        return $shippingAccounts;
    }
}
