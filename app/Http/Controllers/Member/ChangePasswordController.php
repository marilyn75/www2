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
            debug($userData);
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
    public function findpw(){
        return view('member.findpw');
    }
}
