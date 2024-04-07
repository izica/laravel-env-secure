# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/izica/laravel-env-secure.svg?style=flat-square)](https://packagist.org/packages/izica/laravel-env-secure)
[![Total Downloads](https://img.shields.io/packagist/dt/izica/laravel-env-secure.svg?style=flat-square)](https://packagist.org/packages/izica/laravel-env-secure)

PRs are welcome

## Installation

You can install the package via composer:

```bash
composer require izica/laravel-env-secure
```

## Publish config(optional)

```bash
php artisan vendor:publish --provider="Izica\\EnvSecure\\EnvSecureServiceProvider"
```

## Usage

### 1. Encrypt env value
```php
php artisan env:secure {env key} {--cli} {--decrypt}
```
Options:
* --cli - only print result in console don't rewrite .env
* --decrypt - decript env value

Example:
```php
php artisan env:secure DB_PASSWORD
```

### 2. Change config to

```php
//config/database.php

use \Izica\EnvSecure\EnvSecure;

[
    //...
    'connections' => [
         //...
        'mysql' => [
            //...
            'password' => EnvSecure::env('DB_PASSWORD', ''),
        ]
    ]
]
```

## Credits

-   [izica](https://github.com/izica)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
