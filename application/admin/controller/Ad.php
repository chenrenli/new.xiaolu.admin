<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/27
 * Time: 17:57
 */
namespace app\admin\controller;

use app\admin\controller\Base;
use app\common\model\Position;
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
        if($admin_list){
            foreach($admin_list as &$val){
                $val['position_title'] = Position::where("id",$val['position_id'])->value("title");
            }
        }
        $this->assign("total", $list->total());
        $this->assign("page", $page);
        $this->assign("list", $admin_list);

        return $this->fetch();
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $title = input("title");
            $position_id = input("position_id");
            $appid = input("appid");
            $adid = input("adid");
            $status = input("status");
            $packagename = input("packagename");
            $validate = Validate::make([
                'title' => "require",
                'position_id' => "require",
                "appid" => "require",
                "adid" => "require",
            ]);
            $data['title'] = $title;
            $data['position_id'] = $position_id;
            $data['appid'] = $appid;
            $data['adid'] = $adid;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            $sdk = new \app\common\model\Ad();
            $data['status'] = $status;
            $data['create_time'] = time();
            $data['update_time'] = time();
            $data['packagename'] = $packagename;
            $res = $sdk->addData($data);
            if ($res) {
                return output_data([], 200, ["msg" => "添加广告成功"]);
            } else {
                return output_error("添加广告失败");
            }
        } else {
            $position_list = Position::all(['status' => 1]);
            $this->assign("position_list", $position_list);
            return $this->fetch();
        }

    }

    public function edit()
    {
        if ($this->request->isPost()) {
            $title = input("title");
            $id = input("id");
            $position_id = input("position_id");
            $appid = input("appid");
            $adid = input("adid");
            $status = input("status");
            $packagename = input("packagename");
            $validate = Validate::make([
                'title' => "require",
                "id" => "require",
                'position_id' => "require",
                "appid" => "require",
                "adid" => "require",
            ]);
            $data['title'] = $title;
            $data['id'] = $id;
            $data['position_id'] = $position_id;
            $data['appid'] = $appid;
            $data['adid'] = $adid;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            unset($data['id']);
            $map['id'] = $id;
            $sdk = new \app\common\model\Ad();
            $data['status'] = $status;
            $data['update_time'] = time();
            $packagename = input("packagename");
            $res = $sdk->saveData($data, $map);
            if ($res) {
                return output_data([], 200, ["msg" => "编辑广告成功"]);
            } else {
                return output_error("编辑广告失败");
            }
        } else {
            $id = $this->request->param("id");
            $info = \app\common\model\Ad::get($id);
            $this->assign("info", $info);
            $this->assign("id", $id);
            $position_list = Position::all(['status' => 1]);
            $this->assign("position_list", $position_list);
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
            $result = \app\common\model\Ad::destroy($map);
            if ($result) {
                return output_data(array(), 200, array("msg" => "删除数据成功"));
            } else {
                return output_error("删除数据失败", -400);
            }
        }
    }
}