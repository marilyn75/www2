<?php

namespace App\Http\Controllers\Admin;

use App\Http\Class\CommonCodeClass;
use App\Http\Class\NewspaperAdClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewspaperAdsController extends Controller
{
    protected $cls;
    private $page_title = "신문 광고 관리";
    private $page_comment = "신문광고 pdf파일을 관리 합니다.";

    public function __construct(NewspaperAdClass $cls)
    {
        $this->cls = $cls;
    }

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
            return $this->cls->datalist();
        }
    }

    public function create(){
        $conf['cate'] = (new CommonCodeClass)->getNewspaperCodes();
        $conf['action'] = route('admin.newspaper-ads.store');

        $data = $this->cls->getData();

        return view('admin.newspaper-ads.create', compact('conf', 'data'));
    }

    public function store(Request $request){
        $result = $this->cls->store($this, $request);
    
        if($result->isSuccess())
            return back()->with('success_message',$result->getMessage());
        else
            return back()->with('error_message',$result->getMessage());
    }

    public function edit($id){
        $conf['cate'] = (new CommonCodeClass)->getNewspaperCodes();
        $conf['action'] = route('admin.newspaper-ads.update', $id);

        $data = $this->cls->getData($id);

        return view('admin.newspaper-ads.create', compact('conf', 'data'));
    }

    public function update($id, Request $request){
        $result = $this->cls->update($this, $id, $request);
    
        if($result->isSuccess())
            return back()->with('success_message',$result->getMessage());
        else
            return back()->with('error_message',$result->getMessage());
    }

    public function destroy($id){
        $result = $this->cls->destroy($id);
        return $result->jsonResult();
    }
}
