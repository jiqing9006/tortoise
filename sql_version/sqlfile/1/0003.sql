INSERT INTO `tf_action` (`id`, `pid`, `level`, `name`, `urls`, `is_show`) VALUES
(3, 0, 1, '权限', '/Priv/index', 1),
(4, 3, 2, '管理员列表', '/Priv/index', 1),
(5, 3, 2, '菜单列表', '/Priv/priv_list', 1),
(6, 4, 3, '添加用户', '/Priv/add', 0),
(7, 4, 3, '编辑用户', '/Priv/edit', 0);

insert into `dbver` (`ver`, `changelog`, `dateline`) values ('3', '操作权限菜单', unix_timestamp());