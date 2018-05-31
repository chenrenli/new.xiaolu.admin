<?php
/**
 * Created by PhpStorm.
 * User: chenrenli
 * Date: 2018/5/30
 * Time: 15:57
 */
namespace app\admin\controller;
class Welcome extends Base{
    public function index(){
        return $this->fetch();
    }
}