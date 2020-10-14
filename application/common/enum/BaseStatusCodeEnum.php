<?php
namespace app\common\enum;

class BaseStatusCodeEnum
{
    /**************** 0 请求成功 ****************/
    const CODE_0 = '请求成功';

    /**************** 4 数据校验 ****************/
    const CODE_4000001 = '暂无查询数据';
    const CODE_4000002 = '缺少参数拒绝请求';
    const CODE_4000003 = '数据参数错误';
    const CODE_4000004 = '账号密码不一致';
    const CODE_4000005 = '两次密码不一致';
    const CODE_4000006 = '此用户已注册';
    const CODE_4000007 = '此用户还未注册';

    /**************** 4 数据校验 ****************/
    const CODE_5000001 = '数据库链接失败';
    const CODE_5000002 = '数据操作失败';
}
