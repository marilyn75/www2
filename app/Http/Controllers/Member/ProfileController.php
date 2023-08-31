<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    function index() 
    {
        return view('member.profile');
    }

    // 회원정보 변경 처리
    public function update(Request $request){
        $data = $request->all();

        // 유효성 검사
        $rules = [
            'name' => 'required|max:20',
            'email' => 'required|email|max:255',
        ];

        $customMessages = [
            'name.required' => '이름 항목은 필수 입니다.',
            'email.required' => '이메일 항목은 필수 입니다.',
            'email.email' => '유효하지 않은 이메일입니다.',
        ];

        $this->validate($request, $rules, $customMessages);

        // 프로필 사진 업로드
        if(!empty($data['file'])){
            if(auth()->user()->file !== null){  // 기존 파일 삭제
                unlink(public_path() . "/files/profile/" . auth()->user()->file);
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
            $image->save(public_path() . '/files/profile/' . $filename);
        }

        $user = Auth::user();
        User::where('id',$user->id)->update([
            'name' => $data['name'],
            'company' => $data['company'],
            'position' => $data['position'],
            'phone' => $data['phone'],
            'zip_code' => $data['zip_code'],
            'address' => $data['address'],
            'address_detail' => $data['address_detail'],
            'file' => $filename,
        ]);

        return back()
            ->with('success_message','회원정보가 변경 되었습니다.');
    }
}
