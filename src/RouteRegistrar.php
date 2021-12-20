<?php

namespace Mineral\AddressBook;


use Laravel\Lumen\Routing\Router;

class RouteRegistrar
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Register routes for transient tokens, clients, and personal access tokens.
     *
     * @return void
     */
    public function all()
    {
        $this->forRequestApi();
    }

    /**
     * Register the routes needed for authorization.
     *
     * @return void
     */
    public function forRequestApi()
    {
        $this->router->get('profile/address-book', [
            'uses' => 'AddressBookController@index',
            'as' => 'address-book.index',
        ]);

        $this->router->get('profile/address-book/default', [
            'uses' => 'AddressBookController@getDefault',
            'as' => 'address-book.default',
        ]);

        $this->router->get('profile/address-book/{id}/detail', [
            'uses' => 'AddressBookController@show',
            'as' => 'address-book.show',
        ]);

        $this->router->post('profile/address-book', [
            'uses' => 'AddressBookController@store',
            'as' => 'address-book.store',
        ]);

        $this->router->post('profile/address-book/{id}', [
            'uses' => 'AddressBookController@update',
            'as' => 'address-book.update',
        ]);

        $this->router->put('profile/address-book/{id}', [
            'uses' => 'AddressBookController@setDefault',
            'as' => 'address-book.set-default',
        ]);

        $this->router->delete('profile/address-book/{id}', [
            'uses' => 'AddressBookController@delete',
            'as' => 'address-book.delete',
        ]);
    }
}
