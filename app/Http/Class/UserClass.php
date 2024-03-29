<?php

namespace App\Http\Class;

use App\Models\User;
use App\Models\UserLeave;
use App\Models\ChatChannel;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;

// 유저관련 클래스

class UserClass{

    private $id;
    private $model;
    private $file_path;

    public function __construct($id)
    {
        $this->id = $id;
        $this->model = User::where('id',$id);
        $this->file_path = public_path() . "/files/profile/";
    }

    public function data(){
        $data = $this->model->first();

        if(empty($data->file)){
            $socialAccount = $data->socialAccounts()->first();
            if(empty($socialAccount)){
                $data->profile_file = asset('/images/user-placeholder.png');
            }else{
                $data->profile_file = $socialAccount->avatar;
            }
        }else{
            $data->profile_file = asset('/files/profile/' . $data->file);
        }

        return $data;
    }

    public function getProfileAsset(){
        return $this->data()->profile_file;
    }

    // 해당 유저의 마지막 채팅 메세지
    public function getLastChatMessages(){
        return $this->model->first()->chatUserChannels->first()->messages->last()->message;
    }

    public function getChatChannel(){
        return $this->model->first()->chatUserChannels->first()->channel->channel;
    }

    public function getNotReadChatMessagesCount(){
        $modelUserChannel = $this->model->first()->chatUserChannels->first();
        if(empty($modelUserChannel)) return 0;
        $channel = $modelUserChannel->channel->channel;
        $chatUser = ChatChannel::where('channel',$channel)->first()->users->where('user_id','!=',$this->id)->first();
        if(empty($chatUser)) return 0;
        return $chatUser->messages->where('is_read',0)->count();
    }

    public function getNotReadChatMessagesCount2(){ // 관리자모드의 유저 메세지 안읽은 수
        $channel = ($this->model->first()->chatUserChannels->first()->channel->channel);
        return ChatChannel::where('channel',$channel)->first()->users->where('user_id',$this->id)->first()->messages->where('is_read',0)->count();
    }

    public function update(Request $request){
        $data = $request->all();
        $user = $this->model->first();
        // 프로필 사진 업로드
        $filename = null;
        if(!empty($data['file'])){
            if($user->file !== null){  // 기존 파일 삭제
                @unlink($this->file_path . $user->file);
            }
            

            $image = Image::make($data['file']);
            // 이미지의 너비와 높이 가져오기
            $originalWidth = $image->width();
            $originalHeight = $image->height();

            // 리사이즈할 크기 계산
            if ($originalWidth < $originalHeight) {
                // 가로가 짧은 경우
                $resizedWidth = 260;
                $resizedHeight = intval(260 * $originalHeight / $originalWidth);
            } else {
                // 세로가 짧은 경우
                $resizedHeight = 260;
                $resizedWidth = intval(260 * $originalWidth / $originalHeight);
            }

            // 이미지 리사이즈
            $image->resize($resizedWidth, $resizedHeight);

            // 260x260으로 자르기
            $image->crop(260, 260);

            $extension = $data['file']->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->save($this->file_path . $filename);
        }

        $user->name = @$data['name'];
        $user->company = @$data['company'];
        $user->position = @$data['position'];
        $user->phone = @$data['phone'];
        $user->zip_code = @$data['zip_code'];
        $user->address = @$data['address'];
        $user->address_detail = @$data['address_detail'];
        if(!empty($filename))   $user->file = $filename;

        $user->update();

        // User::where('id',$user->id)->update([
        //     'name' => $data['name'],
        //     'company' => $data['company'],
        //     'position' => $data['position'],
        //     'phone' => $data['phone'],
        //     'zip_code' => $data['zip_code'],
        //     'address' => $data['address'],
        //     'address_detail' => $data['address_detail'],
        //     'file' => $filename,
        // ]);
        
    }

    public function changepassword(Request $request){
        $data = $request->all();
        $user = $this->model->first();

        $user->update(['password'=>bcrypt($data['password'])]);

    }

    public function destroy(){
        $user = $this->model->first();

        // 탈퇴 테이블로 이전
        $saveData = [
            'user_id' => $user->id,
            'is_admin' => $user->is_admin,
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'password' => $user->password,
            'file' => $user->file,
            'company' => $user->company,
            'position' => $user->position,
            'phone' => $user->phone,
            'zip_code' => $user->zip_code,
            'address' => $user->address,
            'address_detail' => $user->address_detail,
            'remember_token' => $user->remember_token,
            'created_user_id' => auth()->user()->id,
            'created_ip' => $_SERVER['REMOTE_ADDR'],
        ];
        $r = UserLeave::create($saveData);

        // 소셜계정 삭제
        if($user->hasSocialAccounts()){
            foreach($user->socialAccounts as $_account){
                $result = $this->unlinkSocialAccount($_account->provider_name, $_account->token);
            }
        }

        if(!empty($user->file)){
            unlink($this->file_path . $user->file);
        }

        return $user->forceDelete();
    }

    public static function getUserFromEmail($email)
    {
        $id = null;
        $data = User::where('email',$email)->first();
        if(empty($data)){
            $data = SocialAccount::where('email',$email)->first();
            if(!empty($data)) $id = $data->user_id;
        }else{
            $id = $data->id;
        }

        return new static($id);
    }

    // 소셜계정 연결해제
    public function unlinkSocialAccount($provider, $accessToken){
        if($provider=='kakao'){
            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $accessToken,
            ])->post('https://kapi.kakao.com/v1/user/unlink');

            return $response->json();
        }

        if($provider=='naver'){
            $response = Http::asForm()->post('https://nid.naver.com/oauth2.0/token',[
                'service_provider'=>'NAVER',
                'client_id'=>env('NAVER_CLIENT_ID'),
                'client_secret'=>env('NAVER_CLIENT_SECRET'),
                'access_token'=>$accessToken,
                'grant_type'=>'delete',
            ]);

            return $response->json();
        }
    }
}