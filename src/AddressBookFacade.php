<?php

namespace Mineral\AddressBook;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mineral\AddressBook\Skeleton\SkeletonClass
 */
class AddressBookFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'address-book';
    }
}
