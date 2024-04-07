# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/izica/laravel-env-secure.svg?style=flat-square)](https://packagist.org/packages/izica/laravel-env-secure)
[![Total Downloads](https://img.shields.io/packagist/dt/izica/laravel-env-secure.svg?style=flat-square)](https://packagist.org/packages/izica/laravel-env-secure)
![GitHub Actions](https://github.com/izica/laravel-env-secure/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

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


### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email artemiztomska@gmail.com instead of using the issue tracker.

## Credits

-   [izica](https://github.com/izica)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
