<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        // 세션 시작
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['return_url'] = url()->previous();
        debug($_SESSION);
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

            if($request->expectsJson()){    // 요청 헤더가 json 리턴을 기대함
                return response()->json([
                    'message' => '로그인 되었습니다.'
                ]);
            }else{
                // 세션 시작
                if(session_status() == PHP_SESSION_NONE) {
                session_start();
                }
                
                if(!empty($_SESSION['return_url'])) return redirect($_SESSION['return_url']);
                else                                return redirect('/');
            }
        }else{
            if($request->expectsJson()){    // 요청 헤더가 json 리턴을 기대함
                return response()->json([
                    'message' => '로그인 정보가 유효하지 않습니다.'
                ], 400);
            }else{
                return back()->with('error_message','이메일 또는 비밀번호가 유효하지 않습니다.');
            }
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect(url()->previous());
        // return redirect('/');
    }

   /**
     * 사용자가 인증된 후에 호출되는 메소드.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // 사용자가 로그인한 후에 여기에 추가적인 로직을 구현합니다.
    }
}
