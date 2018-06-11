<?php
/**
 * Created by PhpStorm.
 * User: chenrenli
 * Date: 2018/6/1
 * Time: 14:50
 */
namespace app\admin\controller;

use app\common\model\Ad;
use app\common\model\AppAd;
use app\common\model\Channel;
use app\common\model\Country;
use app\common\model\Position;
use app\common\model\Sdk;
use app\common\model\StrategyAd;
use app\common\model\StrategyRule;
use think\Validate;

class Strategy extends Base
{
    /**
     * 流量策略管理
     * @return mixed
     */
    public function index()
    {
        $map = array();
        $list = \app\common\model\Strategy::where($map)->paginate(10);
        $page = $list->render();
        $admin_list = $list->toArray();
        $admin_list = $admin_list['data'];
        $this->assign("total", $list->total());
        $this->assign("page", $page);
        $this->assign("list", $admin_list);

        return $this->fetch();
    }

    /**
     * 添加流量策略
     * @return array|mixed
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $title = input("title");
            $position_id = input("position_id");
            $weight = input("weight", 0);
            $status = input("status");
            $ad_ids = isset($_POST['ad_ids']) ? $_POST['ad_ids'] : "";  //广告ids
            $version_type = input("version_type");
            $version_content = input("version_content");
            $package_type = input("package_type");
            $package_content = input("package_content");
            $brand_type = input("brand_type");
            $brand_content = input("brand_content");
            $channel_type = input("channel_type");
            $channel_content = isset($_POST['channel_content']) ? $_POST['channel_content'] : '';
            $phone_type = input("phone_type");
            $phone_content = input("phone_content");
            $net_type = input("net_type");
            $net_content = isset($_POST['net_content']) ? $_POST['net_content'] : '';
            $date_type = input("date_type");
            $start_time = input("start_time");
            $start_time_hour = input("start_time_hour");
            $end_time = input("end_time");
            $end_time_hour = input("end_time_hour");
            $country = isset($_POST['country']) ? $_POST['country'] : "";
            $country_type = input("country_type");
            $province = isset($_POST["province"]) ? $_POST['province'] : "";
            $province_type = input("province_type");
            $city = isset($_POST["city"]) ? $_POST['city'] : "";
            $city_type = input("city_type");

            $validate = Validate::make([
                'title' => "require",
            ]);
            $data['title'] = $title;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            $strategyModel = new \app\common\model\Strategy();
            $data['weight'] = $weight;
            $data['status'] = $status;
            $data['create_time'] = time();
            $data['update_time'] = time();
            $res = $strategyModel->addData($data);
            if ($res) {
                //添加关联数据
                if ($ad_ids) {
                    //添加广告数据
                    foreach ($ad_ids as $ad_id) {
                        $strategyAdModel = new StrategyAd();
                        $strategyAdModel->ad_id = $ad_id;
                        $strategyAdModel->strategy_id = $strategyModel->id;
                        $strategyAdModel->save();
                    }
                }
                //添加规则数据
                if ($version_content) {
                    $version_content = str_replace("\r\n", ",", $version_content);
                    $version_content = str_replace("\n", ",", $version_content);
                    //版本
                    $strategyRuleModel = new StrategyRule();
                    $strategyRuleModel->type = 1;
                    $strategyRuleModel->rule = $version_type;
                    $strategyRuleModel->strategy_id = $strategyModel->id;
                    $strategyRuleModel->rule_content = $version_content;
                    $strategyRuleModel->create_time = time();
                    $strategyRuleModel->update_time = time();
                    $strategyRuleModel->save();

                }

                if ($package_content) {
                    $package_content = str_replace("\r\n", ",", $package_content);
                    $package_content = str_replace("\n", ",", $package_content);
                    //包名
                    $strategyRuleModel = new StrategyRule();
                    $strategyRuleModel->type = 2;
                    $strategyRuleModel->rule = $package_type;
                    $strategyRuleModel->strategy_id = $strategyModel->id;
                    $strategyRuleModel->rule_content = $package_content;
                    $strategyRuleModel->create_time = time();
                    $strategyRuleModel->update_time = time();
                    $strategyRuleModel->save();

                }
                if ($brand_content) {
                    $brand_content = str_replace("\r\n", ",", $brand_content);
                    $brand_content = str_replace("\n", ",", $brand_content);
                    //手机品牌
                    $strategyRuleModel = new StrategyRule();
                    $strategyRuleModel->type = 3;
                    $strategyRuleModel->rule = $brand_type;
                    $strategyRuleModel->strategy_id = $strategyModel->id;
                    $strategyRuleModel->rule_content = $brand_content;
                    $strategyRuleModel->create_time = time();
                    $strategyRuleModel->update_time = time();
                    $strategyRuleModel->save();

                }
                if ($channel_content) {
                    //渠道
                    $strategyRuleModel = new StrategyRule();
                    $strategyRuleModel->type = 4;
                    $strategyRuleModel->rule = $channel_type;
                    $strategyRuleModel->strategy_id = $strategyModel->id;
                    $strategyRuleModel->rule_content = implode(",", $channel_content);
                    $strategyRuleModel->create_time = time();
                    $strategyRuleModel->update_time = time();
                    $strategyRuleModel->save();

                }
                if ($phone_content) {
                    $phone_content = str_replace("\r\n", ",", $phone_content);
                    $phone_content = str_replace("\n", ",", $phone_content);
                    //运营商
                    $strategyRuleModel = new StrategyRule();
                    $strategyRuleModel->type = 5;
                    $strategyRuleModel->rule = $phone_type;
                    $strategyRuleModel->strategy_id = $strategyModel->id;
                    $strategyRuleModel->rule_content = $phone_content;
                    $strategyRuleModel->create_time = time();
                    $strategyRuleModel->update_time = time();
                    $strategyRuleModel->save();
                }
                if ($net_content) {
                    //网络
                    $strategyRuleModel = new StrategyRule();
                    $strategyRuleModel->type = 6;
                    $strategyRuleModel->rule = $net_type;
                    $strategyRuleModel->strategy_id = $strategyModel->id;
                    $strategyRuleModel->rule_content = implode(",", $net_content);
                    $strategyRuleModel->create_time = time();
                    $strategyRuleModel->update_time = time();
                    $strategyRuleModel->save();
                }
                if ($start_time || $end_time) {
                    //日期
                    $rule_content = '';
                    if ($start_time) {
                        $rule_content = $start_time . "," . $start_time_hour;
                    }
                    if ($end_time) {
                        $rule_content = $rule_content . "," . $end_time . "," . $end_time_hour;
                    }
                    $strategyRuleModel = new StrategyRule();
                    $strategyRuleModel->type = 7;
                    $strategyRuleModel->rule = $date_type;
                    $strategyRuleModel->strategy_id = $strategyModel->id;
                    $strategyRuleModel->rule_content = $rule_content;
                    $strategyRuleModel->create_time = time();
                    $strategyRuleModel->update_time = time();
                    $strategyRuleModel->save();

                }
                //地区
                if ($country && count($country) >= 1) {
                    //国家
                    $strategyRuleModel = new StrategyRule();
                    $strategyRuleModel->type = 8;
                    $strategyRuleModel->rule = $country_type;
                    $strategyRuleModel->strategy_id = $strategyModel->id;
                    $strategyRuleModel->rule_content = implode(",", $country);
                    $strategyRuleModel->create_time = time();
                    $strategyRuleModel->update_time = time();
                    $strategyRuleModel->save();

                }
                if ($province && count($province) >= 1) {
                    //省
                    $strategyRuleModel = new StrategyRule();
                    $strategyRuleModel->type = 9;
                    $strategyRuleModel->rule = $province_type;
                    $strategyRuleModel->strategy_id = $strategyModel->id;
                    $strategyRuleModel->rule_content = implode(",", $province);
                    $strategyRuleModel->create_time = time();
                    $strategyRuleModel->update_time = time();
                    $strategyRuleModel->save();

                }
                if ($city && count($city) >= 1) {
                    //城市
                    $strategyRuleModel = new StrategyRule();
                    $strategyRuleModel->type = 10;
                    $strategyRuleModel->rule = $city_type;
                    $strategyRuleModel->strategy_id = $strategyModel->id;
                    $strategyRuleModel->rule_content = implode(",", $city);
                    $strategyRuleModel->create_time = time();
                    $strategyRuleModel->update_time = time();
                    $strategyRuleModel->save();

                }
                return output_data([], 200, ["msg" => "添加策略成功"]);
            } else {
                return output_error("添加策略失败");
            }
        } else {
            //获取广告类型列表
            $position_list = Position::all();
            $ad_list = Ad::all(['status' => 1]);
            if ($ad_list) {
                foreach ($ad_list as &$ad) {
                    $position = Position::find($ad->position_id);
                    $sdk = Sdk::find($ad->sdk_id);
                    if ($sdk) {
                        $ad->title = $sdk->title . "-" . $position->title . "-" . $ad->title;
                    }
                }
            }
            //获取渠道列表
            $channel_list = Channel::all();
            $this->assign("channel_list", $channel_list);
            $this->assign("ad_list", $ad_list);
            $this->assign("position_list", $position_list);
            //获取地区列表
            $province_list = Country::where("pid", 0)->select();
            $this->assign("province_list", $province_list);

            $city_list = Country::where("pid", ">", 0)->select();
            $this->assign("city_list", $city_list);

            return $this->fetch();
        }

    }

    public function edit()
    {
        if ($this->request->isPost()) {
            $title = input("title");
            $position_id = input("position_id");
            $weight = input("weight", 0);
            $status = input("status");
            $ad_ids = isset($_POST['ad_ids']) ? $_POST['ad_ids'] : "";  //广告ids
            $version_type = input("version_type");
            $version_content = input("version_content");
            $package_type = input("package_type");
            $package_content = input("package_content");
            $brand_type = input("brand_type");
            $brand_content = input("brand_content");
            $channel_type = input("channel_type");
            $channel_content = isset($_POST['channel_content']) ? $_POST['channel_content'] : '';
            $phone_type = input("phone_type");
            $phone_content = input("phone_content");
            $net_type = input("net_type");
            $net_content = isset($_POST['net_content']) ? $_POST['net_content'] : '';
            $date_type = input("date_type");
            $start_time = input("start_time");
            $start_time_hour = input("start_time_hour");
            $end_time = input("end_time");
            $end_time_hour = input("end_time_hour");
            $country = isset($_POST['country']) ? $_POST['country'] : "";
            $country_type = input("country_type");
            $province = isset($_POST["province"]) ? $_POST['province'] : "";
            $province_type = input("province_type");
            $city = isset($_POST["city"]) ? $_POST['city'] : "";
            $city_type = input("city_type");

            $id = input("id");


            $validate = Validate::make([
                'title' => "require",
                "id" => 'require',
            ]);
            $data['title'] = $title;
            $data['id'] = $id;
            if (!$validate->check($data)) {
                return output_error($validate->getError());
            }
            unset($data['id']);
            $strategyModel = new \app\common\model\Strategy();
            $data['weight'] = $weight;
            $data['status'] = $status;
            $data['create_time'] = time();
            $data['update_time'] = time();
            $map['id'] = $id;
            $res = $strategyModel->saveData($data, $map);

            //删除数据
            StrategyAd::where(['strategy_id' => $id])->delete();
            //规则删除掉
            StrategyRule::destroy(['strategy_id' => $id]);
            //添加关联数据
            if ($ad_ids) {

                //添加广告数据
                foreach ($ad_ids as $ad_id) {
                    $strategyAdModel = new StrategyAd();
                    $strategyAdModel->ad_id = $ad_id;
                    $strategyAdModel->strategy_id = $id;
                    $strategyAdModel->save();
                }
            }
            //添加规则数据
            if ($version_content) {
                //版本
                $strategyRuleModel = new StrategyRule();
                $strategyRuleModel->type = 1;
                $strategyRuleModel->rule = $version_type;
                $strategyRuleModel->strategy_id = $id;
                $strategyRuleModel->rule_content = $version_content;
                $strategyRuleModel->create_time = time();
                $strategyRuleModel->update_time = time();
                $strategyRuleModel->save();

            }

            if ($package_content) {
                //包名
                $strategyRuleModel = new StrategyRule();
                $strategyRuleModel->type = 2;
                $strategyRuleModel->rule = $package_type;
                $strategyRuleModel->strategy_id = $id;
                $strategyRuleModel->rule_content = $package_content;
                $strategyRuleModel->create_time = time();
                $strategyRuleModel->update_time = time();
                $strategyRuleModel->save();

            }
            if ($brand_content) {
                //手机品牌
                $strategyRuleModel = new StrategyRule();
                $strategyRuleModel->type = 3;
                $strategyRuleModel->rule = $brand_type;
                $strategyRuleModel->strategy_id = $id;
                $strategyRuleModel->rule_content = $brand_content;
                $strategyRuleModel->create_time = time();
                $strategyRuleModel->update_time = time();
                $strategyRuleModel->save();

            }
            if ($channel_content) {
                //渠道
                $strategyRuleModel = new StrategyRule();
                $strategyRuleModel->type = 4;
                $strategyRuleModel->rule = $channel_type;
                $strategyRuleModel->strategy_id = $id;
                $strategyRuleModel->rule_content = implode(",", $channel_content);
                $strategyRuleModel->create_time = time();
                $strategyRuleModel->update_time = time();
                $strategyRuleModel->save();

            }
            if ($phone_content) {
                //运营商
                $strategyRuleModel = new StrategyRule();
                $strategyRuleModel->type = 5;
                $strategyRuleModel->rule = $phone_type;
                $strategyRuleModel->strategy_id = $id;
                $strategyRuleModel->rule_content = $phone_content;
                $strategyRuleModel->create_time = time();
                $strategyRuleModel->update_time = time();
                $strategyRuleModel->save();
            }
            if ($net_content) {
                //网络
                $strategyRuleModel = new StrategyRule();
                $strategyRuleModel->type = 6;
                $strategyRuleModel->rule = $net_type;
                $strategyRuleModel->strategy_id = $id;
                $strategyRuleModel->rule_content = implode(",", $net_content);
                $strategyRuleModel->create_time = time();
                $strategyRuleModel->update_time = time();
                $strategyRuleModel->save();
            }
            if ($start_time || $end_time) {

                //日期
                $rule_content = '';
                if ($start_time) {
                    $rule_content = $start_time . "," . $start_time_hour;
                }
                if ($end_time) {
                    $rule_content = $rule_content . "," . $end_time . "," . $end_time_hour;
                }
                $strategyRuleModel = new StrategyRule();
                $strategyRuleModel->type = 7;
                $strategyRuleModel->rule = $date_type;
                $strategyRuleModel->strategy_id = $id;
                $strategyRuleModel->rule_content = $rule_content;
                $strategyRuleModel->create_time = time();
                $strategyRuleModel->update_time = time();
                $strategyRuleModel->save();

            }
            //地区
            if ($country && count($country) >= 1) {

                //国家
                $strategyRuleModel = new StrategyRule();
                $strategyRuleModel->type = 8;
                $strategyRuleModel->rule = $country_type;
                $strategyRuleModel->strategy_id = $id;
                $strategyRuleModel->rule_content = implode(",", $country);
                $strategyRuleModel->create_time = time();
                $strategyRuleModel->update_time = time();
                $strategyRuleModel->save();

            }
            if ($province && count($province) >= 1) {
                //省
                $strategyRuleModel = new StrategyRule();
                $strategyRuleModel->type = 9;
                $strategyRuleModel->rule = $province_type;
                $strategyRuleModel->strategy_id = $id;
                $strategyRuleModel->rule_content = implode(",", $province);
                $strategyRuleModel->create_time = time();
                $strategyRuleModel->update_time = time();
                $strategyRuleModel->save();

            }
            if ($city && count($city) >= 1) {
                //城市
                $strategyRuleModel = new StrategyRule();
                $strategyRuleModel->type = 10;
                $strategyRuleModel->rule = $city_type;
                $strategyRuleModel->strategy_id = $id;
                $strategyRuleModel->rule_content = implode(",", $city);
                $strategyRuleModel->create_time = time();
                $strategyRuleModel->update_time = time();
                $strategyRuleModel->save();

            }

            return output_data([], 200, ["msg" => "编辑策略成功"]);

        } else {
            $id = input("id");
            $info = \app\common\model\Strategy::find($id);
            if ($info) {
                //获取广告数据类别
                $strategyad_list = StrategyAd::all(['strategy_id' => $info->id]);
                $strategyadids = [];
                foreach ($strategyad_list as $strategyad) {
                    $strategyadids[] = $strategyad->ad_id;
                }
                $this->assign("strategyadids", $strategyadids);
                //获取规则列表
                $rule_types = [];
                $strategyrule_list = StrategyRule::all(['strategy_id' => $id]);
                $srule_arr = [];
                if ($strategyrule_list) {
                    foreach ($strategyrule_list as $strategyrule) {
                        $rule_types[] = $strategyrule->type;
                        $srule_arr[$strategyrule->type] = [
                            'rule' => $strategyrule->rule,
                            'rule_content' => $strategyrule->rule_content
                        ];
                    }
                }
//                echo "<pre>";
//                print_r($srule_arr);
                //规则类型
                $this->assign("rule_types", $rule_types);
                $this->assign("srule_arr", $srule_arr);

            }
            //获取广告类型列表
            $position_list = Position::all();
            $ad_list = Ad::all(['status' => 1]);
            if ($ad_list) {
                foreach ($ad_list as &$ad) {
                    $position = Position::find($ad->position_id);
                    $sdk = Sdk::find($ad->sdk_id);
                    if ($sdk) {
                        $ad->title = $sdk->title . "-" . $position->title . "-" . $ad->title;
                    }
                }
            }
            //获取渠道列表
            $channel_list = Channel::all();
            $this->assign("channel_list", $channel_list);
            //获取地区列表
            $province_list = Country::where("pid", 0)->select();
            $this->assign("province_list", $province_list);

            $city_list = Country::where("pid", ">", 0)->select();
            $this->assign("city_list", $city_list);

            $this->assign("ad_list", $ad_list);
            $this->assign("position_list", $position_list);
            $this->assign("info", $info);
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
            $result = \app\common\model\Strategy::destroy($map);
            if ($result) {
                StrategyRule::destroy(["strategy_id" => $id]);
                StrategyAd::destroy(["strategy_id" => $id]);
                return output_data(array(), 200, array("msg" => "删除数据成功"));
            } else {
                return output_error("删除数据失败", -400);
            }
        }
    }
}