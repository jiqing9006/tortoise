CREATE TABLE `tf_role` (
`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'id' ,
`name` VARCHAR(50) NOT NULL COMMENT '名称' ,
`power` VARCHAR(1000) NULL COMMENT '权限字符串' ,
`weight` INT(11) NOT NULL DEFAULT '0' COMMENT '数字越大越靠前' ,
`is_del` TINYINT(4) NOT NULL DEFAULT 0 COMMENT '是否删除 0未删除 1删除' ,
`add_time` INT(11) NOT NULL  COMMENT '添加时间' ,
PRIMARY KEY (`id`),
UNIQUE (`name`))
ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = '角色表';

ALTER TABLE `tf_admin_user` DROP `power`;
ALTER TABLE `tf_admin_user` ADD `role_id` INT(11) NOT NULL DEFAULT '0' COMMENT '0 管理员 非0是具体的角色' AFTER `status`;

insert into `dbver` (`ver`, `changelog`, `dateline`) values ('5', '添加角色', unix_timestamp());