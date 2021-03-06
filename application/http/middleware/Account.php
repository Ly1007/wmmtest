<?php
/**
 * 用户账户登录相关中间件
 */
namespace app\http\middleware;

use app\index\model\logic\JwtLogic;

class Account
{
    /**
     * 前置中间件
     * 检查用户token是否合法，合法的话返回用户id
     */
    public function handle($request, \Closure $next)
    {
        $token = $request->header('token', '');
        if (empty($token)) {
            return json(['error_code' => 0, 'error_msg' => 'token未传！']);
        }

        $JwtLogic = new JwtLogic();
        $data = $JwtLogic->getToken($token);
        $request->userData = $data;

        return $next($request);
    }

}
