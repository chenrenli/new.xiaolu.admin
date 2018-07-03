<?php
/**
 * Created by PhpStorm.
 * User: chenrenli
 * Date: 2018/6/1
 * Time: 15:07
 */
namespace app\admin\controller;

use app\common\model\App;
use app\common\model\Sdk;
use think\Validate;

class Update extends Base
{
    /**
     * 更新管理
     * @return mixed
     */
    public function index()
    {
        $map = array();
        $list = \app\common\model\Update::where($map)->order('id', 'desc')->paginate(10);
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
            $version = input("version");
            $file_path = input("file_path");
            $sdk_id = input("sdk_id");
            $key = input("key");
            $type = input("type");
            $app_id = input("app_id");
            $validate = Validate::make([
                'version' => "require",
                "file_path" => "require",
                "key" => "require",
                "type" => "require",
            ]);
            $data['version'] = $version;
            $data['ver'] = intval(str_replace(".", "", $version));
            $data['file_path'] = $file_path;

            $data['key'] = $key;
            $data['type'] = $type;
            if ($type == 0) {
                if ($app_id <= 0) {
                    return output_error("请选择应用");
                }
                $data['app_id'] = $app_id;
            } else {
                if ($sdk_id <= 0) {
                    return output_error("请选择sdk");
                }
                $data['sdk_id'] = $sdk_id;
            }
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            $sdk = new \app\common\model\Update();
            $res = $sdk->addData($data);
            if ($res) {
                return output_data([], 200, ["msg" => "添加更新信息成功"]);
            } else {
                return output_error("添加更新信息失败");
            }
        } else {
            //获取sdk列表
            $sdkList = Sdk::where([])->select();
            $this->assign("sdk_list", $sdkList);
            $app_list = App::where(['status' => 1])->select();
            $this->assign("app_list", $app_list);
            return $this->fetch();
        }

    }

    /**
     * 编辑更新信息
     * @return array|mixed
     */
    public function edit()
    {
        if ($this->request->isPost()) {
            $version = input("version");
            $file_path = input("file_path");
            $id = input("id");
            $sdk_id = input("sdk_id");
            $key = input("key");
            $type = input("type");
            $app_id = input("app_id");
            $validate = Validate::make([
                'version' => "require",
                "id" => "require",
                "file_path" => "require",
                "key" => "require",
                "type" => 'require',

            ]);
            $data['version'] = $version;
            $data['ver'] = intval(str_replace(".", "", $version));
            $data['file_path'] = $file_path;
            $data['id'] = $id;
            if ($type == 1) {
                if ($sdk_id <= 0) {
                    return output_error("请选择sdk");
                }
                $data['sdk_id'] = $sdk_id;
            } else {
                if ($app_id <= 0) {
                    return output_error("请选择应用");
                }
                $data['app_id'] = $app_id;
            }
            $data['key'] = $key;
            $data['type'] = $type;

            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            unset($data['id']);
            $map['id'] = $id;
            $sdk = new \app\common\model\Update();
            $res = $sdk->saveData($data, $map);

            return output_data([], 200, ["msg" => "编辑更新信息成功"]);

        } else {
            $id = $this->request->param("id");
            $info = \app\common\model\Update::get($id);
            //获取sdk列表
            $sdkList = Sdk::where([])->select();
            $this->assign("sdk_list", $sdkList);
            $this->assign("info", $info);
            $this->assign("id", $id);
            $app_list = App::where(['status' => 1])->select();
            $this->assign("app_list", $app_list);
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
            $result = \app\common\model\Update::destroy($map);
            if ($result) {
                return output_data(array(), 200, array("msg" => "删除数据成功"));
            } else {
                return output_error("删除数据失败", -400);
            }
        }
    }
}