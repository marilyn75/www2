<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSaleFavorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'sale_id', 'created_at', 'updated_at'
    ];
}
