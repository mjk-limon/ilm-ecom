<?php

namespace Ilm\Ecom\Services;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Ilm\Ecom\Air;

abstract class Controller extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected $cacheKey;

    abstract public function moduleName(): null|string;

    public function __construct(
        protected Air $app
    ) {
        $app->setModuleName($this->moduleName())
            ->setCachePrefix($this->cacheKey ?: $this->moduleName());
    }
}
