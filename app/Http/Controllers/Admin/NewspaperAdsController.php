<?php

namespace App\Http\Controllers\Admin;

use App\Http\Class\CommonCodeClass;
use App\Http\Class\lib\FileClass;
use App\Http\Class\NewspaperAdClass;
use App\Http\Controllers\Controller;
use App\Models\NewspaperAd;
use Illuminate\Http\Request;

class NewspaperAdsController extends Controller
{
    private $page_title = "신문 광고 관리";
    private $page_comment = "신문광고 pdf파일을 관리 합니다.";

    public function index(){
        $condition = "";
        if(session()->has('condition')){
            $condition = session('condition');
            session()->forget('condition');
        }
        

        return view('admin.newspaper-ads.index', compact('condition'));
    }

    public function getTableData(Request $request){
        if($request->ajax()){   
            return (new NewspaperAdClass)->datalist();
        }
    }

    public function create(){
        $ss_id = md5(uniqid());

        $conf['ss_id'] = $ss_id;
        $conf['cate'] = (new CommonCodeClass)->getNewspaperCodes();

        $data = [
            'news' => old('news'),
            'news_code' => old('news_code'),
            'news_txt' => old('v'),
            'pub_date' => old('pub_date'),
            'file' => old('file'),
        ];

        return view('admin.newspaper-ads.create', compact('conf', 'data'));
    }

    public function store(Request $request){
        $data = $request->all();
        // dd($data);
        // 유효성 검사
        $this->validate($request, NewspaperAd::$rules, NewspaperAd::$messages);

        $save_data = [
            'news_code' => $data['news_code'],
            'news_txt' => $data['news_txt'],
            'pub_date' => $data['pub_date'],
            'created_ip' => request()->ip(),
            'created_id' => auth()->user()->id,
        ];

        $result = NewspaperAd::create($save_data);

        // 첨부파일 처리
        if(!empty($data['file'])){
            $fileClass = new FileClass('newspaperad');
            $fileinfo = $fileClass->uploadModuleFile($data['file'], $result->id);
        }

        return back()
            ->with('success_message','신문광고가 등록 되었습니다.');
    }
}
