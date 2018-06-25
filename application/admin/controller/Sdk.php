<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/27
 * Time: 17:57
 */
namespace app\admin\controller;

use app\admin\controller\Base;
use app\common\model\AppAd;
use think\Config;
use think\Validate;

//use Think\Page;

class Sdk extends Base
{
    public function index()
    {
        $map = array();
        $list = \app\common\model\Sdk::where($map)->order('id', 'desc')->paginate(10);
        $page = $list->render();
        $admin_list = $list->toArray();
        $admin_list = $admin_list['data'];
        $this->assign("total", $list->total());
        $this->assign("page", $page);
        $this->assign("list", $admin_list);

        return $this->fetch();
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $title = input("title");
            $start_path = input("start_path");
            $start_class = input("start_class");
            $validate = Validate::make([
                'title' => "require",
                "start_path" => "require",
                "start_class" => "require",
            ]);
            $data['title'] = $title;
            $data['start_class'] = $start_class;
            $data['start_path'] = $start_path;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }

            $data['create_time'] = time();
            $data['update_time'] = time();
            $sdk = new \app\common\model\Sdk();
            $res = $sdk->addData($data);
            if ($res) {
                return output_data([], 200, ["msg" => "添加sdk成功"]);
            } else {
                return output_error("添加sdk失败");
            }
        } else {
            return $this->fetch();
        }

    }

    public function edit()
    {
        if ($this->request->isPost()) {
            $title = input("title");
            $id = input("id");
            $start_path = input("start_path");
            $start_class = input("start_class");
            $validate = Validate::make([
                'title' => "require",
                "start_path" => "require",
                "start_class" => "require",
                "id" => "require",
            ]);
            $data['title'] = $title;
            $data['start_class'] = $start_class;
            $data['start_path'] = $start_path;
            $data['id'] = $id;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }

            $data['update_time'] = time();
            unset($data['id']);
            $map['id'] = $id;
            $sdk = new \app\common\model\Sdk();
            $res = $sdk->saveData($data, $map);
            if ($res) {
                return output_data([], 200, ["msg" => "编辑sdk成功"]);
            } else {
                return output_error("编辑sdk失败");
            }
        } else {
            $id = $this->request->param("id");
            $info = \app\common\model\Sdk::get($id);
            $this->assign("info", $info);
            $this->assign("id", $id);
            return $this->fetch("edit");
        }
    }

    /**
     * 删除
     */
    public function delete()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->param("id");
            $app_ad = AppAd::where("sdk_id", $id)->find();
            if ($app_ad) {
                return output_error("sdk已被绑定到应用,不能删除");
            }
            $map['id'] = array("in", $id);
            $result = \app\common\model\Sdk::destroy($map);
            if ($result) {
                return output_data(array(), 200, array("msg" => "删除数据成功"));
            } else {
                return output_error("删除数据失败", -400);
            }
        }
    }
}