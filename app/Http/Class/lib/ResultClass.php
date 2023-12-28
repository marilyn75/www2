<?php

namespace App\Http\Class\lib;

// 처리결과 클래스

class ResultClass{

    protected $success;
    protected $message;
    protected $data;

    public function __construct($success, $message, $data)
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getDataCount()
    {
        if($this->isSuccess())  return count($this->data);
        else                    return 0;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public static function success($message = null, $data = null)
    {
        return new static(true, $message, $data);
    }

    public static function fail($errorMessage)
    {
        return new static(false, $errorMessage, null);
    }

    public function jsonResult(){
        return json_encode([
            'result'=>$this->success,
            'message'=>$this->message,
            'data'=>$this->data,
        ]);
    }
}