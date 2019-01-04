ALTER TABLE `tf_action` ADD `weight` INT(11) NOT NULL DEFAULT '0' COMMENT '权重 数字越大越靠前' AFTER `is_show`;

UPDATE `tf_action` SET `weight` = '-1' WHERE `id` = 3;

insert into `dbver` (`ver`, `changelog`, `dateline`) values ('4', '增加菜单权重', unix_timestamp());