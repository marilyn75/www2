<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksIpAddressesAndUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory, SoftDeletes;
    use TracksIpAddressesAndUser;

    public $timestamps = true;

    protected $fillable = [
        'title',
        'type',
        'content',
        'created_user_id',
        'created_ip',
        'updated_user_id',
        'updated_ip',
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'content_id');
    }
}
