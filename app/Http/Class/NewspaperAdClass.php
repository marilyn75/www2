<?php

namespace App\Http\Class;

use App\Models\NewspaperAd;
use Yajra\DataTables\DataTables;
use App\Http\Class\lib\FileClass;
use App\Http\Class\lib\ResultClass;

// 신문광고관리 클래스

class NewspaperAdClass{

    protected $page_title = "신문광고관리";
    protected $page_comment = "신문광고 pdf파일을 관리 합니다.";
    protected $module_name = "newspaperad";
    private $model;

    public function __construct()
    {
        $this->model = new NewspaperAd;
    }

    public function getListData($request, $itemNum=8){
        $data = $request->all();

        $where[] = ['news_code', 70]; // 부산일보 고정
        if(!empty($data['y']))  $where[] = ['pub_date', 'like', $data['y'].'%'];
        else                    $where[] = ['pub_date', 'like', date("Y").'%'];

        $model = $this->model::where($where);
        $model->orderBy('pub_date','desc');

        return $model->paginate($itemNum);
    }
    
    public function datalist(){
        $data = $this->model::select('id', 'news_code', 'news_txt', 'pub_date')
                // ->where('board_id',$this->board_id)
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as formatted_created_at');
                // ->orderBy('id', 'desc');
            
        return DataTables::of($data)->toJson();
    }

    public function getData($id=null){
        if(empty($id)){
            $data = [
                'news' => old('news'),
                'news_code' => old('news_code'),
                'news_txt' => old('v'),
                'pub_date' => old('pub_date'),
                'file' => old('file'),
            ];
        }else{
            $row = $this->model->find($id);
            $data = $row->toArray();
            $data['file'] = $row->file();
        }

        return $data;
    }

    public function store($ctrl, $request){
        // 유효성 검사
        $ctrl->validate($request, $this->model->rules, $this->model->messages);

        $data = $request->all();

        $save_data = [
            'news_code' => $data['news_code'],
            'news_txt' => $data['news_txt'],
            'pub_date' => $data['pub_date'],
            'created_ip' => request()->ip(),
            'created_user_id' => auth()->user()->id,
        ];

        $result = NewspaperAd::create($save_data);
        if(!$result){
            return ResultClass::fail('신문광고 등록 실패');
        }

        // 첨부파일 처리
        if(!empty($data['file'])){
            $fileClass = new FileClass($this->module_name);
            $result = $fileClass->uploadModuleFile($data['file'], $result->id);

            if(!$result->isSuccess()){
                return $result;
            }
        }

        return ResultClass::success('신문광고가 등록 되었습니다.');
    }

    public function update($ctrl, $id, $request){
        $this->model->rules['file'] = str_replace('required|','',$this->model->rules['file']);
        // 유효성 검사
        $ctrl->validate($request, $this->model->rules, $this->model->messages);

        $data = $request->all();

        $model = $this->model->find($id);
        $model->news_code = $data['news_code'];
        $model->news_txt = $data['news_txt'];
        $model->pub_date = $data['pub_date'];
        $model->updated_ip = request()->ip();
        $model->updated_user_id = auth()->user()->id;
        $result = $model->update();

        if(!$result){
            return ResultClass::fail('신문광고 수정 실패');
        }

        // 첨부파일 처리
        if(!empty($data['file'])){
            $fileClass = new FileClass($this->module_name);
            $result = $fileClass->uploadModuleFile($data['file'], $id);

            if(!$result->isSuccess()){
                return $result;
            }
        }
        
        return ResultClass::success('신문광고가 수정 되었습니다.');
    }

    public function destroy($id){

        $model = $this->model::where('id',$id);
        $file_data = $model->first()->file();

        // 파일 삭제 
        if(!empty($file_data)){
            unlink(public_path($file_data->filepath . $file_data->filename));
            $file_data->delete();
        }

        $result = $model->delete();

        if($result) return ResultClass::success('신문광고가 삭제 되었습니다.');
        else        return ResultClass::fail('신문광고 삭제 실패');
    }
}