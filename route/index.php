<?php

Route::group('V1', function () {
    // 首页
    Route::rule('index', 'Index/index');

    // 测试
    Route::rule('test', 'Test/index');  // 测试
    Route::rule('testCache', 'Test/testCache');  // 测试
    Route::rule('testSession', 'Test/testSession');  // 测试
    Route::rule('setSession', 'Test/setSession');  // 测试

    // account模块
    Route::rule('login', 'Account/login', 'POST');  // 登录
    Route::rule('complexLogin', 'Account/complexLogin', 'POST');  // 复杂登录
    Route::rule('register', 'Account/register', 'POST');  // 注册

    // 用户user模块
    Route::rule('userList', 'User/getList');  // 用户列表
    Route::rule('userInfo', 'User/getInfo');  // 用户信息

})->middleware('Account');
