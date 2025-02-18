<?php

namespace Ilm\Ecom\Services\Routing;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class IlmRouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Router::macro('resourceModule', function ($name, $controller, array $options = []) {
            /** @var Router $this */

            if ($this->container && $this->container->bound(ResourceModuleRegistrar::class)) {
                $registrar = $this->container->make(ResourceModuleRegistrar::class);
            } else {
                $registrar = new ResourceModuleRegistrar($this);
            }

            return new PendingResourceModuleRegistration(
                $registrar,
                $name,
                $controller,
                $options
            );
        });
    }
}
