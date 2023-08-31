<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('member.login');
    }

    public function login(Request $request){
        $data = $request->all();

        $rules = [
            'email' => 'required|email|max:255',
            'password' => 'required|max:30'
        ];

        $customMessages = [
            'email.required' => '이메일 항목은 필수 입니다.',
            'email.email' => '유효하지 않은 이메일입니다.',
            'password.required' => '비밀번호 항목은 필수 입니다.',
        ];

        $this->validate($request, $rules, $customMessages);

        if(Auth::guard('web')->attempt(['email'=>$data['email'], 'password'=>$data['password']])){
            // Remember Admin Email & Password with cookies
            if(isset($data['remember']) && !empty($data['remember'])){
                setcookie("email", $data['email'], time()+3600);
                setcookie("password", $data['password'], time()+3600);
            }else{
                setcookie("email","");
                setcookie("password","");
            }
            return redirect('/');
        }else{
            return back()->with('error_message','이메일 또는 비밀번호가 유효하지 않습니다.');
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
