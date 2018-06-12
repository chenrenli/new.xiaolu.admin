<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/9
 * Time: 10:30
 */
namespace util;

use app\common\model\AuthRule;
use think\Db;

class Auth
{
    /**
     * 获取管理员的权限列表
     */
    public function getAdminRules($uid)
    {
        $sql = "select * from xl_auth_group_access as a
                left join xl_auth_group  as b
                on a.group_id=b.id where a.uid='$uid'";
        $rows = Db::query($sql);
        $rules = '';
        if ($rows) {
            foreach ($rows as $row) {
                $rules .= $row['rules'];
            }
        }
        $rules = explode(",", $rules);
        $authRule = new AuthRule();
        $auth_list = $authRule->whereIn("id", $rules)->select();
        return $auth_list;
    }

    /**
     * 判断某个权限规则
     */
    public function check($name, $uid)
    {
        $auth_list = $this->getAdminRules($uid);
        if ($auth_list) {
            $name = strtolower($name);
            foreach ($auth_list as $auth) {
                if ($name == $auth->name) {
                    return true;
                }
            }
        }
        return false;
    }
}