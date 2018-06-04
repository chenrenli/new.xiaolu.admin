<?php

use think\migration\Migrator;
use think\migration\db\Column;

class StrategyAd extends Migrator
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
        $sql = "create table `xl_strategy_ad`(
id int(10) unsigned not null auto_increment PRIMARY key,
ad_id int(10) unsigned not null default 0 comment'广告Id ',
strategy_id int(10) unsigned not null default 0 comment'策略ID',
status tinyint(1) not null default 1 comment'是否开启:0否,1是'
)engine=innodb default charset=utf8";
        \think\Db::execute($sql);
    }
}
