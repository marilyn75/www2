<?php

namespace App\Http\Class;

use stdClass;
use App\Models\Sale;
use GuzzleHttp\Client;
use App\Models\CommonCode;
use App\Models\IntraMember;
use App\Models\IntraBoardDefault;
use App\Models\IntraSaleHomepage;
use Illuminate\Support\Facades\DB;
use App\Http\Class\lib\ResultClass;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use DragonCode\Contracts\Cashier\Http\Request;

// 매물관련 클래스

class IntraSawonClass{

    public function __construct()
    {
        
    }

    public function getListData($request, $itemNum=9){
        $data = $request->all();

        $model1 = DB::connection('mysql_intranet')
            ->table(DB::raw("
                (select count(*) as homepage_sales_count 
                from CS_SALE_HOMEPAGE a 
                join (select * from CS_MEMBER aa join CS_MEMBER_SINFO bb on aa.user_key=bb.s_user_key) b 
                on a.user_id=b.user_id 
                where mb_out=0 and auth_gr='M01_D01' and chkcert!='y' and a.isDel=0 and a.isDone=1) 
                tbl"))
            ->selectRaw("0 as idx, '' as mb_photo, '개벽 부동산' as user_name, '' as duty, '중개법인' as sosok, '8840' as office_line, '' as mb_email, homepage_sales_count, '' as reg_date");

        $model = DB::connection('mysql_intranet')
                    ->table('CS_MEMBER')
                    ->join('CS_MEMBER_SINFO', 'CS_MEMBER.user_key', '=', 'CS_MEMBER_SINFO.s_user_key')
                    ->where([
                        'mb_out'=>0,
                        'auth_gr'=>'M01_D01',
                        'chkcert'=>'y',
                        ])
                    ->select('idx','mb_photo', 'user_name', 'duty', 'sosok', 'office_line', 'mb_email', DB::raw('(select count(*) from CS_SALE_HOMEPAGE where user_id=CS_MEMBER.user_id and isDel=0 and isDone=1) as homepage_sales_count'), 'reg_date')
                    ->union($model1);

        // $model = IntraMember::where([
        //     'mb_out'=>0,
        //     'auth_gr'=>'M01_D01',
        //     ])->withCount('homepageSales');

        if(!empty($data['sort'])){
            $arrSort = explode("|", $data['sort']);
            if(empty($arrSort[1])) $arrSort[1] = 'asc';
            $model->orderBy($arrSort[0],$arrSort[1]);        
        }else{
            $model->orderBy('reg_date','desc');
        }

        return $model->paginate($itemNum);
            
    }

    public function getData($idx){
        return IntraMember::find($idx);
    }

    public function getPrintData($data){
        // if ($data instanceof stdClass) {
        //     debug('stdClass');
        // }else{
        //     debug('Eloquent');
        // }
        $return = $data->toArray();

        $return['duty'] = $data->info->duty;
        $return['sosok'] = str_replace('소속','',$data->info->sosok);
        $return['office_line'] = $data->info->office_line;

        $return['photo'] = $data->mb_photo;
        $return['photo'] = (empty($return['photo']))?"/images/sawon-placeholder.png":"https://www.gbbinc.co.kr/_Data/Member/".$return['photo'];

        $return['slogan'] = $data->info->slogan;
        $return['introduce'] = $data->info->introduce;

        $sales = $data->homepageSales;
        $clsIntraSale = new IntraSaleClass;
        foreach($sales as $_sale){
            $return['sales'][] = $clsIntraSale->getPrintData($_sale);
        }

        $return['sawon_user_id'] = $data->user_id;
        return $return;
    }

    // 중개사에게 문의하기 
    public function sendInquiry($request){

        $apiUrl = "http://test.gbbinc.co.kr/Share/api.php";

        $client = new Client();

        $subject = $request->name ."님의 문의글";
        if(!empty($request->p_code))    $subject .= " (물건번호 : ".$request->p_code.")";
        $postData = [
            'site_code' => 'mng',
            'board_code' => 'inquiry',
            'b_subject' => $subject,
            'b_content' => $request->message,
            // 'b_content_s' => $request->message,
            'b_content_type' => 'T',
            'reg_ip' => $request->ip(),
            'reg_name' => $request->name,
            'reg_user_id' => (auth()->check())?auth()->user()->id:'',
            'b_hp' => $request->phone,
            'b_email' => $request->email,
            'b_free1' => $request->user_id,  // 중개사아이디
            'b_free2' => $request->p_code,  // 물건번호
            'b_free3' => $request->s_idx,  // 물건 idx
            'reg_pwd' => 'inquiry',
        ];
        try {
            // POST 요청 보내기
            // $response = $client->post($apiUrl,$postData);
            $response = Http::asForm()->post($apiUrl,$postData);

            // 응답 내용 가져오기
            $data = json_decode($response->getBody(), true);
            debug($data);
            // 여기에서 $data를 가공하거나 필요에 따라 처리합니다.

            // return response()->json($data);
            if($data['result'])
                return ResultClass::success('문의 내용이 전달 되었습니다. 담당자 확인 후 연락드리겠습니다.');
            else
                return ResultClass::fail('문의하기 실패.');
        } catch (\Exception $e) {
            // 에러 처리
            // return response()->json(['error' => $e->getMessage()], 500);
            return ResultClass::fail('문의하기 실패.');
        }
    }
}