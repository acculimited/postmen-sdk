<?php

namespace Accu\Postmen\Events;

use Accu\Postmen\Entities\Label;
use Accu\Postmen\Entities\Rate;
use Accu\Postmen\Exceptions\PostmenException;

class EventFactory
{
    public static function fromWebhook(array $json)
    {
        $type = $json['event'] ?? null;

        if (! $type) {
            throw new PostmenException('Unable to decode webhook payload.');
        }

        if ($type === 'calculate_rates') {
            $rates = [];

            foreach ($json['data']['rates'] as $data) {
                $rates[] = Rate::fromData($data);
            }

            return new RatesCalculated($rates);
        }

        if ($type === 'create_a_label') {
            return new LabelCreated(
                Label::fromData($json['data'])
            );
        }

        return new WebhookReceived($json);
    }
}
