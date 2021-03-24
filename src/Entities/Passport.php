<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;

/**
 * @see https://docs.postmen.com/api.html#passport
 */
final class Passport extends PostmenEntity
{
    use JsonSchema;

    public const JSON_SCHEMA = '/passport';

    /** @var string */
    private $number;

    /** @var string */
    private $issue_date;

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): Passport
    {
        $this->number = $number;
        return $this;
    }

    public function getIssueDate(): string
    {
        return $this->issue_date;
    }

    public function setIssueDate(string $issue_date): Passport
    {
        $this->issue_date = $issue_date;
        return $this;
    }
}
