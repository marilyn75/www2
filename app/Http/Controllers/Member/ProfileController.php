<?php

namespace App\Http\Controllers\Member;

use App\Http\Class\UserClass;
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

        $UserClass = new UserClass(auth()->user()->id);
        $UserClass->update($request);

        return back()
            ->with('success_message','회원정보가 변경 되었습니다.');
    }
}
