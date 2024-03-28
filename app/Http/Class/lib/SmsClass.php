<?php

namespace App\Http\Class\lib;

use App\Models\SMS;
use App\Models\IntraMember;
use App\Models\MMS;

// sms 클래스

class SmsClass{

    protected $callback;
    protected $_MAXBYTE_SMS;
    protected $_MAXBYTE_MMS;

    public function __construct()
    {
        $this->callback = '18338840';
        $this->_MAXBYTE_SMS = 90;
        $this->_MAXBYTE_MMS = 2000;
    }

    public function send($phone, $message){
        $phone = str_replace('-','',$phone);

        // 디버그모드에서는 sms 전송 안됨
        if(env('APP_DEBUG')=="debug"){
            $phone = '01055395077';
        }

        // if(env('APP_DEBUG')=="debug"){
        //     debug($message);
        //     $result = true;
        // }else{
            $send_mode = $this->chkSMSorMMS($message);
        
            if($send_mode=="SMS"){
                $result = $this->sendSMS($phone, $message);
            }elseif($send_mode=="MMS"){
                $result = $this->sendMMS($phone, $message);
            }else{
                $result = false;
            }
        // }

        debug('send result', $result);
        // $result 값
        // "TR_SENDDATE" => Illuminate\Support\Carbon @1703832125 {#762 ▶}
        // "TR_SENDSTAT" => "0"
        // "TR_MSGTYPE" => "0"
        // "TR_PHONE" => "01055395077"
        // "TR_CALLBACK" => "18338840"
        // "TR_MSG" => """
        //   계모임 휴대폰 인증번호 [8475]
        //           인증창에 정확히 입력하세요.
        //   """
        // "id" => 263
        return $result;
    }


    // sms 전송
    public function sendSMS($phone, $message){
        $result = SMS::create([
            'TR_SENDDATE' => now(), 
            'TR_SENDSTAT' => '0', 
            'TR_MSGTYPE' => '0', 
            'TR_PHONE' => $phone, 
            'TR_CALLBACK' => $this->callback, 
            'TR_MSG' => $message
        ]);

        return $result;
    }

    // mms 전송
    public function sendMMS($phone, $message){

        $result = MMS::create([
            'REQDATE' => now(), 
            'STATUS' => '0', 
            'TYPE' => '0', 
            'PHONE' => $phone, 
            'CALLBACK' => $this->callback, 
            'SUBJECT' => '',
            'MSG' => $message
        ]);

        return $result;
    }

    // 휴대폰 인증번호 전송
    public function sendPhoneCertNumber($phone, $mm = 5){

        // 세션 시작
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $randomNumber = rand(1000, 9999);

        $message = '계모임 휴대폰 인증번호 ['.$randomNumber.'] 
인증창에 정확히 입력하세요.';

        // 세션에 인증번호 저장
        // 현재 시간에 5분을 더해 만료 시간 계산
        $expiry_time = time() + $mm*60;
        $_SESSION['cert_code'] = [
            'code' => $randomNumber,
            'expiry_time' => $expiry_time,
        ];

        return $this->send($phone, $message);
    }

    // 사원에게 문의안내 sms
    public function sendRequiryNoti($postData){
        $sawon = IntraMember::where('user_id',$postData['b_free1'])->first();
        if(!empty($sawon->mb_mobile)){
            debug($sawon->mb_mobile);
            $name = (empty($postData['reg_name']))?"Guest":$postData['reg_name'];
            $message = '[계모임] '.$name.'님이 문의글을 남겼습니다.
인트라넷에서 확인하세요.
물건번호 : '.$postData['b_free2'].'
연락처 : '.$postData['b_hp'];

            return $this->send($sawon->mb_mobile, $message);
        }
        else
            return false;
    }

    private function str2byte($str){
        return mb_strlen($str,"EUC-KR");
    }

    private function chkSMSorMMS($msg){
        $result = "SMS";
        $strlen = $this->str2byte($msg);

        if($strlen > $this->_MAXBYTE_SMS)   $result = "MMS";
        if($strlen > $this->_MAXBYTE_MMS)   $result = "ERR";

        return $result;
    }
}