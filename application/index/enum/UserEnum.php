<?php
namespace app\index\enum;

class UserEnum
{
    /**
     * 获取状态值
     * @param string $module 模块名
     * @param int $code code
     * @param string $default 默认值
     * @return mixed|string
     */
    public static function getItem($module, $code, $default = ''){
        $key = strtolower($module);
        $code = strtolower($code);

        if (isset(static::$$key)) {
            $modules = static::$$key;
            if (array_key_exists($code, $modules)) {
                return $modules[$code];
            }
        }

        return $default;
    }

    // 性别
    const SEX_DESC_NO = 0;
    const SEX_DESC_MAN = 1;
    const SEX_DESC_WOMAN = 2;

    // 性别描述
    public static $sex = [
        self::SEX_DESC_NO => '此用户还未填写性别',
        self::SEX_DESC_MAN => '男',
        self::SEX_DESC_WOMAN => '女',
    ];

}
