<?php

use think\migration\Migrator;
use think\migration\db\Column;

class App extends Migrator
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
        $sql = "create table `xl_app`(
id int(11) unsigned not null auto_increment PRIMARY key,
packagename varchar(80) not null default '' comment'包名',
gamename varchar(80) not null default '' comment'游戏名',
channel_id int(11) unsigned not null default 0 comment'渠道ID',
channel_title varchar(100) not null default '' comment'渠道名称',
create_time int(11) unsigned not null default 0 comment'创建时间',
update_time int(11) unsigned not null default 0 comment'更新时间',
status tinyint(1) unsigned not null default 1 comment'是否开启:0否,1是'
)engine=innodb default charset utf8";
        \think\Db::execute($sql);
    }
}
