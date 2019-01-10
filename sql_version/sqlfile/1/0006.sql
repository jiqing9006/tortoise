INSERT INTO `tf_action` (`id`, `pid`, `level`, `name`, `urls`, `is_show`) VALUES
(8, 3, 2, '角色管理', '/Role/index', 1),
(9, 8, 3, '编辑', '/Role/edit', 0);

insert into `dbver` (`ver`, `changelog`, `dateline`) values ('6', '菜单', unix_timestamp());