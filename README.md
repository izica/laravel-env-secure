#Laravel env secure
[![Latest Version on Packagist](https://img.shields.io/packagist/v/izica/laravel-env-secure.svg?style=flat-square)](https://packagist.org/packages/izica/laravel-env-secure)
PRs are welcome

## Description
Simple Laravel package with zero dependencies for securing your env values, such as database passwords or API keys, to prevent exposure due to mistakes

## Prerequisites
This package using `php openssl`

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
* --decrypt - decrypt env value

Example:
```php
php artisan env:secure DB_PASSWORD
```

*Your env file will change*
from:
```env
DB_PASSWORD=somepassword
```

to:
```env
DB_PASSWORD=scr::zvzEOZDAE4k/7D/rx
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

## Config

```php
return [
    "prefix"    => env('ENV_SECURE_PREFIX', 'scr::'),
    "algorithm" => env('ENV_SECURE_ALGORITHM', 'AES-128-CTR'),  // https://www.php.net/manual/en/function.openssl-get-cipher-methods.php
    "iv"        => env('ENV_SECURE_IV', 1234567891011121),
    "key"       => env('ENV_SECURE_KEY', null), //APP_KEY by default. If you change the key after the values have been secured, you will not be able to decrypt the values in the future.
];
```

## Credits

-   [izica](https://github.com/izica)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
