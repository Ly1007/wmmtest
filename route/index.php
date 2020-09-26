<?php

Route::group('V1', function () {
    Route::rule('test', 'Test/index');  // 测试
    Route::rule('index', 'Index/index');  // 首页
    Route::rule('login', 'Account/login', 'POST');  // 登录
})->middleware('Account');
