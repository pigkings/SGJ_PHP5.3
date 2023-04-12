CREATE TABLE `oc_user_attribute` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '字段标题',
  `field` varchar(100) NOT NULL DEFAULT '' COMMENT '字段定义',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '数据类型',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字段默认值',
  `tip` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `options` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `user_type` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '文档模型',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户模块：用户属性字段表';

LOCK TABLES `oc_user_attribute` WRITE;
INSERT INTO `oc_user_attribute` (`id`, `name`, `title`, `field`, `type`, `value`, `tip`, `show`, `options`, `user_type`, `create_time`, `update_time`, `status`)
VALUES
	(1, 'gender', '性别', 'tinyint(3)  NOT NULL ', 'radio', '0', '性别', 1, '1:男\n-1:女\r\n0:保密\r\n', 1, 1438651748, 1438651748, 1),
	(2, 'city', '所在城市', 'varchar(15) NOT NULL', 'text', '', '常住城市', 1, '', 1, 1442026468, 1442123810, 1),
	(3, 'summary', '签名', 'varchar(127) NOT NULL', 'text', '', '签名', 1, '', 1, 1438651748, 1438651748, 1);
UNLOCK TABLES;

CREATE TABLE `oc_user_message` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '消息ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '消息父ID',
  `title` varchar(1024) NOT NULL DEFAULT '' COMMENT '消息标题',
  `content` text COMMENT '消息内容',
  `type` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '0系统消息,1评论消息,2私信消息',
  `to_uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '接收用户ID',
  `from_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '私信消息发信用户ID',
  `is_read` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否已读',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发送时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户消息表';

CREATE TABLE `oc_user_person` (
  `uid` int(11) unsigned NOT NULL COMMENT '用户ID',
  `gender` tinyint(3) NOT NULL DEFAULT '0' COMMENT '性别',
  `summary` varchar(127) NOT NULL DEFAULT '' COMMENT '签名',
  `city` varchar(15) NOT NULL COMMENT '所在城市',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户模块：个人类型扩展信息表';

CREATE TABLE `oc_user_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(31) NOT NULL DEFAULT '' COMMENT '名称',
  `title` varchar(31) NOT NULL DEFAULT '' COMMENT '标题',
  `list_field` varchar(127) NOT NULL DEFAULT '' COMMENT '搜索字段',
  `home_template` varchar(127) NOT NULL DEFAULT '' COMMENT '主页模版',
  `center_template` varchar(127) NOT NULL DEFAULT '' COMMENT '个人中心模板',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户模块：用户类型表';

LOCK TABLES `oc_user_type` WRITE;
INSERT INTO `oc_user_type` (`id`, `name`, `title`, `list_field`, `home_template`, `create_time`, `update_time`, `sort`, `status`)
VALUES
	(1, 'person', '个人', '1', '', 1438651748, 1438651748, 0, 1);
UNLOCK TABLES;
