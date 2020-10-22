<?php
/**
 * LogAccountLogic
 */
namespace app\index\model\logic;

use app\index\model\db\LogAccount;

class LogAccountLogic
{
    /**
     * 生成账户登录信息
     * @param array $input 用户信息
     * @param int $status 成功失败状态：1成功，2失败
     * @param string $info 日志信息
     * @param string $ip ip信息
     */
    public function addAccountLog($input, $status, $info, $ip)
    {
        $data = [
            'uid' => $input['id'],
            'name' => $input['name'],
            'status' => $status,
            'info' => $info,
            'ip' => $ip,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'action' => '【mmw】' . $_SERVER['REQUEST_URI'],
            'create_time' => time(),
            'create_date' => date('Y-m-d H:i:s', time()),
        ];

        $logAccount = new LogAccount();

        return $logAccount->addLog($data);
    }
}
