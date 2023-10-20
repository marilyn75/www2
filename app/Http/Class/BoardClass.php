<?php

namespace App\Http\Class;

use App\Models\BoardConf;
use DataTables;
use App\Models\BoardData;
use App\Models\BoardFile;
use App\Models\TmpFile;

// 게시판관련 클래스

class BoardClass{
    private $conf;
    private $post;
    private $board_id;

    public function __construct($board_id=null, $id=null)
    {
        $this->board_id = $board_id;

        if(!empty($id)){
            $this->post = BoardData::where('id', $id)->first();
            if(empty($this->board_id)) $this->board_id = $this->post->conf->id;
        }
        $this->conf = $this->getConf();
    }

    // 게시판 목록
    public function getBoardList(){
        return BoardConf::orderBy('board_name', 'asc')->get();
    }

    // 환경설정값
    public function getConf(){
        if(empty($this->conf)){
            $this->conf = (empty($this->post))?BoardConf::find($this->board_id):$this->post->conf;
        }

        return $this->conf;
    }

    // 게시글 데이터
    public function getPost(){
        return $this->post;
    }

    // 조회수 증가
    public function incrementHits($cnt=1){
        if(!empty($this->post)) $this->post->increment('hits', $cnt);
    }

    // 게시판 존재여부
    public function isExist(){
        return !empty($this->conf);
    }

    public function getBoardName(){
        return ($this->conf)?$this->conf->board_name:"";
    }

    public function datalist(){
        $data = BoardData::select('id', 'title', 'writer')
                ->where('board_id',$this->board_id)
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as formatted_created_at');
                // ->orderBy('id', 'desc');
            
        return DataTables::of($data)->toJson();
    }

    public function store(&$controller, $request){
        // 유효성 검사
        $controller->validate($request, BoardData::$rules);

        $data = $request->all();

        $save_data = [
            'board_id' => $this->board_id,
            'title' => $data['title'],
            'content' => $data['content'],
            'created_user_id' => auth()->user()->id,
            'created_ip' => $request->ip(),
            'writer' => auth()->user()->name,
        ];

        $result = BoardData::create($save_data);
        $board_data_id = $result->id;

        if($result){
            // 첨부파일 처리
            if(!empty($data['tmpfile_idx'])){
                foreach($data['tmpfile_idx'] as $tmp_file_id){
                    
                    $tmp = TmpFile::where('id',$tmp_file_id)->first();
                    // $tmp = TmpFile::find($tmp_file_id)->first();
                    // dd($tmp);
                    // 파일 이동
                    $tmp_file = public_path($tmp->filepath.$tmp->filename);
                    $save_file = public_path('/files/board/'.$tmp->filename);
                    $move_result = rename($tmp_file, $save_file);
                    if($move_result){
                        $save_file_data = [
                            'board_data_id' => $board_data_id,
                            'num'   => $tmp->num,
                            'filepath' => '/files/board/',
                            'filename' => $tmp->filename,
                            'filename_org' => $tmp->filename_org,
                            'filesize' => $tmp->filesize,
                            'filetype' => $tmp->filetype,
                            'created_user_id' => auth()->user()->id,
                            'created_ip' => $request->ip(),
                        ];
                        BoardFile::create($save_file_data);
                    }
                }
            }
        }
    }

    // 조회페이지용 데이터
    public function getViewData($request=null){
        $data = $this->getPost();
        $this->incrementHits();  // 조회수 증가

        // 프로필 사진
        if(!empty($data->user)){
            if(empty($data->user->file)){
                if($data->user->hasSocialAccounts() > 0)
                    $data->photo = $data->user->socialAccounts()->first()->avatar;
                else
                    $data->photo = '/images/user-placeholder.png';
            }else{
                $data->photo = '/files/profile/' . $data->user->file;
            }
        }else{
            $data->photo = '/images/user-placeholder.png';
        }

        // 작성자이름
        if(empty($data->writer) && !empty($data->user))    $data->writer = $data->user->name;

        // 이전글, 다음글
        $currentPostId = $data->id;
        $data->previousPost = BoardData::where('board_id', $this->board_id)->where('id', '<', $currentPostId)
            ->orderBy('id', 'desc')
            ->first();
        $data->nextPost = BoardData::where('board_id', $this->board_id)->where('id', '>', $currentPostId)
            ->orderBy('id', 'asc')
            ->first();

        $_MULTIFILE = [];
        // 첨부파일
        if(!empty($data->files)){
            $data->attachFiles = $data->files;

            foreach($data->attachFiles as $f){
                $ext = pathinfo(public_path($f['filepath']).$f['filename'])['extension'];
                $_MULTIFILE[] = json_encode(Array(
                    "num"=>$f['num'],
                    "id"=>$f['id'],
                    "fidx"=>$f["id"],
                    "name"=>$f["filename_org"],
                    "size"=>$f["filesize"],
                    // "status"=>$_BOARD_TXT["LABEL_ORG_FILE"],
                    // "alt"=>$_files["file_content_org"],
                    // "del_lbl"=>$_BOARD_TXT["LABEL_ORG_FILE"]." " .$_BOARD_TXT["LABEL_DEL"],
                    "type"=>$ext,
                    // "content"=>$_files["file_content"],
                    'fileViewUrl' => route('common.file.view',$f['filename']),
                    'fileDownUrl' => route('common.file.download',$f['filename']),
                    "fileName"=>$f["filename"],
                    "orgFileName"=>$f["filename_org"],
                    // "upload_date"=>Date("Y-m-d H:i",$_files["reg_date"]),
                ));
            }
        }

        
        

        // validate이후 파일정보
        // if(!empty($request->old('ss_id'))){
        //     $tmp_files = TmpFile::where('ss_id', $ss_id)->orderBy('num', 'asc')->get();
        //     foreach($tmp_files as $f){
        //         $ext = pathinfo(public_path($f['filepath']).$f['filename'])['extension'];
        //         $_MULTIFILE[] = json_encode(Array(
        //             "num"=>$f['num'],
        //             "id"=>$f['id'],
        //             "fidx"=>$f["id"],
        //             "name"=>$f["filename_org"],
        //             "size"=>$f["filesize"],
        //             // "status"=>$_BOARD_TXT["LABEL_ORG_FILE"],
        //             // "alt"=>$_files["file_content_org"],
        //             // "del_lbl"=>$_BOARD_TXT["LABEL_ORG_FILE"]." " .$_BOARD_TXT["LABEL_DEL"],
        //             "type"=>$ext,
        //             // "content"=>$_files["file_content"],
        //             'fileViewUrl' => route('common.file.view',$f['filename']),
        //             'fileDownUrl' => route('common.file.download',$f['filename']),
        //             "fileName"=>$f["filename"],
        //             "orgFileName"=>$f["filename_org"],
        //             // "upload_date"=>Date("Y-m-d H:i",$_files["reg_date"]),
        //         ));
        //     }
        // }
        $data->_multifile = $_MULTIFILE;

        return $data;
    }

    // 파일 다운로드
    public function fileDownload($file_id){
        $file_data = BoardFile::find($file_id);
        $filePath = public_path($file_data->filepath . $file_data->filename);

        // 파일이 실제로 존재하는지 확인
        if (file_exists($filePath)) {
            return response()->download($filePath, $file_data->filename_org);
        } else {
            // 파일이 존재하지 않는 경우 404 에러 반환
            abort(404);
        }
    }

    // 게시글 업데이트 처리
    public function update($request){
        $data = $request->all();

        /* 첨부파일 처리 */
        $board_data_id = $this->post->id;
        if(!empty($data['tmpfile_idx'])){
            $_num = 0;
            foreach($data['tmpfile_idx'] as $_fidx){
                if(empty($_fidx)) continue;
                
                if(substr($_fidx,0,1)=="O"){    // 기존파일 처리
                    $fid = intval(substr($_fidx,1));
                    BoardFile::find($fid)->update(['num' => $_num]);
                }else{                          // 추가파일 처리
                    $tmp = TmpFile::where('id',$_fidx)->first();
                    // $tmp = TmpFile::find($tmp_file_id)->first();
                    // dd($tmp);
                    // 파일 이동
                    $tmp_file = public_path($tmp->filepath.$tmp->filename);
                    $save_file = public_path('/files/board/'.$tmp->filename);
                    $move_result = rename($tmp_file, $save_file);
                    if($move_result){
                        $save_file_data = [
                            'board_data_id' => $board_data_id,
                            'num'   => $_num,
                            'filepath' => '/files/board/',
                            'filename' => $tmp->filename,
                            'filename_org' => $tmp->filename_org,
                            'filesize' => $tmp->filesize,
                            'filetype' => $tmp->filetype,
                            'created_user_id' => auth()->user()->id,
                            'created_ip' => $request->ip(),
                        ];
                        BoardFile::create($save_file_data);
                    }
                }
                $_num++;
            }
        }
        if(!empty($data['del_fidx'])){
            // 삭제파일처리
            foreach($data['del_fidx'] as $_fidx){
                $delFile = BoardFile::find($_fidx);
                // $filepath = public_path($delFile->filepath.$delFile->filename);
                // @unlink($filepath);
                $delFile->delete();
            }
        }

        // 데이터 처리
        $this->post->title = $data['title'];
        $this->post->content = $data['content'];
        $this->post->updated_user_id = auth()->user()->id;
        $this->post->updated_ip = $request->ip();

        $r = $this->post->update();
    }

    // 게시글 삭제
    public function destroy(){
        // 첨부파일 데이터 삭제
        $files = $this->post->files;
        foreach($files as $_f){
            $_f->delete();
        }

        $this->post->delete();
    }
}