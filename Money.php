<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Utility\ISOCodes;
use Accu\Postmen\Utility\JsonSerializer;
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
    use JsonSerializer;

    /** @var float */
    private $amount;

    /** @var string ISO 4217 currency code */
    private $currency;

    /**
     * @return float
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Money
     */
    public function setAmount(float $amount): Money
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Must specify a positive monetary value');
        }

        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Money
     */
    public function setCurrency(?string $currency): Money
    {
        if (! ISOCodes::isValidCurrencyCode($currency)) {
            throw new InvalidArgumentException('Invalid ISO code.');
        }

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
