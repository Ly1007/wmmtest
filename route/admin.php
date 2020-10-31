<?php

Route::group('admin', function () {
    // 多模块路由访问 模块名/控制器名/方法名
    Route::rule('index', 'Admin/Index/index'); // 首页
    Route::rule('home/console', 'Admin/Home/console'); // 首页
});
