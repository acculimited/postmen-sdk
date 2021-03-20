<?php

namespace Accu\Postmen\Tests\Unit\Entities;

use Accu\Postmen\Entities\Address;
use Accu\Postmen\Exceptions\PostmenException;
use PHPUnit\Framework\TestCase;

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

        $this->expectException(PostmenException::class);
        json_encode($entity);
    }
}
