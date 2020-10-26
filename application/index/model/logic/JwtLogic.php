<?php
namespace app\index\model\logic;

use Firebase\JWT\JWT;
use think\facade\Config;

class JwtLogic
{
    /**
     * 生成token
     * @param int $uid 用户id
     * @return string 用户登录的token
     */
    public function setToken($uid)
    {
        $key = Config::get('jwt.jwt_key');      // 自定义的一个随机字串，解密时也会用，相当于加密中常用的 盐 salt
        $token = [
            'iss' => '',                              // 签发者 可以为空
            'aud' => '',                              // 面象的用户，可以为空
            'iat' => time(),                          // 签发时间
            'nbf' => time()+2,                        // 在什么时候jwt开始生效  （这里表示生成2秒后才生效）
            'exp' => time()+7200,                     // token 过期时间
            'data' => [                               // 记录的userid的信息，这里是自已添加上去的，如果有其它信息，可以再添加数组的键值对
                'uid' => $uid
            ]
        ];

        return JWT::encode($token, $key, 'HS256'); // 根据参数生成token
    }

    /**
     * 验证token
     * @param string $token 用户token
     * @return int 用户id
     */
    public function getToken($token)
    {
        $data = null;
        $key = Config::get('jwt.jwt_key');
        try {
            $jwt_data = JWT::decode($token, $key, array('HS256'));
            $data = $jwt_data->data;
        } catch (\Firebase\JWT\ExpiredException $e) {  // token过期
            return sys_response(0, $e->getMessage());
        } catch (\Firebase\JWT\BeforeValidException $e) {  // 签名在某个时间点之后才能用
            return sys_response(0, $e->getMessage());
        } catch (\Firebase\JWT\SignatureInvalidException $e) {
            throw new Exception('token解析失败' . $e->getMessage());
//            return json_encode(['error_code' => 0, 'error_msg' => 'token解析失败！']);
        }

        return $data;
    }

}
