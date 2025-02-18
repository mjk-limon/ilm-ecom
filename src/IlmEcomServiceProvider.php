<?php

namespace Ilm\Ecom;

use Illuminate\Routing\Router;
use Ilm\Ecom\Services\Routing\IlmRouteServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class IlmEcomServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        // $this->app->bind('ilm-ecom', function () {});
        $package
            ->name('ilm-ecom')
            ->hasConfigFile();
    }

    public function registeringPackage()
    {
        $this->app->register(IlmRouteServiceProvider::class);
    }
}
