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
 * @param int $error_code 返回状态码
 * @param string $error_msg 返回消息
 * @param array $data 返回数据
 */
if (!function_exists('sys_response')) {
    function sys_response ($error_code = 0, $error_msg = '', $data = null) {
        // 如果$error_msg为空自动获取
        if (empty($error_msg)) {
            $key = 'CODE_' . $error_code;
            $reflectionClass = new ReflectionClass('\app\common\enum\BaseStatusCodeEnum');
            if ($reflectionClass->hasConstant($key)) {
                $error_msg = $reflectionClass->getConstant($key);
            }
        }

        // 返回格式及数据
        $response = [
            'error_code' => $error_code,
            'error_msg' => $error_msg,
        ];
        if ($data !== false) {
            $response['data'] = $data;
        }

        return $response;
    }
}

/**
 * 单张图片上传
 * @param object $file 图片文件
 * @return string 图片路径
 */
if (!function_exists('upImg')) {
    function upImg ($file) {
        $info = $file->move('../public/uploads');
        if ($info) {
            $filePath = $info->getFilename();
            $filePath = str_replace('\\', '/', $filePath);
            $filePath = '/public/uploads' . $filePath;

            return $filePath;
        }
    }
}
