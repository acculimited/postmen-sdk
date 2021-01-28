<?php

namespace Accu\Postmen\Tests\Unit\Entities;

use Accu\Postmen\Entities\Address;
use PHPUnit\Framework\TestCase;
use Swaggest\JsonSchema\InvalidValue;

class AddressTest extends TestCase
{
    public function testBasicSchema()
    {
        $entity = (new Address())
            ->setCountry('GBR');

        self::assertJson(json_encode($entity));
    }

    public function testIncompleteAddress()
    {
        $entity = (new Address());

        $this->expectException(InvalidValue::class);
        json_encode($entity);
    }
}
