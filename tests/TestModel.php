<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Kablanfatih\Encryption\Encryptable;

class TestModel extends Model
{
    use Encryptable;

    public $incrementing = false;

    protected $fillable = ['name'];

    protected $encrypted = ['surname', 'phone', 'body'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            /**
             * @var Model $model
             */
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }
}