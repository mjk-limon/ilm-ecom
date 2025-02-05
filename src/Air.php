<?php

namespace Ilm\Ecom;

use BadMethodCallException;
use Ilm\Ecom\Traits\HasErrors;
use Ilm\Ecom\Traits\Modulable;

/**
 * @method \Illuminate\Http\Client\Response get(string $url, $query = null)
 * @method \Illuminate\Http\Client\Response post(string $url, $data = [])
 * @method \Illuminate\Http\Client\Response put(string $url, $data = [])
 * @method \Illuminate\Http\Client\Response delete(string $url, $data = [])
 */
class Air extends IlmComm
{
    use Modulable,
        HasErrors;

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

    public function error($error, $rt = HasErrors::ERROR_RETURN_JSON)
    {
        return $this->setErrors($error)->generateErrorResponse($rt);
    }
}
