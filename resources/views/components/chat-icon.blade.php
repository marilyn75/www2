<div class="chat-icon">
	<img src="{{ asset('images/chat/live-chat.png') }}" alt="상담채팅" onclick="openWindow('{{ route('chat') }}',600, 900, 'chat');return false;">
	@if ($cnt>0)
    <div class="notification-sticker">{{ $cnt }}</div>
    @endif
</div>