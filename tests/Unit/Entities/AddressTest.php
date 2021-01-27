<?php

namespace Accu\Postmen\Tests\Unit\Entities;

use Accu\Postmen\Entities\Address;
use Accu\Postmen\Utility\Schema\RemoteRefProvider;
use PHPUnit\Framework\TestCase;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;

class AddressTest extends TestCase
{
    public function testBasicSchema()
    {
        $entity = (new Address())
            ->setCountry('GBR');

        $schema = Schema::import(
            '/address',
            new Context(new RemoteRefProvider(__DIR__ . '/../../../resources/schema/com.postmen.api/'))
        );

        /** @var \Swaggest\JsonSchema\Structure\ObjectItem $validated */
        $validated = $schema->in((object) $entity->jsonSerialize());

        self::assertJson(json_encode($validated));
    }
}
