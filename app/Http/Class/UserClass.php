<?php

namespace App\Http\Class;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

// 유저관련 클래스

class UserClass{

    private $model;
    private $file_path;

    public function __construct($id)
    {
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

    public function update(Request $request){
        $data = $request->all();
        $user = $this->model->first();
        // 프로필 사진 업로드
        $filename = null;
        if(!empty($data['file'])){
            if($user->file !== null){  // 기존 파일 삭제
                unlink($this->file_path . $user->file);
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

        $user->name = $data['name'];
        $user->company = $data['company'];
        $user->position = $data['position'];
        $user->phone = $data['phone'];
        $user->zip_code = $data['zip_code'];
        $user->address = $data['address'];
        $user->address_detail = $data['address_detail'];
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

    public function destory(){
        $user = $this->model->first();

        if(!empty($user->file)){
            unlink($this->file_path . $user->file);
        }

        $user->delete();
    }
}