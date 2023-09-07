@extends('admin.layout.layout')

@section('page-title', $page_title)

@section('page-comment', $page_comment)

@section('content')

@include('include.messagebox')

<form action="{{ url(route('admin.users.update')) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">

<div class="my_dashboard_review">
    <div class="row">
        <div class="col-xl-2">
            <h4>Profile Information</h4>
        </div>
        <div class="col-xl-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="wrap-custom-file">
                        <input type="file" name="file" id="image1" accept=".gif, .jpg, .jpeg, .png" value="" />
                        <label  for="image1" style="background-image: url('{{ $data->profile_file }}');">
                                <span><i class="flaticon-download"></i> Upload Photo </span>
                        </label>
                    </div>
                    <p>*minimum 260px x 260px</p>
                </div>
                <div class="col-lg-6 col-xl-6">
                    <div class="my_profile_setting_input form-group">
                        <label for="name">이름</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6">
                    <div class="my_profile_setting_input form-group">
                        <label for="email">이메일</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" readonly>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6">
                    <div class="my_profile_setting_input form-group">
                        <label for="company">회사명</label>
                        <input type="text" class="form-control" id="company" name="company" value="{{ $data->company }}">
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6">
                    <div class="my_profile_setting_input form-group">
                        <label for="position">직책</label>
                        <input type="text" class="form-control" id="position" name="position" value="{{ $data->position }}">
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6">
                    <div class="my_profile_setting_input form-group">
                        <label for="phone">연락처</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone }}">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="my_profile_setting_textarea">
                        <label for="address">주소</label>
                        <input type="text" class="form-control" id="address" name="address" readonly onclick="openSearchZipcode()" value="{{ $data->address }}">
                        <input type="hidden" id="zip_code" name="zip_code" value="{{ $data->zip_code }}">
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="my_profile_setting_textarea">
                        <label for="address_detail">상세주소</label>
                        <input type="text" class="form-control" id="address_detail" name="address_detail" value="{{ $data->address_detail }}">
                    </div>
                </div>
                <div class="col-xl-12 text-right">
                    <div class="my_profile_setting_input">
                        <button class="btn btn2">Update Profile</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</form>

<form action="{{ url(route('admin.users.changepassword')) }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
<div class="my_dashboard_review mt30">
    <div class="row">
        <div class="col-xl-2">
            <h4>Change password</h4>
        </div>
        <div class="col-xl-10">
            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="my_profile_setting_input form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="변경할 비밀번호" >
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6">
                    <div class="my_profile_setting_input form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="비밀번호 확인" >
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="my_profile_setting_input float-right fn-520">
                        <button class="btn btn2">Update Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection