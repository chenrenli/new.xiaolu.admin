<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Update extends Migrator
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
        $sql = "create table `xl_update`(
id int(11) unsigned not null auto_increment PRIMARY key,
version char(20) not null default '' comment'版本号',
ver int(11) unsigned not null default 0 comment'版本号数字版',
file_path varchar(1000) not null default '' comment'文件更新路径'
)engine=innodb default charset=utf8";
        \think\Db::execute($sql);
    }
}
