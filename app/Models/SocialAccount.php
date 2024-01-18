<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksIpAddressesAndUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialAccount extends Model
{
    use HasFactory;
    use SoftDeletes;
    use TracksIpAddressesAndUser;

    protected $fillable = [
        'user_id', 'provider_name', 'provider_id', 'name', 'email', 'token', 'refresh_token', 'expires_in', 'avatar', 'phone'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
