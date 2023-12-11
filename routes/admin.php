<?php

use App\Http\Controllers\Admin\BoardConfsController;
use App\Http\Controllers\Admin\BoardDatasControll;
use App\Http\Controllers\Admin\CommonCodeController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\NewspaperAdsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Member\ChatController;
use App\Models\BoardConf;
use App\Models\CommonCode;
use Illuminate\Support\Facades\Route;
use Tests\Feature\Admin\NewspaperAdsTest;

// 관리자 페이지
Route::prefix('/admin')->middleware('admin')->group(function(){
    Route::get('/', function(){
        return view('admin.dashboard');
    })->name('admin');

    Route::get('/chat/{channel?}', [ChatController::class, 'admin'])->name('admin.chat');

    Route::get('/users', [UsersController::class, 'index'])->name('admin.users');
    Route::get('/users/data', [UsersController::class, 'getTableData'])->name('admin.users.data');
    Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/edit', [UsersController::class, 'update'])->name('admin.users.update');
    Route::post('/users/changepassword', [UsersController::class, 'changepassword'])->name('admin.users.changepassword');
    Route::post('/users/delete/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');

    // 게시판 설정 관리
    Route::get('/board-confs', [BoardConfsController::class, 'index'])->name('admin.board-confs');
    Route::get('/board-confs/data', [BoardConfsController::class, 'getTableData'])->name('admin.board-confs.data');
    Route::get('/board-confs/create', [BoardConfsController::class, 'create'])->name('admin.board-confs.create');
    Route::post('/board-confs/store', [BoardConfsController::class, 'store'])->name('admin.board-confs.store');
    Route::get('/board-confs/edit/{id}', [BoardConfsController::class, 'edit'])->name('admin.board-confs.edit');
    Route::post('/board-confs/edit', [BoardConfsController::class, 'update'])->name('admin.board-confs.update');
    Route::post('/board-confs/delete/{id}', [BoardConfsController::class, 'destroy'])->name('admin.board-confs.destroy');

    // 게시판 권한 관리
    Route::get('/board-confs/permission/{id?}', [BoardConfsController::class, 'permission'])->name('admin.board-confs.permission');
    Route::post('/board-confs/permission/save/{id}', [BoardConfsController::class, 'permission_save'])->name('admin.board-confs.permission.save');

    // 게시물 관리
    Route::get('/board/{id?}',[BoardDatasControll::class, 'index'])->name('admin.board');
    Route::get('/board/data/{id}', [BoardDatasControll::class, 'getTableData'])->name('admin.board.data');
    Route::get('/board/create/{id}', [BoardDatasControll::class, 'create'])->name('admin.board.create');
    Route::post('/board/store/{id}', [BoardDatasControll::class, 'store'])->name('admin.board.store');
    Route::get('/board/view/{id?}', [BoardDatasControll::class, 'show'])->name('admin.board.show');
    Route::get('/board/edit/{id}', [BoardDatasControll::class, 'edit'])->name('admin.board.edit');
    Route::post('/board/edit/{id}', [BoardDatasControll::class, 'update'])->name('admin.board.update');
    Route::post('/board/delete/{id}', [BoardDatasControll::class, 'destroy'])->name('admin.board.destroy');
    
    // 메뉴관리
    Route::get('/menus/{p_id}/{c_id?}', [MenusController::class, 'index'])->where('p_id', '[0-9]+')->name('admin.menus');
    Route::get('/menus/create/{id?}', [MenusController::class, 'create'])->name('admin.menus.create');
    Route::post('/menus/store/{id?}', [MenusController::class, 'store'])->name('admin.menus.store');
    Route::get('/menus/edit/{id?}', [MenusController::class, 'edit'])->name('admin.menus.edit');
    Route::post('/menus/edit/{id?}', [MenusController::class, 'update'])->name('admin.menus.update');
    Route::post('/menus/delete/{id?}', [MenusController::class, 'destroy'])->name('admin.menus.destroy');
    Route::post('/menus/sort', [MenusController::class, 'sort'])->name('admin.menus.sort');
    Route::get('/menus/sort/edit/{id?}', [MenusController::class, 'sort_edit'])->name('admin.menus.sort.edit');
    Route::post('/menus/option', [MenusController::class, 'option'])->name('admin.menus.option');

    // 공통코드관리
    Route::get('/codes/{p_id?}/{c_id?}', [CommonCodeController::class, 'index'])->where('p_id', '[0-9]+')->name('admin.codes');
    Route::get('/codes/create/{id?}', [CommonCodeController::class, 'create'])->name('admin.codes.create');
    Route::post('/codes/store/{id?}', [CommonCodeController::class, 'store'])->name('admin.codes.store');
    Route::get('/codes/edit/{id?}', [CommonCodeController::class, 'edit'])->name('admin.codes.edit');
    Route::post('/codes/edit/{id?}', [CommonCodeController::class, 'update'])->name('admin.codes.update');
    Route::post('/codes/delete/{id?}', [CommonCodeController::class, 'destroy'])->name('admin.codes.destroy');
    Route::post('/codes/sort', [CommonCodeController::class, 'sort'])->name('admin.codes.sort');
    Route::get('/codes/sort/edit/{id?}', [CommonCodeController::class, 'sort_edit'])->name('admin.codes.sort.edit');

    // 신문광고관리
    Route::get('/newspaperads', [NewspaperAdsController::class, 'index'])->name('admin.newspaper-ads');
    Route::get('/newspaperads/data', [NewspaperAdsController::class, 'getTableData'])->name('admin.newspaper-ads.data');
    Route::get('/newspaperads/create', [NewspaperAdsController::class, 'create'])->name('admin.newspaper-ads.create');
    Route::post('/newspaperads/store', [NewspaperAdsController::class, 'store'])->name('admin.newspaper-ads.store');
    Route::get('/newspaperads/edit/{id?}', [NewspaperAdsController::class, 'edit'])->name('admin.newspaper-ads.edit');
    Route::post('/newspaperads/update/{id?}', [NewspaperAdsController::class, 'update'])->name('admin.newspaper-ads.update');
    Route::post('/newspaperads/delete/{id?}', [NewspaperAdsController::class, 'destroy'])->name('admin.newspaper-ads.destroy');
});
