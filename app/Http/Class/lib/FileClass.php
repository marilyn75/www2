<?php

namespace App\Http\Class\lib;

use App\Models\ModuleFile;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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
                @unlink(public_path($_f->filepath . $_f->filename));
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

    public function mkThumbnailFromUrl($imgUrl, $w=250, $h=150){
        $path = '/files/thumb/';
        $this->chkDir(public_path($path));

        // 이미지 파일명 확인
        $filename = pathinfo($imgUrl, PATHINFO_FILENAME);
        // 이미지 확장자 확인
        $extension = pathinfo($imgUrl, PATHINFO_EXTENSION);
        $saveFileName = $filename.'_'.$w.'x'.$h.'.'.$extension;
        $outputPath = public_path($path.$saveFileName);

        if(!file_exists($outputPath)){

            $imageContent = @file_get_contents($imgUrl);
            if($imageContent === false){
                return null;
            }

            // 이미지 로드
            $image = Image::make($imageContent);

            // 이미지 리사이징
            $image->fit($w, $h);

            // 워터마크 로드
            $watermarkPath = public_path("/images/property/watermark.png");
            $watermark = Image::make($watermarkPath);
            // 워터마크 크기 조정
            $wm_w = $watermark->width();
            $wm_h = $watermark->height();

            if($wm_w >= $image->width() - 40){
                $wm_w = $image->width() - 40;
                $wm_h = round($wm_w / 11);
                $watermark->fit($wm_w, $wm_h);
            }

            // 이미지에 워터마크 삽입
            $image->insert($watermark, 'center');

            // 새로운 이미지 저장
            $image->save($outputPath);
        }

        return str_replace(base_path('public'), '', $outputPath);

        // 이미지 출력
        // return $image->response();
    }
}