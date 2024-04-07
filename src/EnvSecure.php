<?php

namespace Izica\EnvSecure;

class EnvSecure
{
    public static function env($key, $default = null)
    {
        return self::decrypt(env($key, $default));
    }

    public static function encrypt($value)
    {
        if (!is_string($value)) {
            return $value;
        }

        $prefix = config('env-secure.prefix', 'scr::');

        if (str_starts_with($value, $prefix)) {
            return $value;
        }

        return $prefix . openssl_encrypt(
                $value,
                config("env-secure.algorithm", "AES-128-CTR"),
                config("env-secure.key", null) ?? env('APP_KEY'),
                0,
                config("env-secure.iv", 1234567891011121),
            );
    }

    public static function decrypt($value)
    {
        $prefix = config('env-secure.prefix', 'scr::');

        if (!is_string($value)) {
            return $value;
        }

        if (!str_starts_with($value, $prefix)) {
            return $value;
        }

        return openssl_decrypt(
            str_replace($prefix, '', $value),
            config("env-secure.algorithm", "AES-128-CTR"),
            config("env-secure.key", null) ?? env('APP_KEY'),
            0,
            config("env-secure.iv", 1234567891011121),
        );
    }
}
