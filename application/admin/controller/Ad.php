<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/27
 * Time: 17:57
 */
namespace app\admin\controller;

use app\admin\controller\Base;
use think\Config;
use think\Validate;

//use Think\Page;

class Ad extends Base
{
    public function index()
    {
        $map = array();
        $list = \app\common\model\Ad::where($map)->paginate(10);
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
            $validate = Validate::make([
                'title' => "require",
            ]);
            $data['title'] = $title;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            $sdk = new \app\common\model\Ad();
            $res = $sdk->addData($data);
            if ($res) {
                return output_data([], 200, ["msg" => "添加渠道成功"]);
            } else {
                return output_error("添加渠道失败");
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
            $validate = Validate::make([
                'title' => "require",
                "id" => "require",
            ]);
            $data['title'] = $title;
            $data['id'] = $id;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            unset($data['id']);
            $map['id'] = $id;
            $sdk = new \app\common\model\Channel();
            $res = $sdk->saveData($data, $map);
            if ($res) {
                return output_data([], 200, ["msg" => "编辑渠道成功"]);
            } else {
                return output_error("编辑渠道失败");
            }
        } else {
            $id = $this->request->param("id");
            $info = \app\common\model\Channel::get($id);
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
            $map['id'] = array("in", $id);
            $result = \app\common\model\Channel::destroy($map);
            if ($result) {
                return output_data(array(), 200, array("msg" => "删除数据成功"));
            } else {
                return output_error("删除数据失败", -400);
            }
        }
    }
}