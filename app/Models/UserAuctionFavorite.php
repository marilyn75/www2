<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAuctionFavorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'gbn', 'code', 'no', 'created_at', 'updated_at'
    ];
}
