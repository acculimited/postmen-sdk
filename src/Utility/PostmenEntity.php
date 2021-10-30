<?php

namespace Accu\Postmen\Utility;

use JsonSerializable;

abstract class PostmenEntity implements JsonSerializable
{
    /**
     * @param array $data
     * @return PostmenEntity
     */
    public static function fromData(array $data)
    {
        return new static();
    }
}
