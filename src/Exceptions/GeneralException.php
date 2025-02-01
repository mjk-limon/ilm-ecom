<?php

namespace Ilm\Ecom\Exceptions;

class GeneralException extends IlmException
{
    const CLIENT_NOT_FOUND = 0x101;
    const CLIENT_CREDENTIALS_ERROR = 0x102;

    const HTTP_REQUEST_ERROR = 0x201;

    protected $msg = [
        257 => 'Clent ID and Client Secret is not initialized',
        258 => 'Invalid Clent ID or Secret',
        513 => 'Couldn\'t connect to api server',
    ];

    public function __construct(int $code)
    {
        parent::__construct(
            'General Error. ' . $this->msg[$code] ?? '',
            $code
        );
    }

    public static function make(int $code)
    {
        return new static($code);
    }
}
