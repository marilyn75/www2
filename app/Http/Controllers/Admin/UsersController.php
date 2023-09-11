<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Class\UserClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{

    private $page_title = "회원 관리";
    private $page_comment = "회원정보를 관리 합니다.";

    public function index(){
        $condition = "";
        if(session()->has('condition')){
            $condition = session('condition');
            session()->forget('condition');
        }
        

        return view('admin.users.index', compact('condition'));
    }

    public function getTableData(Request $request){
        if($request->ajax()){
            $data = User::select('id', 'name', 'email')
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as formatted_created_at')
                ->orderBy('id', 'desc');
            return DataTables::of($data)->toJson();
        }
    }

    public function edit($id, Request $request){
        $UserClass = new UserClass($id);
        // $data = User::find($id);
        //dd($data->socialAccounts()->count());

        return view('admin.users.edit')->with(['page_title'=>$this->page_title, 'page_comment'=>$this->page_comment, 'data'=>$UserClass->data()]);
    }

    public function update(Request $request){
        // 유효성 검사
        $this->validate($request, User::$rules['update']);

        $UserClass = new UserClass($request->id);
        $UserClass->update($request);

        return back()
            ->with('success_message','회원정보가 변경 되었습니다.');
    }

    public function destory($id){
        $UserClass = new UserClass($id);
        $UserClass->destory();

        return json_encode(['result'=>true, 'message'=>'삭제 되었습니다.']);
    }

    public function changepassword(Request $request){
        // 유효성 검사
        $this->validate($request, User::$rules['admin_changepassword']);

        $UserClass = new UserClass($request->id);
        $UserClass->changepassword($request);

        return back()
            ->with('success_message','비밀번호가 변경 되었습니다.');
    }
}
