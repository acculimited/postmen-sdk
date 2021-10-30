<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;

/**
 * DetailedCharge
 *
 * A Charge as a part of breakdown of rate price
 *
 * @package DetailedCharge
 * @see https://docs.postmen.com/api.html#detailed-charges
 */
final class DetailedCharge extends PostmenEntity
{
    use JsonSchema;

    public const JSON_SCHEMA = '/detailed_charges';

    /** @var Money Object with charge details */
    private $charge;

    /** @var string Detailed charges e.g. base, tax, fuel, discount etc. */
    private $type;

    public function getCharge(): ?Money
    {
        return $this->charge;
    }

    public function setCharge(?Money $charge): DetailedCharge
    {
        $this->charge = $charge;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): DetailedCharge
    {
        $this->type = $type;
        return $this;
    }

    public static function fromData(array $data): DetailedCharge
    {
        return (new self())
            ->setCharge(Money::fromData($data['charge'] ?? []))
            ->setType($data['type'] ?? null);
    }
}
