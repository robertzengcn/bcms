/*
Navicat MySQL Data Transfer

Source Server         : 本地_127.0.0.1
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : eqshow

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-08-22 14:21:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `showcate`
-- ----------------------------
DROP TABLE IF EXISTS `showcate`;
CREATE TABLE `showcate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL DEFAULT '',
  `value` varchar(20) DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '99',
  `rank` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of showcate
-- ----------------------------
INSERT INTO `showcate` VALUES ('1', '行业', '101', 'tpType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('2', '企业', '102', 'tpType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('3', '风格', '103', 'tpType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('4', '个人', '104', 'tpType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('5', '节日', '105', 'tpType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('6', '图标', '106', 'tpType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('7', '动画', '107', 'tpType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('8', '行业', '201', 'bgType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('9', '企业', '202', 'bgType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('10', '风格', '203', 'bgType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('11', '个人', '204', 'bgType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('12', '节日', '205', 'bgType', '0', '99', '0');
INSERT INTO `showcate` VALUES ('13', '行业', '101', 'scene_type', '0', '99', '0');
INSERT INTO `showcate` VALUES ('14', '企业', '103', 'scene_type', '0', '99', '0');
INSERT INTO `showcate` VALUES ('15', '风格', '105', 'scene_type', '0', '99', '0');
INSERT INTO `showcate` VALUES ('16', '个人', '102', 'scene_type', '0', '99', '0');
INSERT INTO `showcate` VALUES ('17', '节日', '104', 'scene_type', '0', '99', '0');
INSERT INTO `showcate` VALUES ('20', '经典', '20', 'musType', '0', '1', '0');
INSERT INTO `showcate` VALUES ('21', '流行', '21', 'musType', '0', '2', '0');

-- ----------------------------
-- Table structure for `showscene`
-- ----------------------------
DROP TABLE IF EXISTS `showscene`;
CREATE TABLE `showscene` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `scenecode_varchar` varchar(50) NOT NULL,
  `scenename_varchar` varchar(50) DEFAULT NULL,
  `scenetype_int` int(11) NOT NULL DEFAULT '0',
  `userid_int` int(50) NOT NULL,
  `hitcount_int` int(11) NOT NULL DEFAULT '0',
  `createtime_time` datetime DEFAULT NULL,
  `musicurl_varchar` varchar(500) DEFAULT NULL,
  `videocode_varchar` varchar(2000) DEFAULT NULL,
  `showstatus_int` int(11) NOT NULL DEFAULT '1' COMMENT '显示状态1显示,2关闭',
  `thumbnail_varchar` varchar(200) DEFAULT NULL COMMENT '缩略图',
  `movietype_int` int(11) DEFAULT '0' COMMENT '翻页方式',
  `desc_varchar` varchar(500) DEFAULT NULL COMMENT '场景描述',
  `ip_varchar` varchar(50) DEFAULT NULL,
  `delete_int` int(11) NOT NULL DEFAULT '0' COMMENT '0未删,1已经删除 ',
  `tagid_int` int(11) NOT NULL DEFAULT '0',
  `sourceId_int` int(11) NOT NULL DEFAULT '0',
  `biztype_int` int(11) NOT NULL DEFAULT '1',
  `eqid_int` int(11) DEFAULT NULL,
  `eqcode` varchar(50) DEFAULT NULL,
  `datacount_int` int(11) NOT NULL DEFAULT '0',
  `musictype_int` int(11) NOT NULL DEFAULT '3',
  `usecount_int` int(11) NOT NULL DEFAULT '0',
  `fromsceneid_bigint` bigint(20) NOT NULL DEFAULT '0',
  `publish_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `rank` bigint(20) unsigned DEFAULT '0',
  `shenhe` tinyint(1) unsigned DEFAULT '1',
  `isadvanceduser` tinyint(3) unsigned DEFAULT NULL,
  `hideeqad` int(8) unsigned DEFAULT '0',
  `lastpageid` bigint(20) unsigned DEFAULT NULL,
  `is_tpl` tinyint(3) unsigned DEFAULT NULL,
  `is_public` tinyint(1) unsigned DEFAULT '1',
  `source_id_int` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `scenecode` (`scenecode_varchar`),
  KEY `userid` (`userid_int`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=266911 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=3;

-- ----------------------------
-- Records of showscene
-- ----------------------------
INSERT INTO `showscene` VALUES ('266668', 'U808Y6W35U', '我的H5场景秀', '101', '1', '0', '2017-01-01 12:00:00', null, null, '1', 'show/default_thum.jpg', '0', '这是我制作的H5页面，快打开看看！', '127.0.0.1', '0', '0', '0', '1', null, null, '1', '3', '0', '0', '0', '0', '0', '1', '0', '0', null, '0', '1', '0');

-- ----------------------------
-- Table structure for `showscenedata`
-- ----------------------------
DROP TABLE IF EXISTS `showscenedata`;
CREATE TABLE `showscenedata` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sceneid_bigint` bigint(20) NOT NULL DEFAULT '0',
  `pageid_bigint` bigint(20) NOT NULL DEFAULT '0',
  `elementid_int` int(11) DEFAULT '0',
  `elementtitle_varchar` varchar(50) DEFAULT NULL,
  `elementtype_int` int(11) NOT NULL DEFAULT '5',
  `userid_int` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sceneid` (`sceneid_bigint`,`userid_int`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `showscenepage`
-- ----------------------------
DROP TABLE IF EXISTS `showscenepage`;
CREATE TABLE `showscenepage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sceneid_bigint` int(11) NOT NULL,
  `scenecode_varchar` varchar(50) NOT NULL,
  `pagecurrentnum_int` int(11) NOT NULL DEFAULT '1' COMMENT '当前页数',
  `createtime_time` datetime DEFAULT NULL,
  `content_text` longtext,
  `pagename_varchar` varchar(50) DEFAULT NULL,
  `userid_int` int(11) NOT NULL,
  `properties_text` text NOT NULL,
  `mytypl_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sceneid` (`scenecode_varchar`) USING BTREE,
  KEY `scenid` (`sceneid_bigint`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=266669 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of showscenepage
-- ----------------------------
INSERT INTO `showscenepage` VALUES ('2', '266668', 'U808Y6W35U', '1', '2017-08-22 14:11:07', '[]', null, '1', 'null', '0');

-- ----------------------------
-- Table structure for `showscenepagesys`
-- ----------------------------
DROP TABLE IF EXISTS `showscenepagesys`;
CREATE TABLE `showscenepagesys` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sceneid_bigint` bigint(20) NOT NULL,
  `scenecode_varchar` varchar(50) NOT NULL,
  `pagecurrentnum_int` int(11) NOT NULL DEFAULT '1' COMMENT '当前页数',
  `createtime_time` datetime DEFAULT NULL,
  `content_text` longtext,
  `pagename_varchar` varchar(50) DEFAULT NULL,
  `userid_int` int(11) NOT NULL,
  `biztype_int` int(11) DEFAULT NULL,
  `tagid_int` int(11) DEFAULT NULL,
  `thumbsrc_varchar` varchar(200) DEFAULT NULL,
  `eqsrc_varchar` varchar(200) DEFAULT NULL,
  `eqid_int` int(11) DEFAULT NULL,
  `usecount_int` int(11) NOT NULL DEFAULT '0',
  `tagids_int` varchar(50) DEFAULT '' COMMENT '标签ids',
  PRIMARY KEY (`id`),
  KEY `sceneid` (`scenecode_varchar`) USING BTREE,
  KEY `scenid` (`sceneid_bigint`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=439 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;



-- ----------------------------
-- Table structure for `showshare`
-- ----------------------------
DROP TABLE IF EXISTS `showshare`;
CREATE TABLE `showshare` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `scene_id` int(10) unsigned NOT NULL,
  `timeline` int(10) unsigned NOT NULL DEFAULT '0',
  `appmessage` int(10) unsigned NOT NULL DEFAULT '0',
  `qq` int(10) unsigned NOT NULL DEFAULT '0',
  `weibo` int(10) unsigned NOT NULL DEFAULT '0',
  `qzone` int(10) unsigned NOT NULL DEFAULT '0',
  `other` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of showshare
-- ----------------------------

-- ----------------------------
-- Table structure for `showsys`
-- ----------------------------
DROP TABLE IF EXISTS `showsys`;
CREATE TABLE `showsys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `web_title` varchar(100) NOT NULL DEFAULT '',
  `web_description` varchar(255) NOT NULL DEFAULT '',
  `web_keywords` varchar(100) NOT NULL DEFAULT '',
  `is_open_reg` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `qi_ad_xds` int(5) unsigned NOT NULL DEFAULT '90',
  `is_user_anli_shenghe` tinyint(1) unsigned DEFAULT '0',
  `web_logo` varchar(255) NOT NULL,
  `web_site` varchar(100) NOT NULL,
  `web_copyright` varchar(20) NOT NULL,
  `web_qq` varchar(20) NOT NULL,
  `web_mail` varchar(20) NOT NULL,
  `web_phone` varchar(20) NOT NULL,
  `web_address` varchar(50) NOT NULL,
  `web_appid` varchar(100) NOT NULL,
  `web_appsecret` varchar(100) NOT NULL,
  `web_ipc` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of showsys
-- ----------------------------
INSERT INTO `showsys` VALUES ('1', '一站式微信营销平台', '微场景和h5页面的制作平台，无需编程便可在线创建H5页面、微信场景应用、微杂志制作、微信海报、微信邀请函制作、微信场景制作、微场景定制、企业微场景、轻应用、场景应用、微信场景应用等交互内容，并可通过Web将创作作品上传到各大社交平台，比如微博，微信，豆瓣等，开启企业营销之门。', 'H5页面开发,微信场景应用,微场景制作,h5页面模板,微信场景,微信海报,微信邀请函,微邀请,微信邀请函制作,微信场景制作,微场景定制,企业微场景,轻应用,场景应用,微信场景应用,企业微信', '1', '80', '0', '', '', '', '2016067220', '', '', '', 'wx8e4bea2a1132b1ac', 'af88509b64670348669e640b50874324', '12323');

-- ----------------------------
-- Table structure for `showtag`
-- ----------------------------
DROP TABLE IF EXISTS `showtag`;
CREATE TABLE `showtag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid_int` int(11) NOT NULL DEFAULT '0',
  `name_varchar` varchar(50) DEFAULT NULL,
  `type_int` int(11) DEFAULT NULL COMMENT '背景还是图片0背景,1图片,2音乐,88样例,99用户',
  `biztype_int` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of showtag
-- ----------------------------
INSERT INTO `showtag` VALUES ('1', '0', '图文', '88', '1101', '2015-03-14 18:10:32');
INSERT INTO `showtag` VALUES ('2', '0', '图集', '88', '1101', '2015-03-14 18:10:32');
INSERT INTO `showtag` VALUES ('4', '0', '文字', '88', '1101', '2015-03-14 18:10:32');
INSERT INTO `showtag` VALUES ('5', '0', '图表', '88', '1101', '2015-03-14 18:10:32');
INSERT INTO `showtag` VALUES ('6', '0', '报名表', '88', '1102', '2015-03-14 18:10:46');
INSERT INTO `showtag` VALUES ('8', '0', '留言', '88', '1102', '2015-03-14 18:10:46');
INSERT INTO `showtag` VALUES ('9', '0', '联系', '88', '1102', '2015-03-14 18:10:46');
INSERT INTO `showtag` VALUES ('11', '0', '清新', '88', '1103', '2015-03-14 18:11:01');
INSERT INTO `showtag` VALUES ('12', '0', '蓝色', '88', '1103', '2015-03-14 18:11:01');
INSERT INTO `showtag` VALUES ('13', '0', '中国风', '88', '1103', '2015-03-14 18:11:01');
INSERT INTO `showtag` VALUES ('14', '0', '简洁', '88', '1103', '2015-03-14 18:11:01');
INSERT INTO `showtag` VALUES ('15', '0', '黑白', '88', '1103', '2015-03-14 18:11:01');
INSERT INTO `showtag` VALUES ('16', '0', '红色', '88', '1103', '2015-03-14 18:11:01');
INSERT INTO `showtag` VALUES ('17', '0', '怀旧', '88', '1103', '2015-03-14 18:11:01');
INSERT INTO `showtag` VALUES ('18', '0', '现代', '88', '1103', '2015-03-14 18:11:01');
INSERT INTO `showtag` VALUES ('19', '0', '扁平化', '88', '1103', '2015-03-14 18:11:01');
INSERT INTO `showtag` VALUES ('20', '0', '电商', '2', '101', '2015-03-15 13:09:27');
INSERT INTO `showtag` VALUES ('21', '0', '餐饮', '2', '101', '2015-03-15 13:09:27');
INSERT INTO `showtag` VALUES ('22', '0', '家具', '2', '101', '2015-03-15 13:09:27');
INSERT INTO `showtag` VALUES ('23', '0', 'IT', '2', '101', '2015-03-15 13:09:27');
INSERT INTO `showtag` VALUES ('24', '0', '教育', '2', '101', '2015-03-15 13:09:27');
INSERT INTO `showtag` VALUES ('25', '0', '媒体', '2', '101', '2015-03-15 13:09:27');
INSERT INTO `showtag` VALUES ('26', '0', '服装', '2', '101', '2015-03-15 13:09:27');
INSERT INTO `showtag` VALUES ('27', '0', '房产', '2', '101', '2015-03-15 13:09:27');
INSERT INTO `showtag` VALUES ('28', '0', '婚庆', '2', '101', '2015-03-15 13:09:27');
INSERT INTO `showtag` VALUES ('29', '0', '娱乐', '2', '101', '2015-03-15 13:09:27');
INSERT INTO `showtag` VALUES ('30', '0', '旅游', '2', '101', '2015-03-15 13:09:27');
INSERT INTO `showtag` VALUES ('31', '0', '聚会', '2', '102', '2015-03-15 13:09:38');
INSERT INTO `showtag` VALUES ('32', '0', '生日', '2', '102', '2015-03-15 13:09:38');
INSERT INTO `showtag` VALUES ('33', '0', '生活', '2', '102', '2015-03-15 13:09:38');
INSERT INTO `showtag` VALUES ('34', '0', '情感', '2', '102', '2015-03-15 13:09:38');
INSERT INTO `showtag` VALUES ('35', '0', '简历', '2', '102', '2015-03-15 13:09:38');
INSERT INTO `showtag` VALUES ('36', '0', '请帖', '2', '102', '2015-03-15 13:09:38');
INSERT INTO `showtag` VALUES ('37', '0', '计划', '2', '102', '2015-03-15 13:09:38');
INSERT INTO `showtag` VALUES ('39', '0', '会议', '2', '103', '2015-03-15 13:09:51');
INSERT INTO `showtag` VALUES ('40', '0', '培训', '2', '103', '2015-03-15 13:09:52');
INSERT INTO `showtag` VALUES ('42', '0', '招聘', '2', '103', '2015-03-15 13:09:52');
INSERT INTO `showtag` VALUES ('43', '0', '总结', '2', '103', '2015-03-15 13:09:52');
INSERT INTO `showtag` VALUES ('44', '0', '活动', '2', '103', '2015-03-15 13:09:52');
INSERT INTO `showtag` VALUES ('45', '0', '汇报', '2', '103', '2015-03-15 13:09:52');
INSERT INTO `showtag` VALUES ('46', '0', '名片', '2', '103', '2015-03-15 13:09:52');
INSERT INTO `showtag` VALUES ('47', '0', '元旦', '2', '104', '2015-03-15 13:10:03');
INSERT INTO `showtag` VALUES ('49', '0', '元宵节', '2', '104', '2015-03-15 13:10:04');
INSERT INTO `showtag` VALUES ('56', '0', '圣诞节', '2', '104', '2015-03-15 13:10:04');
INSERT INTO `showtag` VALUES ('57', '0', '24节气', '2', '104', '2015-03-15 13:10:04');
INSERT INTO `showtag` VALUES ('58', '0', '清新', '2', '105', '2015-03-15 13:10:14');
INSERT INTO `showtag` VALUES ('59', '0', '蓝色', '2', '105', '2015-03-15 13:10:14');
INSERT INTO `showtag` VALUES ('60', '0', '中国风', '2', '105', '2015-03-15 13:10:14');
INSERT INTO `showtag` VALUES ('61', '0', '简洁', '2', '105', '2015-03-15 13:10:14');
INSERT INTO `showtag` VALUES ('62', '0', '黑白', '2', '105', '2015-03-15 13:10:14');
INSERT INTO `showtag` VALUES ('63', '0', '红色', '2', '105', '2015-03-15 13:10:14');
INSERT INTO `showtag` VALUES ('64', '0', '怀旧', '2', '105', '2015-03-15 13:10:14');
INSERT INTO `showtag` VALUES ('65', '0', '现代', '2', '105', '2015-03-15 13:10:14');
INSERT INTO `showtag` VALUES ('66', '0', '扁平化', '2', '105', '2015-03-15 13:10:14');
INSERT INTO `showtag` VALUES ('68', '1', '电器', '1', '0', '2017-08-16 17:18:31');

-- ----------------------------
-- Table structure for `showupfile`
-- ----------------------------
DROP TABLE IF EXISTS `showupfile`;
CREATE TABLE `showupfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid_int` int(11) NOT NULL,
  `filetype_int` int(11) NOT NULL DEFAULT '0' COMMENT '0背景,2音乐,1图片',
  `filesrc_varchar` varchar(200) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `sizekb_int` decimal(18,2) DEFAULT '0.00',
  `filethumbsrc_varchar` varchar(200) DEFAULT NULL,
  `biztype_int` int(11) DEFAULT '0',
  `ext_varchar` varchar(50) DEFAULT NULL,
  `filename_varchar` varchar(100) DEFAULT NULL,
  `eqsrc_varchar` varchar(200) DEFAULT NULL,
  `tagid_int` int(11) DEFAULT '0',
  `delete_int` int(11) NOT NULL DEFAULT '0' COMMENT '0正常,1删除',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid_int`,`filetype_int`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of showupfile
-- ----------------------------

-- ----------------------------
-- Table structure for `showupfilesys`
-- ----------------------------
DROP TABLE IF EXISTS `showupfilesys`;
CREATE TABLE `showupfilesys` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid_int` int(11) NOT NULL,
  `filetype_int` int(11) NOT NULL DEFAULT '0' COMMENT '0背景,2音乐,1图片',
  `filesrc_varchar` varchar(200) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `sizekb_int` decimal(18,2) DEFAULT '0.00',
  `filethumbsrc_varchar` varchar(200) DEFAULT NULL,
  `biztype_int` int(11) DEFAULT '0',
  `ext_varchar` varchar(50) DEFAULT NULL,
  `filename_varchar` varchar(100) DEFAULT NULL,
  `eqsrc_varchar` varchar(200) DEFAULT NULL,
  `tagid_int` int(11) DEFAULT '0',
  `eqsrcthumb_varchar` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid_int`,`filetype_int`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=608260 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
