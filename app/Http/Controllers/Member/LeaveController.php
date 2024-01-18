<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Class\lib\ResultClass;
use App\Http\Class\UserClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LeaveController extends Controller
{
    // 회원탈퇴
    public function index(Request $request){
        if($request->method()=='POST'){
            $this->validate($request, ['leavechk'=>'accepted'],['leavechk.accepted'=>'유의사항을 확인하시고 동의해주세요.']);

            // 소셜회원인지 체크
            if(auth()->user()->hasSocialAccounts()){
                return $this->leave($request);
            }else{
                $result = ResultClass::fail('패스워드 확인');
                return $result->jsonResult();
            }
        }else{
            return view('member.leave');
        }
    }

    // 패스워드 확인
    public function confirmpw(Request $request){
        $data = $request->all();
        // 유효성 검사
        $this->validate($request, ['password' => 'required|min:6|max:30']);

        $user = auth()->user();

        // 현재 비밀번호 체크
        $currentPassword = $data["password"]; // 사용자가 입력한 비밀번호
        if (Hash::check($currentPassword, $user->password) === false) {
            // return back()
            //     ->with('error_message','비밀번호가 불일치 합니다.');
            return ResultClass::fail('비밀번호가 불일치 합니다.')->jsonResult();
        }else{
            return $this->leave($request);
        }
    }

    public function leave(Request $request){
        if($request->expectsJson()){    // 요청 헤더가 json 리턴을 기대함
            // 탈퇴처리
            $clsUser = new UserClass(auth()->user()->id);
            $respose = $clsUser->destroy();
            if($respose){
                auth()->guard('web')->logout();
                return ResultClass::success('탈퇴처리 완료')->jsonResult();
            }else{
                return ResultClass::fail('탈퇴처리 실패! 관리자에게 문의하세요.')->jsonResult();
            }
        }else{
            return ResultClass::fail('잘못된 접근입니다.')->jsonResult();
        }
    }

    public function leave_done(){
        return view('member.leave-done');
    }
}
