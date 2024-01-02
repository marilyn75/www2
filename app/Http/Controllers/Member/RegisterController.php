<?php

namespace App\Http\Controllers\Member;

use App\Http\Class\lib\ResultClass;
use App\Http\Class\lib\SmsClass;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // 약관동의
    public function index(){
        return view('member.agree');
    }
    public function handleAgree(Request $request){
        // 유효성 검사
        $this->validate($request, ['agree' => 'required',], ['agree.required'=>"약관동의는 필수 입니다."]);
        return redirect(route('register'));
    }

    // 회원정보 저장
    public function store(Request $request){
        $data = $request->all();

        if($request->isMethod('get')){
   
            return view('member.register');
        }elseif($request->isMethod('post')){

            // 유효성 검사
            $this->validate($request, User::$rules['register'], ['isCert.required'=>"휴대폰 인증은 필수 입니다."]);
            
            $saveData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
            ];      

            $result = User::create($saveData);

            return redirect(route('login'))
                ->with('success_message','회원가입 완료되었습니다. 로그인 하세요.')
                ->with('email',$saveData['email']);
        }
    }

    // 인증번호 전송
    public function sendCertNum(Request $request){
        $phone = $request->phone;

        // 휴대폰번호 중복체크
        $cnt = User::where('phone',$phone)->count();
        if($cnt > 0){
            $result = ResultClass::fail('이미 가입된 휴대폰 번호입니다.');
        }else{

            if($request->ajax()){
                $response = (new SmsClass)->sendPhoneCertNumber($phone, 1);
                $result = ResultClass::success('인증번호가 전송 되었습니다.', $response);
            }else{
                $result = ResultClass::fail('잘못된 요청 입니다.');
            }
        }

        return $result->jsonResult();
    }

    public function confirmCertNum(Request $request){
        // 세션 시작
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $cert_number = $request->cert_number;
        if($request->ajax()){
            // 만료 시간 확인
            if (isset($_SESSION['cert_code']['expiry_time']) && time() > $_SESSION['cert_code']['expiry_time']) {
                // 세션 만료                
                unset($_SESSION['cert_code']);
                $result = ResultClass::fail('세션이 만료되었습니다.');
            } else {// 세션 유효
                if($_SESSION['cert_code']['code']==$cert_number){// 일치
                    $result = ResultClass::success('인증이 완료되었습니다.');
                }else{// 불일치
                    $result = ResultClass::fail('인증코드가 일치하지 않습니다.');
                }
            }
        }else{
            $result = ResultClass::fail('잘못된 요청 입니다.');
        }

        return $result->jsonResult();
    }
}
