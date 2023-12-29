<?php

namespace App\Http\Class\lib;

use App\Models\SMS;

// sms 클래스

class SmsClass{

    protected $model;
    protected $callback;

    public function __construct()
    {
        $this->model = new SMS;
        $this->callback = '18338840';
    }

    public function send($phone, $message){
        $phone = str_replace('-','',$phone);

        // 디버그모드에서는 sms 전송 안됨
        if(env('APP_DEBUG')=="debug"){
            $result = true;
        }else{
            $result = $this->model->create([
                'TR_SENDDATE' => now(), 
                'TR_SENDSTAT' => '0', 
                'TR_MSGTYPE' => '0', 
                'TR_PHONE' => $phone, 
                'TR_CALLBACK' => $this->callback, 
                'TR_MSG' => $message
            ]);
        }

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

        debug('sendPhoneCertNumber - message', $message);
        return $this->send($phone, $message);
    }
}