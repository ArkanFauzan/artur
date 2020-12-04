<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Str;

trait Uuid
{
    // uuid
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'id';
    }
}

