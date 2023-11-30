<?php

use App\Models\Menu;
use DragonCode\Contracts\Cashier\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('index');
})->name('main');

// 관리자
require __DIR__.'/admin.php';

// 회원관련
Route::prefix('/member')->group(function(){
    Route::get('register', [App\Http\Controllers\Member\RegisterController::class, 'index'])->name('register')->middleware('guest');
    Route::post('register', [App\Http\Controllers\Member\RegisterController::class, 'store'])->middleware('guest');

    Route::get('changepw', [App\Http\Controllers\Member\ChangePasswordController::class, 'index'])->name('changepw')->middleware('auth');
    Route::post('changepw', [App\Http\Controllers\Member\ChangePasswordController::class, 'update'])->middleware('auth');

    Route::get('profile', [App\Http\Controllers\Member\ProfileController::class, 'index'])->name('profile')->middleware('auth');
    Route::post('profile', [App\Http\Controllers\Member\ProfileController::class, 'update'])->middleware('auth');
});

Route::get('login',[App\Http\Controllers\Member\LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login',[App\Http\Controllers\Member\LoginController::class, 'login'])->middleware('guest');

Route::get('logout',[App\Http\Controllers\Member\LoginController::class, 'logout'])->name('logout');

Route::get('social/{provider}',[App\Http\Controllers\Auth\SocialController::class, 'login'])->name('social.login');
Route::get('social/callback/{provider}',[App\Http\Controllers\Auth\SocialController::class, 'callback'])->name('social.callback');






// 채팅
Route::get('/chat/{channel?}', [App\Http\Controllers\Member\ChatController::class, 'index'])->name('chat');
Route::post('/chat/broadcast', [App\Http\Controllers\Member\ChatController::class, 'broadcast'])->name('chat.broadcast')->middleware('auth');
Route::post('/chat/receive', [App\Http\Controllers\Member\ChatController::class, 'receive'])->name('chat.receive')->middleware('auth');

// 공통 routes  //////////////////////////////////
Route::prefix('/common')->group(function(){
    // 세션생성용
    Route::post('redirect-after-session', function(){
        Session::put('condition', $_REQUEST['data']);
        return $_REQUEST['url'];
    })->name('common.redirect-after-session');

    // 임시파일 업로드
    Route::post('multiFileUpload/upload', [App\Http\Controllers\Common\TmpFilesController::class, 'upload'])->name('common.file.upload');

    // 임시파일 다운로드
    Route::get('multiFileUpload/download/{filename}', [App\Http\Controllers\Common\TmpFilesController::class, 'download'])->name('common.file.download');
    // 임시파일 보기
    Route::get('multiFileUpload/view/{filename}', [App\Http\Controllers\Common\TmpFilesController::class, 'view'])->name('common.file.view');
});

Route::match(['get', 'post'], '/page/{id}', [App\Http\Controllers\Web\PageController::class, 'index'])->name('page');
Route::post('/page/store/{id}', [App\Http\Controllers\Web\PageController::class, 'store'])->name('page.store');
Route::post('/page/update/{id}', [App\Http\Controllers\Web\PageController::class, 'update'])->name('page.update');
Route::post('/page/destroy/{id}', [App\Http\Controllers\Web\PageController::class, 'destroy'])->name('page.destroy');
Route::post('/page/ajax/{id}', [App\Http\Controllers\Web\PageController::class, 'ajax'])->name('page.ajax');

Route::get('board/data/{id}', [App\Http\Controllers\Admin\BoardDatasControll::class, 'getTableData'])->name('board.data');
Route::get('/board/file-download/{file_id}', [App\Http\Controllers\Admin\BoardDatasControll::class, 'download'])->name('board.filedownload');


Route::get('/test', function(){
    return view('test');
});