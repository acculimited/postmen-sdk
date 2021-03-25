<?php

namespace Accu\Postmen\Schema;

use Accu\Postmen\Exceptions\PostmenException;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Exception as SchemaException;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;

trait JsonSchema
{
    public function jsonSerialize()
    {
        if (! defined('static::JSON_SCHEMA')) {
            throw new PostmenException(static::class . ' must define a public JSON_SCHEMA.');
        }

        try {
            static $schema = null;

            if (! $schema) {
                $schema = Schema::import(static::JSON_SCHEMA, new Context(
                    new RefProvider(__DIR__ . '/../../resources/schemas/com.postmen.api')
                ));
            }

            // Casting as an (object) does not work recursively here.
            $validated = $schema->in(json_decode(
                json_encode((object) $this->toArray()),
                false
            ));
        } catch (InvalidValue $exception) {
            throw new PostmenException(
                "Data failed JSON schema validation for [{$exception->getSchemaPointer()}]",
                $exception->getCode(),
                $exception
            );
        } catch (SchemaException $exception) {
            throw new PostmenException('JSON schema validation failed', $exception->getCode(), $exception);
        }

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
