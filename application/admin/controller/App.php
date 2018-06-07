<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/27
 * Time: 17:57
 */
namespace app\admin\controller;

use app\admin\controller\Base;
use app\common\model\Ad;
use app\common\model\AppAd;
use app\common\model\Channel;
use app\common\model\Position;
use app\common\model\Sdk;
use think\Config;
use think\Validate;

//use Think\Page;

class App extends Base
{
    public function index()
    {
        //获取广告类型
        $positionModel = new Position();
        $position_list = $positionModel->where("status", 1)->select();
        $map = array();
        $list = \app\common\model\App::where($map)->paginate(10);
        $page = $list->render();
        $admin_list = $list->toArray();
        $admin_list = $admin_list['data'];

        //获取应用设置sdk的情况
        if ($admin_list) {
            foreach ($admin_list as &$val) {
                $app_id = $val['id'];
                $appAdModel = new AppAd();
                $app_ad_list = $appAdModel->where("app_id", $app_id)->select();
                $val['app_ad_list'] = $app_ad_list;
            }
        }
        $this->assign("total", $list->total());
        $this->assign("page", $page);
        $this->assign("list", $admin_list);
        $this->assign("position_list", $position_list);
        return $this->fetch();
    }

    /**
     * 添加应用
     * @return array|mixed
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $packagename = input("packagename");
            $gamename = input("gamename");
            $channel_id = input("channel_id");
            $validate = Validate::make([
                'packagename' => "require",
                'gamename' => 'require',
                'channel_id' => 'require',
            ]);
            $data['packagename'] = $packagename;
            $data['gamename'] = $gamename;
            $data['channel_id'] = $channel_id;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            $channelModel = new Channel();
            $channel = $channelModel->where(['id' => $channel_id])->find();
            if (!$channel) {
                return output_error("渠道不存在");
            }
            //检测是否添加重复的应用
            $map['channel_id'] = $channel_id;
            $map['packagename'] = $packagename;
            $app = \app\common\model\App::where($map)->find();
            if ($app) {
                return output_error("同渠道中已存在同样的包名");
            }

            $data['channel_title'] = $channel->title;
            $data['create_time'] = time();
            $data['update_time'] = time();
            $sdk = new \app\common\model\App();
            $res = $sdk->addData($data);
            if ($res) {
                return output_data([], 200, ["msg" => "添加应用成功"]);
            } else {
                return output_error("添加应用失败");
            }
        } else {
            $channelModel = new Channel();
            $channel_list = $channelModel->where([])->select();
            $this->assign("channel_list", $channel_list);
            return $this->fetch();
        }

    }

    public function edit()
    {
        if ($this->request->isPost()) {
            $packagename = input("packagename");
            $gamename = input("gamename");
            $channel_id = input("channel_id");
            $id = input("id");
            $validate = Validate::make([
                'packagename' => "require",
                'gamename' => 'require',
                'channel_id' => 'require',
                "id" => "require"
            ]);
            $data['packagename'] = $packagename;
            $data['gamename'] = $gamename;
            $data['channel_id'] = $channel_id;
            $data['id'] = $id;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            $channelModel = new Channel();
            $channel = $channelModel->where(['id' => $channel_id])->find();
            if (!$channel) {
                return output_error("渠道不存在");
            }
            //检测是否添加重复的应用
            $map['channel_id'] = $channel_id;
            $map['packagename'] = $packagename;

            $app = \app\common\model\App::where($map)->whereNotIn("id", $id)->find();
            if ($app) {
                return output_error("同渠道中已存在同样的包名");
            }
            unset($data['id']);
            $data['channel_title'] = $channel->title;
            $data['create_time'] = time();
            $data['update_time'] = time();
            $sdk = new \app\common\model\App();
            $res = $sdk->saveData($data, ['id' => $id]);
            if ($res) {
                return output_data([], 200, ["msg" => "编辑应用成功"]);
            } else {
                return output_error("编辑应用失败");
            }
        } else {
            $id = input("id");
            $app = \app\common\model\App::where("id", $id)->find();
            $channelModel = new Channel();
            $channel_list = $channelModel->where([])->select();
            $this->assign("app", $app);
            $this->assign("channel_list", $channel_list);
            $this->assign("id", $id);
            return $this->fetch();
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
            $result = \app\common\model\App::destroy($map);
            if ($result) {
                return output_data(array(), 200, array("msg" => "删除数据成功"));
            } else {
                return output_error("删除数据失败", -400);
            }
        }
    }

    /**
     * 为应用设置广告
     */
    public function setAd()
    {
        if ($this->request->isPost()) {
            $sdk_id = input("sdk_id");
            $appid = input("appid");
            $adid = input("adid");
            $adpackagename = input("adpackagename");
            $id = input("id");
            $ad_id = input("ad_id");
            $position_id = input("position_id");
            $validate = Validate::make([
                "sdk_id" => "require",
                "id" => "require",
                "ad_id" => "require",
            ]);


            $data['sdk_id'] = $sdk_id;
            $data['position_id'] = $position_id;
            $data['id'] = $id;
            $data['ad_id'] = $ad_id;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            $data['app_id'] = $data['id'];
            unset($data['id']);
            $adInfo = Ad::find($ad_id);
            if (!$adInfo) {
                return output_error("广告信息不存在");
            }
            $data['adpackagename'] = $adInfo->packagename;
            $data['appid'] = $adInfo->appid;
            $data['adid'] = $adInfo->adid;

            $positionModel = new Position();
            $position = $positionModel->where("id", $position_id)->find();
            $sdkModel = new Sdk();
            $sdk = $sdkModel->where("id", $sdk_id)->find();
            $data['sdk_title'] = $sdk->title;
            $data['position_title'] = $position->title;
            $appAdModel = new AppAd();
            $res = $appAdModel->addData($data);
            if ($res) {
                return output_data([], 200, ["msg" => "设置sdk成功"]);
            } else {
                return output_error("设置sdk失败");
            }


        } else {
            $id = input("id");
            $sdkModel = new Sdk();
            $sdk_list = $sdkModel->select();
            $positionModel = new Position();
            $position_list = $positionModel->where("status", 1)->select();
            $this->assign("position_list", $position_list);
            $this->assign("sdk_list", $sdk_list);
            $this->assign("id", $id);

            return $this->fetch();
        }
    }

    public function editAd()
    {
        if ($this->request->isPost()) {
            $sdk_id = input("sdk_id");
            $appid = input("appid");
            $adid = input("adid");
            $adpackname = input("adpackagename", "");
            $id = input("id");
            $position_id = input("position_id");
            $ad_id = input("ad_id");
            $validate = Validate::make([
                "sdk_id" => "require",
                "id" => "require",
                "position_id" => "require",
            ]);
            $data['sdk_id'] = $sdk_id;
            $data['position_id'] = $position_id;
            $data['ad_id'] = $ad_id;
            $data['id'] = $id;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            unset($data['id']);
            $app_ad = AppAd::where("id", "=", $id)->find();
            if (!$app_ad) {
                return output_error("不存在广告sdk");
            }
            $adInfo = Ad::find($ad_id);
            if (!$adInfo) {
                return output_error("广告信息不存在");
            }
            $data['adpackagename'] = $adInfo->packagename;
            $data['appid'] = $adInfo->appid;
            $data['adid'] = $adInfo->adid;


            $positionModel = new Position();
            $position = $positionModel->where("id", $position_id)->find();
            $sdkModel = new Sdk();
            $sdk = $sdkModel->where("id", $sdk_id)->find();
            $data['sdk_title'] = $sdk->title;
            $data['position_title'] = $position->title;
            $appAdModel = new AppAd();
            $res = $appAdModel->saveData($data, ['id' => $id]);
            if ($res) {
                return output_data([], 200, ["msg" => "设置sdk成功"]);
            } else {
                return output_error("设置sdk失败");
            }


        } else {
            $id = input("id");
            $appAdModel = new AppAd();
            $app_ad = $appAdModel->where("id", $id)->find();

            $sdkModel = new Sdk();
            $sdk_list = $sdkModel->select();
            $positionModel = new Position();
            $position_list = $positionModel->where("status", 1)->select();
            $this->assign("position_list", $position_list);
            $this->assign("sdk_list", $sdk_list);
            $this->assign("id", $id);
            $this->assign("app_ad", $app_ad);
            return $this->fetch();
        }
    }

    /**
     * 删除广告
     */
    public function delAd()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->param("id");
            $map['id'] = array("in", $id);
            $result = \app\common\model\AppAd::destroy($map);
            if ($result) {
                return output_data(array(), 200, array("msg" => "删除数据成功"));
            } else {
                return output_error("删除数据失败", -400);
            }
        }
    }

    /**
     * 获取广告列表
     */
    public function getAdList()
    {
        $position_id = input("position_id");
        $ad_list = Ad::all(['position_id' => $position_id, 'status' => 1]);

        return output_data($ad_list, 200, array("msg" => "获取广告数据成功"));
    }
}