<?php
/**
 * 账户日志model
 */
namespace app\index\model\db;

use Think\Model;

class LogAccount extends Model
{
    protected $table = 'mmw_log_account';

    // 生成账户登录信息
    public function addLog($data)
    {
        return $this->save($data);
    }
}
