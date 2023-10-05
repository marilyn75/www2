<?php

namespace App\Http\Class;

use Illuminate\Http\Request;
use App\Events\PusherBroadcast;
use App\Models\ChatUser;

// 채팅판관련 클래스

class ChatClass{

    private string $channel;

    public function __construct($channel)
    {
        $this->channel = $channel; 
    }

    public function makeChannel($target_id){
        // 채널이 있는지 체크
        // $chatUser = ChatUser::where()
    }

    public function send(Request $request){
        broadcast(new PusherBroadcast($request->get('message'), $this->channel))->toOthers();
        return $request->get('message');
    }

    public function receive(Request $request)
    {
        return $request->get('message');
    }
}