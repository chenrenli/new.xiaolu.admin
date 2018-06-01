<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/31
 * Time: 13:36
 */

$menu = array(
    'admin_menu' => array(
        array(
            'name' => "sdk",
            'title' => "应用管理",
            'child' => array(
                array(
                    'name' => "app",
                    'title' => "应用管理",
                    'controller' => 'app',
                    'action' => 'index',
                ),

            ),
        ),
        array(
            'name' => "sdk",
            'title' => "sdk管理",
            'child' => array(
                array(
                    'name' => "sdk",
                    'title' => "sdk管理",
                    'controller' => 'sdk',
                    'action' => 'index',
                ),

            ),
        ),
        array(
            'name' => "channel",
            'title' => "渠道管理",
            'child' => array(
                array(
                    'name' => "channel",
                    'title' => "渠道管理",
                    'controller' => 'channel',
                    'action' => 'index',
                ),

            ),
        ),
        array(
            'name' => "position",
            'title' => "广告类型",
            'child' => array(
                array(
                    'name' => "position",
                    'title' => "广告类型管理",
                    'controller' => 'position',
                    'action' => 'index',
                ),

            ),
        ),
        array(
            'name' => "更新管理",
            'title' => "更新管理",
            'child' => array(
                array(
                    'name' => "update",
                    'title' => "更新管理",
                    'controller' => 'update',
                    'action' => 'index',
                ),

            ),
        ),
        array(
            'name' => "admin",
            'title' => "管理员",
            'child' => array(
                array(
                    'name' => "topic",
                    'title' => "管理员管理",
                    'controller' => 'admin',
                    'action' => 'index',
                ),
                array(
                    'name' => "topic",
                    'title' => "角色管理",
                    'controller' => 'AuthGroup',
                    'action' => 'index',
                ),
                array(
                    'name' => "topic",
                    'title' => "权限管理",
                    'controller' => 'AuthRule',
                    'action' => 'index',
                ),

            ),
        ),

    )
);

return $menu;