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
use App\Http\Class\lib\SmsClass;
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
            ->selectRaw("0 as idx, '' as mb_photo, '부동산중개법인개벽' as user_name, '' as duty, '주식회사' as sosok, '8840' as office_line, '' as mb_email, homepage_sales_count, '' as reg_date");

        $model = DB::connection('mysql_intranet')
                    ->table('CS_MEMBER')
                    ->join('CS_MEMBER_SINFO', 'CS_MEMBER.user_key', '=', 'CS_MEMBER_SINFO.s_user_key')
                    ->where([
                        'mb_out'=>0,
                        'auth_gr'=>'M01_D01',
                        'chkcert'=>'y',
                        'gmi_hide1' => 0,   // 계원소개제외여부
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

        if($idx==0){    // 중개보조원 모두
            $data = "other";
        }else
            $data = IntraMember::find($idx); 

        return $data;
    }

    public function getPrintData($data){
        // if ($data instanceof stdClass) {
        //     debug('stdClass');
        // }else{
        //     debug('Eloquent');
        // }

        if($data=="other"){ // 중개보조원들
            $return['duty'] = "";
            $return['sosok'] = "주식회사";
            $return['office_line'] = "8840";

            $return['photo'] = "/images/sawon-placeholder.png";

            $return['slogan'] = "";
            $return['introduce'] = "";

            // $sales = $data->homepageSales;
            // $clsIntraSale = new IntraSaleClass;
            // foreach($sales as $_sale){
            //     $return['sales'][] = $clsIntraSale->getPrintData($_sale);
            // }

            $return['sawon_user_id'] = "radmin";
            $return['user_name'] = "부동산중개법인개벽";
            
            $sales = IntraSaleHomepage::join('CS_MEMBER','CS_MEMBER.user_id','=','CS_SALE_HOMEPAGE.user_id')
                ->join('CS_MEMBER_SINFO', 'CS_MEMBER.user_key', '=', 'CS_MEMBER_SINFO.s_user_key')
                ->where([
                    'mb_out'=>0, 
                    'auth_gr'=>'M01_D01',
                    'CS_SALE_HOMEPAGE.isDone'=>1,
                    'CS_SALE_HOMEPAGE.isDel'=>0,
                ])->where('chkcert','!=','y')
                ->select('CS_SALE_HOMEPAGE.*')
                ->orderBy('reg_date','desc')
                ->paginate(5);
 
            $clsIntraSale = new IntraSaleClass;
            $return['sales'] = $sales;
            // foreach($sales as $_sale){
            //     $return['sales'][] = $clsIntraSale->getPrintData($_sale);
            // }

            $return['chkcert'] = "n";

        }else{
            $return = $data->toArray();

            $return['duty'] = $data->info->duty;
            $return['sosok'] = $data->info->sosok;
            $return['office_line'] = $data->info->office_line;

            $return['photo'] = $data->mb_photo;
            $return['photo'] = (empty($return['photo']))?"/images/sawon-placeholder.png":env('INTRANET_DOMAIN')."/_Data/Member/".$return['photo'];

            $return['slogan'] = $data->info->slogan;
            $return['introduce'] = $data->info->introduce;

            // $sales = $data->homepageSales->paginate(5);
            $sales = IntraSaleHomepage::where([
                'isDone'=>1,
                'isDel'=>0,
                'user_id'=>$data->user_id,
            ])
            ->orderBy('reg_date','desc')
            ->paginate(5);
            $return['sales'] = $sales;
            // $clsIntraSale = new IntraSaleClass;
            // foreach($sales as $_sale){
            //     $return['sales'][] = $clsIntraSale->getPrintData($_sale);
            // }

            $return['sawon_user_id'] = $data->user_id;

            $return['chkcert'] = "y";
        }
        return $return;
    }

    // 중개사에게 문의하기 
    public function sendInquiry(&$controller, $request){
        $required = ['phone'=>'required', 'message'=>'required'];
        $messages = [];
        if(!auth()->check()){
            $required['agree'] = 'required';
            $messages = [
                'agree.required' => '개인정보처리방침에 동의해주세요.',
            ];
        }
        $controller->validate($request, $required, $messages);

        $apiUrl = env('INTRANET_DOMAIN')."/Share/api.php";

        $client = new Client();

        $name = empty($request->name) ? 'Guest' : $request->name;
        if(empty($request->gbn)){// 물건문의 

            $subject = $name ."님의 문의글";
            if(!empty($request->p_code))    $subject .= " (물건번호 : ".$request->p_code.")";
            $postData = [
                'site_code' => 'mng',
                'board_code' => 'inquiry',
                'b_subject' => $subject,
                'b_content' => $request->message,
                // 'b_content_s' => $request->message,
                'b_content_type' => 'T',
                'reg_ip' => $request->ip(),
                'reg_name' => $name,
                'reg_user_id' => (auth()->check())?auth()->user()->id:'',
                'b_hp' => $request->phone,
                'b_email' => $request->email,
                'b_free1' => $request->user_id,  // 중개사아이디
                'b_free2' => $request->p_code,  // 물건번호
                'b_free3' => $request->s_idx,  // 물건 idx
                'reg_pwd' => 'inquiry',
            ];
        }else{          // 경공매 문의
            $subject = $name ."님의 문의글";
            if(!empty($request->p_code))    $subject .= " (물건번호 : ".$request->title.")";
            $postData = [
                'site_code' => 'mng',
                'board_code' => 'auction',
                'CgCode' => $request->gbn,
                'b_subject' => $subject,
                'b_content' => $request->message,
                // 'b_content_s' => $request->message,
                'b_content_type' => 'T',
                'reg_ip' => $request->ip(),
                'reg_name' => $name,
                'reg_user_id' => (auth()->check())?auth()->user()->id:'',
                'b_hp' => $request->phone,
                'link_url1' => $request->link_url,  // 물건링크
                'b_email' => $request->email,
                'b_free1' => $request->title,  // 물건번호
                'b_free2' => $request->addr,  // 물건명 (소재지)
                'reg_pwd' => 'inquiry',
            ];
        }
        try {
            // POST 요청 보내기
            // $response = $client->post($apiUrl,$postData);
            // $apiUrl = "http://local.gbbinc.co.kr/Share/api.php";
            $response = Http::asForm()->post($apiUrl,$postData);

            // 응답 내용 가져오기
            $data = json_decode($response->getBody(), true);

            // return response()->json($data);
            if($data['result']){
                // 사원에게 알림 sms
                $result = (new SmsClass)->sendRequiryNoti($postData);
debug($result);
                return ResultClass::success('문의 내용이 전달 되었습니다. 담당자 확인 후 연락드리겠습니다.');
            }else{
                return ResultClass::fail('[ERR] 문의하기 실패하였습니다.');
            }
        } catch (\Exception $e) {
            // 에러 처리
            // return response()->json(['error' => $e->getMessage()], 500);
            return ResultClass::fail('문의하기 실패.'.$e->getMessage()."\n".$e->getLine());
        }
    }

    // 메인 전문가 추천
    public function mainAgents(){
        $data = IntraMember::join('CS_MEMBER_SINFO', 'CS_MEMBER.user_key','=','CS_MEMBER_SINFO.s_user_key')
            ->where([
                'mb_out'=>0, 
                'auth_gr'=>'M01_D01'
            ])
            ->where('chkcert','=','y')
            ->orderBy('user_name', 'asc')
            ->get();
        return $data;
    }
}