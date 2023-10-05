<?php

namespace App\View\Components;

use Closure;
use App\Models\ChatUser;
use App\Http\Class\UserClass;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ChatIcon extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $cnt = 0;
        if(auth()->check()){
            $cnt = (new UserClass(auth()->user()->id))->getNotReadChatMessagesCount();
        }
        return view('components.chat-icon', compact('cnt'));
    }
}
