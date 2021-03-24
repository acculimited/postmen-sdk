<?php

namespace Accu\Postmen\Entities\ServiceOptions;

use Accu\Postmen\Schema\JsonSchema;
use Accu\Postmen\Utility\PostmenEntity;

/**
 * Abstract service options object
 *
 * @package ServiceOptions\ServiceOption
 * @see https://docs.postmen.com/api.html#service-option
 */
abstract class ServiceOption extends PostmenEntity
{
    use JsonSchema;
}
