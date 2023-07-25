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
});