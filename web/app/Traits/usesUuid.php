<?php

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * contains Eloquent-ORM functions to override the default, number based, incrementing id to an uuid based format
 */
trait usesUuid {

    protected static function bootUsesUuid() {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string)Str::uuid();
            }
        });
    }

    public function getIncrementing() {
        return false;
    }

    public function getKeyType() {
        return 'string';
    }

}
