<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('member.register');
    }

    // 회원정보 저장
    public function store(Request $request){
        $data = $request->all();

        // 유효성 검사
        $rules = [
            'name' => 'required|max:20',
            'email' => 'required|email|max:255',
            'password' => 'required|max:30|confirmed'
        ];

        $customMessages = [
            'email.required' => '이메일 항목은 필수 입니다.',
            'email.email' => '유효하지 않은 이메일입니다.',
            'password.required' => '비밀번호 항목은 필수 입니다.',
            'password.confirmed' => '비밀번호가 일치하지 않습니다.',
        ];

        $this->validate($request, $rules, $customMessages);

        $saveData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ];      

        $chkDup = User::where('email',$saveData['email'])->count();
        if($chkDup > 0){
            return back()->with('error_message', '이미 가입된 이메일 입니다.');
        }

        $result = User::create($saveData);

        return redirect(route('login'))
            ->with('success_message','회원가입 완료되었습니다. 로그인 하세요.')
            ->with('email',$saveData['email']);
    }
}
