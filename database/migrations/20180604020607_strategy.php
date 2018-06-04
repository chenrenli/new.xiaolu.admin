<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Strategy extends Migrator
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
        $sql = "create table `xl_strategy`(
id int(11) unsigned not null auto_increment primary key,
title varchar(200) not null default '' comment'名称',
position_id int(10) unsigned not null default 0 comment'广告类型ID',
weight int(10) unsigned not null default 0 comment'权重',
create_time int(11) unsigned not null default 0 comment'创建时间',
update_time int(11) unsigned not null default 0 comment'更新时间',
status tinyint(1) unsigned not null default 1 comment'开启状态:1开启,0关闭'
)engine=innodb default charset=utf8 comment'流量策略表'";
        \think\Db::execute($sql);
    }
}
