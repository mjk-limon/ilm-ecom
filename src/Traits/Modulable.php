<?php

namespace Ilm\Ecom\Traits;

use Illuminate\Support\Facades\Cache;

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

    protected function getModuleApiEndpoint(string $path)
    {
        $base = !config('ilm-ecom.sandbox')
            ? config('ilm-ecom.url')
            : config('ilm-ecom.sandbox-url');

        return sprintf('%s/api/v1/%s/%s', rtrim($base, '/'), $this->moduleName, ltrim($path, '/'));
    }

    protected function getCachedData($key)
    {
        return Cache::get($this->cachePrefix . '_' . $key);
    }
}
