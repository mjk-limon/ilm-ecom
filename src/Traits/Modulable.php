<?php

namespace Ilm\Ecom\Traits;

use Illuminate\Http\Client\PendingRequest;

trait Modulable
{
    protected $moduleName;

    protected $cachePrefix;

    public function setModuleName(?string $name)
    {
        $this->moduleName = $name;

        return $this;
    }

    public function setCachePrefix(string $prefix)
    {
        $this->cachePrefix = $prefix;

        return $this;
    }

    protected function cacheKey(string $path, $query)
    {
        $queryString = $query && ! is_string($query) ? http_build_query($query) : strval($query);
        $key = sprintf('%s_%s_%s', $this->cachePrefix, $path, $queryString);
        return md5($key);
    }

    protected function httpAppendModuleUri(PendingRequest $http)
    {
        $moduleUri = sprintf(
            '%s/api/%s/%s',
            rtrim($this->httpBaseUrl, '/'),
            $this->version,
            ltrim($this->moduleName, '/')
        );

        $http->baseUrl(
            $this->httpBaseUrl = $moduleUri
        );
    }
}
