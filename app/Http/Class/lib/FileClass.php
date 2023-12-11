<?php

namespace App\Http\Class\lib;

use App\Models\ModuleFile;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

// 파일처리관련 클래스

class FileClass{

    public $module;
    private $model;
    private $path;

    public function __construct($module_name=null)
    {
        $this->model = new ModuleFile;
        $this->path = public_path('files/'.$module_name);
        $this->module = $module_name;
    }

    public function uploadModuleFile($file, $module_data_id, $num=null){
        $this->chkDir($this->path);

        $this->removePreFile($module_data_id, $num);

        $fileExt = $file->getClientOriginalExtension();
        $fileName_org = $file->getClientOriginalName();
        $fileName = md5(uniqid().time().$fileName_org).".".$fileExt;
        $filesize = $file->getSize();
        $filetype = $file->getMimeType();

        $file->move($this->path, $fileName);

        if(empty($num)) $num = $this->model::where(['module_code' => $this->module, 'module_data_id' => $module_data_id,])->count() + 1;

        $save_data = [
            'module_code' => $this->module,
            'module_data_id' => $module_data_id,
            'filepath' => '/files/'.$this->module.'/',
            'filename' => $fileName,
            'filename_org' => $fileName_org,
            'filesize' => $filesize,
            'filetype' => $filetype,
            'num' => $num,
            'created_ip' => request()->ip(),
            'created_id' => auth()->user()->id,
        ];
        $result = $this->model::create($save_data);

        return ($result)?ResultClass::success('파일 업로드 성공', $result):ResultClass::fail('파일 업로드 오류');
    }

    // 기존파일 삭제
    public function removePreFile($module_data_id, $num=null){
        $data = $this->model::where(['module_code' => $this->module, 'module_data_id' => $module_data_id,]);
        debug($this->module, $module_data_id, $data->count());
        if(!empty($num)) $data->where('num', $num);

        if($data->count() > 0){
            foreach($data->get() as $_f){
                unlink(public_path($_f->filepath . $_f->filename));
            }
            $data->delete();
        }

    }

    // 디렉토리 체크 없으면 생성
    private function chkDir($dir){
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0777, true, true);
        }
    }

    public function download($id){

        $file_data = $this->model::find($id);
        $path = public_path($file_data->filepath . $file_data->filename);

        if(!File::exists($path))    abort(404);

        $file = File::get($path);
        $type = $file_data->filetype;

        $response = new Response($file, 200);
        $response->header('Content-Type', $type);
        $response->header('Content-Disposition', 'attachment; filename="' . $file_data->filename_org . '"');

        return $response;
    }

    public function viewfile($id){

        $file_data = $this->model::find($id);
        $path = public_path($file_data->filepath . $file_data->filename);

        if(!File::exists($path))    abort(404);

        $file = File::get($path);
        $type = $file_data->filetype;

        return response($file, 200)->header('Content-Type', $type);
    }

}