CREATE TABLE `tf_article` (
`id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'id' ,
`title` VARCHAR(255) NOT NULL COMMENT '标题' ,
`title_img` VARCHAR(255) NOT NULL COMMENT '标题图' ,
`content` TEXT NULL COMMENT '内容' ,
`is_del` TINYINT(4) NOT NULL DEFAULT 0 COMMENT '是否删除 0未删除 1删除' ,
`add_time` INT(11) NOT NULL  COMMENT '添加时间' ,
PRIMARY KEY (`id`))
ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = '文章表';

insert into `dbver` (`ver`, `changelog`, `dateline`) values ('7', '图，文测试', unix_timestamp());