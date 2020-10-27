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


/**
 * 上传图片示例（TP5.1（ROOT_PATH）不能用）
 */
function addimg($pic,$url){
    // 获取表单上传文件 例如上传了001.jpg
    // $file = request()->file($filename);
    // 移动到框架应用根目录/public/uploads/ 目录下
    // $file = request()->file($pic);
    if (is_array($pic)) {

        foreach($pic as $file){
            // 'img' . DS . 'goodsimg'
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate(['size'=> 1024 * 1000 ,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public'. DS .$url);
            $data[] = str_replace('\\', '/',$url . '/' . $info->getSaveName());
        }

        return implode(',',$data);
    } elseif (is_object($pic)) {
        $info = $pic->validate(['size'=> 1024 * 1000 ,'ext'=>'jpg,png,gif'])
            ->move(ROOT_PATH . 'public'. DS . $url);
        if($info){
            //返回文件位置信息 如：20180620/42a79759f284b767dfcb2a0197904287.jpg
            return  str_replace('\\', '/',$url . '/' . $info->getSaveName());

        }else{
            // 上传失败获取错误信息
            return false;
            // return $file->getError();
        }
        //单文件上传
    }
}
