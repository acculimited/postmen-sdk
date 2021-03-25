<?php

namespace Accu\Postmen\Tests\Unit\Requests\ShipperAccounts;

use Accu\Postmen\Entities\ShipperAccount;
use Accu\Postmen\Requests\ShipperAccounts\ListAll;
use PHPUnit\Framework\TestCase;

class ListAllTest extends TestCase
{
    /** @test */
    public function request_validates_schema()
    {
        $listAll = new ListAll();
        $payload = json_encode($listAll);

        self::assertIsObject(json_decode($payload));
    }

    /** @test */
    public function can_retrieve_all_shipper_accounts()
    {
        $schema = json_decode(
            file_get_contents(__DIR__ . '/../../../../resources/schemas/com.postmen.api/shipper_account.json'),
            true
        );

        $listAll = (new ListAll())
            ->mapResponseData($schema['links'][2]['live_example']['response']);

        self::assertIsArray($listAll);

        foreach ($listAll as $item) {
            self::assertInstanceOf(ShipperAccount::class, $item);
        }
    }
}
