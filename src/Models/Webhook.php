<?php

namespace Ahmetbarut\LaravelAutoDeploy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'secret',
    ];

    protected $hidden = [
    ];

    public static function booted()
    {
        static::creating(function ($webhook) {
            $webhook->generateKey();
        });
    }

    public function getRouteKeyName()
    {
        return 'secret';
    }

    public function getUrlAttribute($value)
    {
        return route('laravel-auto-deploy.show', $this->secret);
    }

    public function generateKey()
    {
        $this->secret = bin2hex(random_bytes(32));
    }

    public function verifyKey($secret)
    {
        return hash_equals($this->secret, $secret);
    }
}
