<?php

namespace App\Http\Class;

use App\Models\Sale;
use App\Models\CommonCode;
use App\Models\IntraMember;
use App\Models\IntraSaleHomepage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use DragonCode\Contracts\Cashier\Http\Request;

// 매물관련 클래스

class IntraSawonClass{

    public function __construct()
    {
        
    }

    public function getListData($itemNum=8){
        return IntraMember::where([
            'mb_out'=>0,
            'auth_gr'=>'M01_D01',
            ])->orderBy('reg_date','asc')->paginate($itemNum);
    }

    public function getData($idx){
        return IntraMember::find($idx);
    }

    public function getPrintData($data){
        $return = $data->toArray();

        $return['duty'] = $data->info->duty;
        $return['sosok'] = $data->info->sosok;
        $return['office_line'] = $data->info->office_line;

        $return['photo'] = $data->mb_photo;
        $return['photo'] = (empty($return['photo']))?"/images/user-placeholder.png":"https://www.gbbinc.co.kr/_Data/Member/".$return['photo'];

        $return['slogan'] = $data->info->slogan;

        $sales = $data->homepageSales;
        $clsIntraSale = new IntraSaleClass;
        foreach($sales as $_sale){
            $return['sales'][] = $clsIntraSale->getPrintData($_sale);
        }

        return $return;
    }
}