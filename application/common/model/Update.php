<?php
/**
 * Created by PhpStorm.
 * User: chenrenli
 * Date: 2018/6/1
 * Time: 15:11
 */
namespace app\common\model;

use think\Model;

class Update extends Model
{
    public $autoWriteTimestamp = false;

    public function addData($data)
    {
        return $this->data($data)->save();
    }

    public function saveData($data, $map)
    {
        return $this->save($data, $map);
    }

}