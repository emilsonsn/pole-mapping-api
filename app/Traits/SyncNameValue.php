<?php

namespace App\Traits;

trait SyncNameValue
{
    protected static function bootSyncNameValue(): void
    {
        static::saving(function ($model) {
            if (isset($model->name)) {
                $model->value = $model->name;
            }
        });
    }
}
