<?php

namespace Ilm\Ecom\Traits;

use Illuminate\Http\Client\PendingRequest;

trait Modulable
{
    protected $moduleName;

    protected $cachePrefix;

    public function setModuleName(null|string $name)
    {
        $this->moduleName = $name;
        return $this;
    }

    public function setCachePrefix(string $prefix)
    {
        $this->cachePrefix = $prefix;
        return $this;
    }

    protected function httpAppendModuleUri(PendingRequest $http)
    {
        $moduleUri = sprintf('%s/api/%s', rtrim($this->httpBaseUrl, '/'), ltrim($this->moduleName, '/'));

        $http->baseUrl(
            $this->httpBaseUrl = $moduleUri
        );
    }
}
