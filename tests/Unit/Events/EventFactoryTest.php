<?php

namespace Accu\Postmen\Tests\Unit\Events;

use Accu\Postmen\Entities\Label;
use Accu\Postmen\Entities\Rate;
use Accu\Postmen\Events\EventFactory;
use Accu\Postmen\Events\LabelCreated;
use Accu\Postmen\Events\RatesCalculated;
use Accu\Postmen\Events\WebhookReceived;
use Accu\Postmen\Exceptions\PostmenException;
use PHPUnit\Framework\TestCase;

class EventFactoryTest extends TestCase
{
    public function testInvalidWebhookEnvelope()
    {
        $this->expectException(PostmenException::class);

        EventFactory::fromWebhook([
            'meta' => [],
            'data' => [],
        ]);
    }

    public function testReceivesGenericWebhookReceivedEvent()
    {
        $json = [
            'event' => 'test-case',
            'meta' => [],
            'data' => [
                'content' => 'testing',
            ],
        ];

        $event = EventFactory::fromWebhook($json);
        self::assertInstanceOf(WebhookReceived::class, $event);
        self::assertEquals('testing', $event->data()['data']['content']);
    }

    public function testDecodesCalculateRatesWebhookPayload()
    {
        $json = \GuzzleHttp\Utils::jsonDecode(
            \file_get_contents(__DIR__ . '/../../resources/webhooks-calculate-rates.json'),
            true
        );

        $event = EventFactory::fromWebhook($json);
        self::assertInstanceOf(RatesCalculated::class, $event);

        $rates = $event->data();
        self::assertIsArray($rates);
        self::assertCount(1, $rates);

        $rate = $rates[0];
        self::assertInstanceOf(Rate::class, $rate);
        self::assertEquals('fedex', $rate->getSimpleShipperAccount()->getSlug());
    }

    public function testDecodesCreateLabelWebhookPayload()
    {
        $json = \GuzzleHttp\Utils::jsonDecode(
            \file_get_contents(__DIR__ . '/../../resources/webhooks-create-label.json'),
            true
        );

        $event = EventFactory::fromWebhook($json);
        self::assertInstanceOf(LabelCreated::class, $event);

        $label = $event->data();
        self::assertInstanceOf(Label::class, $label);
        self::assertEquals('3318b97b-150f-4205-840d-a6d966b9e0ea', $label->getId());
        self::assertEquals(['3884930103'], $label->getTrackingNumbers());
    }
}
