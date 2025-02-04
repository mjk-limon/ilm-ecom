<?php

namespace Ilm\Ecom\Traits;

use Exception;

trait HasErrors
{
    const ERROR_RETURN_JSON = 1;
    const ERROR_RETURN_ARRAY = 2;

    protected $errors = [];

    public function setErrors($error)
    {
        $this->errors = $error;
        return $this;
    }

    public function generateErrorResponse(int $returnType = self::ERROR_RETURN_JSON)
    {
        $errors = $this->errors;

        if ($errors instanceof Exception) {
            $errors = [$errors->getMessage()];
        }

        return $returnType === self::ERROR_RETURN_JSON
            ? json_encode($errors, JSON_PRETTY_PRINT)
            : $errors;
    }
}
