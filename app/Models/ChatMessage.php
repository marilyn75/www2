<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'chat_user_id',
        'token',
        'message',
        'is_read'
    ];

    public function chatUser(){
        return $this->BelongsTo(ChatUser::class);
    }
}
