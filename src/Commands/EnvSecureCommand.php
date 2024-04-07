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

        $value1 = env($key, null);

        if (!isset($value1)) {
            throw new \Exception("$key value not found.");
        }

        if (!is_string($value1)) {
            throw new \Exception("$key is not a string.");
            return;
        }

        $value2 = $decrypt
            ? EnvSecure::decrypt($value1)
            : EnvSecure::encrypt($value1);

        if ($cli) {
            print_r($value2);
            print_r("\n");
        } else {
            $this->writeToEnv($key, $value1, $value2);
        }
    }
}
