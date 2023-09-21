<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\BoardConf;
use App\Models\TmpFile;
use Illuminate\Http\Request;

class TmpFilesController extends Controller
{

    public function upload(Request $request){
        $file_path = public_path('/files/temp/');

        $data = $request->all();
        $file_data = $request->file('mupfile');
        $conf = BoardConf::find($data['board_conf_id']);

        if(empty($conf)) return json_encode(['result'=>false, 'msg'=>'파일업로드에 필요한 환경이 구성되지 않았습니다.']);

        // 파일 업로드 제약조건 체크
        $maxFileSize = $this->getFilesizeByte(ini_get("upload_max_filesize"));
        $postMaxSize = $this->getFilesizeByte(ini_get("post_max_size")) ;
        
        $uploadSizeLimit = $maxFileSize;
        if($maxFileSize > $postMaxSize) $uploadSizeLimit = $postMaxSize;
        if($uploadSizeLimit > $conf->file_size) $uploadSizeLimit = $conf->file_size;

        $ableFileExt = explode(",",$conf->file_type);
        $filesize = $file_data->getSize();
        $filetype = $file_data->getMimeType();

        if($uploadSizeLimit > 0 && $filesize > $uploadSizeLimit){
            return json_encode([
                "result"=>false,"msg"=>"업로드 가능 용량 초과 (".$uploadSizeLimit.")","size"=>$filesize
            ]);
        }

        $fileExt = $file_data->getClientOriginalExtension();
        IF(count($ableFileExt)>0 && !@in_array(strtolower($fileExt),$ableFileExt)) {
            return json_encode([
                "result"=>false,"msg"=>"업로드 가능한 파일이 아닙니다.","size"=>$filesize
            ]);
        }

        // 임시폴더로 파일 저장
        // $saveFileName = md5(uniqid().time().$file_data->file).".".$fileExt;
        if($file_data->isValid()){
            $fileName_org = $data["mupfile"]->getClientOriginalName();
            $fileName = md5(uniqid().time().$fileName_org).".".$fileExt;
            $data["mupfile"]->move($file_path, $fileName);
        }

        // 임시파일정보 테이블에 데이터 저장
        $num = TmpFile::where(['ss_id'=>$data['file_ss_id'], 'module'=>$data['module']])->count();
        $save_data = [
            'ss_id' => $data['file_ss_id'],
            'module' => $data['module'],
            'filepath' => '/files/temp/',
            'filename' => $fileName,
            'filename_org' => $fileName_org,
            'filesize' => $filesize,
            'filetype' => $filetype,
            'num' => $num,
            'created_ip' => $request->ip(),
            'created_id' => auth()->user()->id,
        ];
        $result = TmpFile::create($save_data);

        if($result){
            return json_encode(
                [
                    'result' => $result,
                    'uploadPath' => $file_path,
                    'filename' => $fileName,
                    'orgFileName' => $fileName_org,
                    'fileUrl' => $file_path . $fileName,
                    'fileIdx' => $result->id,
                    'size' => $filesize,
                    'type' => $filetype,
                    'fileViewUrl' => route('common.file.view',$fileName),
                    'fileDownUrl' => route('common.file.download',$fileName),
                ]
            );
        }else{
            return json_encode([
                'result' => false, 'errMsg' => "error"
            ]);
        }
        
    }

    public function download($filename){
        $filePath = public_path('files/temp/' . $filename);
        if(!file_exists($filePath)) $filePath = public_path('files/board/' . $filename);

        // 파일이 실제로 존재하는지 확인
        if (file_exists($filePath)) {
            $tmpfile = TmpFile::where('filename', $filename)->first();
            // 파일이 존재하는 경우 파일 다운로드 링크 생성
            return response()->download($filePath, $tmpfile->filename_org);
        } else {
            // 파일이 존재하지 않는 경우 404 에러 반환
            abort(404);
        }
    }

    public function view($filename){
        $filePath = public_path('files/temp/' . $filename);
        if(!file_exists($filePath)) $filePath = public_path('files/board/' . $filename);

        // 파일이 실제로 존재하는지 확인
        if (file_exists($filePath)) {
            // // 파일 확장자를 가져옴
            // $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

            // // 이미지 파일 또는 텍스트 파일인 경우 브라우저에서 직접 보여줌
            // if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'txt'])) {
                return response()->file($filePath);
            // } else {
            //     // 다른 파일 형식인 경우 다운로드 링크 생성
            //     return response()->download($filePath, $filename);
            // }
        } else {
            // 파일이 존재하지 않는 경우 404 에러 반환
            abort(404);
        }
    }

    public function getFilesizeByte($str){
        $size_str = str_replace("BYTE","",strtoupper($str));
    
        if(strpos($size_str,"K")!==false){
            $size = str_replace("K","",$size_str) * 1 * 1024 * 1024;
        }elseif(strpos($size_str,"M")!==false){
            $size = str_replace("M","",$size_str) * 1 * 1024 * 1024;
        }	elseif(strpos($size_str,"G")!==false){
            $size = str_replace("G","",$size_str) * 1 * 1024 * 1024;
        }
    
        return $size;
    }
}
