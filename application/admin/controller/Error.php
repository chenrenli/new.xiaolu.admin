<?php
/**
 * Created by PhpStorm.
 * User: chenrenli
 * Date: 2018/6/12
 * Time: 14:08
 */
namespace app\admin\controller;

use think\Controller;

class Error extends Controller
{
    public function index()
    {
        $msg = input("msg");
        $type = input("type");

        $this->assign("msg", $msg);
        $this->assign("type", $type);
        return $this->fetch();
    }
}