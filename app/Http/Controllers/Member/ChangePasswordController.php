<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index(){
        return view('member.changepw');
    }

    // 비밀번호 변경 처리
    public function update(Request $request){
        $data = $request->all();

        // 유효성 검사
        $rules = [
            'curr_password' => 'required|max:30',
            'password' => 'required|max:30|confirmed'
        ];

        $customMessages = [
            'curr_password.required' => '현재 비밀번호 항목은 필수 입니다.',
            'password.required' => '변경할 비밀번호 항목은 필수 입니다.',
            'password.confirmed' => '비밀번호가 일치하지 않습니다.',
        ];

        $this->validate($request, $rules, $customMessages);

        $user = Auth::user();

        // 현재 비밀번호 체크
        $currentPassword = $data["curr_password"]; // 사용자가 입력한 현재 비밀번호
        if (Hash::check($currentPassword, $user->password) === false) {
            return back()
                ->with('error_message','현재 비밀번호가 불일치 합니다.');
        } 

        User::where('id',$user->id)->update(['password'=>bcrypt($data['password'])]);

        return back()
            ->with('success_message','비밀번호가 변경 되었습니다.');
    }
}
