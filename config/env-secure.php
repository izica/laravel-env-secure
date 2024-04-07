<?php

return [
    "prefix"    => env('ENV_SECURE_PREFIX', 'scr::'),
    "algorithm" => env('ENV_SECURE_ALGORITHM', 'AES-128-CTR'), // https://www.php.net/manual/en/function.openssl-get-cipher-methods.php
    "iv"        => env('ENV_SECURE_IV', 1234567891011121),
    "key"       => env('ENV_SECURE_KEY', null), //APP_KEY by default. If you change the key after the values have been secured, you will not be able to decrypt the values in the future.
];