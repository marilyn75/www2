<?php

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

// 관리자 페이지
Route::prefix('/admin')->middleware('admin')->group(function(){
    Route::get('/', function(){
        return view('admin.dashboard');
    })->name('admin');

    Route::get('/users', [UsersController::class, 'index'])->name('admin.users');
    Route::get('/users/data', [UsersController::class, 'getTableData'])->name('admin.users.data');
    Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/edit', [UsersController::class, 'update'])->name('admin.users.update');
    Route::post('/users/changepassword', [UsersController::class, 'changepassword'])->name('admin.users.changepassword');
    Route::post('/users/delete/{id}', [UsersController::class, 'destory'])->name('admin.users.destory');
});
