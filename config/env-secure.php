<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    "prefix"    => env('ENV_SECURE_PREFIX', 'scr::'),
    "algorithm" => env('ENV_SECURE_ALGORITHM', 'AES-128-CTR'),
    "iv"        => env('ENV_SECURE_IV', 1234567891011121),
    "key"       => env('ENV_SECURE_KEY', null), //APP_KEY by default
];