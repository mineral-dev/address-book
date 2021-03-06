<?php

namespace Mineral\AddressBook;

class AddressBook
{
    /**
     * Binds the Passport routes into the controller.
     *
     * @param  callable|null  $callback
     * @param  array  $options
     * @return void
     */
    public static function routes($callback = null, array $options = [])
    {
        $callback = $callback ?: function ($router) {
            $router->all();
        };

        $defaultOptions = [
            'namespace' => '\Mineral\AddressBook\Http\Controllers',
        ];

        $options = array_merge($defaultOptions, $options);

        \Route::group($options, function ($router) use ($callback) {
            $callback(new RouteRegistrar($router));
        });
    }
}
