@extends('admin.layout.layout')

@section('page-title', '실시간 문의')

<!-- @section('page-comment', '회원들의 문의사항을 실시간 채팅으로 관리 합니다.') -->

@section('content')

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

<div class="row">
    <div class="col-lg-5 col-xl-4">
        <div class="message_container ms_list">
            <div class="inbox_user_list">
                <div class="iu_heading">
                    <div class="candidate_revew_search_box">
                        <form class="form-inline">
                            <input class="form-control" type="search" placeholder="이름을 검색" aria-label="Search">
                            <button class="btn" type="submit"><i class="ri-user-search-line"></i></button>
                        </form>
                    </div>
                </div>
                <ul>
                @foreach ($users as $_user)
                    @php
                        $msg_cnt = $_user->getNotReadChatMessagesCount2();
                    @endphp
                    <li class="contact">
                        <a href="{{ route('admin.chat', $_user->getChatChannel()) }}">
                            <div class="wrap">
                                <!-- <span class="contact-status online"></span> -->
                                <img class="img-fluid" src="{{ $_user->data()->profile_file }}" />
                                <div class="meta">
                                    <h5 class="name">{{ $_user->data()->name }}</h5>
                                    <p class="preview">{{ $_user->getLastChatMessages() }}</p>
                                </div>
                                @if ($msg_cnt > 0)
                                <div class="m_notif">{{ $msg_cnt }}</div>
                                @endif
                            </div>
                        </a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    @if (!empty($currUser))
    <div class="col-lg-7 col-xl-8">
        <div class="message_container chat_contain">
            <div class="user_heading">
                <a href="#">
                    <div class="wrap">
                        <span class="contact-status online"></span>
                        <img class="img-fluid" src="{{ $currUser->getProfileAsset() }}" width="57" height="57" />
                        <div class="meta">
                            <h5 class="name">{{ $currUser->data()->name }}</h5>
                            <p class="preview">was online today at 11:43</p>
                        </div>
                    </div>
                </a>
            </div>
            <x-ChatBox channel='{{ $channel }}' />
        </div>
    </div>    
    @else
    <div class="col-lg-7 col-xl-8">
        <div class="message_container chat_contain">
            <div class="user_heading">
                <a href="#">
                    <div class="wrap">
                        <span class="contact-status online"></span>
                        <div class="meta">
                            <h5 class="name">좌측에서 채팅 사용자를 선택하세요.</h5>
                            {{-- <p class="preview">was online today at 11:43</p> --}}
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
    </div>    
    @endif
    
</div>

<script>
    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {cluster: '{{ env('PUSHER_APP_CLUSTER') }}'});
    const channel = pusher.subscribe('{{ $channel }}');

    //Receive messages
    channel.bind('chat', function(data){
        $.post("{{ route('chat.receive') }}", {
            _token: '{{ csrf_token() }}',
            message: data.message,
            channel: data.channel,
        })
        .done(function(res){
            console.log('bind');
            $(".chatting_content > li").last().after(res);
            $(".inbox_chatting_box").scrollTop($('.chatting_content')[0].scrollHeight);
        });
    });

    //Broadcast messages
    $("form").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: "{{ route('chat.broadcast') }}",
            method: 'POST',
            headers: {
                'X-Socket-Id': pusher.connection.socket_id
            },
            data: {
                _token: '{{ csrf_token() }}',
                channel: '{{ $channel }}',
                message: $("form #message").val(),
            }
        }).done(function(res){
            console.log('send'+$('.chatting_content')[0].scrollHeight);
            $(".chatting_content > li").last().after(res);
            $("form #message").val('');
            $(".inbox_chatting_box").scrollTop($('.chatting_content')[0].scrollHeight);
        })

        return false;
    });

    $(document).ready(function(){
        $(".inbox_chatting_box").scrollTop($('.chatting_content')[0].scrollHeight);
    });
</script>
@endsection