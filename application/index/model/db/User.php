<?php
/**
 * user Model
 */
namespace app\index\model\db;

use think\db\Query;
use think\Model;

class User extends Model
{
    protected $table = 'mmw_user';

    // 用户注册
    public function userRegister($input)
    {
        return $this->insert($input);
    }

    // 获取用户信息
    public function getUserInfo($input)
    {
        $map =[];
        if (!empty($input['user_mobile'])) {
            $map['tel'] = ['EQ', $input['user_mobile']];
        } else if (!empty($input['user_name'])) {
            $map['name'] = ['EQ', $input['user_name']];
        }
        if (!empty($input['id'])) {
            $map['id'] = ['EQ', $input['id']];
        }

        return $this->where($map)->find();
    }

    // 用户分页列表查询条件
    private function getUserPageMap($input)
    {

        $map = new Query();
        $map->where('is_delete', 'EQ', 1);

        if (!empty($input['name'])) {
            $map->where('name', 'EQ', $input['name']);
        }
        if (!empty($input['tel'])) {
            $map->where('tel', 'EQ', $input['tel']);
        }

        return $map;
    }

    // 用户分页列表数量
    public function getUserPageCount($input)
    {
        $map = $this->getUserPageMap($input);

        return $this->where($map)->count('id');
    }

    // 用户分页列表
    public function getUserPageList($input, $offset = 0, $limit = 0)
    {
        $map = $this->getUserPageMap($input);

        return $this->where($map)
            ->field(['id', 'tel', 'address', 'sex', 'create_time'])
            ->order('create_time desc')
            ->limit($offset, $limit)
            ->select();
    }

}
