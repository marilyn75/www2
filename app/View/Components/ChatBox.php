<?php

namespace App\View\Components;

use App\Http\Class\UserClass;
use Closure;
use App\Models\ChatChannel;
use App\Models\ChatMessage;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ChatBox extends Component
{
    private string $channel;
    /**
     * Create a new component instance.
     */
    public function __construct($channel)
    {
        $this->channel = $channel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $messages=[];
        // 전체 메세지 불러오기
        if(auth()->check() && !empty($this->channel)){
            // is_view 업데이트
            $users = ChatChannel::where('channel', $this->channel)->first()->users;
            $ids = [];
            $my_id = 0;
            foreach($users as $_user){
                $ids[] = $_user->id;
                if(empty($profiles[$_user->id])) $profiles[$_user->id] = (new UserClass($_user->user_id))->getProfileAsset();
                if($my_id==0 && $_user->user_id==auth()->user()->id) $my_id = $_user->id;
            }

            $modelMsg = ChatMessage::whereIn('chat_user_id', $ids)->orderBy('id', 'asc')->get();

            foreach($modelMsg as $_msg){
                $messages[] = [
                    'position' => ($_msg->chat_user_id == $my_id)?'right':'left',
                    'message' => $_msg->message,
                    'profile' => $profiles[$_msg->chat_user_id],
                    'time' => $_msg->created_at,
                ];
            }
        }
        
        return view('components.chat-box', compact('messages'));
    }
}
