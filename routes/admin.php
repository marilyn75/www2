<?php

use App\Http\Controllers\Admin\BoardConfsController;
use App\Http\Controllers\Admin\BoardDatasControll;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\UsersController;
use App\Models\BoardConf;
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
    Route::post('/users/delete/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');

    // 게시판 설정 관리
    Route::get('/board-confs', [BoardConfsController::class, 'index'])->name('admin.board-confs');
    Route::get('/board-confs/data', [BoardConfsController::class, 'getTableData'])->name('admin.board-confs.data');
    Route::get('/board-confs/create', [BoardConfsController::class, 'create'])->name('admin.board-confs.create');
    Route::post('/board-confs/store', [BoardConfsController::class, 'store'])->name('admin.board-confs.store');
    Route::get('/board-confs/edit/{id}', [BoardConfsController::class, 'edit'])->name('admin.board-confs.edit');
    Route::post('/board-confs/edit', [BoardConfsController::class, 'update'])->name('admin.board-confs.update');
    Route::post('/board-confs/delete/{id}', [BoardConfsController::class, 'destroy'])->name('admin.board-confs.destroy');

    // 게시물 관리
    Route::get('/board/{id?}',[BoardDatasControll::class, 'index'])->name('admin.board');
    Route::get('/board/data/{id}', [BoardDatasControll::class, 'getTableData'])->name('admin.board.data');
    Route::get('/board/create/{id}', [BoardDatasControll::class, 'create'])->name('admin.board.create');
    Route::post('/board/store/{id}', [BoardDatasControll::class, 'store'])->name('admin.board.store');
    Route::get('/board/view/{id?}', [BoardDatasControll::class, 'show'])->name('admin.board.show');
    Route::get('/board/file-download/{file_id}', [BoardDatasControll::class, 'download'])->name('admin.board.filedownload');
    Route::get('/board/edit/{id}', [BoardDatasControll::class, 'edit'])->name('admin.board.edit');
    Route::post('/board/edit/{id}', [BoardDatasControll::class, 'update'])->name('admin.board.update');
    Route::post('/board/delete/{id}', [BoardDatasControll::class, 'destroy'])->name('admin.board.destroy');
    
    // 메뉴관리
    Route::get('/menus', [MenusController::class, 'index'])->name('admin.menus');
});
