<div class="chat-icon">
	<!-- <img src="{{ asset('images/chat/live-chat.png') }}" alt="상담채팅" onclick="openWindow('{{ route('chat') }}',600, 900, 'chat');return false;"> -->
	<button 
    @auth
    onclick="openWindow('{{ route('chat') }}',600, 900, 'chat');return false;"
    @else
    data-toggle="modal" data-target="#logalertModal" onclick="return false;"
    @endauth
    >
    <p>무엇을 <br> 도와드릴까요?</p>
    <p class="mont click_chat">click</p>
    <i class="ri-message-3-line"></i>
    </button>
    @if ($cnt>0)
    <div class="notification-sticker">{{ $cnt }}</div>
    @endif
</div>