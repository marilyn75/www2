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

    public function getListData($request, $itemNum=8){
        $data = $request->all();

        $model = IntraMember::where([
            'mb_out'=>0,
            'auth_gr'=>'M01_D01',
            ])->withCount('homepageSales');

        if(!empty($data['sort'])){
            $arrSort = explode("|", $data['sort']);
            if(empty($arrSort[1])) $arrSort[1] = 'asc';
            $model->orderBy($arrSort[0],$arrSort[1]);
            debug('order',$arrSort);            
        }else{
            $model->orderBy('reg_date','desc');
        }

        return $model->paginate($itemNum);
            
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
        $return['introduce'] = $data->info->introduce;

        $sales = $data->homepageSales;
        $clsIntraSale = new IntraSaleClass;
        foreach($sales as $_sale){
            $return['sales'][] = $clsIntraSale->getPrintData($_sale);
        }

        return $return;
    }
}