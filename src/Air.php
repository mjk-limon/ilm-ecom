<?php

namespace Ilm\Ecom;

use BadMethodCallException;
use Ilm\Ecom\Traits\Modulable;
use Ilm\Ecom\Traits\ResponseTrait;

/**
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

    public function get(string $url, $query = null)
    {
        $cacheKey = $this->cacheKey($url, $query);
        $cached = $this->cache()->get($cacheKey);

        if ($cached !== null) {
            return $cached;
        }

        $data = $this->request('get', $url, ['query' => $query]);
        $this->cache()->put($cacheKey, $data);

        return $data;
    }

    private function request(string $method, string $path, array $args)
    {
        $http = $this->authorizedHttp();
        $this->httpAppendModuleUri($http);

        return $http->{$method}($path, ...$args)->json();
    }

    public function response($file, $data = [])
    {
        return $this->setResponseFile($file)
            ->setResponseData($data)
            ->generateResponse();
    }

    public function error($error)
    {
        return $this->setErrors($error)->generateErrorResponse();
    }
}
