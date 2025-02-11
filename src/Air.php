<?php

namespace Ilm\Ecom;

use BadMethodCallException;
use Ilm\Ecom\Traits\Modulable;
use Ilm\Ecom\Traits\ResponseTrait;

/**
 * @method \Illuminate\Http\Client\Response get(string $url, $query = null)
 * @method \Illuminate\Http\Client\Response post(string $url, $data = [])
 * @method \Illuminate\Http\Client\Response put(string $url, $data = [])
 * @method \Illuminate\Http\Client\Response delete(string $url, $data = [])
 */
class Air extends IlmComm
{
    use ResponseTrait,
        Modulable;

    public $version = 'v1';

    public function __call($name, $arguments)
    {
        if (in_array($name, ['get', 'post', 'put', 'delete'])) {
            return $this->request($name, array_shift($arguments), $arguments);
        }

        throw new BadMethodCallException;
    }

    private function request(string $method, string $path, array $args)
    {
        if ($cached = $this->cached($method, $path, $args, $this->cachePrefix)) {
            return $cached;
        }

        $http = $this->authorizedHttp();
        $this->httpAppendModuleUri($http);

        return $http->{$method}($path, ...$args);
    }

    public function response($file, $data = [], $responseOptions)
    {
        return $this->setResponseFile($file)
            ->setResponseData($data)
            ->setResponseOptions($responseOptions)
            ->generateResponse();
    }

    public function error($error, $rt = self::ERROR_RETURN_JSON)
    {
        return $this->setErrors($error)->generateErrorResponse($rt);
    }
}
