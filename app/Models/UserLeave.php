<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLeave extends Model
{
    use HasFactory;

    protected $table = "users_leave";

    protected $fillable = [
        'user_id',
        'is_admin',
        'name',
        'email',
        'email_verified_at',
        'password',
        'file',
        'company',
        'position',
        'phone',
        'zip_code',
        'address',
        'address_detail',
        'remember_token',
    ];
}
