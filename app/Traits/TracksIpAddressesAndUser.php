<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
// use App\Audit;

trait TracksIpAddressesAndUser
{
    public static function bootTracksIpAddressesAndUser()
    {
        static::creating(function ($model) {
            $model->created_ip = request()->ip();
            if (Auth::check()) {
                $model->created_user_id = Auth::id();
            }
        });

        static::updating(function ($model) {
            $model->updated_ip = request()->ip();
            if (Auth::check()) {
                $model->updated_user_id = Auth::id();
            }
        });

        static::deleting(function ($model) {
            if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($model))) {
                $model->deleted_user_id = Auth::id();
                $model->deleted_ip = request()->ip();
                $model->save();
            } else {
                // Audit::create([
                //     'type' => 'delete',
                //     'ip_address' => request()->ip(),
                //     'user_id' => Auth::id(),
                //     'auditable_type' => get_class($model),
                //     'auditable_id' => $model->id,
                // ]);
            }
        });
    }
}
