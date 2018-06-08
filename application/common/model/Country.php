<?php
/**
 * Created by PhpStorm.
 * User: chenrenli
 * Date: 2018/6/8
 * Time: 15:21
 */
namespace app\common\model;

use think\Model;

class Country extends Model
{

    public function addData($data)
    {
        return $this->data($data)->save();
    }

    public function saveData($data, $map)
    {
        return $this->save($data, $map);
    }
}