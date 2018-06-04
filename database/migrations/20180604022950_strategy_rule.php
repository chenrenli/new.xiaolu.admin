<?php

use think\migration\Migrator;
use think\migration\db\Column;

class StrategyRule extends Migrator
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
        $sql = "create table `xl_strategy_rule`(
id int(10) unsigned not null auto_increment PRIMARY key,
strategy_id int(10) unsigned not null default 0 comment'策略ID',
`type` tinyint(1) unsigned not null default 0 comment'类型:1版本号',
`rule` tinyint(1) unsigned not null default 0 comment'规则类型:1不包括,2包括',
`rule_content` varchar(200) not null default '' comment'规则内容',
create_time int(11) unsigned not null default 0 comment'创建时间',
update_time int(11) unsigned not null default 0 comment'更新时间',
)engine=innodb default charset=utf8";
    }
}
