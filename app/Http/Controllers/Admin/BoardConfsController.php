<?php

namespace App\Http\Controllers\Admin;

use App\Http\Class\BoardClass;
use DataTables;
use App\Http\Controllers\Controller;
use App\Models\BoardConf;
use App\Models\BoardPermission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class BoardConfsController extends Controller
{
    public function index()
    {
        $condition = "";
        if(session()->has('condition')){
            $condition = session('condition');
            session()->forget('condition');
        }

        return view('admin.board-confs.index', compact('condition'));
    }

    public function getTableData(Request $request){
        if($request->ajax()){
            $data = BoardConf::select('id', 'board_name', 'skin')
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as formatted_created_at')
                ->orderBy('id', 'desc');
            return DataTables::of($data)->toJson();
        }
    }

    public function create(){
        return view('admin.board-confs.create');
    }

    public function store(Request $request){
        $data = $request->all();

        // 유효성 검사
        $this->validate($request, BoardConf::$rules);

        $save_data = [
            'board_name' => $data['board_name'],
            'skin' => $data['skin'],
            'use_comment' => $data['use_comment'],
            'use_secret' => $data['use_secret'],
            'file_num' => $data['file_num'],
            'file_type' => $data['file_type'],
            'file_size' => $data['file_size'],
            'file_total_size' => $data['file_total_size'],
        ];

        $result = BoardConf::create($save_data);

        return back()
            ->with('success_message','게시판이 생성 되었습니다.');
    }

    public function edit($id){
        $data = BoardConf::find($id);
        return view('admin.board-confs.edit')->with(compact('data'));
    }

    public function update(Request $request){
        $data = $request->all();

        $board_conf = BoardConf::find($data['id']);

        $board_conf->board_name = $data['board_name'];
        $board_conf->skin = $data['skin'];
        $board_conf->use_comment = $data['use_comment'];
        $board_conf->use_secret = $data['use_secret'];
        $board_conf->file_num = $data['file_num'];
        $board_conf->file_type = $data['file_type'];
        $board_conf->file_size = $data['file_size'];
        $board_conf->file_total_size = $data['file_total_size'];

        $board_conf->update();

        return back()
            ->with('success_message','게시판 설정이 수정되었습니다.');
    }

    public function destroy($id){
        BoardConf::find($id)->delete();

        return json_encode(['result'=>true, 'message'=>'삭제 되었습니다.']);
    }

    public function permission($id){
        $roles = Role::where('name', '!=', 'SuperAdmin')->get();
        $columns = BoardClass::$arrCloumns;
        $permissionData = BoardPermission::where('board_id', $id)->get();
        $data = null;
        foreach($permissionData as $_per){
            $data[$_per['role']] = $_per;
        }
        
        return view('admin.board-confs.permission', compact('roles', 'id', 'columns', 'data'));
    }

    public function permission_save($id, Request $request){
        $data = $request->all();

        foreach($data['role'] as $_i=>$_data){
            $saveData['board_id'] = $id;
            $saveData['role'] = $_data;
            foreach(BoardClass::$arrCloumns as $__column){
                $saveData[$__column] = intval($data[$__column][$_i]);
            }
            $saveData['updated_user_id'] = auth()->user()->id;
            $saveData['updated_ip'] = $request->ip();

            if(BoardPermission::where(['board_id' => $id, 'role' => $saveData['role']])->count()==0){
                $saveData['created_user_id'] = auth()->user()->id;
                $saveData['created_ip'] = $request->ip();

                BoardPermission::create($saveData);
            }else{
                unset($saveData['board_id']);
                BoardPermission::where(['board_id' => $id, 'role' => $saveData['role']])->update($saveData);
            }
        }

        return back()
            ->with('success_message','게시판 권한설정이 저장되었습니다.');
    }
}
