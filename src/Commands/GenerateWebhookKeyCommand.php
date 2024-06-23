<?php

namespace Ahmetbarut\LaravelAutoDeploy\Commands;

use Ahmetbarut\LaravelAutoDeploy\Models\Webhook;
use Illuminate\Console\Command;

class GenerateWebhookKeyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto-deploy:generate-webhook-key
    {--name= : The name of the webhook.}
    {--url= : The URL of the webhook.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new webhook key for auto deployment.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! $url = $this->option('url')) {
            $url = config('app.url');
        }

        if (! $name = $this->option('name')) {
            $name = 'Auto Deployment';
        }

        $model = app('auto-deploy-model');

        $webhook = $model::create([
            'name' => $name,
            'url' => $url,
        ]);

        $this->info("Webhook key generated successfully!");
        $this->line("Name: {$webhook->name}");
        $this->line(sprintf("Your webhook url: %s", $webhook->url));
    }
}
