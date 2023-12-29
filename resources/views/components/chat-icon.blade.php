<div class="chat-icon">
	<!-- <img src="{{ asset('images/chat/live-chat.png') }}" alt="상담채팅" onclick="openWindow('{{ route('chat') }}',600, 900, 'chat');return false;"> -->
	<button onclick="openWindow('{{ route('chat') }}',600, 900, 'chat');return false;">
    <p>무엇을 <br> 도와드릴까요?</p>
    <p class="mont click_chat">click</p>
    <i class="ri-message-3-line"></i>
    </button>
    @if ($cnt>0)
    <div class="notification-sticker">{{ $cnt }}</div>
    @endif
</div>