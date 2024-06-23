<?php

namespace Ahmetbarut\LaravelAutoDeploy\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto-deploy:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the package.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Installing the package...");

        File::put(base_path('Envoy.blade.php'), File::get(__DIR__ . '/stubs/Envoy.blade.php'));

        $this->info("Package installed successfully!");

        $this->info("Publishing configuration...");

        $this->call('vendor:publish', [
            '--provider' => "Ahmetbarut\LaravelAutoDeploy\LaravelAutoDeployServiceProvider",
            '--tag' => "config",
        ]);

        $this->info("Configuration published successfully!");

        return static::SUCCESS;
    }
}
