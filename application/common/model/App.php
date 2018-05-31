<?php
/**
 * Created by PhpStorm.
 * User: chenrenli
 * Date: 2018/5/29
 * Time: 16:22
 */
namespace app\common\model;
use think\Model;

class App extends Model{
    public function addData($data){
        return $this->data($data)->save();
    }
    public function saveData($data,$map){
        return $this->save($data,$map);
    }
}
