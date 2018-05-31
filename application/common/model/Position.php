<?php
/**
 * Created by PhpStorm.
 * User: chenrenli
 * Date: 2018/5/30
 * Time: 10:14
 */
namespace app\common\model;

use think\Model;

class Position extends Model
{
    protected $autoWriteTimestamp = false;

    public function addData($data)
    {
        return $this->data($data)->save();
    }

    public function saveData($data, $map)
    {
        return $this->save($data, $map);
    }

}