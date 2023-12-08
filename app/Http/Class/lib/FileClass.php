<?php

namespace App\Http\Class\lib;

use App\Models\ModuleFile;
use Illuminate\Support\Facades\File;

// 파일처리관련 클래스

class FileClass{

    public $module;
    private $model;
    private $path;

    public function __construct($module_name)
    {
        $this->model = new ModuleFile;
        $this->path = public_path('files/'.$module_name);
        $this->module = $module_name;
    }

    public function uploadModuleFile($file, $id=null){
        $this->chkDir($this->path);

        $fileExt = $file->getClientOriginalExtension();
        $fileName_org = $file->getClientOriginalName();
        $fileName = md5(uniqid().time().$fileName_org).".".$fileExt;
        $filesize = $file->getSize();
        $filetype = $file->getMimeType();

        $file->move($this->path, $fileName);

        $num = $this->model::where(['module_code' => $this->module, 'module_data_id' => $id,])->count() + 1;

        $save_data = [
            'module_code' => $this->module,
            'module_data_id' => $id,
            'filepath' => $this->path,
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

    // 디렉토리 체크 없으면 생성
    private function chkDir($dir){
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0777, true, true);
        }
    }

}