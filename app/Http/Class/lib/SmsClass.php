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

    public function send(){
        // $DATA["TR_SENDDATE"] = "now()";
        // $DATA["TR_SENDSTAT"] = "0";
        // $DATA["TR_MSGTYPE"] = "0";
        // $DATA["TR_PHONE"] = $R_DATA["phone"];
        // $DATA["TR_CALLBACK"] = "18338840";
        // $DATA["TR_MSG"] = $R_DATA["msg"];
        
    }
}