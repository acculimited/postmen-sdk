<?php

namespace Accu\Postmen\Utility;

trait JsonSerializer
{
    /**
     * This method can access private instance variables as it is defined as part of a trait.
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this), static function ($value) {
            if ($value === null || $value === [] || $value === '') {
                return false;
            }

            return true;
        });
    }
}
