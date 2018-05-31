<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Sdk extends Migrator
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
        $sql = "create table `xl_sdk`(
        id int(11) unsigned not null auto_increment PRIMARY key,
        title varchar(80) not null default '' comment'名称',
        start_path varchar(200) not null default '' comment'启动路径',
        start_class varchar(200) not null default '' comment'启动类名',
        create_time int(11) unsigned not null default 0 comment'创建时间',
        update_time int(11) unsigned not null default 0 comment'更新时间'
        )engine=innodb default charset utf8";

        \think\Db::execute($sql);
    }
}
