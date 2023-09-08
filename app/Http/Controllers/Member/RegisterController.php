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
        $this->validate($request, User::$rules['register']);

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
