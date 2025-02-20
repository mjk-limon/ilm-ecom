<?php

namespace Ilm\Ecom\Services\Routing;

use Illuminate\Routing\ResourceRegistrar;

class ResourceModuleRegistrar extends ResourceRegistrar
{
    /**
     * The default actions for a resourceful controller.
     *
     * @var string[]
     */
    protected $resourceDefaults = ['index', 'form', 'upsert', 'show', 'destroy'];

    /**
     * The verbs used in the resource URIs.
     *
     * @var array
     */
    protected static $verbs = [
        'form' => 'form',
    ];

    /**
     * Add the form method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceForm($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/' . static::$verbs['form'] . '/{' . $base . '?}';

        unset($options['missing']);

        $action = $this->getResourceAction($name, $controller, 'form', $options);

        return $this->router->get($uri, $action);
    }

    /**
     * Add the upsert method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array  $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceUpsert($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/{' . $base . '?}';

        unset($options['missing']);

        $action = $this->getResourceAction($name, $controller, 'upsert', $options);

        return $this->router->match(['POST', 'PUT', 'PATCH'], $uri, $action);
    }
}
