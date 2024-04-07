<?php

namespace Izica\EnvSecure\Commands;

use Dotenv\Dotenv;
use Illuminate\Console\Command;
use Izica\EnvSecure\EnvSecure;

class EnvSecureCommand extends Command
{
    protected $signature = 'env:secure {key} {--decrypt} {--cli}';

    private function writeToEnv($key, $value1, $value2)
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
        $decrypt = $this->option('decrypt');
        $cli = $this->option('cli');

        $dotenv = Dotenv::createArrayBacked(base_path('.'));
        $data = $dotenv->load();

        if (!isset($data[$key])) {
            throw new \Exception("$key value not found.");
        }

        if (!is_string($data[$key])) {
            throw new \Exception("$key is not a string.");
            return;
        }

        $value = $decrypt
            ? EnvSecure::decrypt($data[$key])
            : EnvSecure::encrypt($data[$key]);

        if ($cli) {
            print_r($value);
            print_r("\n");
        } else {
            $this->writeToEnv($key, $data[$key], $value);
        }
    }
}
