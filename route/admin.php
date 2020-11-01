<?php

Route::group('admin', function () {
    // 多模块路由访问 模块名/控制器名/方法名
    Route::rule('index', 'admin/Index/index'); // 首页
    Route::rule('home/console', 'admin/Home/console'); // 首页

    // 用户
    Route::rule('user/list', 'admin/User/list');
});
