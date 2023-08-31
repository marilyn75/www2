<?php

use Illuminate\Support\Facades\Route;

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