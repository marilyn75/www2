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
        $this->validate($request, User::$rules['update']);

        $UserClass = new UserClass(auth()->user()->id);
        $UserClass->update($request);

        return back()
            ->with('success_message','회원정보가 변경 되었습니다.');
    }

    public function mypage(){
        return view('member.mypage');
    }
}
