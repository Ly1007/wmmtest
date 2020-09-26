<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 返回信息
 * @param int $status 返回状态码
 * @param string $msg 返回消息
 * @param array $data 返回数据
 */
function sys_response($status = 0, $msg = '', $data = null)
{
    return [
        "error_code" => $status,
        "error_msg" => $msg,
        "data" => $data
    ];
}
