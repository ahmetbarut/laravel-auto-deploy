<?php

use Ahmetbarut\LaravelAutoDeploy\Models\Webhook;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/api/laravel-auto-deploy/{webhook:secret}', function (Webhook $webhook) {

    if (!$webhook->verifyKey(request()->route('webhook')->secret)) {
        return response('Unauthorized', 401);
    }

    $process = Process::run(sprintf("cd %s && php vendor/bin/envoy run deploy", base_path()));

    if ($process->failed()){
        return response($process->output(), 500);
    }

    return response();
    
})->name('laravel-auto-deploy.show')->middleware(\Illuminate\Routing\Middleware\SubstituteBindings::class);
