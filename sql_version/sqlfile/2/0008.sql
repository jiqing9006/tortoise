INSERT INTO `tf_action` (`id`, `pid`, `level`, `name`, `urls`, `is_show`) VALUES
(10, 1, 2, '文章管理', '/Article/index', 1),
(11, 10, 3, '编辑', '/Article/edit', 0);

insert into `dbver` (`ver`, `changelog`, `dateline`) values ('8', '菜单', unix_timestamp());