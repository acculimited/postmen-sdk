<?php

namespace Accu\Postmen\Entities;

use Accu\Postmen\Utility\PostmenEntity;
use InvalidArgumentException;

/**
 * Reference to another object
 *
 * @see https://docs.postmen.com/api.html#reference
 */
final class Reference extends PostmenEntity
{
    /** @var PostmenEntity|mixed */
    private $entity;

    public function getEntity()
    {
        return $this->entity;
    }

    public function setEntity($entity): Reference
    {
        if (! method_exists($entity, 'getId')) {
            throw new InvalidArgumentException('Expected an object with a getId() method.');
        }

        $this->entity = $entity;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getEntity()->getId(),
        ];
    }

    public static function fromEntity($entity)
    {
        return (new static)->setEntity($entity);
    }

    public static function mapCollection(array $collection)
    {
        return array_map(static function ($item) {
            return Reference::fromEntity($item);
        }, $collection);
    }
}
