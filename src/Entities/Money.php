<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;
use InvalidArgumentException;

/**
 * Money
 *
 * Money object specifying the item / product value
 *
 * @package Money
 * @see https://docs.postmen.com/api.html#money
 */
final class Money extends PostmenEntity
{
    use JsonSchema;

    public const JSON_SCHEMA = '/money';

    /** @var float */
    private $amount;

    /** @var string ISO 4217 currency code */
    private $currency;

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): Money
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Must specify a positive monetary value');
        }

        $this->amount = $amount;
        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): Money
    {
        $this->currency = $currency;
        return $this;
    }

    public static function fromData(array $data): Money
    {
        return (new self)
            ->setAmount($data['amount'] ?? null)
            ->setCurrency($data['currency'] ?? null);
    }
}
