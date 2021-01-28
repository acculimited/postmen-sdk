<?php

namespace Accu\Postmen\Schema;

use Accu\Postmen\Exceptions\PostmenException;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;

trait JsonSchema
{
    public function jsonSerialize()
    {
        if (! defined('static::JSON_SCHEMA')) {
            throw new PostmenException(static::class . ' must define a public JSON_SCHEMA.');
        }

        $schema = Schema::import(static::JSON_SCHEMA, new Context(
            new RefProvider(__DIR__ . '/../../resources/schemas/com.postmen.api')
        ));

        // Casting as an (object) does not work recursively here.
        $validated = $schema->in(json_decode(
            json_encode($this->toArray()),
            false
        ));

        return $validated->jsonSerialize();
    }

    public function toArray(): array
    {
        return array_filter(get_object_vars($this), static function ($value) {
            if ($value === null || $value === [] || $value === '') {
                return false;
            }

            return true;
        });
    }
}