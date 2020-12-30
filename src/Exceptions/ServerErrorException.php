<?php

namespace Accu\Postmen\Exceptions;

class ServerErrorException extends PostmenException
{
    public const STATUS_ERROR_500 = 500;
    public const STATUS_ERROR_502 = 502;
    public const STATUS_ERROR_503 = 503;
    public const STATUS_ERROR_504 = 504;

    public const SERVER_ERRORS = [
        self::STATUS_ERROR_500,
        self::STATUS_ERROR_502,
        self::STATUS_ERROR_503,
        self::STATUS_ERROR_504
    ];
}
