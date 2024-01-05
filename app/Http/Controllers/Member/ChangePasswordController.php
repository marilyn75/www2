<?php

namespace App\Http\Controllers\Member;

use App\Http\Class\UserClass;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
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
        $this->validate($request, User::$rules['changepassword']);

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

    // 아이디(이메일)찾기
    public function findid(Request $request){
        $data = $request->all();

        if($request->method()=='POST'){
            $rules = [
                'name'=>'required','phone'=>'required',
            ];
            // 유효성 검사
            $this->validate($request, $rules);

            $userData = User::where(['name'=>$data['name'],'phone'=>$data['phone']])->first();
            debug($userData->hasSocialAccounts());
            if(empty($userData)){
                return back()
                    ->with('error_message','일치하는 회원정보가 없습니다.');
            }else{

                return view('member.findidok', compact('userData'));
            }
            
        }else{
            

            return view('member.findid');
        }
    }

    // 비밀번호 찾기
    public function findpw(Request $request){
        if($request->method()=="GET"){
            return view('member.findpw');
        }else{
            // 유효성 검사
            $rules = ['email' => 'required|email|max:255',
            'isCert' => 'required',];

            $this->validate($request, $rules, ['isCert.required'=>"휴대폰 인증은 필수 입니다."]);

            // 세션 시작
            if(session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $clsUser = UserClass::getUserFromEmail($request->email);
            if(empty($clsUser)){
                return back()
                ->with('error_message','일치하는 회원정보가 없습니다.');
            }

            $_SESSION['FNDPW_EMAIL'] = $request->email;

            return redirect(route('findpw.form'));
        }
    }

    public function findpw_form(Request $request){
        // 세션 시작
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $data = $request->all();
        if($request->method()=="GET"){
            // 세션이 없으면
            if(empty($_SESSION['FNDPW_EMAIL'])){
                return redirect(route('findpw'));
            }

            $email = $_SESSION['FNDPW_EMAIL'];

            return view('member.changepw2', compact('email'));
        }else{
            // 유효성 검사
            $rules = User::$rules['changepassword'];
            unset($rules['curr_password']);

            $this->validate($request, $rules);

            $clsUser = UserClass::getUserFromEmail($data['email']);
            if(empty($clsUser)){
                return back()
                ->with('error_message','일치하는 회원정보가 없습니다.');
            }

            // unset($_SESSION['FNDPW_EMAIL']);

            $clsUser->changepassword($request);
            // User::where('id',$user->id)->update(['password'=>bcrypt($data['password'])]);

            return redirect(route('login'))
                ->with('success_message','비밀번호가 변경 되었습니다. 로그인 하세요.');
        }
    }
}
