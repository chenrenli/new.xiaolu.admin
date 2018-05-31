<?php

use think\migration\Migrator;
use think\migration\db\Column;

class AppAd extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $sql = "create table `xl_app_ad`(
id int(11) unsigned not null auto_increment primary key,
sdk_id int(10) unsigned not null default 0 comment'sdkId',
sdk_title varchar(100) not null default '' comment'sdk名称',
app_id int(10) unsigned not null default 0 comment'app Id',
position_id int(10) unsigned not null default 0 comment'广告类型ID',
position_title varchar(200) not null default '' comment'广告类型名称',
adid varchar(100) not null default '' comment'第三方广告ID',
appid varchar(100) not null default '' comment'第三方应用ID',
status tinyint(1) unsigned not null default 0 comment'是否有效:0无,1是'
)engine=innodb default charset=utf8 comment'应用关联的广告'";
        \think\Db::execute($sql);
    }
}
