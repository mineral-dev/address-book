## Installation

add in composer json
```json
{
  ...
  "repositories": [
        ...
        {
            "type": "vcs",
            "url": "git@github.com:mineral-dev/address-book.git"
        }
    ]
}
```

You can install the package via composer:

```bash
composer require mineral/address-book
```

## Usage


add in route
```php
\Mineral\AddressBook\AddressBook::routes();
```

## Credits

-   [Faza](https://github.com/faza13)

## License

The MIT License (MIT). Please see [License File](packages/mineral/banner-promotion/LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
