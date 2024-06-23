<?php

namespace Ahmetbarut\LaravelAutoDeploy;

use Illuminate\Support\ServiceProvider;

class LaravelAutoDeployServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\GenerateWebhookKeyCommand::class,
                
            ]);
        }

        $this->app->bind('auto-deploy-model', function () {
            return config('auto-deploy.model');
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/auto-deploy.php', 'auto-deploy');
    }
}
