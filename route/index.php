<?php

// 必须登录，带有token后才能访问
Route::group('v1', function () {
    // 首页
    Route::rule('index', 'Index/index');

    // 测试
    Route::rule('test', 'Test/test');  // 测试
    Route::rule('testCache', 'Test/testCache');  // 测试
    Route::rule('testSession', 'Test/testSession');  // 测试
    Route::rule('setSession', 'Test/setSession');  // 测试

    // account模块
    Route::rule('changePwd', 'Account/changePwd', 'POST');  // 修改密码

    // 用户user模块
    Route::rule('userList', 'User/getList');  // 用户列表
    Route::rule('userInfo', 'User/getInfo');  // 用户信息
    Route::rule('upHeadImg', 'User/upHeadImg', 'POST');  // 用户上传头像



})->middleware('Account');


// 无需登陆即可访问
Route::group('v1', function () {
    // 登录注册
    Route::rule('login', 'Account/login', 'POST');  // 登录
    Route::rule('complexLogin', 'Account/complexLogin', 'POST');  // 复杂登录
    Route::rule('register', 'Account/register', 'POST');  // 注册

    // 导出
    Route::rule('export', 'Excel/export');
    Route::rule('testInfiniteReply', 'Test/testInfiniteReply', 'POST'); // 测试多级回复
});
