<?php

use DragonCode\Contracts\Cashier\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

$menuItems = [
    ['name' => '홈', 'url' => '/'],
    ['name' => '소개', 'url' => '/about'],
    ['name' => '서비스', 'url' => '/services'],
    // 추가적인 메뉴 항목들을 필요에 따라 배열에 추가합니다.
];

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

Route::get('board/{id}', [App\Http\Controllers\Web\BoardController::class, 'index'])->name('board');
Route::get('board/data/{id}', [App\Http\Controllers\Web\BoardController::class, 'getTableData'])->name('board.data');
Route::get('board/view/{id?}', [App\Http\Controllers\Web\BoardController::class, 'show'])->name('board.show');

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