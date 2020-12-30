<?php

namespace Accu\Postmen\Exceptions;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class InvalidRequestException extends Exception
{
    public const META_ERROR_3001 = 3001;
    public const META_ERROR_4104 = 4104;
    public const META_ERROR_4105 = 4105;
    public const META_ERROR_4109 = 4109;
    public const SHIPPER_ACCOUNT_NOT_FOUND = 4140;
    public const META_ERROR_4153 = 4153;
    public const META_ERROR_4157 = 4157;
    public const META_ERROR_4163 = 4163;
    public const META_ERROR_4164 = 4164;
    public const META_ERROR_4171 = 4171;
    public const META_ERROR_4508 = 4508;
    public const META_ERROR_4703 = 4703;
    public const META_ERROR_4713 = 4713;
    public const META_ERROR_4715 = 4715;
    public const META_ERROR_4716 = 4716;
    public const META_ERROR_4722 = 4722;
    public const META_ERROR_4723 = 4723;
    public const META_ERROR_4724 = 4724;
    public const META_ERROR_4725 = 4725;
    public const META_ERROR_4733 = 4733;

    public const INVALID_REQUEST_ERRORS = [
        self::META_ERROR_3001,
        self::META_ERROR_4104,
        self::META_ERROR_4105,
        self::META_ERROR_4109,
        self::SHIPPER_ACCOUNT_NOT_FOUND,
        self::META_ERROR_4153,
        self::META_ERROR_4157,
        self::META_ERROR_4163,
        self::META_ERROR_4164,
        self::META_ERROR_4171,
        self::META_ERROR_4508,
        self::META_ERROR_4703,
        self::META_ERROR_4713,
        self::META_ERROR_4715,
        self::META_ERROR_4716,
        self::META_ERROR_4722,
        self::META_ERROR_4723,
        self::META_ERROR_4724,
        self::META_ERROR_4725,
        self::META_ERROR_4733
    ];

    /** @var RequestInterface */
    private $request;

    /** @var ResponseInterface */
    private $response;

    public function __construct(
        string $message,
        RequestInterface $request = null,
        ResponseInterface $response = null,
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->request = $request;
        $this->response = $response;
    }
}
