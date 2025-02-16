<?php

namespace Ilm\Ecom\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ilm\Ecom\IlmEcomServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Mjklimon\\IlmEcom\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            IlmEcomServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('ilm-ecom.sandbox-url', 'https://creative.jahidlimon.com/ilm-ecom');
        config()->set('ilm-ecom.client-id', '9e255dee-2bbb-4e29-aed4-70e365426c2a');
        config()->set('ilm-ecom.client-secret', 'jr0aDtt9JW4ZxeYJqMTs1R134NxjIvuL4VHm7fsG');

        cache()->set('87d3cf2fcda098612f21cfc9a4756d4f', ['success' => true]);

        // foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/../database/migrations') as $migration) {
        //     (include $migration->getRealPath())->up();
        // }
    }
}
