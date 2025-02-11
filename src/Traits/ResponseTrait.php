<?php

namespace Ilm\Ecom\Traits;

use Closure;
use Exception;

trait ResponseTrait
{
    const ERROR_RETURN_JSON = 1;

    const ERROR_RETURN_ARRAY = 2;

    protected $responseFile;

    protected $responseData;

    public static $defaultResponseProvider;

    protected $responseProvider;

    protected $responseOptions;

    protected $errors = [];

    protected function setResponseFile($file)
    {
        $this->responseFile = $file;

        return $this;
    }

    protected function setResponseData($data)
    {
        $this->responseData = $data;

        return $this;
    }

    protected function setErrors($error)
    {
        $this->errors = $error;

        return $this;
    }

    public function setResponseProvider(Closure $provider)
    {
        $this->responseProvider = $provider;

        return $this;
    }

    public function setResponseOptions(array $options)
    {
        $this->responseOptions = $options;

        return $this;
    }

    private function getResponseProvider()
    {
        if (self::$defaultResponseProvider) {
            return self::$defaultResponseProvider;
        }

        if ($this->responseProvider) {
            return $this->responseProvider;
        }

        return Closure::fromCallable(function ($blade, $data) {
            return view($blade, $data);
        });
    }

    private function getResponseFile($options)
    {
        $file = $this->responseFile;
        $options = array_merge($this->responseOptions, $options);

        if ($custom = $options['customs'][$file] ?? '') {
            return $custom;
        }

        if (!($default = $options['defaults'][$file] ?? '')) {
            return '';
        }

        $module = $options['module'] ?? '';
        return $module . '/' . $default;
    }

    protected function generateResponse($options = [])
    {
        $provider = $this->getResponseProvider();
        $file = $this->getResponseFile($options);

        return $provider($file, $this->responseData);
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
