<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'channel_id',
        'user_id',
    ];

    public function channel(){
        return $this->BelongsTo(ChatChannel::class, 'channel_id');
    }

    public function messages(){
        return $this->hasMany(ChatMessage::class, 'chat_user_id');
    }
}
