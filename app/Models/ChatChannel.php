<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatChannel extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'channel',
        'is_open',
    ];

    public function users(){
        return $this->hasMany(ChatUser::class, 'channel_id')->with('messages');
    }

}
