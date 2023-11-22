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
}