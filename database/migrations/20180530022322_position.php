<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Position extends Migrator
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
        $sql = "create table `xl_position`(
id int(11) unsigned not null auto_increment PRIMARY key,
title varchar(200) not null default '' comment'类型名称',
status tinyint(1) not null default 1 comment'是否有效:0无,1有'
)engine=innodb default charset=utf8 comment'广告类型'";
        \think\Db::execute($sql);
    }
}
