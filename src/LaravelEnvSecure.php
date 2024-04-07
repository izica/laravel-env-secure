<?php

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;

namespace Izica\LaravelEnvSecure;


class LaravelEnvSecure
{
    public static function env($key, $default = null)
    {
        return Cache::remember("laravel-env-secure:$key", 3600000, function () use ($key, $default) {
            $value = env($key, $default);
            if (!is_string($value)) {
                return $value;
            }
            $value = Str::of($value);
            $prefix = config("env-secure.prefix");
            if (!$value->startsWith($key, $prefix)) {
                return $value;
            }
            $value = $value->replace($prefix, '');

            try {
                $decrypted = Crypt::decryptString($value->replace($prefix, ''));
            } catch (DecryptException $e) {
                return $value;
            }
        });
    }
}
