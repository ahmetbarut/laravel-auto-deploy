# Introduction

This package is designed to automate the deployment process of Laravel applications. It provides a series of commands and configurations that help streamline the deployment workflow, reducing the time and effort required to keep your application up-to-date and running smoothly.

## Usage

After the initial deployment of your application, you need to create a `webhook` for your project.

```shell
php artisan auto-deploy:generate-webhook-key
```

## Output

```shell
Webhook key generated successfully!
Name: Auto Deployment
Your webhook url: https://laravel-auto-deploy.test/api/laravel-auto-deploy/dbe02d682acc7aa4fb1e421a6c33b773f56c7be1b5f2516dce860b2a121dae37
```

## Installation

```shell
composer require ahmetbarut/laravel-auto-deploy
```
