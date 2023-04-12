-- MySQL dump 10.13  Distrib 5.7.26, for Win64 (x86_64)
--
-- Host: localhost    Database: guessgame
-- ------------------------------------------------------
-- Server version	5.7.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `gg_admin_access`
--

DROP TABLE IF EXISTS `gg_admin_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `group` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '管理员用户组',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台管理员与用户组对应关系表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_access`
--

LOCK TABLES `gg_admin_access` WRITE;
/*!40000 ALTER TABLE `gg_admin_access` DISABLE KEYS */;
INSERT INTO `gg_admin_access` VALUES (1,1,1,1438651748,1438651748,0,1);
/*!40000 ALTER TABLE `gg_admin_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_admin_addon`
--

DROP TABLE IF EXISTS `gg_admin_addon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_addon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '插件名或标识',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text NOT NULL COMMENT '插件描述',
  `config` text COMMENT '配置',
  `author` varchar(32) NOT NULL DEFAULT '' COMMENT '作者',
  `version` varchar(8) NOT NULL DEFAULT '' COMMENT '版本号',
  `adminlist` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  `type` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '插件类型',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='插件表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_addon`
--

LOCK TABLES `gg_admin_addon` WRITE;
/*!40000 ALTER TABLE `gg_admin_addon` DISABLE KEYS */;
/*!40000 ALTER TABLE `gg_admin_addon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_admin_config`
--

DROP TABLE IF EXISTS `gg_admin_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '配置标题',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '配置名称',
  `value` text NOT NULL COMMENT '配置值',
  `group` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `type` varchar(16) NOT NULL DEFAULT '' COMMENT '配置类型',
  `options` varchar(255) NOT NULL DEFAULT '' COMMENT '配置额外值',
  `tip` varchar(100) NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='系统配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_config`
--

LOCK TABLES `gg_admin_config` WRITE;
/*!40000 ALTER TABLE `gg_admin_config` DISABLE KEYS */;
INSERT INTO `gg_admin_config` VALUES (1,'站点开关','TOGGLE_WEB_SITE','1',1,'select','0:关闭\r\n1:开启','站点关闭后将不能访问',1378898976,1406992386,1,1),(2,'网站标题','WEB_SITE_TITLE','开心水果竞猜',1,'text','','网站标题前台显示标题',1378898976,1379235274,2,1),(3,'网站口号','WEB_SITE_SLOGAN','现金红包，越猜越大！未猜中累计到下次！',1,'text','','网站口号、宣传标语、一句话介绍',1434081649,1434081649,3,1),(4,'网站LOGO','WEB_SITE_LOGO','85',1,'picture','','网站LOGO',1407003397,1407004692,4,1),(5,'网站描述','WEB_SITE_DESCRIPTION','开心水果，越猜越大！',1,'textarea','','网站搜索引擎描述',1378898976,1379235841,5,1),(29,'竞猜开始时间','GUESS_START_TIME','0',6,'num','','时间采用24小时  凌晨12点为24',1469673020,1469673627,0,1),(30,'竞猜结束时间','GUESS_END_TIME','24',6,'num','','时间采用24小时  凌晨12点为24',1469673086,1469673642,0,1),(31,'第一层推广人','GUESS_FIRST_LEVEL_AWARD','10',6,'num','','充值奖励（%）',1469870719,1469870719,0,1),(6,'网站关键字','WEB_SITE_KEYWORD','开心水果，越猜越大！未猜中累计到下次！',1,'textarea','','网站搜索引擎关键字',1378898976,1381390100,6,1),(7,'版权信息','WEB_SITE_COPYRIGHT','@2017',1,'text','','设置在网站底部显示的版权信息',1406991855,1469589914,7,1),(27,'竞猜提示标题','WEB_JINGCAI_TIP','开心水果，越猜越大！',1,'text','','',1469589159,1469589203,0,1),(8,'网站备案号','WEB_SITE_ICP','',1,'text','','设置在网站底部显示的备案号',1378900335,1415983236,8,1),(28,'首页显示开奖记录数目','GUESS_HOME_SHOW','28',6,'num','','',1469607135,1469672873,0,1),(9,'站点统计','WEB_SITE_STATISTICS','',1,'textarea','','支持百度、Google、cnzz等所有Javascript的统计代码',1378900335,1415983236,9,1),(10,'文件上传大小','UPLOAD_FILE_SIZE','10',2,'num','','文件上传大小单位：MB',1428681031,1428681031,1,1),(11,'图片上传大小','UPLOAD_IMAGE_SIZE','2',2,'num','','图片上传大小单位：MB',1428681071,1428681071,2,1),(12,'后台多标签','ADMIN_TABS','1',2,'radio','0:关闭\r\n1:开启','',1453445526,1453445526,3,1),(13,'分页数量','ADMIN_PAGE_ROWS','10',2,'num','','分页时每页的记录数',1434019462,1434019481,4,1),(14,'后台主题','ADMIN_THEME','default',2,'select','default:默认主题\r\nblue:蓝色理想\r\ngreen:绿色生活','后台界面主题',1436678171,1436690570,5,1),(15,'导航分组','NAV_GROUP_LIST','main:主导航\r\ntop:顶部导航\r\nbottom:底部导航\r\nwap_bottom:Wap底部导航',2,'array','','导航分组',1458382037,1458382061,6,1),(16,'配置分组','CONFIG_GROUP_LIST','1:基本\r\n2:系统\r\n3:开发\r\n4:部署\r\n5:授权\r\n6:竞猜\r\n7:支付',2,'array','','配置分组',1379228036,1469412264,7,1),(17,'开发模式','DEVELOP_MODE','1',3,'select','1:开启\r\n0:关闭','开发模式下会显示菜单管理、配置管理、数据字典等开发者工具',1432393583,1432393583,1,1),(18,'是否显示页面Trace','SHOW_PAGE_TRACE','0',3,'select','0:关闭\r\n1:开启','是否显示页面Trace信息',1387165685,1469437324,2,1),(19,'系统加密KEY','AUTH_KEY','QQvfCR/&@lre:\"GwXJLK_(`#$W/Sf!gS&-~)]/v}vXY{R]cAIc-ZOs~lNA}opN.h',3,'textarea','','轻易不要修改此项，否则容易造成用户无法登录；如要修改，务必备份原key',1438647773,1438647815,3,1),(20,'URL模式','URL_MODEL','1',4,'select','0:普通模式\r\n1:PATHINFO模式\r\n2:REWRITE模式\r\n3:兼容模式','',1438423248,1438423248,1,1),(21,'静态文件独立域名','STATIC_DOMAIN','',4,'text','','静态文件独立域名一般用于在用户无感知的情况下平和的将网站图片自动存储到腾讯万象优图、又拍云等第三方服务。',1438564784,1438564784,2,1),(22,'官网账号','AUTH_USERNAME','trial',5,'text','','官网登陆账号（支持用户名、邮箱、手机号）',1438647815,1438647815,1,1),(23,'官网密码','AUTH_PASSWORD','trial',5,'text','','官网密码',1438647815,1438647815,2,1),(24,'密钥','AUTH_SN','',5,'textarea','','密钥请通过登陆官网至个人中心获取',1438647815,1438647815,3,1),(25,'开奖周期（分钟）','GUESS_OPEN_CYCLE','0.5',6,'num','','配置每多少分钟进行开奖，请正确设置参数值',1469412618,1469412618,0,1),(26,'开奖前禁止投注时间（秒）','GUESS_CLOSE_BETTING','10',6,'num','','临近开奖前多少秒内禁止进行投注',1469412731,1681193287,0,1),(32,'第二层推广人','GUESS_SECOND_LEVEL_AWARD','5',6,'num','','第二层推广人奖励（%）',1469870779,1469870817,0,1),(33,'网站名称','WEB_NAME','开心水果',1,'text','','网站名称',1469932938,1469932938,28,1),(34,'新用户注册奖励','GUESS_REGIST_AWARD','1000',6,'num','','新用户注册奖励',1470100732,1470100732,0,1),(35,'微信支付图片','GUESS_WEIXIN_IMG','73',7,'picture','','',1470107654,1470318653,0,1),(36,'支付宝支付图片','GUESS_ALI_IMG','74',7,'picture','','',1470107696,1470318608,0,1),(37,'最小投注金额','GUESS_LIMIT_SCORE','1',6,'num','','',1470275141,1470275141,0,1),(38,'游戏规则','GUESS_GAME_RULE','                                                                                                <p>\r\n	六种红包，分别对应1,2,3,4,5,6个数字，每期系统自动随机开奖一种红包（一个数字）。\r\n</p>\r\n<p>\r\n	猜中开奖红包可获得投注金5倍奖励\r\n</p>\r\n<p>\r\n	大小单双猜中可获得投注金1.9倍奖励\r\n</p>\r\n<p>\r\n	可以单独猜红包，也可以单独猜大小单双，组合猜中奖率更大，奖金更丰厚<span style=\"white-space:normal;\">（1,2,3为小；4,5,6为大；1,3,5为单；2,4,6为双）</span> \r\n</p>\r\n<p>\r\n	投注时间每天0点-24点开奖，1分钟一场，全天共288场\r\n</p>\r\n<p>\r\n	每一场投注时间有4分钟，开奖前1分钟停止投注\r\n</p>\r\n<p>\r\n	最低投注5积分，满100积分即可申请提现，1积分=1元，每天可申请2次提现，申请提现后24小时内到账\r\n</p>\r\n<p>\r\n	玩法技巧：每期同时投注四个数字，即可增加中奖率到95%以上哦\r\n</p>                                                                        ',6,'kindeditor','','',1470317894,1470317894,0,1),(39,'支付宝帐号','GUESS_ALI_ACCOUNT','ceshi123456@163.com',7,'text','','',1470318684,1470318684,0,1),(40,'微信支付帐号','GUESS_WEIXIN_ACCOUNT','ceshi123456',7,'text','','',1470318722,1470318722,0,1),(41,'首页活动公告','GUESS_HOME_GG','小赌怡情 ！         大赌伤身！',6,'text','','',1470385794,1470385794,0,1);
/*!40000 ALTER TABLE `gg_admin_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_admin_group`
--

DROP TABLE IF EXISTS `gg_admin_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '部门ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上级部门ID',
  `title` varchar(31) NOT NULL DEFAULT '' COMMENT '部门名称',
  `icon` varchar(31) NOT NULL DEFAULT '' COMMENT '图标',
  `menu_auth` text NOT NULL COMMENT '权限列表',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='部门信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_group`
--

LOCK TABLES `gg_admin_group` WRITE;
/*!40000 ALTER TABLE `gg_admin_group` DISABLE KEYS */;
INSERT INTO `gg_admin_group` VALUES (1,0,'超级管理员','','',1426881003,1427552428,0,1),(2,1,'总代理','','{\"User\":[\"21\",\"22\"]}',1474027995,1474027995,2,1);
/*!40000 ALTER TABLE `gg_admin_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_admin_hook`
--

DROP TABLE IF EXISTS `gg_admin_hook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '钩子ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件',
  `type` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='钩子表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_hook`
--

LOCK TABLES `gg_admin_hook` WRITE;
/*!40000 ALTER TABLE `gg_admin_hook` DISABLE KEYS */;
INSERT INTO `gg_admin_hook` VALUES (1,'AdminIndex','后台首页小工具','后台首页小工具',1,1446522155,1446522155,1),(2,'FormBuilderExtend','FormBuilder类型扩展Builder','',1,1447831268,1447831268,1),(3,'UploadFile','上传文件钩子','',1,1407681961,1407681961,1),(4,'PageHeader','页面header钩子，一般用于加载插件CSS文件和代码','',1,1407681961,1407681961,1),(5,'PageFooter','页面footer钩子，一般用于加载插件CSS文件和代码','',1,1407681961,1407681961,1),(6,'CommonHook','通用钩子，自定义用途，一般用来定制特殊功能','',1,1456147822,1456147822,1);
/*!40000 ALTER TABLE `gg_admin_hook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_admin_module`
--

DROP TABLE IF EXISTS `gg_admin_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(31) NOT NULL DEFAULT '' COMMENT '名称',
  `title` varchar(63) NOT NULL DEFAULT '' COMMENT '标题',
  `logo` varchar(63) NOT NULL DEFAULT '' COMMENT '图片图标',
  `icon` varchar(31) NOT NULL DEFAULT '' COMMENT '字体图标',
  `icon_color` varchar(7) NOT NULL DEFAULT '' COMMENT '字体图标颜色',
  `description` varchar(127) NOT NULL DEFAULT '' COMMENT '描述',
  `developer` varchar(31) NOT NULL DEFAULT '' COMMENT '开发者',
  `version` varchar(7) NOT NULL DEFAULT '' COMMENT '版本',
  `user_nav` text NOT NULL COMMENT '个人中心导航',
  `config` text NOT NULL COMMENT '配置',
  `admin_menu` text NOT NULL COMMENT '菜单节点',
  `is_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许卸载',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='模块功能表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_module`
--

LOCK TABLES `gg_admin_module` WRITE;
/*!40000 ALTER TABLE `gg_admin_module` DISABLE KEYS */;
INSERT INTO `gg_admin_module` VALUES (1,'Admin','系统','','fa fa-cog','#3CA6F1','核心系统','红包竞猜系统','1.3.0','','','{\"1\":{\"pid\":\"0\",\"title\":\"\\u7cfb\\u7edf\",\"icon\":\"fa fa-cog\",\"level\":\"system\",\"id\":\"1\"},\"2\":{\"pid\":\"1\",\"title\":\"\\u7cfb\\u7edf\\u529f\\u80fd\",\"icon\":\"fa fa-folder-open-o\",\"id\":\"2\"},\"3\":{\"pid\":\"2\",\"title\":\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\",\"icon\":\"fa fa-wrench\",\"url\":\"Admin\\/Config\\/group\",\"id\":\"3\"},\"4\":{\"pid\":\"3\",\"title\":\"\\u4fee\\u6539\\u8bbe\\u7f6e\",\"url\":\"Admin\\/Config\\/groupSave\",\"id\":\"4\"},\"5\":{\"pid\":\"2\",\"title\":\"\\u5bfc\\u822a\\u7ba1\\u7406\",\"icon\":\"fa fa-map-signs\",\"url\":\"Admin\\/Nav\\/index\",\"id\":\"5\"},\"6\":{\"pid\":\"5\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Admin\\/Nav\\/add\",\"id\":\"6\"},\"7\":{\"pid\":\"5\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"Admin\\/Nav\\/edit\",\"id\":\"7\"},\"8\":{\"pid\":\"5\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Admin\\/Nav\\/setStatus\",\"id\":\"8\"},\"10\":{\"pid\":\"9\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Admin\\/Slider\\/add\",\"id\":\"10\"},\"11\":{\"pid\":\"9\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"Admin\\/Slider\\/edit\",\"id\":\"11\"},\"12\":{\"pid\":\"9\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Admin\\/Slider\\/setStatus\",\"id\":\"12\"},\"13\":{\"pid\":\"2\",\"title\":\"\\u914d\\u7f6e\\u7ba1\\u7406\",\"icon\":\"fa fa-cogs\",\"url\":\"Admin\\/Config\\/index\",\"id\":\"13\"},\"14\":{\"pid\":\"13\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Admin\\/Config\\/add\",\"id\":\"14\"},\"15\":{\"pid\":\"13\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"Admin\\/Config\\/edit\",\"id\":\"15\"},\"16\":{\"pid\":\"13\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Admin\\/Config\\/setStatus\",\"id\":\"16\"},\"17\":{\"pid\":\"2\",\"title\":\"\\u4e0a\\u4f20\\u7ba1\\u7406\",\"icon\":\"fa fa-upload\",\"url\":\"Admin\\/Upload\\/index\",\"id\":\"17\"},\"18\":{\"pid\":\"17\",\"title\":\"\\u4e0a\\u4f20\\u6587\\u4ef6\",\"url\":\"Admin\\/Upload\\/upload\",\"id\":\"18\"},\"19\":{\"pid\":\"17\",\"title\":\"\\u5220\\u9664\\u6587\\u4ef6\",\"url\":\"Admin\\/Upload\\/delete\",\"id\":\"19\"},\"20\":{\"pid\":\"17\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Admin\\/Upload\\/setStatus\",\"id\":\"20\"},\"21\":{\"pid\":\"17\",\"title\":\"\\u4e0b\\u8f7d\\u8fdc\\u7a0b\\u56fe\\u7247\",\"url\":\"Admin\\/Upload\\/downremoteimg\",\"id\":\"21\"},\"22\":{\"pid\":\"17\",\"title\":\"\\u6587\\u4ef6\\u6d4f\\u89c8\",\"url\":\"Admin\\/Upload\\/fileManager\",\"id\":\"22\"},\"23\":{\"pid\":\"1\",\"title\":\"\\u7cfb\\u7edf\\u6743\\u9650\",\"icon\":\"fa fa-folder-open-o\",\"id\":\"23\"},\"24\":{\"pid\":\"23\",\"title\":\"\\u7528\\u6237\\u8bbe\\u7f6e\",\"icon\":\"fa fa-user\",\"url\":\"Admin\\/User\\/index\",\"id\":\"24\"},\"25\":{\"pid\":\"24\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Admin\\/User\\/add\",\"id\":\"25\"},\"26\":{\"pid\":\"24\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"Admin\\/User\\/edit\",\"id\":\"26\"},\"27\":{\"pid\":\"24\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Admin\\/User\\/setStatus\",\"id\":\"27\"},\"28\":{\"pid\":\"23\",\"title\":\"\\u7ba1\\u7406\\u8bbe\\u7f6e\",\"icon\":\"fa fa-lock\",\"url\":\"Admin\\/Access\\/index\",\"id\":\"28\"},\"29\":{\"pid\":\"28\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Admin\\/Access\\/add\",\"id\":\"29\"},\"30\":{\"pid\":\"28\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"Admin\\/Access\\/edit\",\"id\":\"30\"},\"31\":{\"pid\":\"28\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Admin\\/Access\\/setStatus\",\"id\":\"31\"},\"32\":{\"pid\":\"23\",\"title\":\"\\u5206\\u7ec4\\u6743\\u9650\",\"icon\":\"fa fa-sitemap\",\"url\":\"Admin\\/Group\\/index\",\"id\":\"32\"},\"33\":{\"pid\":\"32\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Admin\\/Group\\/add\",\"id\":\"33\"},\"34\":{\"pid\":\"32\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"Admin\\/Group\\/edit\",\"id\":\"34\"},\"35\":{\"pid\":\"32\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Admin\\/Group\\/setStatus\",\"id\":\"35\"},\"36\":{\"pid\":\"1\",\"title\":\"\\u6269\\u5c55\\u4e2d\\u5fc3\",\"icon\":\"fa fa-folder-open-o\",\"id\":\"36\"},\"38\":{\"pid\":\"37\",\"title\":\"\\u5b89\\u88c5\",\"url\":\"Admin\\/Theme\\/install\",\"id\":\"38\"},\"39\":{\"pid\":\"37\",\"title\":\"\\u5378\\u8f7d\",\"url\":\"Admin\\/Theme\\/uninstall\",\"id\":\"39\"},\"40\":{\"pid\":\"37\",\"title\":\"\\u66f4\\u65b0\\u4fe1\\u606f\",\"url\":\"Admin\\/Theme\\/updateInfo\",\"id\":\"40\"},\"41\":{\"pid\":\"37\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Admin\\/Theme\\/setStatus\",\"id\":\"41\"},\"42\":{\"pid\":\"37\",\"title\":\"\\u5207\\u6362\\u4e3b\\u9898\",\"url\":\"Admin\\/Theme\\/setCurrent\",\"id\":\"42\"},\"43\":{\"pid\":\"37\",\"title\":\"\\u53d6\\u6d88\\u4e3b\\u9898\",\"url\":\"Admin\\/Theme\\/cancel\",\"id\":\"43\"},\"44\":{\"pid\":\"36\",\"title\":\"\\u529f\\u80fd\\u6a21\\u5757\",\"icon\":\"fa fa-th-large\",\"url\":\"Admin\\/Module\\/index\",\"id\":\"44\"},\"45\":{\"pid\":\"44\",\"title\":\"\\u5b89\\u88c5\",\"url\":\"Admin\\/Module\\/install\",\"id\":\"45\"},\"46\":{\"pid\":\"44\",\"title\":\"\\u5378\\u8f7d\",\"url\":\"Admin\\/Module\\/uninstall\",\"id\":\"46\"},\"47\":{\"pid\":\"44\",\"title\":\"\\u66f4\\u65b0\\u4fe1\\u606f\",\"url\":\"Admin\\/Module\\/updateInfo\",\"id\":\"47\"},\"48\":{\"pid\":\"44\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Admin\\/Module\\/setStatus\",\"id\":\"48\"},\"50\":{\"pid\":\"49\",\"title\":\"\\u5b89\\u88c5\",\"url\":\"Admin\\/Addon\\/install\",\"id\":\"50\"},\"51\":{\"pid\":\"49\",\"title\":\"\\u5378\\u8f7d\",\"url\":\"Admin\\/Addon\\/uninstall\",\"id\":\"51\"},\"52\":{\"pid\":\"49\",\"title\":\"\\u8fd0\\u884c\",\"url\":\"Admin\\/Addon\\/execute\",\"id\":\"52\"},\"53\":{\"pid\":\"49\",\"title\":\"\\u8bbe\\u7f6e\",\"url\":\"Admin\\/Addon\\/config\",\"id\":\"53\"},\"54\":{\"pid\":\"49\",\"title\":\"\\u540e\\u53f0\\u7ba1\\u7406\",\"url\":\"Admin\\/Addon\\/adminList\",\"id\":\"54\"},\"55\":{\"pid\":\"54\",\"title\":\"\\u65b0\\u589e\\u6570\\u636e\",\"url\":\"Admin\\/Addon\\/adminAdd\",\"id\":\"55\"},\"56\":{\"pid\":\"54\",\"title\":\"\\u7f16\\u8f91\\u6570\\u636e\",\"url\":\"Admin\\/Addon\\/adminEdit\",\"id\":\"56\"},\"57\":{\"pid\":\"54\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Admin\\/Addon\\/setStatus\",\"id\":\"57\"},\"58\":{\"pid\":\"2\",\"title\":\"\\u7ade\\u731c\\u56fe\\u7247\",\"icon\":\"fa fa-image\",\"url\":\"Admin\\/Slider\\/index\",\"id\":\"58\"},\"59\":{\"pid\":\"2\",\"title\":\"\\u7ade\\u731c\\u7ba1\\u7406\",\"icon\":\"fa fa-image\",\"url\":\"Admin\\/Term\\/index\",\"id\":\"59\"}}',1,1438651748,1681192898,0,1),(2,'Cms','门户','','fa fa-newspaper-o','#9933FF','门户模块','红包竞猜系统','1.3.0','','{\"need_check\":\"0\",\"toggle_comment\":\"1\",\"group_list\":\"1:\\u9ed8\\u8ba4\",\"cate\":\"a:1\",\"taglib\":[\"Cms\"]}','{\"1\":{\"id\":\"1\",\"pid\":\"0\",\"title\":\"CMS\",\"icon\":\"fa fa-newspaper-o\"},\"2\":{\"pid\":\"1\",\"title\":\"\\u5185\\u5bb9\\u7ba1\\u7406\",\"icon\":\"fa fa-folder-open-o\",\"id\":\"2\"},\"3\":{\"pid\":\"2\",\"title\":\"\\u6587\\u7ae0\\u914d\\u7f6e\",\"icon\":\"fa fa-wrench\",\"url\":\"Cms\\/Index\\/module_config\",\"id\":\"3\"},\"4\":{\"pid\":\"2\",\"title\":\"\\u6587\\u6863\\u6a21\\u578b\",\"icon\":\"fa fa-th-large\",\"url\":\"Cms\\/Type\\/index\",\"id\":\"4\"},\"5\":{\"pid\":\"4\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Cms\\/Type\\/add\",\"id\":\"5\"},\"6\":{\"pid\":\"4\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"Cms\\/Type\\/edit\",\"id\":\"6\"},\"7\":{\"pid\":\"4\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Cms\\/Type\\/setStatus\",\"id\":\"7\"},\"8\":{\"pid\":\"4\",\"title\":\"\\u5b57\\u6bb5\\u7ba1\\u7406\",\"icon\":\"fa fa-database\",\"url\":\"Cms\\/Attribute\\/index\",\"id\":\"8\"},\"9\":{\"pid\":\"8\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Cms\\/Attribute\\/add\",\"id\":\"9\"},\"10\":{\"pid\":\"8\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"Cms\\/Attribute\\/edit\",\"id\":\"10\"},\"11\":{\"pid\":\"8\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Cms\\/Attribute\\/setStatus\",\"id\":\"11\"},\"12\":{\"pid\":\"2\",\"title\":\"\\u680f\\u76ee\\u5206\\u7c7b\",\"icon\":\"fa fa-navicon\",\"url\":\"Cms\\/Category\\/index\",\"id\":\"12\"},\"13\":{\"pid\":\"12\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Cms\\/Category\\/add\",\"id\":\"13\"},\"14\":{\"pid\":\"12\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"Cms\\/Category\\/edit\",\"id\":\"14\"},\"15\":{\"pid\":\"12\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Cms\\/Category\\/setStatus\",\"id\":\"15\"},\"16\":{\"pid\":\"12\",\"title\":\"\\u6587\\u6863\\u7ba1\\u7406\",\"icon\":\"fa fa-edit\",\"url\":\"Cms\\/Index\\/index\",\"id\":\"16\"},\"17\":{\"pid\":\"16\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Cms\\/Index\\/add\",\"id\":\"17\"},\"18\":{\"pid\":\"16\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Cms\\/Index\\/edit\",\"id\":\"18\"},\"19\":{\"pid\":\"16\",\"title\":\"\\u65b0\\u589e\",\"url\":\"Cms\\/Index\\/setStatus\",\"id\":\"19\"},\"36\":{\"pid\":\"2\",\"title\":\"\\u56de\\u6536\\u7ad9\",\"icon\":\"fa fa-recycle\",\"url\":\"Cms\\/Index\\/recycle\",\"id\":\"36\"},\"37\":{\"pid\":\"36\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Cms\\/Notice\\/setStatus\",\"id\":\"37\"},\"38\":{\"pid\":\"2\",\"title\":\"\\u4e3e\\u62a5\\u5217\\u8868\",\"icon\":\"fa fa-info-circle\",\"url\":\"Cms\\/Report\\/index\",\"id\":\"38\"},\"39\":{\"pid\":\"38\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"Cms\\/Report\\/edit\",\"id\":\"39\"},\"40\":{\"pid\":\"38\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"Cms\\/Report\\/setStatus\",\"id\":\"40\"}}',0,1469086094,1470727850,0,0),(3,'User','用户','','fa fa-users','#F9B440','用户中心','红包竞猜系统','1.3.0','{\"title\":{\"center\":\"\\u4e2a\\u4eba\\u7ba1\\u7406\"},\"center\":[{\"title\":\"\\u4fee\\u6539\\u4fe1\\u606f\",\"icon\":\"fa fa-edit\",\"url\":\"User\\/Center\\/profile\",\"color\":\"#F68A3A\"},{\"title\":\"\\u6d88\\u606f\\u4e2d\\u5fc3\",\"icon\":\"fa fa-envelope-o\",\"url\":\"User\\/Message\\/index\",\"badge\":[\"User\\/Message\",\"newMessageCount\"],\"badge_class\":\"badge-danger\",\"color\":\"#80C243\"},{\"title\":\"\\u4fee\\u6539\\u5bc6\\u7801\",\"icon\":\"fa fa-lock\",\"url\":\"User\\/Center\\/password\",\"color\":\"#45BEC3\"}],\"main\":[{\"title\":\"\\u4e2a\\u4eba\\u4e2d\\u5fc3\",\"icon\":\"fa fa-tachometer\",\"url\":\"User\\/Center\\/index\"}]}','{\"status\":\"1\",\"reg_toggle\":\"1\",\"allow_reg_type\":[\"username\"],\"deny_username\":\"\",\"user_protocol\":\"\\u8bf7\\u5728\\u201c\\u540e\\u53f0\\u2014\\u2014\\u7528\\u6237\\u2014\\u2014\\u7528\\u6237\\u8bbe\\u7f6e\\u201d\\u4e2d\\u8bbe\\u7f6e\",\"behavior\":[\"User\"]}','{\"1\":{\"pid\":\"0\",\"title\":\"\\u7528\\u6237\",\"icon\":\"fa fa-user\",\"id\":\"1\"},\"2\":{\"pid\":\"1\",\"title\":\"\\u7528\\u6237\\u7ba1\\u7406\",\"icon\":\"fa fa-folder-open-o\",\"id\":\"2\"},\"3\":{\"pid\":\"2\",\"title\":\"\\u7528\\u6237\\u8bbe\\u7f6e\",\"icon\":\"fa fa-wrench\",\"url\":\"User\\/Index\\/module_config\",\"id\":\"3\"},\"4\":{\"pid\":\"2\",\"title\":\"\\u7528\\u6237\\u7edf\\u8ba1\",\"icon\":\"fa fa-area-chart\",\"url\":\"User\\/Index\\/index\",\"id\":\"4\"},\"25\":{\"pid\":\"2\",\"title\":\"\\u7528\\u6237\\u79ef\\u5206\",\"icon\":\"fa fa-area-chart\",\"url\":\"Admin\\/Score\\/index\",\"id\":\"25\"},\"5\":{\"pid\":\"2\",\"title\":\"\\u7528\\u6237\\u5217\\u8868\",\"icon\":\"fa fa-list\",\"url\":\"User\\/User\\/index\",\"id\":\"5\"},\"6\":{\"pid\":\"5\",\"title\":\"\\u65b0\\u589e\",\"url\":\"User\\/User\\/add\",\"id\":\"6\"},\"7\":{\"pid\":\"5\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"User\\/User\\/edit\",\"id\":\"7\"},\"8\":{\"pid\":\"5\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"User\\/User\\/setStatus\",\"id\":\"8\"},\"9\":{\"pid\":\"2\",\"title\":\"\\u7528\\u6237\\u7c7b\\u578b\",\"icon\":\"fa fa-user\",\"url\":\"User\\/Type\\/index\",\"id\":\"9\"},\"10\":{\"pid\":\"9\",\"title\":\"\\u65b0\\u589e\",\"url\":\"User\\/Type\\/add\",\"id\":\"10\"},\"11\":{\"pid\":\"9\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"User\\/Type\\/edit\",\"id\":\"11\"},\"12\":{\"pid\":\"9\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"User\\/Type\\/setStatus\",\"id\":\"12\"},\"13\":{\"pid\":\"9\",\"title\":\"\\u5b57\\u6bb5\\u7ba1\\u7406\",\"icon\":\"fa fa-users\",\"url\":\"User\\/Attribute\\/index\",\"id\":\"13\"},\"14\":{\"pid\":\"13\",\"title\":\"\\u65b0\\u589e\",\"url\":\"User\\/Attribute\\/add\",\"id\":\"14\"},\"15\":{\"pid\":\"13\",\"title\":\"\\u7f16\\u8f91\",\"url\":\"User\\/Attribute\\/edit\",\"id\":\"15\"},\"16\":{\"pid\":\"13\",\"title\":\"\\u8bbe\\u7f6e\\u72b6\\u6001\",\"url\":\"User\\/Attribute\\/setStatus\",\"id\":\"16\"},\"17\":{\"pid\":\"1\",\"title\":\"\\u5145\\u503c\\u7ba1\\u7406\",\"icon\":\"fa fa-folder-open-o\",\"id\":\"17\"},\"18\":{\"pid\":\"17\",\"title\":\"\\u5145\\u503c\\u5217\\u8868\",\"url\":\"Admin\\/Recharge\\/index\",\"id\":\"18\"},\"19\":{\"pid\":\"17\",\"title\":\"\\u5151\\u6362\\u5217\\u8868\",\"url\":\"Admin\\/Withdraw\\/index\",\"id\":\"19\"},\"20\":{\"pid\":\"17\",\"title\":\"\\u79ef\\u5206\\u8bb0\\u5f55\",\"url\":\"Admin\\/Account\\/index\",\"id\":\"20\"},\"21\":{\"pid\":\"1\",\"title\":\"\\u4ee3\\u7406\\u7ba1\\u7406\",\"icon\":\"fa fa-list\",\"url\":\"User\\/User\\/index\",\"id\":\"21\"},\"22\":{\"pid\":\"21\",\"title\":\"\\u9080\\u8bf7\\u63a8\\u5e7f\",\"icon\":\"fa fa-list\",\"url\":\"User\\/User\\/invitelist\",\"id\":\"22\"},\"23\":{\"pid\":\"17\",\"title\":\"\\u6295\\u6ce8\\u8bb0\\u5f55\",\"url\":\"Admin\\/Bet\\/index\",\"id\":\"23\"},\"24\":{\"pid\":\"17\",\"title\":\"\\u4e2d\\u5956\\u8bb0\\u5f55\",\"url\":\"Admin\\/Win\\/index\",\"id\":\"24\"}}',0,1469086098,1681192895,0,1);
/*!40000 ALTER TABLE `gg_admin_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_admin_nav`
--

DROP TABLE IF EXISTS `gg_admin_nav`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `group` varchar(11) NOT NULL DEFAULT '' COMMENT '分组',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `title` varchar(31) NOT NULL DEFAULT '' COMMENT '导航标题',
  `type` varchar(15) NOT NULL DEFAULT '' COMMENT '导航类型',
  `value` text COMMENT '导航值',
  `target` varchar(11) NOT NULL DEFAULT '' COMMENT '打开方式',
  `icon` varchar(32) NOT NULL DEFAULT '' COMMENT '图标',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='前台导航表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_nav`
--

LOCK TABLES `gg_admin_nav` WRITE;
/*!40000 ALTER TABLE `gg_admin_nav` DISABLE KEYS */;
INSERT INTO `gg_admin_nav` VALUES (1,'bottom',0,'关于','link','','','',1449742225,1449742255,0,1),(2,'bottom',1,'关于我们','link','http://www.goupu.org','','',1449742312,1449742312,0,1),(4,'bottom',1,'服务产品','link','http://www.goupu.org','','',1449742597,1449742651,0,1),(5,'bottom',1,'商务合作','link','http://www.goupu.org','','',1449742664,1449742664,0,1),(6,'bottom',1,'加入我们','link','http://www.goupu.org','','',1449742678,1449742697,0,1),(7,'bottom',0,'帮助','link','','','',1449742688,1449742688,0,1),(8,'bottom',7,'用户协议','link','http://www.goupu.org','','',1449742706,1449742706,0,1),(9,'bottom',7,'意见反馈','link','http://www.goupu.org','','',1449742716,1449742716,0,1),(10,'bottom',7,'常见问题','link','http://www.goupu.org','','',1449742728,1449742728,0,1),(11,'bottom',0,'联系方式','link','','','',1449742742,1449742742,0,1),(12,'bottom',11,'联系我们','link','http://www.goupu.org','','',1449742752,1449742752,0,1),(13,'bottom',11,'新浪微博','link','http://weibo.com/u/5667168319','','',1449742802,1449742802,0,1),(14,'main',0,'产品中心','page','','','',1457084559,1457084559,0,1),(15,'main',0,'客户服务','page','','','',1457084572,1457084572,0,1),(16,'main',0,'案例展示','page','','','',1457084583,1457084583,0,1),(17,'main',0,'新闻动态','page','','','',1457084714,1457084714,0,1),(18,'main',0,'联系我们','page','','','',1457084725,1457084725,0,1),(20,'top',0,'官网','link','http://www.goupu.org','_blank','',1457084925,1457084955,0,1),(21,'top',0,'开发手册','link','http://doc.corethink.cn','_blank','',1457084979,1457084979,0,1),(22,'top',0,'云商城','link','http://appstore.corethink.cn','_blank','',1457084997,1457085006,0,1),(23,'top',0,'论坛','link','http://bbscorethink.cn','_blank','',1457085052,1457085052,0,1),(24,'top',0,'CMS','module','Cms','','fa fa-newspaper-o',1469086094,1469086094,0,1),(25,'top',0,'用户','module','User','','fa fa-users',1469086098,1469086098,0,1);
/*!40000 ALTER TABLE `gg_admin_nav` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_admin_session`
--

DROP TABLE IF EXISTS `gg_admin_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_session` (
  `session_id` varchar(255) NOT NULL,
  `session_expire` int(11) NOT NULL,
  `session_data` blob,
  UNIQUE KEY `session_id` (`session_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='session存储表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_session`
--

LOCK TABLES `gg_admin_session` WRITE;
/*!40000 ALTER TABLE `gg_admin_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `gg_admin_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_admin_slider`
--

DROP TABLE IF EXISTS `gg_admin_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_slider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '幻灯ID',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
  `cover` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '封面ID',
  `award` decimal(4,2) NOT NULL COMMENT '中奖赔率',
  `hitnum` int(11) DEFAULT NULL COMMENT '中奖数字',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '点击链接',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='幻灯切换表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_slider`
--

LOCK TABLES `gg_admin_slider` WRITE;
/*!40000 ALTER TABLE `gg_admin_slider` DISABLE KEYS */;
INSERT INTO `gg_admin_slider` VALUES (1,'苹果-①',75,5.00,1,'',1469267535,1504835903,10,1),(2,'葡萄-②',76,5.00,2,'',1469267813,1504835923,9,1),(3,'菠萝-③',77,5.00,3,'',1469591928,1504835947,8,1),(4,'草莓-④',78,5.00,4,'',1469591962,1504835967,7,1),(5,'西瓜-⑤',79,5.00,5,'',1469591986,1504835986,6,1),(6,'香蕉-⑥',80,5.00,6,'',1469592010,1504836015,5,1),(7,'水果-大',81,2.00,7,'',1470275623,1504836086,0,1),(8,'水果-小',82,2.00,8,'',1470275649,1504836102,0,1),(9,'水果-单',83,2.00,9,'',1470275822,1504836118,0,1),(10,'水果-双',84,2.00,10,'',1470275850,1504836152,0,1);
/*!40000 ALTER TABLE `gg_admin_slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_admin_theme`
--

DROP TABLE IF EXISTS `gg_admin_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_theme` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '名称',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '标题',
  `description` varchar(127) NOT NULL DEFAULT '' COMMENT '描述',
  `developer` varchar(32) NOT NULL DEFAULT '' COMMENT '开发者',
  `version` varchar(8) NOT NULL DEFAULT '' COMMENT '版本',
  `config` text COMMENT '主题配置',
  `current` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否当前主题',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='前台主题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_theme`
--

LOCK TABLES `gg_admin_theme` WRITE;
/*!40000 ALTER TABLE `gg_admin_theme` DISABLE KEYS */;
/*!40000 ALTER TABLE `gg_admin_theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_admin_upload`
--

DROP TABLE IF EXISTS `gg_admin_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_upload` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'UID',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '文件链接',
  `ext` char(4) NOT NULL DEFAULT '' COMMENT '文件类型',
  `size` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件sha1编码',
  `location` varchar(15) NOT NULL DEFAULT '' COMMENT '文件存储位置',
  `download` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COMMENT='文件上传表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_upload`
--

LOCK TABLES `gg_admin_upload` WRITE;
/*!40000 ALTER TABLE `gg_admin_upload` DISABLE KEYS */;
INSERT INTO `gg_admin_upload` VALUES (62,1,'hd_logo.png','/Uploads/2017-02-08/589a19b344300.png','','png',92857,'e2f541e2f3c4818e140874dfef7fd2d0','57c7a51c0ee3e9a3c2aaab0c5191f9f66b5e0cf2','Local',0,1486494131,1486494131,0,1),(63,1,'红包副本.png','/Uploads/2017-02-08/589a2081b0ab0.png','','png',42750,'2c038d71f598d6ae5dd3f85e824abc94','ce69cf715940394811520edd5fe8020c6234fdbc','Local',0,1486495873,1486495873,0,1),(64,1,'红包副本.png','/Uploads/2017-02-08/589a20e85db2d.png','','png',42424,'e591efca47eb12c7149abb3a2fd628a4','55fea9d03347d928b0806cb2ec7ff13856116d83','Local',0,1486495976,1486495976,0,1),(65,1,'红包副本.png','/Uploads/2017-02-08/589a210259e24.png','','png',43710,'8bb8adc3d9b46710885ee9e29deda307','6876d8b8390468f21fecaada11bdce4dec56119a','Local',0,1486496002,1486496002,0,1),(66,1,'红包副本.png','/Uploads/2017-02-08/589a211ea0b1b.png','','png',43861,'50c715a2ab7c28d628a4b564e3a9e0c9','e2de544bebedfdec6027e581ab7f2435bc36c931','Local',0,1486496030,1486496030,0,1),(67,1,'红包副本.png','/Uploads/2017-02-08/589a216e52412.png','','png',44471,'275a9a86ae0e9773ae9f5aaa1d8946d7','faebe344177bcedc99caca4815d607b394ef1cf3','Local',0,1486496110,1486496110,0,1),(68,1,'红包副本.png','/Uploads/2017-02-08/589a221fad548.png','','png',41619,'b176c0195f1336155405e45f01b76977','946138d996593d10fb13a3b2f588d4ee0d9aaa60','Local',0,1486496287,1486496287,0,1),(69,1,'红包副本.png','/Uploads/2017-02-08/589a2237c11e7.png','','png',42195,'123b7fe283819b17aec8305e9d529445','e5ccb51fda82a48be93eee1bb40464be6f4ea277','Local',0,1486496311,1486496311,0,1),(70,1,'红包副本.png','/Uploads/2017-02-08/589a224f84cc9.png','','png',43088,'2d30ab587638af391eb76152c92b8485','6112413f918d83d6212a95c78ac5844b675b0280','Local',0,1486496335,1486496335,0,1),(71,1,'红包副本.png','/Uploads/2017-02-08/589a2263487ab.png','','png',43019,'e7d6f359501f9ac0edd748e5653634b1','e3b3bf593e4683be884c73b7e69d3fb3e97059fd','Local',0,1486496355,1486496355,0,1),(72,1,'红包副本.png','/Uploads/2017-02-08/589a227a1e477.png','','png',42821,'24e1ad0a8f7af66fec68885108ce8932','bff12b0ff024ca07b70ee6faff01be15f1b4ef5e','Local',0,1486496378,1486496378,0,1),(73,1,'未标题-2.jpg','/Uploads/2017-09-08/59b1f76b9408f.jpg','','jpg',180018,'66b391530a01b186ef372f8e753c5b32','c3b506706fb8f4969b3a379fc46bd53dab14be8d','Local',0,1504835435,1504835435,0,1),(74,1,'未标题-1.jpg','/Uploads/2017-09-08/59b1f77284c3e.jpg','','jpg',151899,'c80204713323dbc65ed3ba15262475d6','203d85657546c9456044ca324b940d8ff441ec0a','Local',0,1504835442,1504835442,0,1),(75,1,'57a540471c564.jpg','/Uploads/2017-09-08/59b1f93c803c2.jpg','','jpg',7505,'68c3e5334a193921114a89b03957d9e5','7d7d04787374553e8f7fbad34a17bbd3df931d50','Local',0,1504835900,1504835900,0,1),(76,1,'57a5403bbbc52.jpg','/Uploads/2017-09-08/59b1f950eed44.jpg','','jpg',7795,'3a6d4f7951a3be83ff0d0fd680d754fd','f3f60cc209aef1b03837c744260e85582c20b4a0','Local',0,1504835920,1504835920,0,1),(77,1,'57a54052781b6.jpg','/Uploads/2017-09-08/59b1f969a64fb.jpg','','jpg',9198,'295934df531f3b91c78eed4e94edde6e','270a34872bd50ab943ef215cd846c971f4e8c126','Local',0,1504835945,1504835945,0,1),(78,1,'57a5405da3053.jpg','/Uploads/2017-09-08/59b1f97a4abb9.jpg','','jpg',9344,'94c5c123f0bb92fe7c4d09fbf177bdc9','301aa12faeb074705c8de28bbc330510ff713c22','Local',0,1504835962,1504835962,0,1),(79,1,'57a540685f882.jpg','/Uploads/2017-09-08/59b1f98b023a3.jpg','','jpg',6785,'166f1e897c65dc344d34b1c197d15475','fc64f799bc79f29c257ffccf27283f0458784ff1','Local',0,1504835979,1504835979,0,1),(80,1,'57a54072b6d88.jpg','/Uploads/2017-09-08/59b1f9ad9ac2d.jpg','','jpg',7442,'aa6bd14cb40d9b53512442693838433f','74e2d95f1645212cf24535214aaf79d07c9b2e3c','Local',0,1504836013,1504836013,0,1),(81,1,'57a2a01bc0539.png','/Uploads/2017-09-08/59b1f9eeee951.png','','png',298,'eddcc770dc265b5f14cd030e55f91193','f4c357c98aa76852edbd73361ff3010967d45df5','Local',0,1504836078,1504836078,0,1),(82,1,'57a2a037a171e.png','/Uploads/2017-09-08/59b1fa046908d.png','','png',280,'d4904f8a3c76448a334af4b0bb2bb8b5','0f01151f2288723684ba3a8cda141bcd0b6c2784','Local',0,1504836100,1504836100,0,1),(83,1,'57a2a0e0d6037.png','/Uploads/2017-09-08/59b1fa1365324.png','','png',310,'fb1dc21977df6965151ac2d8a1838092','2ed67fc515d5f3fc8e5f1d7916c3836c5a1c4306','Local',0,1504836115,1504836115,0,1),(84,1,'57a2a0fe1a04a.png','/Uploads/2017-09-08/59b1fa3418d9f.png','','png',323,'ca996b7464b8e306471d9add1e3670d5','a84ebf7f1dce4cd1974e315be029a13fe0fca4a0','Local',0,1504836148,1504836148,0,1),(85,1,'logo.png','/Uploads/2017-09-08/59b1fa63bccf1.png','','png',67807,'0ab8e4f0f5416cfa21a10757c287649d','0cbe6ea2c75b0001f0271322e1603575714ffb8b','Local',0,1504836195,1504836195,0,1);
/*!40000 ALTER TABLE `gg_admin_upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_admin_user`
--

DROP TABLE IF EXISTS `gg_admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_admin_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'UID',
  `user_type` int(11) NOT NULL DEFAULT '1' COMMENT '用户类型',
  `nickname` varchar(63) NOT NULL DEFAULT '' COMMENT '昵称',
  `username` varchar(31) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(63) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(63) NOT NULL DEFAULT '' COMMENT '邮箱',
  `email_bind` tinyint(1) NOT NULL DEFAULT '0' COMMENT '邮箱验证',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `mobile_bind` tinyint(1) NOT NULL DEFAULT '0' COMMENT '邮箱验证',
  `avatar` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '头像',
  `score` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `money` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `reg_type` varchar(15) NOT NULL DEFAULT '' COMMENT '注册方式',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  `code` varchar(15) DEFAULT NULL COMMENT '推广码',
  `invite_id` int(11) DEFAULT NULL COMMENT '邀请人id',
  `invite_path` varchar(255) DEFAULT ',' COMMENT '推广记录路径方便查询',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COMMENT='用户账号表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_admin_user`
--

LOCK TABLES `gg_admin_user` WRITE;
/*!40000 ALTER TABLE `gg_admin_user` DISABLE KEYS */;
INSERT INTO `gg_admin_user` VALUES (1,1,'超级管理员','admin','f874073984e1bb39677d5323331b2c9e','10373458@qq.com',1,'18888888888',1,61,0,0.00,0,'',1438651748,1681195179,1,'1977',NULL,','),(66,1,'rtrwew','rtrwew','164c4b472c1690504d12c93d7f0fa49e','',0,'',0,0,0,0.00,2130706433,'username',1681192373,1681192373,1,'66738',NULL,','),(67,1,'test2','test2','164c4b472c1690504d12c93d7f0fa49e','',0,'',0,0,0,0.00,3232239202,'username',1681192782,1681192782,1,'67698',NULL,',');
/*!40000 ALTER TABLE `gg_admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_cms_article`
--

DROP TABLE IF EXISTS `gg_cms_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_cms_article` (
  `id` int(11) unsigned NOT NULL COMMENT '文档ID',
  `title` varchar(127) NOT NULL DEFAULT '' COMMENT '标题',
  `abstract` varchar(255) NOT NULL DEFAULT '' COMMENT '简介',
  `content` text NOT NULL COMMENT '正文内容',
  `tags` varchar(127) NOT NULL COMMENT '标签',
  `cover` int(11) NOT NULL DEFAULT '0' COMMENT '封面图片ID',
  `file` int(11) NOT NULL DEFAULT '0' COMMENT '附件ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章类型扩展表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_cms_article`
--

LOCK TABLES `gg_cms_article` WRITE;
/*!40000 ALTER TABLE `gg_cms_article` DISABLE KEYS */;
INSERT INTO `gg_cms_article` VALUES (1,'OpenCMF v1.1.0正式版发布！','OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。','                <span style=\"color:#777777;\">OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。</span>            ','',1,0),(2,'OpenCMF v1.1.0正式版发布！','OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。','                <span style=\"color:#777777;\">OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。</span>            ','',1,0),(3,'OpenCMF v1.1.0正式版发布！','OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。','                <span style=\"color:#777777;\">OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。</span>            ','',1,0),(4,'OpenCMF v1.1.0正式版发布！','OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。','                <span style=\"color:#777777;\">OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。</span>            ','',1,0),(5,'OpenCMF v1.1.0正式版发布！','OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。','                <span style=\"color:#777777;\">OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。</span>            ','',1,0),(6,'OpenCMF v1.1.0正式版发布！','OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。','                <span style=\"color:#777777;\">OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。</span>            ','',1,0),(7,'OpenCMF v1.1.0正式版发布！','OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。','                <span style=\"color:#777777;\">OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。</span>            ','',1,0),(8,'OpenCMF v1.1.0正式版发布！','OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。','                <span style=\"color:#777777;\">OpenCMF是一套基于统一核心的通用互联网+信息化服务解决方案，追求简单、高效、卓越。可轻松实现支持多终端的WEB产品快速搭建、部署、上线。系统功能采用模块化、组件化、插件化等低耦合设计，应用商城拥有丰富的功能模块、插件、主题，便于用户灵活扩展和二次开发。</span>            ','',1,0);
/*!40000 ALTER TABLE `gg_cms_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_cms_attribute`
--

DROP TABLE IF EXISTS `gg_cms_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_cms_attribute` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '字段标题',
  `field` varchar(100) NOT NULL DEFAULT '' COMMENT '字段定义',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '数据类型',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字段默认值',
  `tip` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `options` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `doc_type` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '文档模型',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='文档属性字段表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_cms_attribute`
--

LOCK TABLES `gg_cms_attribute` WRITE;
/*!40000 ALTER TABLE `gg_cms_attribute` DISABLE KEYS */;
INSERT INTO `gg_cms_attribute` VALUES (1,'cid','分类','int(11) unsigned NOT NULL ','select','0','所属分类',1,'',0,1383891233,1384508336,0,1),(2,'uid','用户ID','int(11) unsigned NOT NULL ','num','0','用户ID',0,'',0,1383891233,1384508336,0,1),(3,'view','阅读量','varchar(255) NOT NULL','num','0','标签',0,'',0,1413303715,1413303715,0,1),(4,'comment','评论数','int(11) unsigned NOT NULL ','num','0','评论数',0,'',0,1383891233,1383894927,0,1),(5,'good','赞数','int(11) unsigned NOT NULL ','num','0','赞数',0,'',0,1383891233,1384147827,0,1),(6,'bad','踩数','int(11) unsigned NOT NULL ','num','0','踩数',0,'',0,1407646362,1407646362,0,1),(7,'create_time','创建时间','int(11) unsigned NOT NULL ','datetime','0','创建时间',1,'',0,1383891233,1383895903,0,1),(8,'update_time','更新时间','int(11) unsigned NOT NULL ','datetime','0','更新时间',0,'',0,1383891233,1384508277,0,1),(9,'sort','排序','int(11) unsigned NOT NULL ','num','0','用于显示的顺序',1,'',0,1383891233,1383895757,0,1),(10,'status','数据状态','tinyint(4) NOT NULL ','radio','1','数据状态',0,'-1:删除\r\n0:禁用\r\n1:正常',0,1383891233,1384508496,0,1),(11,'title','标题','char(127) NOT NULL ','text','','文档标题',1,'',3,1383891233,1383894778,0,1),(12,'abstract','简介','varchar(255) NOT NULL','textarea','','文档简介',1,'',3,1383891233,1384508496,0,1),(13,'content','正文内容','text','kindeditor','','文章正文内容',1,'',3,1383891233,1384508496,0,1),(14,'tags','文章标签','varchar(127) NOT NULL','tags','','标签',1,'',3,1383891233,1384508496,0,1),(15,'cover','封面','int(11) unsigned NOT NULL ','picture','0','文档封面',1,'',3,1383891233,1384508496,0,1),(16,'file','附件','int(11) unsigned NOT NULL ','file','0','附件',1,'',3,1439454552,1439454552,0,1);
/*!40000 ALTER TABLE `gg_cms_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_cms_category`
--

DROP TABLE IF EXISTS `gg_cms_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_cms_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父分类ID',
  `group` tinyint(4) NOT NULL DEFAULT '0' COMMENT '分组',
  `doc_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '分类模型',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '分类名称',
  `url` varchar(127) NOT NULL COMMENT '链接地址',
  `content` text NOT NULL COMMENT '内容',
  `index_template` varchar(32) NOT NULL DEFAULT '' COMMENT '列表封面模版',
  `detail_template` varchar(32) NOT NULL DEFAULT '' COMMENT '详情页模版',
  `post_auth` tinyint(4) NOT NULL DEFAULT '0' COMMENT '投稿权限',
  `icon` varchar(32) NOT NULL DEFAULT '' COMMENT '缩略图',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='栏目分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_cms_category`
--

LOCK TABLES `gg_cms_category` WRITE;
/*!40000 ALTER TABLE `gg_cms_category` DISABLE KEYS */;
INSERT INTO `gg_cms_category` VALUES (1,0,1,3,'产品中心','','','','',1,'fa fa-send-o',1431926468,1446449005,0,1),(2,0,1,3,'新闻动态','','','','',1,'fa-search',1446449071,1446449394,0,1),(3,0,1,3,'客户服务','','','','',1,'fa-heart',1446449078,1446449400,0,1),(4,0,1,3,'案例展示','','','','',1,'fa-th',1446449673,1446449673,0,1),(5,0,1,3,'品牌专区','','','','',1,'fa-arrows',1446449686,1446449686,0,1),(6,0,1,3,'联系我们','','','','',1,'fa-envelope-o',1446449697,1446449697,0,1);
/*!40000 ALTER TABLE `gg_cms_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_cms_comment`
--

DROP TABLE IF EXISTS `gg_cms_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_cms_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '评论父ID',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `nickname` varchar(63) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `data_id` int(11) unsigned NOT NULL COMMENT '数据ID',
  `content` text NOT NULL COMMENT '评论内容',
  `good` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '赞数',
  `bad` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '踩数',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `ip` varchar(15) NOT NULL COMMENT '来源IP',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档评论表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_cms_comment`
--

LOCK TABLES `gg_cms_comment` WRITE;
/*!40000 ALTER TABLE `gg_cms_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `gg_cms_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_cms_index`
--

DROP TABLE IF EXISTS `gg_cms_index`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_cms_index` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `cid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `doc_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文档类型ID',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发布者ID',
  `view` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '阅读量',
  `comment` int(11) NOT NULL DEFAULT '0' COMMENT '评论数',
  `good` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '赞数',
  `bad` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '踩数',
  `mark` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '收藏',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='文档类型基础表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_cms_index`
--

LOCK TABLES `gg_cms_index` WRITE;
/*!40000 ALTER TABLE `gg_cms_index` DISABLE KEYS */;
INSERT INTO `gg_cms_index` VALUES (1,2,3,1,0,0,0,0,0,1449839213,1449839263,0,-1),(2,2,3,1,0,0,0,0,0,1449839213,1449839263,0,-1),(3,2,3,1,0,0,0,0,0,1449839213,1449839263,0,-1),(4,2,3,1,0,0,0,0,0,1449839213,1449839263,0,-1),(5,2,3,1,0,0,0,0,0,1449839213,1449839263,0,-1),(6,2,3,1,0,0,0,0,0,1449839213,1449839263,0,-1),(7,2,3,1,0,0,0,0,0,1449839213,1449839263,0,-1),(8,2,3,1,0,0,0,0,0,1449839213,1449839263,0,-1);
/*!40000 ALTER TABLE `gg_cms_index` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_cms_mark`
--

DROP TABLE IF EXISTS `gg_cms_mark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_cms_mark` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `data_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '数据ID',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '关注时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收藏表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_cms_mark`
--

LOCK TABLES `gg_cms_mark` WRITE;
/*!40000 ALTER TABLE `gg_cms_mark` DISABLE KEYS */;
/*!40000 ALTER TABLE `gg_cms_mark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_cms_report`
--

DROP TABLE IF EXISTS `gg_cms_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_cms_report` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'UID',
  `data_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '举报项ID',
  `reason` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '举报理由',
  `abstract` text NOT NULL COMMENT '详情',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='举报信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_cms_report`
--

LOCK TABLES `gg_cms_report` WRITE;
/*!40000 ALTER TABLE `gg_cms_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `gg_cms_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_cms_type`
--

DROP TABLE IF EXISTS `gg_cms_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_cms_type` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型ID',
  `name` char(16) NOT NULL DEFAULT '' COMMENT '模型名称',
  `title` char(16) NOT NULL DEFAULT '' COMMENT '模型标题',
  `icon` varchar(32) NOT NULL DEFAULT '' COMMENT '缩略图',
  `main_field` int(11) NOT NULL DEFAULT '0' COMMENT '主要字段',
  `list_field` varchar(127) NOT NULL DEFAULT '' COMMENT '列表显示字段',
  `filter_field` varchar(127) NOT NULL DEFAULT '' COMMENT '前台筛选字段',
  `field_sort` varchar(255) NOT NULL COMMENT '表单字段排序',
  `field_group` varchar(255) NOT NULL DEFAULT '' COMMENT '表单字段分组',
  `system` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '系统类型',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='文档模型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_cms_type`
--

LOCK TABLES `gg_cms_type` WRITE;
/*!40000 ALTER TABLE `gg_cms_type` DISABLE KEYS */;
INSERT INTO `gg_cms_type` VALUES (1,'link','链接','fa fa-link',0,'','','','',1,1426580628,1426580628,0,1),(2,'page','单页','fa fa-file-text',0,'','','','',1,1426580628,1426580628,0,1),(3,'article','文章','fa fa-file-word-o',11,'11','','{\"1\":[\"1\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\"],\"2\":[\"9\",\"7\"]}','1:基础\n2:扩展',0,1426580628,1426580628,0,1);
/*!40000 ALTER TABLE `gg_cms_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_log_account`
--

DROP TABLE IF EXISTS `gg_log_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_log_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `remark` varchar(255) DEFAULT NULL COMMENT '资金操作说明',
  `money` decimal(11,2) DEFAULT NULL COMMENT '操作金额',
  `type` tinyint(2) DEFAULT NULL COMMENT '操作类型  1充值 2提现申请 3投注 4中奖 5后台调整 6提现驳回 7提现成功 8推广奖励',
  `account_old` decimal(11,2) DEFAULT NULL COMMENT '操作前金额',
  `account_new` decimal(11,2) DEFAULT NULL COMMENT '操作后金额',
  `total_recharge_old` decimal(11,2) DEFAULT NULL COMMENT '操作前总的充值金额',
  `total_recharge_new` decimal(11,2) DEFAULT NULL COMMENT '操作后总的充值金额',
  `total_withdraw_old` decimal(11,2) DEFAULT NULL COMMENT '操作前总的提现金额',
  `total_withdraw_new` decimal(11,2) DEFAULT NULL COMMENT '操作后总的提现金额',
  `total_award_old` decimal(11,2) DEFAULT NULL COMMENT '总的推广奖励金额',
  `total_award_new` decimal(11,2) DEFAULT NULL COMMENT '操作后总的推广奖励金额',
  `total_win_old` decimal(11,2) DEFAULT NULL COMMENT '操作前总的中奖金额',
  `total_win_new` decimal(11,2) DEFAULT NULL COMMENT '操作后总的中奖金额',
  `frozen_account_old` decimal(11,2) DEFAULT NULL COMMENT '操作前冻结金额',
  `frozen_account_new` decimal(11,2) DEFAULT NULL COMMENT '操作后冻结金额',
  `total_betting_old` decimal(11,2) DEFAULT NULL COMMENT '操作前投资总金额',
  `total_betting_new` decimal(11,2) DEFAULT NULL COMMENT '操作后投资总金额',
  `addtime` int(11) DEFAULT NULL COMMENT '操作时间',
  `isplus` tinyint(2) DEFAULT NULL COMMENT '增加或者减少金额  1增加  2减少',
  `adminid` int(11) DEFAULT NULL COMMENT '后台操作人员ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_log_account`
--

LOCK TABLES `gg_log_account` WRITE;
/*!40000 ALTER TABLE `gg_log_account` DISABLE KEYS */;
INSERT INTO `gg_log_account` VALUES (1,66,'注册赠送积分',1000.00,9,0.00,1000.00,0.00,1000.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,1681192373,1,NULL),(2,66,'参与投注,竞猜期数3399',1000.00,3,1000.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,1000.00,1681192388,2,NULL),(3,67,'注册赠送积分',1000.00,9,0.00,1000.00,0.00,1000.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,1681192782,1,NULL),(4,67,'参与投注,竞猜期数3430',100.00,3,1000.00,900.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,100.00,1681193849,2,NULL),(5,67,'参与投注,竞猜期数3431',60.00,3,900.00,840.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,100.00,160.00,1681193894,2,NULL),(6,67,'第3431期开奖，中奖号码5',50.00,4,840.00,890.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,50.00,0.00,0.00,160.00,160.00,1681193903,1,NULL);
/*!40000 ALTER TABLE `gg_log_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_log_award`
--

DROP TABLE IF EXISTS `gg_log_award`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_log_award` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `recharge_id` int(11) DEFAULT NULL COMMENT '期数',
  `award_scale` decimal(11,2) DEFAULT NULL COMMENT '投注金额',
  `award_money` decimal(11,2) DEFAULT NULL COMMENT '中奖金额',
  `addtime` int(11) DEFAULT NULL COMMENT '中奖时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_log_award`
--

LOCK TABLES `gg_log_award` WRITE;
/*!40000 ALTER TABLE `gg_log_award` DISABLE KEYS */;
/*!40000 ALTER TABLE `gg_log_award` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_log_betting`
--

DROP TABLE IF EXISTS `gg_log_betting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_log_betting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `money` decimal(11,2) DEFAULT NULL COMMENT '投注金额',
  `addtime` int(11) DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL COMMENT '投注期数',
  `bet_num` tinyint(2) DEFAULT NULL COMMENT '投注号码',
  `ip` varchar(50) DEFAULT NULL COMMENT '投注者IP',
  `award_scale` tinyint(2) DEFAULT NULL COMMENT '获奖赔率',
  `can_award_money` decimal(11,2) DEFAULT NULL COMMENT '可以获得奖励',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_log_betting`
--

LOCK TABLES `gg_log_betting` WRITE;
/*!40000 ALTER TABLE `gg_log_betting` DISABLE KEYS */;
INSERT INTO `gg_log_betting` VALUES (1,66,1000.00,1681192388,3399,1,'127.0.0.1',5,5000.00),(2,67,100.00,1681193849,3430,3,'192.168.14.98',5,500.00),(3,67,10.00,1681193894,3431,1,'192.168.14.98',5,50.00),(4,67,10.00,1681193894,3431,2,'192.168.14.98',5,50.00),(5,67,10.00,1681193894,3431,3,'192.168.14.98',5,50.00),(6,67,10.00,1681193894,3431,4,'192.168.14.98',5,50.00),(7,67,10.00,1681193894,3431,5,'192.168.14.98',5,50.00),(8,67,10.00,1681193894,3431,6,'192.168.14.98',5,50.00);
/*!40000 ALTER TABLE `gg_log_betting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_log_recharge`
--

DROP TABLE IF EXISTS `gg_log_recharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_log_recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `money` decimal(11,2) DEFAULT NULL COMMENT '提现金额',
  `type` tinyint(2) DEFAULT NULL COMMENT '充值方式 1支付宝 2微信',
  `addtime` int(11) DEFAULT NULL COMMENT '提交时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '审核时间',
  `op_remark` varchar(255) DEFAULT NULL COMMENT '处理备注',
  `user_remark` varchar(255) DEFAULT NULL COMMENT '用户提现备注',
  `status` tinyint(2) DEFAULT NULL COMMENT '状态  1申请中  2 驳回申请  3充值成功',
  `apply_ip` varchar(50) DEFAULT NULL COMMENT '申请人IP',
  `admin_id` int(11) DEFAULT NULL COMMENT '后台处理人ID',
  `op_ip` varchar(50) DEFAULT NULL COMMENT '处理人IP',
  `water_number` varchar(100) DEFAULT NULL COMMENT '交易流水号',
  `is_award` tinyint(2) DEFAULT '2' COMMENT '是否已经发送充值奖励  1已经发送 2尚未发送',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_log_recharge`
--

LOCK TABLES `gg_log_recharge` WRITE;
/*!40000 ALTER TABLE `gg_log_recharge` DISABLE KEYS */;
/*!40000 ALTER TABLE `gg_log_recharge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_log_win`
--

DROP TABLE IF EXISTS `gg_log_win`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_log_win` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `term_id` int(11) DEFAULT NULL COMMENT '期数ID',
  `hit_num` tinyint(4) DEFAULT NULL COMMENT '中间号码',
  `award_scale` tinyint(4) DEFAULT NULL COMMENT '中奖赔率',
  `win_money` int(11) DEFAULT NULL COMMENT '赢取金额',
  `addtime` int(11) DEFAULT NULL COMMENT '开奖时间',
  `bet_money` decimal(11,2) DEFAULT NULL COMMENT '投注金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_log_win`
--

LOCK TABLES `gg_log_win` WRITE;
/*!40000 ALTER TABLE `gg_log_win` DISABLE KEYS */;
INSERT INTO `gg_log_win` VALUES (1,67,3431,5,5,50,1681193903,10.00);
/*!40000 ALTER TABLE `gg_log_win` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_log_withdraw`
--

DROP TABLE IF EXISTS `gg_log_withdraw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_log_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `money` decimal(11,2) DEFAULT NULL COMMENT '提现金额',
  `addtime` int(11) DEFAULT NULL COMMENT '提交时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '审核时间',
  `op_remark` varchar(255) DEFAULT NULL COMMENT '处理备注',
  `user_remark` varchar(255) DEFAULT NULL COMMENT '用户提现备注',
  `status` tinyint(2) DEFAULT NULL COMMENT '状态  1申请中  2 驳回申请  3提现成功',
  `apply_ip` varchar(50) DEFAULT NULL COMMENT '申请人IP',
  `account_number` varchar(50) DEFAULT NULL COMMENT '收款帐号',
  `admin_id` int(11) DEFAULT NULL COMMENT '后台处理人ID',
  `op_ip` varchar(50) DEFAULT NULL COMMENT '处理人IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_log_withdraw`
--

LOCK TABLES `gg_log_withdraw` WRITE;
/*!40000 ALTER TABLE `gg_log_withdraw` DISABLE KEYS */;
/*!40000 ALTER TABLE `gg_log_withdraw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_term`
--

DROP TABLE IF EXISTS `gg_term`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hit_num` tinyint(2) DEFAULT NULL COMMENT '中奖号码',
  `start_time` int(11) DEFAULT NULL COMMENT '开始时间',
  `end_time` int(11) DEFAULT NULL COMMENT '结束时间',
  `all_award` decimal(11,2) DEFAULT '0.00' COMMENT '总的中奖金额',
  `all_bet` decimal(11,2) DEFAULT '0.00' COMMENT '总的投注个数',
  `all_bet_money` decimal(11,2) DEFAULT '0.00' COMMENT '总的投注金额',
  `set_hit_num` tinyint(2) DEFAULT NULL COMMENT '设定开奖号码',
  `term_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3471 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_term`
--

LOCK TABLES `gg_term` WRITE;
/*!40000 ALTER TABLE `gg_term` DISABLE KEYS */;
INSERT INTO `gg_term` VALUES (3345,5,1486490691,1486490991,0.00,0.00,0.00,NULL,NULL),(3346,2,1486490995,1486491295,0.00,0.00,0.00,NULL,NULL),(3347,6,1486491299,1486491599,0.00,0.00,0.00,NULL,NULL),(3348,2,1486491603,1486491903,0.00,0.00,0.00,NULL,NULL),(3349,1,1486491906,1486492206,0.00,0.00,0.00,NULL,NULL),(3350,1,1486492209,1486492509,0.00,0.00,0.00,NULL,NULL),(3351,5,1486492513,1486492813,0.00,0.00,0.00,NULL,NULL),(3352,6,1486492817,1486493117,0.00,0.00,0.00,NULL,NULL),(3353,1,1486493121,1486493421,0.00,0.00,0.00,NULL,NULL),(3354,1,1486493424,1486493724,0.00,0.00,0.00,NULL,NULL),(3355,4,1486493727,1486494027,0.00,0.00,0.00,NULL,NULL),(3356,3,1486494031,1486494331,0.00,0.00,0.00,NULL,NULL),(3357,2,1486494335,1486494635,0.00,0.00,0.00,NULL,NULL),(3358,5,1486494638,1486494938,0.00,0.00,0.00,NULL,NULL),(3359,2,1486494941,1486495241,0.00,0.00,0.00,NULL,NULL),(3360,6,1486495245,1486495545,0.00,0.00,0.00,NULL,NULL),(3361,1,1486495549,1486495849,0.00,0.00,0.00,NULL,NULL),(3362,4,1486495853,1486496153,0.00,0.00,0.00,NULL,NULL),(3363,2,1486496156,1486496456,0.00,0.00,0.00,NULL,NULL),(3364,5,1486496459,1486496759,0.00,0.00,0.00,NULL,NULL),(3365,6,1486496763,1486497063,0.00,0.00,0.00,NULL,NULL),(3366,5,1486497067,1486497367,0.00,0.00,0.00,NULL,NULL),(3367,1,1486497370,1486497670,0.00,0.00,0.00,NULL,NULL),(3368,1,1486497673,1486497973,0.00,0.00,0.00,NULL,NULL),(3369,6,1486497977,1486498277,0.00,0.00,0.00,NULL,NULL),(3370,1,1486498281,1486498581,0.00,0.00,0.00,NULL,NULL),(3371,4,1486498584,1486498884,0.00,0.00,0.00,NULL,NULL),(3372,5,1486498887,1486499187,0.00,0.00,0.00,NULL,NULL),(3373,3,1486499191,1486499491,0.00,0.00,0.00,NULL,NULL),(3374,5,1486499495,1486499795,0.00,0.00,0.00,NULL,NULL),(3375,1,1486499799,1486500099,0.00,0.00,0.00,NULL,NULL),(3376,6,1486500103,1486500403,0.00,0.00,0.00,NULL,NULL),(3377,1,1486500407,1486500707,0.00,0.00,0.00,NULL,NULL),(3378,6,1486500711,1486501011,0.00,0.00,0.00,NULL,NULL),(3379,5,1486501015,1486501315,0.00,0.00,0.00,NULL,NULL),(3380,5,1486501319,1486501619,0.00,0.00,0.00,NULL,NULL),(3381,2,1486501623,1486501923,0.00,0.00,0.00,NULL,NULL),(3382,5,1486501928,1486502228,0.00,0.00,0.00,NULL,NULL),(3383,2,1486502231,1486502531,0.00,0.00,0.00,NULL,NULL),(3384,3,1486502534,1486502834,0.00,0.00,0.00,NULL,NULL),(3385,3,1486502838,1486503138,0.00,0.00,0.00,NULL,NULL),(3386,1,1486503141,1486503441,0.00,0.00,0.00,NULL,NULL),(3387,3,1486503444,1486503744,0.00,0.00,0.00,NULL,NULL),(3388,2,1486503747,1486504047,0.00,0.00,0.00,NULL,NULL),(3389,1,1486504052,1486504352,0.00,1.00,5.00,NULL,NULL),(3390,4,1486504356,1486504656,0.00,0.00,0.00,NULL,NULL),(3391,1,1486504660,1486504960,0.00,0.00,0.00,NULL,NULL),(3392,5,1486505986,1486506286,0.00,0.00,0.00,NULL,NULL),(3393,3,1486506290,1486506590,0.00,0.00,0.00,NULL,NULL),(3394,2,1504835257,1504835557,0.00,0.00,0.00,NULL,NULL),(3395,4,1504835561,1504835861,0.00,0.00,0.00,NULL,NULL),(3396,1,1504835864,1504836164,0.00,0.00,0.00,NULL,NULL),(3397,6,1504836168,1504836468,0.00,0.00,0.00,NULL,NULL),(3398,4,1512521126,1512521426,0.00,0.00,0.00,NULL,NULL),(3399,2,1681192187,1681192487,0.00,1.00,1000.00,NULL,NULL),(3400,6,1681192488,1681192788,0.00,0.00,0.00,NULL,NULL),(3401,5,1681192789,1681192849,0.00,0.00,0.00,NULL,NULL),(3402,5,1681192850,1681192910,0.00,0.00,0.00,NULL,NULL),(3403,5,1681192911,1681192971,0.00,0.00,0.00,NULL,NULL),(3404,1,1681192972,1681193032,0.00,0.00,0.00,NULL,NULL),(3405,2,1681193033,1681193093,0.00,0.00,0.00,NULL,NULL),(3406,4,1681193094,1681193124,0.00,0.00,0.00,NULL,NULL),(3407,1,1681193125,1681193155,0.00,0.00,0.00,NULL,NULL),(3408,5,1681193157,1681193187,0.00,0.00,0.00,NULL,NULL),(3409,3,1681193188,1681193218,0.00,0.00,0.00,NULL,NULL),(3410,3,1681193219,1681193249,0.00,0.00,0.00,NULL,NULL),(3411,6,1681193250,1681193280,0.00,0.00,0.00,NULL,NULL),(3412,3,1681193281,1681193311,0.00,0.00,0.00,NULL,NULL),(3413,4,1681193312,1681193342,0.00,0.00,0.00,NULL,NULL),(3414,5,1681193343,1681193373,0.00,0.00,0.00,NULL,NULL),(3415,3,1681193374,1681193404,0.00,0.00,0.00,NULL,NULL),(3416,5,1681193405,1681193435,0.00,0.00,0.00,NULL,NULL),(3417,3,1681193436,1681193466,0.00,0.00,0.00,NULL,NULL),(3418,6,1681193467,1681193497,0.00,0.00,0.00,NULL,NULL),(3419,3,1681193498,1681193528,0.00,0.00,0.00,NULL,NULL),(3420,6,1681193529,1681193559,0.00,0.00,0.00,NULL,NULL),(3421,5,1681193560,1681193590,0.00,0.00,0.00,NULL,NULL),(3422,6,1681193591,1681193621,0.00,0.00,0.00,NULL,NULL),(3423,1,1681193622,1681193652,0.00,0.00,0.00,NULL,NULL),(3424,5,1681193653,1681193683,0.00,0.00,0.00,NULL,NULL),(3425,1,1681193684,1681193714,0.00,0.00,0.00,NULL,NULL),(3426,1,1681193715,1681193745,0.00,0.00,0.00,NULL,NULL),(3427,5,1681193747,1681193777,0.00,0.00,0.00,NULL,NULL),(3428,5,1681193779,1681193809,0.00,0.00,0.00,NULL,NULL),(3429,5,1681193811,1681193841,0.00,0.00,0.00,NULL,NULL),(3430,1,1681193842,1681193872,0.00,1.00,100.00,NULL,NULL),(3431,5,1681193872,1681193902,50.00,1.00,60.00,NULL,NULL),(3432,2,1681193903,1681193933,0.00,0.00,0.00,NULL,NULL),(3433,5,1681193934,1681193964,0.00,0.00,0.00,NULL,NULL),(3434,3,1681193965,1681193995,0.00,0.00,0.00,NULL,NULL),(3435,3,1681193996,1681194026,0.00,0.00,0.00,NULL,NULL),(3436,3,1681194029,1681194059,0.00,0.00,0.00,NULL,NULL),(3437,2,1681194062,1681194092,0.00,0.00,0.00,NULL,NULL),(3438,2,1681194095,1681194125,0.00,0.00,0.00,NULL,NULL),(3439,3,1681194127,1681194157,0.00,0.00,0.00,NULL,NULL),(3440,6,1681194158,1681194188,0.00,0.00,0.00,NULL,NULL),(3441,3,1681194190,1681194220,0.00,0.00,0.00,NULL,NULL),(3442,2,1681194222,1681194252,0.00,0.00,0.00,NULL,NULL),(3443,2,1681194254,1681194284,0.00,0.00,0.00,NULL,NULL),(3444,2,1681194299,1681194329,0.00,0.00,0.00,NULL,NULL),(3445,3,1681194330,1681194360,0.00,0.00,0.00,NULL,NULL),(3446,3,1681194361,1681194391,0.00,0.00,0.00,NULL,NULL),(3447,5,1681194392,1681194422,0.00,0.00,0.00,NULL,NULL),(3448,2,1681194423,1681194453,0.00,0.00,0.00,NULL,NULL),(3449,2,1681194454,1681194484,0.00,0.00,0.00,NULL,NULL),(3450,5,1681194485,1681194515,0.00,0.00,0.00,NULL,NULL),(3451,1,1681194516,1681194546,0.00,0.00,0.00,NULL,NULL),(3452,3,1681194547,1681194577,0.00,0.00,0.00,NULL,NULL),(3453,1,1681194578,1681194608,0.00,0.00,0.00,NULL,NULL),(3454,6,1681194609,1681194639,0.00,0.00,0.00,NULL,NULL),(3455,4,1681194640,1681194670,0.00,0.00,0.00,NULL,NULL),(3456,4,1681194671,1681194701,0.00,0.00,0.00,NULL,NULL),(3457,6,1681194702,1681194732,0.00,0.00,0.00,NULL,NULL),(3458,6,1681194733,1681194763,0.00,0.00,0.00,NULL,NULL),(3459,4,1681194764,1681194794,0.00,0.00,0.00,NULL,NULL),(3460,5,1681194795,1681194825,0.00,0.00,0.00,NULL,NULL),(3461,5,1681194826,1681194856,0.00,0.00,0.00,NULL,NULL),(3462,5,1681194857,1681194887,0.00,0.00,0.00,NULL,NULL),(3463,1,1681194888,1681194918,0.00,0.00,0.00,NULL,NULL),(3464,1,1681194920,1681194950,0.00,0.00,0.00,NULL,NULL),(3465,1,1681194953,1681194983,0.00,0.00,0.00,NULL,NULL),(3466,4,1681194985,1681195015,0.00,0.00,0.00,NULL,NULL),(3467,2,1681195017,1681195047,0.00,0.00,0.00,NULL,NULL),(3468,5,1681195048,1681195078,0.00,0.00,0.00,NULL,NULL),(3469,2,1681195081,1681195111,0.00,0.00,0.00,NULL,NULL),(3470,NULL,1681195114,1681195144,0.00,0.00,0.00,NULL,NULL);
/*!40000 ALTER TABLE `gg_term` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_user_account`
--

DROP TABLE IF EXISTS `gg_user_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_user_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `account` decimal(11,2) DEFAULT '0.00' COMMENT '账户余额',
  `frozen_account` decimal(11,2) DEFAULT '0.00' COMMENT '冻结金额',
  `total_recharge` decimal(11,2) DEFAULT '0.00' COMMENT '总的提现金额',
  `total_withdraw` decimal(11,2) DEFAULT '0.00' COMMENT '总额提现金额',
  `total_award` decimal(11,2) DEFAULT '0.00' COMMENT '总的推广奖励金额+',
  `total_win` decimal(11,2) DEFAULT '0.00' COMMENT '总的中奖金额',
  `total_betting` decimal(11,2) DEFAULT '0.00' COMMENT '总的投注金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_user_account`
--

LOCK TABLES `gg_user_account` WRITE;
/*!40000 ALTER TABLE `gg_user_account` DISABLE KEYS */;
INSERT INTO `gg_user_account` VALUES (1,66,0.00,0.00,0.00,0.00,0.00,0.00,1000.00),(2,67,890.00,0.00,0.00,0.00,0.00,50.00,160.00);
/*!40000 ALTER TABLE `gg_user_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_user_attribute`
--

DROP TABLE IF EXISTS `gg_user_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_user_attribute` (
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户模块：用户属性字段表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_user_attribute`
--

LOCK TABLES `gg_user_attribute` WRITE;
/*!40000 ALTER TABLE `gg_user_attribute` DISABLE KEYS */;
INSERT INTO `gg_user_attribute` VALUES (1,'gender','性别','tinyint(3)  NOT NULL ','radio','0','性别',1,'1:男\n-1:女\r\n0:保密\r\n',1,1438651748,1438651748,1),(2,'city','所在城市','varchar(15) NOT NULL','text','','常住城市',1,'',1,1442026468,1442123810,1),(3,'summary','签名','varchar(127) NOT NULL','text','','签名',1,'',1,1438651748,1438651748,1);
/*!40000 ALTER TABLE `gg_user_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_user_message`
--

DROP TABLE IF EXISTS `gg_user_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_user_message` (
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
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='用户消息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_user_message`
--

LOCK TABLES `gg_user_message` WRITE;
/*!40000 ALTER TABLE `gg_user_message` DISABLE KEYS */;
INSERT INTO `gg_user_message` VALUES (53,0,'注册成功','少侠/女侠好：<br>恭喜您成功注册开心水果竞猜的帐号<br>您的帐号信息如下（请妥善保管）：<br>UID：66<br>昵称：rtrwew<br>用户名：rtrwew<br>密码：q12345678.<br><br>',0,66,0,0,1681192373,1681192373,0,1),(54,0,'注册成功','少侠/女侠好：<br>恭喜您成功注册开心水果竞猜的帐号<br>您的帐号信息如下（请妥善保管）：<br>UID：67<br>昵称：test2<br>用户名：test2<br>密码：q12345678.<br><br>',0,67,0,0,1681192782,1681192782,0,1);
/*!40000 ALTER TABLE `gg_user_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_user_person`
--

DROP TABLE IF EXISTS `gg_user_person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_user_person` (
  `uid` int(11) unsigned NOT NULL COMMENT '用户ID',
  `gender` tinyint(3) NOT NULL DEFAULT '0' COMMENT '性别',
  `summary` varchar(127) NOT NULL DEFAULT '' COMMENT '签名',
  `city` varchar(15) NOT NULL COMMENT '所在城市',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户模块：个人类型扩展信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_user_person`
--

LOCK TABLES `gg_user_person` WRITE;
/*!40000 ALTER TABLE `gg_user_person` DISABLE KEYS */;
INSERT INTO `gg_user_person` VALUES (2,0,'','');
/*!40000 ALTER TABLE `gg_user_person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gg_user_type`
--

DROP TABLE IF EXISTS `gg_user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gg_user_type` (
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户模块：用户类型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gg_user_type`
--

LOCK TABLES `gg_user_type` WRITE;
/*!40000 ALTER TABLE `gg_user_type` DISABLE KEYS */;
INSERT INTO `gg_user_type` VALUES (1,'person','个人','1','','',1438651748,1438651748,0,1);
/*!40000 ALTER TABLE `gg_user_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-11 14:43:52
