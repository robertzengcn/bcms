SET FOREIGN_KEY_CHECKS=0;


-- ----------------------------
-- Table structure for `counterhistory`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `counterhistory` (
  `counter_history` int(8) NOT NULL,
  `counter` int(12) NOT NULL,
  `doctor_id` int(12) NOT NULL,
  `department_id` int(12) NOT NULL,
  PRIMARY KEY (`counter_history`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `departmentmanager`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `departmentmanager` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '科室名称',
  `smalldescript` varchar(250) NOT NULL,
  `fulldescript` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `doctormanager`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `doctormanager` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '医生名称',
  `pic` varchar(200) DEFAULT NULL COMMENT '医生照片',
  `birthday` date NOT NULL COMMENT '生日',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别 0男 1女',
  `content` text,
  `certificate` varchar(200) DEFAULT NULL COMMENT '资格证(图片)',
  `specialty` varchar(200) DEFAULT NULL,
  `cultural` varchar(50) NOT NULL COMMENT '学历',
  `university` varchar(50) NOT NULL COMMENT '毕业院校',
  `plushtime` char(10) DEFAULT NULL,
  `click_count` int(11) DEFAULT NULL,
  `position` varchar(100) NOT NULL,
  `title` tinyint(1) unsigned DEFAULT NULL,
  `keywords` tinyint(1) unsigned DEFAULT NULL,
  `description` tinyint(1) unsigned DEFAULT NULL,
  `departmentmanager_id` int(11) unsigned DEFAULT '0',
  `fulldescript` tinytext NOT NULL,
  `department_id` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_doctormanager_departmentmanager` (`departmentmanager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `doctormangertodisease`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `doctormangertodisease` (
  `id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '自增ID',
  `doctor_id` int(11) unsigned NOT NULL,
  `disease_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `member`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(10) CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(11) CHARACTER SET utf8 DEFAULT NULL,
  `ownscore` int(11) unsigned DEFAULT '0' COMMENT '已消费积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `memberlog`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `memberlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `last_log` int(10) DEFAULT NULL COMMENT '最后登陆时间',
  `type` int(2) DEFAULT '2' COMMENT '2为登陆',
  `score` int(10) DEFAULT '0' COMMENT '改行为获得的积分数',
  PRIMARY KEY (`id`),
  KEY `uid_log` (`uid`) USING BTREE,
  CONSTRAINT `memberlog_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


-- ----------------------------
-- Table structure for `resertemplate`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `resertemplate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `department_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '单周1 双周2 按月3',
  `plushtime` varchar(10) NOT NULL COMMENT '发布时间',
  `morning_time` varchar(30) DEFAULT NULL COMMENT '早上时间',
  `afternoon_time` varchar(30) DEFAULT NULL COMMENT '下午时间',
  `night_time` varchar(30) DEFAULT NULL COMMENT '晚上时间',
  `moning_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='预约模板表';

-- ----------------------------
-- Table structure for `resertemplatedetail`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `resertemplatedetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `morning` varchar(30) DEFAULT NULL,
  `afternoon` varchar(30) DEFAULT NULL,
  `night` varchar(30) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `doctor_num` varchar(255) NOT NULL,
  `tem_id` int(11) NOT NULL,
  `num` int(11) DEFAULT '0',
  `plushtime` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `getdate` (`type`,`tem_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;




ALTER TABLE `ask` ADD `isdisplay` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '是否显示，默认0，不显示';

ALTER TABLE `reservation` ADD `mark` int(11) NOT NULL DEFAULT '0' COMMENT '已预约人数';

ALTER TABLE `worker` ADD `acls` TEXT NOT NULL DEFAULT '' COMMENT '菜单访问权限' ;

ALTER TABLE `mediaid` ADD `tag` VARCHAR(255) NOT NULL DEFAULT '' ;
ALTER TABLE `mediaid` ADD `flag` CHAR(1) NOT NULL DEFAULT '' ;

ALTER TABLE `article` ADD `show_position` VARCHAR(10) NULL DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)' ;
ALTER TABLE `topic` ADD `show_position` VARCHAR(10) NULL DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)' ;
ALTER TABLE `success` ADD `show_position` VARCHAR(10) NULL DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)' ;
ALTER TABLE `technology` ADD `show_position` VARCHAR(10) NULL DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)' ;
ALTER TABLE `channelarticle` ADD `show_position` VARCHAR(10) NULL DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)' ;
ALTER TABLE `news` ADD `show_position` VARCHAR(10) NULL DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)' ;
ALTER TABLE `mediareport` ADD `show_position` VARCHAR(10) NULL DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)' ;
ALTER TABLE `doctor` ADD `show_position` VARCHAR(10) NULL DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)' ;
ALTER TABLE `ask` ADD `show_position` VARCHAR(10) NULL DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)' ;
alter table `department` add `orders` int(11) DEFAULT '0' COMMENT '科室排序';



