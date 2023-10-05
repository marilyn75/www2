<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use App\Models\ChatUser;
use App\Models\ChatChannel;
use Illuminate\Http\Request;
use App\Http\Class\ChatClass;
use App\Events\PusherBroadcast;
use App\Http\Class\UserClass;
use App\Http\Controllers\Controller;
use App\Models\ChatMessage;

class ChatController extends Controller
{
    public function index(Request $request, $channel=null)
    {
        $data = $request->all();
        $target_id = @$data['target_id'];

        // 채널이 있는지 체크

        if(auth()->check() && empty($channel)){
            $chat_channels = auth()->user()->chatUserChannels->first();
            if(empty($chat_channels)){
                // 유저용 채널 생성
                $channel = uniqid();
                $result = ChatChannel::create([
                    'channel' => $channel,
                ]);

                ChatUser::create([
                    'channel_id' => $result->id,
                    'user_id' => auth()->user()->id,
                ]);

                // 관리자 가져오기
                $admin = User::where('is_admin',1)->first();
                $adminChatUser = ChatUser::create([
                    'channel_id' => $result->id,
                    'user_id' => $admin->id,
                ]);

                // 관리자 최초 메세지
                ChatMessage::create([
                    'chat_user_id' => $adminChatUser->id,
                    'token' => 'first_token',
                    'message' => '안녕하세요. 무엇을 도와드릴까요?',
                ]);
            }else{
                $channel = $chat_channels->channel->channel;
            }
            return redirect(route('chat', $channel));
        }

        // 안읽은 메세지 읽음표시
        if(auth()->check() && !empty($channel)){
            $noReadMsg = ChatChannel::where('channel', $channel)->first()
                ->users->where('user_id', '!=', auth()->user()->id)->first()
                ->messages->where('is_read',0);
            foreach($noReadMsg as $_msg) $_msg->update(['is_read'=>1]);
        }

        return view('chat.index', compact('channel'));
    }

    public function broadcast(Request $request)
    {
        $chat_channel = ChatChannel::where('channel',$request->channel)->first();
        $chat_user = ChatUser::where(['user_id' => auth()->user()->id, 'channel_id' => $chat_channel->id])->first();
        // 메세지 디비저장
        $result = ChatMessage::create([
            'chat_user_id' => $chat_user->id,
            'token' => $request->_token,
            'message' => $request->message,
        ]);

        broadcast(new PusherBroadcast($request->get('message'), $request->channel))->toOthers();
        return view('chat.broadcast', ['message' => $request->get('message'), 'time' => $result->created_at]);
    }

    public function receive(Request $request)
    {
        $modelChatUser = ChatChannel::where('channel', $request->channel)->first()
            ->users->where('user_id', '!=', auth()->user()->id)->first();
        $modelMessage = $modelChatUser
            ->messages->where('message', $request->message)->last();

        $modelMessage->is_read = 1;
        $modelMessage->update();

        $profile = (new UserClass($modelChatUser->user_id))->getProfileAsset();
            
        return view('chat.receive', ['message' => $request->get('message'), 'profile'=>$profile, 'time'=>$modelMessage->created_at]);
    }

    public function admin($channel=null){

        $users = [];
        $currUser = null;
        // 채팅 유저목록
        $usersWithMessages = User::has('chatUserChannels.messages')->get();
        foreach($usersWithMessages as $_user){
            if($_user->id != auth()->user()->id){
                $clsUser = new UserClass($_user->id);
                if(!empty($channel) && $channel == $clsUser->getChatChannel()){
                    $currUser = $clsUser;
                    // 현재 유저의 메세지 읽음표시
                    $noReadMsg = ChatChannel::where('channel', $channel)->first()
                        ->users->where('user_id', '!=', auth()->user()->id)->first()
                        ->messages->where('is_read',0);
                    foreach($noReadMsg as $_msg) $_msg->update(['is_read'=>1]);
                } 

                $users[] = $clsUser;
            }
        }
        //dd($usersWithMessages[0]->chatUserChannels->first()->channel->channel);

        return view('admin.chat.index', compact('users', 'channel', 'currUser'));
    }
}
