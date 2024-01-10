<?php

Route::get('/test2', function(){
    return view('test.aaa');
});

Route::get('/test3', function(){
    return view('test.bbb');
});

Route::get('/test4', function(){
    return view('test.find_email');
});

Route::get('/test5', function(){
    return view('test.find_pw');
});

Route::get('/test6', function(){
    return view('test.found_email');
});

Route::get('/test7', function(){
    return view('test.found_pw');
});

Route::get('/member_leave', function(){
    return view('test.member_leave');
});

Route::get('/leave_finish', function(){
    return view('test.leave_finish');
});

Route::get('/service_agree', function(){
    return view('test.service_agree');
});

Route::get('/personal_agree', function(){
    return view('test.personal_agree');
});

?>