<?php

namespace App\Traits;

trait TracksUserId
{
    public static function bootTracksUserId()
    {
        static::creating(function ($model) {
            $model->created_ip = request()->ip();
        });

        static::updating(function ($model) {
            $model->updated_ip = request()->ip();
        });

        static::deleting(function ($model) {
            $model->deleted_ip = request()->ip();
            $model->save();
        });
    }
}
