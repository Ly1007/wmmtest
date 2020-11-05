<?php

// 必须登录，带有token后才能访问
Route::group('v1', function () {
    // 首页
    Route::rule('index', 'Index/Index/index');

    // 测试
    Route::rule('test', 'Index/Test/test');  // 测试
    Route::rule('testCache', 'Index/Test/testCache');  // 测试
    Route::rule('testSession', 'Index/Test/testSession');  // 测试
    Route::rule('setSession', 'Index/Test/setSession');  // 测试

    // account模块
    Route::rule('changePwd', 'Index/Account/changePwd', 'POST');  // 修改密码

    // 用户user模块
    Route::rule('userList', 'Index/User/getList');  // 用户列表
    Route::rule('userInfo', 'Index/User/getInfo');  // 用户信息
    Route::rule('upHeadImg', 'Index/User/upHeadImg', 'POST');  // 用户上传头像

})->middleware('Account');

// 无需登陆即可访问
Route::group('v1', function () {
    // 登录注册
    Route::rule('login', 'Index/Account/login', 'POST');  // 登录
    Route::rule('complexLogin', 'Index/Account/complexLogin', 'POST');  // 复杂登录
    Route::rule('register', 'Index/Account/register', 'POST');  // 注册

    // 导出
    Route::rule('export', 'Index/Excel/export');
    Route::rule('testInfiniteReply', 'Index/Test/testInfiniteReply', 'POST'); // 测试多级回复
});
