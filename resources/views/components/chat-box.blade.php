<div class="inbox_chatting_box">
    <ul class="chatting_content chatting_content_w">
        {{-- @include('chat.receive', ['message'=>'무엇을 도와드릴까요?', 'profile'=>$_msg['profile']]) --}}

        @if($messages)
            @foreach ($messages as $_msg)
                @if($_msg['position']=='left')
                    @include('chat.receive', ['message'=>$_msg['message'], 'profile'=>$_msg['profile'], 'time'=>$_msg['time']])
                @else
                    @include('chat.broadcast', ['message'=>$_msg['message'], 'time'=>$_msg['time']])
                @endif
            @endforeach
        @endif
    </ul>
</div>
<div class="mi_text">
    <div class="message_input">
        <form class="form-inline">
            <input class="form-control" type="text" placeholder="Message..." aria-label="Search" autocomplete="off" id="message" name="message">
            <button class="btn" type="submit"><img src="/images/chat/send.png" alt=""></button>
        </form>
    </div>
</div>