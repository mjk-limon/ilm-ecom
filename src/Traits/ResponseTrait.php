<?php

namespace Ilm\Ecom\Traits;

use Exception;

trait ResponseTrait
{
    const ERROR_RETURN_JSON = 1;

    const ERROR_RETURN_ARRAY = 2;

    protected $responseProvider;

    protected $response;

    protected $errors = [];

    public function setResponseProvider(string $provider)
    {
        $this->responseProvider = $provider;
    }

    protected function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    protected function setErrors($error)
    {
        $this->errors = $error;

        return $this;
    }

    protected function generateResponse()
    {
        // 
    }

    protected function generateErrorResponse(int $returnType = self::ERROR_RETURN_JSON)
    {
        $errors = $this->errors;

        if ($errors instanceof Exception) {
            $errors = ['error' => $errors->getCode(), 'hint' => $errors->getMessage()];
        }

        $errors = $errors + ['success' => false, 'error' => 0, 'hint' => ''];

        return $returnType === self::ERROR_RETURN_JSON
            ? json_encode($errors, JSON_PRETTY_PRINT)
            : $errors;
    }
}
