<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Class\UserClass;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    private $page_title = "회원 관리";
    private $page_comment = "회원정보를 관리 합니다.";

    public function index(){
        return view('admin.users.index');
    }

    public function getTableData(Request $request){
        if($request->ajax()){
            $data = User::select('id', 'name', 'email')
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as formatted_created_at');
            return DataTables::of($data)->toJson();
        }
    }

    public function edit($id){
        $UserClass = new UserClass($id);
        // $data = User::find($id);
        //dd($data->socialAccounts()->count());

        return view('admin.users.edit')->with(['page_title'=>$this->page_title, 'page_comment'=>$this->page_comment, 'data'=>$UserClass->data()]);
    }

    public function update(Request $request){
        // 유효성 검사
        $rules = [
            'name' => 'required|max:20',
            'email' => 'required|email|max:255',
        ];

        $customMessages = [
            'name.required' => '이름 항목은 필수 입니다.',
            'email.required' => '이메일 항목은 필수 입니다.',
            'email.email' => '유효하지 않은 이메일입니다.',
        ];

        $this->validate($request, $rules, $customMessages);

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
        $rules = [
            'password' => 'required|max:30|confirmed'
        ];

        $customMessages = [
            'password.required' => '변경할 비밀번호 항목은 필수 입니다.',
            'password.confirmed' => '비밀번호가 일치하지 않습니다.',
        ];

        $this->validate($request, $rules, $customMessages);

        $UserClass = new UserClass($request->id);
        $UserClass->changepassword($request);

        return back()
            ->with('success_message','비밀번호가 변경 되었습니다.');
    }
}
