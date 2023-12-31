<?php

use App\Http\Class\CommonCodeClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\AddrSearchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 주소검색
Route::get('/search', [AddrSearchController::class,'search'])->name('AddrSearch');

// 매물옵션코드
Route::get('/saleOptionCodes', function(){
    $codes = CommonCodeClass::getChildrenTreeFormFirstCodeText('매물옵션정보');

    return $codes;
});

// 카테고리코드
Route::get('/saleCategoryCodes', function(){
    $codes = CommonCodeClass::getChildrenTreeFormFirstCodeText('매물유형');

    return $codes;
});