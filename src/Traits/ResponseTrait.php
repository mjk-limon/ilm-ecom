<?php

namespace Ilm\Ecom\Traits;

use Closure;
use Exception;

trait ResponseTrait
{
    protected $responseFile;

    protected $responseData;

    public static $defaultResponseProvider;

    protected $responseProvider;

    protected $responseOptions;

    protected $errors;

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
        if ($this->responseProvider) {
            return $this->responseProvider;
        }

        if (self::$defaultResponseProvider) {
            return self::$defaultResponseProvider;
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

        $module = isset($options['module']) && !empty($options['module'])
            ? $options['module'] . '/'
            : '';

        return $module . $file;
    }

    protected function generateResponse($options = [])
    {
        $provider = $this->getResponseProvider();
        $file = $this->getResponseFile($options);

        return $provider($file, $this->responseData);
    }

    protected function generateErrorResponse()
    {
        $errors = $this->errors;

        $this->responseFile = 'error';

        if ($errors instanceof Exception) {
            $this->responseFile = $errors->getCode();
            $errors = ['error' => $errors->getCode(), 'hint' => $errors->getMessage()];
        }

        if (!is_array($errors)) {
            $errors = ['hint' => $errors];
        }

        $this->responseData = $errors + ['success' => false, 'error' => 0, 'hint' => ''];

        return $this->generateResponse(['module' => 'errors']);
    }
}
