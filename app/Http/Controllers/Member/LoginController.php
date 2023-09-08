<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('member.login');
    }

    public function login(Request $request){
        $data = $request->all();

        $this->validate($request, User::$rules['login']);

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
