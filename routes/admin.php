<?php

use Illuminate\Support\Facades\Route;

// 관리자 페이지
Route::prefix('/admin')->middleware('admin')->group(function(){
    Route::get('/', function(){
        return view('admin.dashboard');
    })->name('admin');

    Route::get('/users', function(){
        return view('admin.users');
    })->name('admin.users');
});
