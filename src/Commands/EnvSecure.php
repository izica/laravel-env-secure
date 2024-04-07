<?php

namespace App\Console\Commands;

use Dotenv\Dotenv;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class EnvSecure extends Command
{
    protected $signature = 'env:secure {key}';

    private function replace($key, $value1, $value2)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=$value1", "$key=$value2", file_get_contents($path)
            ));
        }
    }

    public function handle()
    {
        $key = $this->argument('key');

        $dotenv = Dotenv::createArrayBacked(base_path('.'));
        $data = $dotenv->load();

        if (!isset($data[$key])) {
            throw new \Exception("$key value not found.");
        }
        $value = $data[$key];

        if (!is_string($value)) {
            throw new \Exception("$key is not a string.");
            return;
        }

        $prefix = config("env-secure.prefix");
        if (Str::of($value)->startsWith($prefix)) {
            throw new \Exception("$key already secured.");
            return;
        }

        $this->replace($key, $value, $prefix . Crypt::encryptString($value));
    }
}
