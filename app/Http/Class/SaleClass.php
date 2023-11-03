<?php

namespace App\Http\Class;

use App\Models\CommonCode;
use App\Models\Sale;
use DragonCode\Contracts\Cashier\Http\Request;
use Illuminate\Support\Facades\Session;

// 매물관련 클래스

class SaleClass{

    public function __construct()
    {
        
    }

    public function getTmpId(){
        $tmp_id = "";
        if(session()->has('sale_tmp_id')){
            $tmp_id = session("sale_tmp_id");
            $model = Sale::where(['tmp_id'=>$tmp_id, 'created_user_id'=>auth()->user()->id]);
            if($model->count() == 0){
                $model->forceDelete();
                $tmp_id = uniqid();
                Session::put('sale_tmp_id', $tmp_id);
            }
        }else{
            $tmp_id = uniqid();
            Session::put('sale_tmp_id', $tmp_id);
        }

        return $tmp_id;
    }

    public function getDataFromTmpId($tmp_id){
        $data = Sale::where(['tmp_id'=>$tmp_id, 'created_user_id'=>auth()->user()->id])->first();
        return is_null($data)?null:$data->toArray();
    }

    public function postSetp1($request){
        $data = $request->all();

        $result = Sale::create([
            'tmp_id' => $data['tmp_id'],
            'sale_code' => $data['tmp_id'],
            'trade_type' => $data['tradeType'],
            'trade_type_txt' => CommonCode::where('id', $data['tradeType'])->pluck('title')->first(),
            'sale_type' => $data['saleType'],
            'sale_type_txt' => $data['saleTypeTxt'],
            'title' => '',
            'created_user_id' => auth()->user()->id,
            'created_ip' => $request->ip(),
        ]);

        return $result;
    }
}