@extends('layout.layout-popup')

@section('page-title', '문의 채팅창')

@section('content')

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

@if (auth()->check())
<!-- Our LogIn Register -->
<section class="our-log bgc-fa">
    <div class="container">
        <div class="row">

            <div class="col-xl-12" style="height: 100%">
                <div class="message_container">
                    <div class="user_heading">
                        <a href="#">
                            <div class="wrap">
                                <span class="contact-status online"></span>
                                관리자에게 문의
                                {{-- <img class="img-fluid" src="images/team/s5.jpg" alt="s5.jpg"/>
                                <div class="meta">
                                    <h5 class="name">Joanne Davies</h5>
                                    <p class="preview">was online today at 11:43</p>
                                </div> --}}
                            </div>
                        </a>
                    </div>
                    <x-ChatBox channel="{{ $channel }}" />
                </div>
            </div>
        </div>
    </div>
</section>

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
            console.log('send');
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
@else
    @include('include.page-permission');
@endif

@endsection