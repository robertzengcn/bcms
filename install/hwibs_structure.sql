SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for interface_ask
-- ----------------------------
DROP TABLE IF EXISTS `interface_ask`;
CREATE TABLE `interface_ask` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ask_id` int(10) unsigned DEFAULT NULL,
  `question_id` int(10) unsigned DEFAULT NULL,
  `is_reply` tinyint(255) unsigned DEFAULT '0',
  `source_domain` varchar(255) DEFAULT NULL,
  `add_time` int(10) unsigned DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `source_hospital` varchar(255) DEFAULT NULL,
  `reply_time` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for ampnews
-- ----------------------------
DROP TABLE IF EXISTS `ampnews`;
CREATE TABLE `ampnews` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `picurl` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `keywordid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for answer
-- ----------------------------
DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `ask_id` int(10) unsigned DEFAULT NULL COMMENT 'ask主键id',
  `doc_id` int(10) unsigned DEFAULT NULL COMMENT '回答医师id',
  `content` text,
  `plushtime` int(11) unsigned DEFAULT NULL COMMENT '回答时间',
  `hos_id` int(10) unsigned DEFAULT NULL COMMENT '医院id',
  `useful` int(10) unsigned DEFAULT '0' COMMENT '顶',
  `useless` int(10) unsigned DEFAULT NULL COMMENT '踩',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在线提问表(回答表)';

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) NOT NULL COMMENT '标题字段',
  `pic` varchar(200) DEFAULT NULL COMMENT '标题图片字段',
  `source` varchar(255) DEFAULT NULL COMMENT '文章来源',
  `content` text NOT NULL COMMENT '内容',
  `click_count` int(11) NOT NULL DEFAULT '31' COMMENT '点击量',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `plushtime` int(10) NOT NULL COMMENT '发布时间字段',
  `isbidding` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否竞价 0否 1是',
  `department_id` int(11) unsigned NOT NULL,
  `disease_id` int(11) unsigned NOT NULL,
  `doctor_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned DEFAULT NULL COMMENT '栏目ID',
  `is_top` tinyint(3) unsigned DEFAULT NULL,
  `worker_id` int(11) DEFAULT '1' COMMENT '工作人员',
  `relation` varchar(100) DEFAULT NULL COMMENT '相关资讯ids  1,2,3,4...',
  `updatetime` int(11) unsigned DEFAULT NULL,
  `show_position` varchar(10) DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)',
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `department_id` (`department_id`),
  KEY `disease_id` (`disease_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章资讯表';

-- ----------------------------
-- Table structure for ask
-- ----------------------------
DROP TABLE IF EXISTS `ask`;
CREATE TABLE `ask` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '问题编号',
  `plushtime` int(10) unsigned DEFAULT NULL COMMENT '提问时间',
  `name` char(255) DEFAULT NULL COMMENT '提问者姓名',
  `subject` char(255) DEFAULT NULL COMMENT '提问标题',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '问题状态，1为可视，0为禁止',
  `answertime` int(11) unsigned DEFAULT NULL COMMENT '回答时间',
  `ip` char(15) DEFAULT NULL COMMENT '提问者ip地址',
  `isanswer` tinyint(3) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '提问者网站用户唯一id',
  `department_id` int(10) unsigned DEFAULT NULL COMMENT '问题所属科室',
  `disease_id` int(10) unsigned DEFAULT NULL COMMENT '问题所属疾病',
  `departname` varchar(255) DEFAULT '' COMMENT '接受总控传入的科室中文名称(后续使用)',
  `department` int(10) DEFAULT '0' COMMENT '接受总控传入的科室id(后续使用)',
  `isdisplay` tinyint(1) unsigned DEFAULT '0' COMMENT '是否显示，1显示，0不显示，默认不显示',
  `show_position` varchar(10) DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)',
  `user_alis` int(10) DEFAULT '0' COMMENT '总控的用户别名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在线提问表(主表)';

-- ----------------------------
-- Table structure for askaddto
-- ----------------------------
DROP TABLE IF EXISTS `askaddto`;
CREATE TABLE `askaddto` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mode` tinyint(3) unsigned DEFAULT NULL,
  `ask_id` int(10) unsigned DEFAULT NULL COMMENT '问题唯一编码id',
  `ans_id` int(10) unsigned DEFAULT NULL COMMENT '问题回答外键id',
  `info` text COMMENT '回复或追问内容',
  `plushtime` int(11) unsigned DEFAULT NULL COMMENT '回复或追问时间',
  `useful` int(10) unsigned DEFAULT NULL COMMENT '顶',
  `useless` int(10) unsigned DEFAULT NULL COMMENT '踩',
  `add_id` int(10) unsigned DEFAULT '0' COMMENT '回复或追问ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在线提问表(追问回复)';

-- ----------------------------
-- Table structure for askassay
-- ----------------------------
DROP TABLE IF EXISTS `askassay`;
CREATE TABLE `askassay` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增id',
  `ask_id` int(10) unsigned DEFAULT NULL COMMENT '问题主键id',
  `item` varchar(255) DEFAULT NULL COMMENT '检验项目集合',
  `consult` varchar(255) DEFAULT NULL COMMENT '参考值集合',
  `unit` varchar(255) DEFAULT NULL COMMENT '单位集合',
  `finally` varchar(255) DEFAULT NULL COMMENT '结果值集合',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在线提问表(详情表)';

-- ----------------------------
-- Table structure for askdesc
-- ----------------------------
DROP TABLE IF EXISTS `askdesc`;
CREATE TABLE `askdesc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增id',
  `ask_id` int(10) unsigned DEFAULT NULL COMMENT '问题主键id',
  `description` varchar(255) DEFAULT NULL COMMENT '问题详细描述',
  `phone` char(30) DEFAULT NULL COMMENT '联系方式',
  `history` text COMMENT '疾病历史',
  `condtion` varchar(255) DEFAULT NULL COMMENT '目前治疗情况',
  `click_count` tinyint(3) unsigned DEFAULT NULL COMMENT '问题点击量',
  `city` varchar(50) DEFAULT NULL COMMENT '患者城市',
  `pic1` varchar(255) DEFAULT NULL COMMENT '图片1',
  `pic2` varchar(255) DEFAULT NULL COMMENT '图片2',
  `pic3` varchar(255) DEFAULT NULL COMMENT '图片3',
  `age` int(3) unsigned DEFAULT NULL COMMENT '患者年龄',
  `gender` varchar(255) DEFAULT NULL,
  `doctor` tinyint(1) unsigned DEFAULT NULL,
  `assay_pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='在线提问表(化验单)';

-- ----------------------------
-- Table structure for buisness
-- ----------------------------
DROP TABLE IF EXISTS `buisness`;
CREATE TABLE `buisness` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `swt_id` varchar(50) NOT NULL COMMENT '商务通ID',
  `url` varchar(100) NOT NULL COMMENT '商务通指向地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商务通表';

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '栏目名称',
  `url` varchar(200) DEFAULT NULL COMMENT 'URL名称',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否使用 1是 0否',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- ----------------------------
-- Table structure for channel
-- ----------------------------
DROP TABLE IF EXISTS `channel`;
CREATE TABLE `channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `name` varchar(100) NOT NULL COMMENT '频道名称',
  `shortname` varchar(100) DEFAULT NULL COMMENT '短名称',
  `is_use_tpl` tinyint(3) unsigned DEFAULT NULL,
  `tplurl` varchar(200) DEFAULT NULL,
  `detailtplurl` varchar(200) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `flag` char(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='自定义频道表';

-- ----------------------------
-- Table structure for channelarticle
-- ----------------------------
DROP TABLE IF EXISTS `channelarticle`;
CREATE TABLE `channelarticle` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `subject` varchar(120) NOT NULL COMMENT '标题字段',
  `pic` varchar(200) DEFAULT NULL COMMENT '标题图片字段',
  `source` varchar(255) DEFAULT NULL COMMENT '文章来源',
  `content` text NOT NULL COMMENT '内容',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `plushtime` int(10) NOT NULL DEFAULT '0' COMMENT '发布时间字段',
  `click_count` int(11) NOT NULL DEFAULT '31' COMMENT '点击量',
  `channel_id` int(11) unsigned DEFAULT NULL,
  `updatetime` int(11) unsigned DEFAULT NULL,
  `show_position` varchar(10) DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)',
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_channelarticle_channel` (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='频道文章表';

-- ----------------------------
-- Table structure for contact
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `val` varchar(250) NOT NULL COMMENT '值',
  `is_retain` tinyint(3) unsigned DEFAULT NULL,
  `flag` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='联系方式表';

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '科室名称',
  `url` varchar(200) DEFAULT NULL COMMENT '科室URL名称',
  `title` varchar(100) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `tplurl` varchar(255) DEFAULT NULL,
  `pic` varchar(200) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='科室表';

-- ----------------------------
-- Table structure for device
-- ----------------------------
DROP TABLE IF EXISTS `device`;
CREATE TABLE `device` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) DEFAULT NULL COMMENT '标题字段',
  `pic` varchar(200) NOT NULL COMMENT '标题图片字段',
  `content` text NOT NULL COMMENT '内容',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `tag` varchar(80) DEFAULT NULL COMMENT 'tag',
  `plushtime` int(11) unsigned DEFAULT NULL,
  `click_count` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='医院设备表';

-- ----------------------------
-- Table structure for disease
-- ----------------------------
DROP TABLE IF EXISTS `disease`;
CREATE TABLE `disease` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '疾病名称',
  `url` varchar(200) NOT NULL COMMENT '疾病URL名称',
  `title` varchar(100) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `department_id` int(11) unsigned DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `tplurl` varchar(255) DEFAULT NULL,
  `layer` tinyint(3) unsigned DEFAULT NULL,
  `parent_id` tinyint(3) unsigned DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_disease_departments` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='疾病表';

-- ----------------------------
-- Table structure for doctor
-- ----------------------------
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '医生名称',
  `pic` varchar(200) NOT NULL COMMENT '医生照片',
  `birthday` date NOT NULL COMMENT '生日',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别 0男 1女',
  `content` text,
  `certificate` varchar(200) NOT NULL COMMENT '资格证(图片)',
  `specialty` varchar(200) NOT NULL COMMENT '擅长领域',
  `cultural` varchar(50) NOT NULL COMMENT '学历',
  `university` varchar(50) NOT NULL COMMENT '毕业院校',
  `title` varchar(100) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `department_id` int(11) unsigned DEFAULT NULL,
  `plushtime` char(10) DEFAULT NULL,
  `click_count` int(11) DEFAULT NULL,
  `position` varchar(100) NOT NULL,
  `reserv_id` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '关联预约表中的医生id',
  `show_position` varchar(10) DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)',
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_doctor_department` (`department_id`),
  CONSTRAINT `cons_fk_doctor_department_id_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='医生表';

-- ----------------------------
-- Table structure for doctortodisease
-- ----------------------------
DROP TABLE IF EXISTS `doctortodisease`;
CREATE TABLE `doctortodisease` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `doctor_id` int(11) unsigned NOT NULL,
  `disease_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='医生疾病多对多表';

-- ----------------------------
-- Table structure for environment
-- ----------------------------
DROP TABLE IF EXISTS `environment`;
CREATE TABLE `environment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) DEFAULT NULL COMMENT '标题字段',
  `pic` varchar(200) NOT NULL COMMENT '标题图片字段',
  `content` text NOT NULL COMMENT '内容',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `tag` varchar(80) DEFAULT NULL COMMENT 'tag',
  `plushtime` int(11) unsigned DEFAULT NULL,
  `click_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='医院环境表';

-- ----------------------------
-- Table structure for errorpage
-- ----------------------------
DROP TABLE IF EXISTS `errorpage`;
CREATE TABLE `errorpage` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `code` varchar(30) NOT NULL COMMENT '错误编码',
  `content` text NOT NULL COMMENT '页面显示内容文字',
  `page` varchar(200) DEFAULT NULL COMMENT '指向页面',
  `defaultpage` varchar(200) NOT NULL DEFAULT 'error.html' COMMENT '默认页面',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='异常页面表';

-- ----------------------------
-- Table structure for `feedback`
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '反馈者姓名',
  `tel` int(11) DEFAULT NULL COMMENT '联系电话',
  `content` text COMMENT '反馈内容',
  `ischeck` tinyint(1) DEFAULT '0' COMMENT '审阅状态  0：未  1：已审阅',
  `plushtime` int(10) DEFAULT NULL,
  `click_count` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for honor
-- ----------------------------
DROP TABLE IF EXISTS `honor`;
CREATE TABLE `honor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) DEFAULT NULL COMMENT '标题字段',
  `pic` varchar(200) NOT NULL COMMENT '标题图片字段',
  `content` text NOT NULL COMMENT '内容',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `tag` varchar(80) DEFAULT NULL COMMENT 'tag',
  `plushtime` int(11) unsigned DEFAULT NULL,
  `click_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='医院荣誉表';

-- ----------------------------
-- Table structure for inspection
-- ----------------------------
DROP TABLE IF EXISTS `inspection`;
CREATE TABLE `inspection` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `subject` varchar(50) NOT NULL COMMENT '检验名称',
  `name` varchar(30) NOT NULL COMMENT '姓名',
  `medicalRecordCode` varchar(50) NOT NULL COMMENT '病例号',
  `sampleCode` varchar(100) NOT NULL COMMENT '样本编号',
  `samplingTime` varchar(40) NOT NULL COMMENT '采样时间',
  `reportingDate` varchar(30) NOT NULL COMMENT '报告日期',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别 0男 1女',
  `bedsCode` varchar(40) DEFAULT NULL COMMENT '病床号',
  `department` varchar(50) NOT NULL COMMENT '科别',
  `sampleType` varchar(40) NOT NULL COMMENT '标本种类',
  `age` varchar(10) NOT NULL COMMENT '年龄',
  `diagnose` varchar(255) NOT NULL COMMENT '诊断',
  `doctor` varchar(50) NOT NULL COMMENT '送检基师',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='检查报告单表';

-- ----------------------------
-- Table structure for inspectionitem
-- ----------------------------
DROP TABLE IF EXISTS `inspectionitem`;
CREATE TABLE `inspectionitem` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `zh` varchar(120) NOT NULL COMMENT '检测项目中文名称',
  `en` varchar(120) NOT NULL COMMENT '检测项目英文名称',
  `val` varchar(50) NOT NULL COMMENT '评估值',
  `reference` varchar(50) NOT NULL COMMENT '检查项目参考值',
  `unit` varchar(20) NOT NULL COMMENT '检查项目单位',
  `result` text NOT NULL COMMENT '检查项目结果',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='检查项目表';

-- ----------------------------
-- Table structure for introduce
-- ----------------------------
DROP TABLE IF EXISTS `introduce`;
CREATE TABLE `introduce` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) NOT NULL COMMENT '标题字段',
  `pic` varchar(200) DEFAULT NULL COMMENT '标题图片字段',
  `source` varchar(255) DEFAULT NULL COMMENT '文章来源',
  `content` text NOT NULL COMMENT '内容',
  `click_count` int(11) NOT NULL DEFAULT '31' COMMENT '点击量',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `plushtime` int(10) NOT NULL COMMENT '发布时间字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='医院简介表';

-- ----------------------------
-- Table structure for keywords
-- ----------------------------
DROP TABLE IF EXISTS `keywords`;
CREATE TABLE `keywords` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(100) NOT NULL,
  `msgtype` varchar(20) NOT NULL,
  `content` text,
  `media_id` varchar(200) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `musicurl` varchar(200) DEFAULT NULL,
  `hqmusicurl` varchar(200) DEFAULT NULL,
  `articlecount` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyword` (`keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for link
-- ----------------------------
DROP TABLE IF EXISTS `link`;
CREATE TABLE `link` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '链接ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '站点名称',
  `pic` varchar(160) NOT NULL DEFAULT '' COMMENT '站点图标',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '站点地址',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `isdisplay` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示 1为显示，0为不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- ----------------------------
-- Table structure for mediaid
-- ----------------------------
DROP TABLE IF EXISTS `mediaid`;
CREATE TABLE `mediaid` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `media_id` varchar(100) DEFAULT NULL,
  `thumb_media_id` varchar(100) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `video_media_id` varchar(100) DEFAULT NULL,
  `errcode` int(11) unsigned DEFAULT NULL,
  `errmsg` varchar(255) DEFAULT NULL,
  `tag` varchar(100) DEFAULT '',
  `flag` char(1) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mediareport
-- ----------------------------
DROP TABLE IF EXISTS `mediareport`;
CREATE TABLE `mediareport` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) NOT NULL COMMENT '标题字段',
  `pic` varchar(200) DEFAULT NULL COMMENT '标题图片字段',
  `source` varchar(255) DEFAULT NULL COMMENT '文章来源',
  `content` text NOT NULL COMMENT '内容',
  `click_count` int(11) NOT NULL DEFAULT '31' COMMENT '点击量',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `plushtime` int(10) NOT NULL COMMENT '发布时间字段',
  `updatetime` int(11) unsigned DEFAULT NULL,
  `show_position` varchar(10) DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='媒体报道表';

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fromusername` varchar(100) NOT NULL,
  `msgid` varchar(50) NOT NULL,
  `msgtype` varchar(8) NOT NULL,
  `content` text,
  `picurl` varchar(200) DEFAULT NULL,
  `mediaid` varchar(200) DEFAULT NULL,
  `thumbmediaid` varchar(200) DEFAULT NULL,
  `label` varchar(200) DEFAULT NULL,
  `format` varchar(10) DEFAULT NULL,
  `isreply` int(1) DEFAULT '0',
  `createtime` int(11) DEFAULT NULL,
  `tag` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for moon
-- ----------------------------
DROP TABLE IF EXISTS `moon`;
CREATE TABLE `moon` (
  `code` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for movie
-- ----------------------------
DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) NOT NULL COMMENT '标题字段',
  `pic` varchar(200) DEFAULT NULL COMMENT '标题图片字段',
  `content` text NOT NULL COMMENT '在线观看地址',
  `plushtime` int(11) unsigned DEFAULT NULL,
  `title` varchar(100) DEFAULT '',
  `keywords` varchar(255) DEFAULT '',
  `description` varchar(1000) DEFAULT '',
  `link` varchar(255) DEFAULT NULL,
  `updatetime` int(11) unsigned DEFAULT NULL,
   `flag` char(10) default '' COMMENT '调用标识',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='视频表';

-- ----------------------------
-- Table structure for navgroup
-- ----------------------------
DROP TABLE IF EXISTS `navgroup`;
CREATE TABLE `navgroup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增ID',
  `is_group` tinyint(3) unsigned DEFAULT '0' COMMENT '1为导航组，0为普通导航',
  `group_id` int(10) unsigned DEFAULT '0' COMMENT '如果为普通导航，父导航组ID是多少',
  `subject` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `layer` int(11) unsigned DEFAULT '0' COMMENT '0为顶级',
  `pid` int(11) unsigned DEFAULT '0',
  `sort` int(11) unsigned DEFAULT '0',
  `cate` int(11) unsigned DEFAULT '0',
  `is_display` tinyint(4) unsigned DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for navigation
-- ----------------------------
DROP TABLE IF EXISTS `navigation`;
CREATE TABLE `navigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '导航ID',
  `subject` varchar(100) NOT NULL COMMENT '导航名称',
  `url` varchar(255) NOT NULL COMMENT '导航地址',
  `layer` tinyint(1) NOT NULL DEFAULT '0' COMMENT '导航层次',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '导航父级ID 0为顶级',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '显示排序',
  `cate` tinyint(1) NOT NULL DEFAULT '1' COMMENT '导航类型 1头部全站通用导航 2疾病导航 3页尾通用导航',
  `is_display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示状态 0不显示 1显示',
  `name` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='导航表';

-- ----------------------------
-- Table structure for mobilenavigation
-- ----------------------------
DROP TABLE IF EXISTS `mobilenavigation`;
CREATE TABLE `mobilenavigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增ID',
  `is_group` tinyint(3) unsigned DEFAULT '0' COMMENT '1为导航组，0为普通导航',
  `group_id` int(10) unsigned DEFAULT '0' COMMENT '如果为普通导航，父导航组ID是多少',
  `subject` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `layer` int(11) unsigned DEFAULT '0' COMMENT '0为顶级',
  `pid` int(11) unsigned DEFAULT '0',
  `sort` int(11) unsigned DEFAULT '0',
  `cate` int(11) unsigned DEFAULT '0',
  `is_display` tinyint(4) unsigned DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='移动端导航表';

-- ----------------------------
-- Table structure for mobilepicmanager
-- ----------------------------
DROP TABLE IF EXISTS `mobilepicmanager`;
CREATE TABLE `mobilepicmanager` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `flag` varchar(20) NOT NULL COMMENT '标记',
  `img` varchar(200) NOT NULL COMMENT '图片',
  `link` varchar(255) DEFAULT NULL COMMENT '链接',
  `sort` smallint(6) NOT NULL DEFAULT '1' COMMENT '排序',
  `kind` tinyint(3) NOT NULL COMMENT '1logo2轮播3其他7头部通栏',
  `text` varchar(255) DEFAULT NULL,
  `cate` tinyint(3) unsigned DEFAULT '0' COMMENT '1代表wap，2为app，3为wechat',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='手机图片管理表';

-- ----------------------------
-- Table structure for networkpic
-- ----------------------------
DROP TABLE IF EXISTS `networkpic`;
CREATE TABLE `networkpic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) NOT NULL COMMENT '标题字段',
  `pic` varchar(200) DEFAULT NULL COMMENT '标题图片字段',
  `source` varchar(255) DEFAULT NULL COMMENT '文章来源',
  `content` text NOT NULL COMMENT '内容',
  `click_count` int(11) NOT NULL DEFAULT '31' COMMENT '点击量',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `plushtime` int(10) NOT NULL COMMENT '发布时间字段',
  `isbidding` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否竞价 0否 1是',
  `updatetime` int(11) unsigned DEFAULT NULL,
  `show_position` varchar(10) DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='动态新闻表';

-- ----------------------------
-- Table structure for pic
-- ----------------------------
DROP TABLE IF EXISTS `pic`;
CREATE TABLE `pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pic` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for picmanager
-- ----------------------------
DROP TABLE IF EXISTS `picmanager`;
CREATE TABLE `picmanager` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `flag` varchar(20) NOT NULL COMMENT '标记',
  `img` varchar(200) NOT NULL COMMENT '图片',
  `link` varchar(255) DEFAULT NULL COMMENT '链接',
  `sort` smallint(6) NOT NULL DEFAULT '1' COMMENT '排序',
  `kind` tinyint(3) NOT NULL COMMENT '1logo2轮播3其他7头部通栏',
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='图片管理表';

-- ----------------------------
-- Table structure for plugin
-- ----------------------------
DROP TABLE IF EXISTS `plugin`;
CREATE TABLE `plugin` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `byname` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `authorurl` varchar(255) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `byversion` varchar(50) DEFAULT NULL,
  `version` varchar(50) DEFAULT NULL,
  `display` tinyint(1) unsigned DEFAULT '1',
  `addtime` int(10) DEFAULT NULL,
  `updatetime` int(10) DEFAULT NULL,
  `upurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for recommendlist
-- ----------------------------
DROP TABLE IF EXISTS `recommendlist`;
CREATE TABLE `recommendlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性ID',
  `is_top` tinyint(1) DEFAULT '0' COMMENT '是否置顶 0否1是',
  `is_tomobile` tinyint(1) DEFAULT '1' COMMENT '是否推荐到手机 0否1是',
  `recommendposition_id` smallint(6) unsigned NOT NULL COMMENT '推荐位置ID',
  `article_id` int(11) unsigned DEFAULT '0' COMMENT '文章ID',
  `category_id` int(11) unsigned DEFAULT '0' COMMENT '栏目ID',
  `topic_id` int(10) unsigned DEFAULT '0' COMMENT '专题ID',
  `success_id` int(11) DEFAULT '0' COMMENT '案例ID',
  `technology_id` int(11) DEFAULT '0' COMMENT '技术ID',
  `channelarticle_id` int(10) unsigned DEFAULT '0',
  `news_id` int(10) DEFAULT '0',
  `media_id` int(10) DEFAULT '0',
  `doctor_id` int(10) unsigned DEFAULT '0',
  `ask_id` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `recommendposition_id` (`recommendposition_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='article位置表';

-- ----------------------------
-- Table structure for recommendposition
-- ----------------------------
DROP TABLE IF EXISTS `recommendposition`;
CREATE TABLE `recommendposition` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'article属性类型ID',
  `name` varchar(20) NOT NULL COMMENT '所属位置名称',
  `shortname` varchar(10) DEFAULT NULL COMMENT '短名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='article支持位置表';

-- ----------------------------
-- Table structure for `reseruser`
-- ----------------------------
DROP TABLE IF EXISTS `reseruser`;
CREATE TABLE `reseruser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `sex` int(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `age` int(3) NOT NULL COMMENT '年龄',
  `date` int(10) NOT NULL COMMENT '预约日期',
  `time` varchar(10) NOT NULL COMMENT '上午还是下午',
  `address` varchar(100) DEFAULT NULL,
  `hometel` varchar(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL COMMENT '电子邮箱',
  `ill` text NOT NULL COMMENT '病情描述',
  `reservation_id` int(10) unsigned DEFAULT '0' COMMENT '总控预约ID,不是总控预约的则为0',
  `reservation_fid` int(10) unsigned DEFAULT '0' COMMENT '对应预约详情表中ID',
  `member_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='用户预约表';

-- ----------------------------
-- Table structure for `reservation`
-- ----------------------------
DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) unsigned NOT NULL COMMENT '关联科室',
  `doctor_id` int(11) unsigned NOT NULL COMMENT '关联医生',
  `along` float NOT NULL COMMENT '单人诊断时间',
  `date` int(11) NOT NULL,
  `morning` varchar(50) DEFAULT NULL COMMENT '上午诊断时间',
  `afternoon` varchar(50) DEFAULT NULL COMMENT '下午诊断时间',
  `night` varchar(50) DEFAULT NULL COMMENT '晚上诊断时间',
  `state` int(11) DEFAULT '0' COMMENT '排班状态，0为开启，1为关闭',
  `mark` int(11) NOT NULL DEFAULT '0' COMMENT '已预约人数',
  PRIMARY KEY (`id`),
  KEY `doctor_department_date` (`department_id`,`doctor_id`,`date`),
  KEY `doctor_department` (`department_id`,`doctor_id`),
  KEY `doctor_reser` (`doctor_id`),
  CONSTRAINT `depart_reser` FOREIGN KEY (`department_id`) REFERENCES `departmentmanager` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `doctor_reser` FOREIGN KEY (`doctor_id`) REFERENCES `doctormanager` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COMMENT='预约排班表';

-- ----------------------------
-- Table structure for `reservationdetail`
-- ----------------------------
DROP TABLE IF EXISTS `reservationdetail`;
CREATE TABLE `reservationdetail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) unsigned NOT NULL COMMENT '关联科室',
  `doctor_id` int(11) unsigned NOT NULL COMMENT '关联医生',
  `date` int(11) NOT NULL,
  `times` varchar(50) DEFAULT NULL COMMENT '时间段',
  `statu` varchar(20) DEFAULT NULL COMMENT '预约状态',
  `username` varchar(20) DEFAULT NULL COMMENT '预约人姓名',
  `telephone` varchar(20) DEFAULT NULL COMMENT '电话号码',
  `card` varchar(30) DEFAULT NULL COMMENT '身份证',
  `member_id` int(10) DEFAULT NULL,
  `reserver_id` int(10) DEFAULT '0',
  `make_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='预约详细表';

-- ----------------------------
-- Table structure for seo
-- ----------------------------
DROP TABLE IF EXISTS `seo`;
CREATE TABLE `seo` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `page_name` varchar(30) NOT NULL COMMENT '页面名称',
  `flag` varchar(20) DEFAULT NULL COMMENT '标记',
  `title` varchar(120) DEFAULT NULL COMMENT '标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '关键字',
  `description` text COMMENT '描述',
  `is_retain` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否系统保留 1保留 0自建',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='seo三要素表';

-- ----------------------------
-- Table structure for spiteip
-- ----------------------------
DROP TABLE IF EXISTS `spiteip`;
CREATE TABLE `spiteip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL COMMENT 'IP地址',
  `times` int(11) NOT NULL COMMENT '来访时间',
  `url` varchar(200) NOT NULL COMMENT '访问的URL',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='IP列表';

-- ----------------------------
-- Table structure for statisticslog
-- ----------------------------
DROP TABLE IF EXISTS `statisticslog`;
CREATE TABLE `statisticslog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `ip` varchar(21) DEFAULT NULL COMMENT 'ip地址',
  `visittime` int(10) NOT NULL COMMENT '访问时间 时间戳',
  `sessionid` varchar(100) DEFAULT NULL COMMENT 'sessionID',
  `fromurl` varchar(255) DEFAULT NULL COMMENT '来路url 空是直接地址栏输入',
  `url` varchar(255) NOT NULL COMMENT '受访问url',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='统计日志表';

-- ----------------------------
-- Table structure for success
-- ----------------------------
DROP TABLE IF EXISTS `success`;
CREATE TABLE `success` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `subject` varchar(120) NOT NULL COMMENT '标题字段',
  `pic1` varchar(200) DEFAULT NULL COMMENT '缩略图1',
  `pic2` varchar(200) DEFAULT NULL COMMENT '缩略图2',
  `source` varchar(255) DEFAULT NULL COMMENT '文章来源',
  `content` text NOT NULL COMMENT '内容',
  `click_count` int(11) NOT NULL DEFAULT '31' COMMENT '点击量',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `plushtime` int(10) NOT NULL COMMENT '发布时间字段',
  `isbidding` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否竞价 0否 1是',
  `disease_id` tinyint(3) unsigned DEFAULT NULL,
  `department_id` tinyint(3) unsigned DEFAULT NULL,
  `recommendposition_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `worker_id` tinyint(1) unsigned DEFAULT NULL,
  `is_top` tinyint(3) unsigned DEFAULT NULL,
  `updatetime` int(11) unsigned DEFAULT NULL,
  `show_position` varchar(10) DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='案例表';

-- ----------------------------
-- Table structure for tag
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tag` varchar(50) NOT NULL COMMENT 'tag',
  `plushtime` int(10) NOT NULL COMMENT '写入时间戳 与文章写入时间相关',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tags与文章联系表';

-- ----------------------------
-- Table structure for technology
-- ----------------------------
DROP TABLE IF EXISTS `technology`;
CREATE TABLE `technology` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) NOT NULL COMMENT '标题字段',
  `pic` varchar(200) DEFAULT NULL COMMENT '标题图片字段',
  `content` text NOT NULL COMMENT '内容',
  `click_count` int(11) NOT NULL DEFAULT '31' COMMENT '点击量',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `plushtime` int(10) NOT NULL COMMENT '发布时间字段',
  `isbidding` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否竞价 0否 1是',
  `department_id` int(11) unsigned NOT NULL,
  `kind` tinyint(3) unsigned DEFAULT NULL,
  `recommendposition_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '推荐位置',
  `updatetime` int(11) unsigned DEFAULT NULL,
  `is_top` tinyint(3) unsigned DEFAULT NULL,
  `show_position` varchar(10) DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)',
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='特色技术表';

-- ----------------------------
-- Table structure for thirdstat
-- ----------------------------
DROP TABLE IF EXISTS `thirdstat`;
CREATE TABLE `thirdstat` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `subject` varchar(80) NOT NULL COMMENT '名称',
  `js` text NOT NULL COMMENT 'js代码',
  `isuse` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否使用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第三方统计代码';

-- ----------------------------
-- Table structure for topic
-- ----------------------------
DROP TABLE IF EXISTS `topic`;
CREATE TABLE `topic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) NOT NULL COMMENT '标题字段',
  `pic` varchar(200) DEFAULT NULL COMMENT '标题图片字段',
  `link` varchar(255) DEFAULT NULL COMMENT '文件名称',
  `url` varchar(255) DEFAULT NULL COMMENT '所在文件夹',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `content` text,
  `plushtime` int(10) NOT NULL COMMENT '发布时间',
  `is_tpl` tinyint(3) unsigned DEFAULT NULL COMMENT '1 文章类 2 静态类 3 动态类',
  `effect` varchar(100) DEFAULT NULL COMMENT '特效列表',
  `tpl` varchar(100) DEFAULT NULL COMMENT '模板文件',
  `topicid` int(11) DEFAULT NULL COMMENT '专题模板ID',
  `topiclistid` tinyint(3) unsigned DEFAULT NULL,
  `disease_id` tinyint(1) unsigned DEFAULT NULL,
  `show_position` varchar(10) DEFAULT '0' COMMENT '显示位置：1(pc), 2(手机网页), 3(app), 4(微站)',
  `click_count` int(11) DEFAULT '0' COMMENT '点击次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='专题表';

-- ----------------------------
-- Table structure for topic_list
-- ----------------------------
DROP TABLE IF EXISTS `topic_list`;
CREATE TABLE `topic_list` (
  `id` int(60) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL COMMENT '专题模板名称',
  `url` varchar(250) NOT NULL COMMENT '专题模板路径 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for trendip
-- ----------------------------
DROP TABLE IF EXISTS `trendip`;
CREATE TABLE `trendip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'IP地址',
  `times` int(11) NOT NULL COMMENT '来访时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for uservar
-- ----------------------------
DROP TABLE IF EXISTS `uservar`;
CREATE TABLE `uservar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '变量中文名',
  `val` text COLLATE utf8_unicode_ci NOT NULL COMMENT '变量值',
  `var_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '变量英文名',
  `kind` tinytext COLLATE utf8_unicode_ci NOT NULL COMMENT '1特色技术 2专题 3个性频道',
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '变量类型',
  `tid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for worker
-- ----------------------------
DROP TABLE IF EXISTS `worker`;
CREATE TABLE `worker` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `group_id` int(10) NOT NULL COMMENT '用户组 1 管理员 2 工作人员',
  `plushtime` int(10) NOT NULL COMMENT '注册时间',
  `purview` varchar(200) DEFAULT NULL COMMENT '权限',
  `acls` text,
  `telephone` varchar(11) DEFAULT NULL COMMENT '电话号码',
  `nick_name` varchar(20) DEFAULT NULL COMMENT '昵称，用户姓名',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='后台工作人员表';

-- ----------------------------
-- Table structure for workerloghistory
-- ----------------------------
DROP TABLE IF EXISTS `workerloghistory`;
CREATE TABLE `workerloghistory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `logtime` int(10) NOT NULL COMMENT '操作时间',
  `op` varchar(100) NOT NULL COMMENT '操作名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='工作人员操作日志表';

-- ----------------------------
-- Table structure for workhistory
-- ----------------------------
DROP TABLE IF EXISTS `workhistory`;
CREATE TABLE `workhistory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `begintime` varchar(20) NOT NULL COMMENT '起始时间',
  `endtime` varchar(20) NOT NULL COMMENT '结束时间',
  `company` varchar(150) NOT NULL COMMENT '单位名称',
  `position` varchar(150) NOT NULL COMMENT '职位',
  `remark` text COMMENT '备注',
  `doctor_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wh_doid` (`doctor_id`),
  CONSTRAINT `wh_doid` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='工作资历表';

-- ----------------------------
-- Table structure for library
-- ----------------------------
DROP TABLE IF EXISTS `library`;
CREATE TABLE `library` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `plushtime` int(10) unsigned DEFAULT '0' COMMENT '增加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `counterhistory`
-- ----------------------------
DROP TABLE IF EXISTS `counterhistory`;
CREATE TABLE `counterhistory` (
  `counter_history` int(8) NOT NULL,
  `counter` int(12) NOT NULL,
  `doctor_id` int(12) NOT NULL,
  `department_id` int(12) NOT NULL,
  PRIMARY KEY (`counter_history`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `departmentmanager`
-- ----------------------------
DROP TABLE IF EXISTS `departmentmanager`;
CREATE TABLE `departmentmanager` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '科室名称',
  `smalldescript` varchar(250) NOT NULL,
  `fulldescript` varchar(1000) NOT NULL,
  `belong` int(11) DEFAULT NULL COMMENT '从属科室',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `doctormanager`
-- ----------------------------
DROP TABLE IF EXISTS `doctormanager`;
CREATE TABLE `doctormanager` (
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
  `fulldescript` text NOT NULL,
  `department_id` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `doctormangertodisease`
-- ----------------------------
DROP TABLE IF EXISTS `doctormangertodisease`;
CREATE TABLE `doctormangertodisease` (
  `id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '自增ID',
  `doctor_id` int(11) unsigned NOT NULL,
  `disease_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `member`
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(11) CHARACTER SET utf8 DEFAULT NULL,
  `ownscore` int(11) unsigned DEFAULT '0' COMMENT '现有积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `memberlog`
-- ----------------------------
DROP TABLE IF EXISTS `memberlog`;
CREATE TABLE `memberlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `last_log` int(10) DEFAULT NULL COMMENT '最后登陆时间',
  `type` int(2) DEFAULT '2' COMMENT '2为登陆',
  `score` int(10) DEFAULT '0' COMMENT '改行为获得的积分数',
  PRIMARY KEY (`id`),
  KEY `uid_log` (`uid`) USING BTREE,
  CONSTRAINT `memberlog_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `resertemplate`
-- ----------------------------
DROP TABLE IF EXISTS `resertemplate`;
CREATE TABLE `resertemplate` (
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
) ENGINE=MyISAM AUTO_INCREMENT=434 DEFAULT CHARSET=utf8 COMMENT='预约模板表';


-- ----------------------------
-- Table structure for `weibo`
-- ----------------------------
DROP TABLE IF EXISTS `weibo`;
CREATE TABLE `weibo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `access_token` varchar(60) DEFAULT NULL,
  `expires_time` int(40) DEFAULT NULL,
  `uid` varchar(40) DEFAULT NULL COMMENT '授权用户的UID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `client`
-- ----------------------------
DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '姓名',
  `gender` int(1) NOT NULL COMMENT '性别',
  `age` int(3) NOT NULL COMMENT '年龄',
  `birthday` char(10) DEFAULT '' COMMENT '出生日期',
  `address` varchar(200) DEFAULT '' COMMENT '住址',
  `telephone` varchar(12) NOT NULL DEFAULT '' COMMENT '电话号码',
  `email` varchar(50) DEFAULT '' COMMENT '电子邮箱',
  `qq` varchar(11) DEFAULT '' COMMENT 'qq',
  `plushtime` int(11) DEFAULT '0' COMMENT '数据添加日期',
  `mark` varchar(255) DEFAULT '' COMMENT '备注信息',
  `ad_record` int(5) DEFAULT '0' COMMENT '预约后按时赴约次数（信用评估）',
  `focus_id` varchar(255) DEFAULT '' COMMENT '关注人',
  `res_code` text COMMENT '预约记录关联（resbookinginfo id）',
  `last_source` int(2) DEFAULT '0' COMMENT '最新一次的来源渠道',
  `source` int(2) unsigned DEFAULT '0' COMMENT '来源渠道',
  `last_reception` int(3) DEFAULT '0' COMMENT '最新一次对接的客服ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COMMENT='客户咨询预约表';

-- ----------------------------
-- Table structure for `clientrecord`
-- ----------------------------
DROP TABLE IF EXISTS `clientrecord`;
CREATE TABLE `clientrecord` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci,
  `recordtime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` int(11) unsigned DEFAULT NULL COMMENT 'client表关联ID',
  `reception_id` int(3) DEFAULT '0' COMMENT '咨询员',
  `plushtime` int(11) unsigned DEFAULT NULL,
  `focus_id` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_clientrecord_client` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for `patientdatasource`
-- ----------------------------
DROP TABLE IF EXISTS `patientdatasource`;
CREATE TABLE `patientdatasource` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '来源标题',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '来源备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='信息来源表' AUTO_INCREMENT=1;

-- ----------------------------
-- Table structure for `patientreceptionist`
-- ----------------------------
DROP TABLE IF EXISTS `patientreceptionist`;
CREATE TABLE `patientreceptionist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `user_name` varchar(64) NOT NULL DEFAULT '' COMMENT '接待员姓名',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='前台接待员' AUTO_INCREMENT=1;

-- ----------------------------
-- Table structure for `clientgroup`
-- ----------------------------
DROP TABLE IF EXISTS `clientgroup`;
CREATE TABLE `clientgroup` (
 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
 `name` varchar(20) NOT NULL DEFAULT '' COMMENT '组名',
 `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客户管理组表';




-- ----------------------------
-- Table structure for `boyimanager`
-- ----------------------------
DROP TABLE IF EXISTS `boyimanager`;
CREATE TABLE `boyimanager` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `boyikey` varchar(70) DEFAULT NULL,
  `date` int(40) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL COMMENT '用户名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `user_token`
-- ----------------------------
DROP TABLE IF EXISTS `user_token`;
CREATE TABLE `user_token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `token` varchar(128) NOT NULL,
  `expire_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=MEMORY AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*
预约挂号相关
*/


-- ----------------------------
-- Table structure for `resbookinginfo`
-- ----------------------------
DROP TABLE IF EXISTS `resbookinginfo`;
CREATE TABLE `resbookinginfo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` varchar(255) DEFAULT NULL,
  `doctor_id` int(11) unsigned NOT NULL COMMENT '关联医生',
  `date` int(11) NOT NULL,
  `times` varchar(50) DEFAULT NULL COMMENT '时间段',
  `statu` varchar(20) DEFAULT NULL COMMENT '预约状态',
  `member_id` int(10) DEFAULT NULL COMMENT '用户Id',
  `resvation_id` int(10) DEFAULT '0' COMMENT '对应预约表resvation id',
  `username` varchar(20) DEFAULT NULL COMMENT '预约人姓名',
  `medical_card` varchar(30) DEFAULT NULL COMMENT '就诊卡/HIS系统卡号',
  `telephone` varchar(15) DEFAULT NULL COMMENT '病患手机号码',
  `id_card` varchar(25) DEFAULT NULL COMMENT '身份证号',
  `age` int(3) DEFAULT NULL COMMENT '年龄',
  `sex` int(1) DEFAULT NULL COMMENT '性别0男1女',
  `address` varchar(200) DEFAULT NULL COMMENT '家庭住址',
  `email` varchar(30) DEFAULT NULL COMMENT '电子邮箱',
  `description` text COMMENT '病情描述',
  `make_time` int(11) DEFAULT NULL COMMENT '下单时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='预约详细表';


-- ----------------------------
-- Table structure for `resdepartment`
-- ----------------------------
DROP TABLE IF EXISTS `resdepartment`;
CREATE TABLE `resdepartment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '科室名称',
  `description` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `belong` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `resdoctor`
-- ----------------------------
DROP TABLE IF EXISTS `resdoctor`;
CREATE TABLE `resdoctor` (
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
  `position` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `department_id` tinyint(3) unsigned DEFAULT NULL,
  `relation_id` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `resertemplate`
-- ----------------------------
DROP TABLE IF EXISTS `resertemplate`;
CREATE TABLE `resertemplate` (
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
DROP TABLE IF EXISTS `resertemplatedetail`;
CREATE TABLE `resertemplatedetail` (
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
  `click_count` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `getdate` (`type`,`tem_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `reseruser`
-- ----------------------------
DROP TABLE IF EXISTS `reseruser`;
CREATE TABLE `reseruser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `sex` int(1) NOT NULL COMMENT '性别',
  `age` int(3) NOT NULL COMMENT '年龄',
  `date` int(15) DEFAULT NULL,
  `time` varchar(10) NOT NULL COMMENT '上午还是下午',
  `address` varchar(100) DEFAULT NULL,
  `hometel` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL COMMENT '电子邮箱',
  `ill` text NOT NULL COMMENT '病情描述',
  `reservation_id` int(10) unsigned DEFAULT '0' COMMENT '总控预约ID,不是总控预约的则为0',
  `reservation_fid` int(10) unsigned DEFAULT '0' COMMENT '对应预约详情表中ID',
  `member_id` int(10) DEFAULT NULL COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='用户预约表';


-- ----------------------------
-- Table structure for `reservation`
-- ----------------------------
DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) unsigned NOT NULL COMMENT '关联科室',
  `doctor_id` int(11) unsigned NOT NULL COMMENT '关联医生',
  `along` float NOT NULL COMMENT '单人诊断时间',
  `date` int(11) NOT NULL,
  `morning` varchar(50) DEFAULT NULL COMMENT '上午诊断时间',
  `afternoon` varchar(50) DEFAULT NULL COMMENT '下午诊断时间',
  `night` varchar(50) DEFAULT NULL COMMENT '晚上诊断时间',
  `state` int(11) DEFAULT '0' COMMENT '排班状态，0为开启，1为关闭',
  `mark` int(11) NOT NULL DEFAULT '0' COMMENT '已预约人数',
  PRIMARY KEY (`id`),
  KEY `doctor_department_date` (`department_id`,`doctor_id`,`date`),
  KEY `doctor_department` (`department_id`,`doctor_id`),
  KEY `doctor_reser` (`doctor_id`),
  CONSTRAINT `depart_reser` FOREIGN KEY (`department_id`) REFERENCES `departmentmanager` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='预约排班表';


-- ----------------------------
-- Table structure for `reservationdetail`
-- ----------------------------
DROP TABLE IF EXISTS `reservationdetail`;
CREATE TABLE `reservationdetail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) unsigned NOT NULL COMMENT '关联科室',
  `doctor_id` int(11) unsigned NOT NULL COMMENT '关联医生',
  `date` int(20) DEFAULT NULL,
  `times` varchar(50) DEFAULT NULL COMMENT '时间段',
  `statu` varchar(20) DEFAULT NULL COMMENT '预约状态',
  `username` varchar(20) DEFAULT NULL COMMENT '预约人姓名',
  `telephone` varchar(20) DEFAULT NULL COMMENT '电话号码',
  `card` varchar(30) DEFAULT NULL COMMENT '身份证',
  `member_id` int(10) DEFAULT NULL COMMENT '用户Id',
  `reserver_id` int(10) DEFAULT '0' COMMENT '对应预约表id',
  `make_time` datetime DEFAULT NULL COMMENT '下单时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='预约详细表';


-- ----------------------------
-- Table structure for `resschedule`
-- ----------------------------
DROP TABLE IF EXISTS `resschedule`;
CREATE TABLE `resschedule` (
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
  `click_count` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `getdate` (`type`,`tem_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `restemplate`
-- ----------------------------
DROP TABLE IF EXISTS `restemplate`;
CREATE TABLE `restemplate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '单周1 双周2 按月3',
  `plushtime` varchar(10) NOT NULL COMMENT '发布时间',
  `morning_time` varchar(30) DEFAULT NULL COMMENT '早上时间',
  `afternoon_time` varchar(30) DEFAULT NULL COMMENT '下午时间',
  `night_time` varchar(30) DEFAULT NULL COMMENT '晚上时间',
  `moning_time` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='预约模板表';


-- ----------------------------
-- Table structure for `resvation`
-- ----------------------------
DROP TABLE IF EXISTS `resvation`;
CREATE TABLE `resvation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) unsigned NOT NULL COMMENT '关联科室',
  `doctor_id` int(11) unsigned NOT NULL COMMENT '关联医生',
  `along` float NOT NULL COMMENT '单人诊断时间',
  `date` int(11) NOT NULL,
  `morning` varchar(50) DEFAULT NULL COMMENT '上午诊断时间',
  `afternoon` varchar(50) DEFAULT NULL COMMENT '下午诊断时间',
  `night` varchar(50) DEFAULT NULL COMMENT '晚上诊断时间',
  `state` int(11) DEFAULT '0' COMMENT '排班状态，0为开启，1为关闭',
  `mark` int(11) NOT NULL DEFAULT '0' COMMENT '已预约人数',
  `morning_source` tinyint(3) unsigned DEFAULT NULL,
  `afternoon_source` tinyint(3) unsigned DEFAULT NULL,
  `night_source` tinyint(3) unsigned DEFAULT NULL,
  `time_point` varchar(255) DEFAULT NULL,
  `morning_point` varchar(255) DEFAULT NULL,
  `after_point` tinyint(1) unsigned DEFAULT NULL,
  `night_point` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='预约排班表';
-- ----------------------------
-- Table structure for `hmtoken`
-- ----------------------------
DROP TABLE IF EXISTS `hmtoken`;
CREATE TABLE `hmtoken` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `token` varchar(128) NOT NULL,
  `expire_time` int(10) NOT NULL,
  `work_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=MEMORY AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `clienttoworker`
-- ----------------------------
DROP TABLE IF EXISTS `clienttoworker`;
CREATE TABLE `clienttoworker` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `client_id` int(10) DEFAULT NULL,
  `work_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `workergroup`
-- ----------------------------
DROP TABLE IF EXISTS `workergroup`;
CREATE TABLE `workergroup` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `mark` text,
  `acls` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for `commodity`
-- ----------------------------
DROP TABLE IF EXISTS `commodity`;
CREATE TABLE `commodity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL COMMENT '商品名称',
  `subtitle` varchar(64) DEFAULT NULL COMMENT '商品副标题',
  `description` varchar(255) DEFAULT NULL COMMENT '商品描述',
  `quantity` int(20) unsigned NOT NULL COMMENT '商品数量',
  `salenum` int(20) NOT NULL DEFAULT '0' COMMENT '已销数量',
  `pic` varchar(250) DEFAULT NULL COMMENT '商品图片',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '商品状态 1为启用，0为关闭',
  `types` int(1) NOT NULL DEFAULT '1' COMMENT '商品类型 1：医疗服务 2：医院购买  3：商城配送',
  `counts` int(8) DEFAULT NULL COMMENT '点击数',
  `model` varchar(25) DEFAULT NULL COMMENT '商品型号',
  `exchange` int(10) DEFAULT '1' COMMENT '兑换方式：1为纯积分，2为积分加现金',
  `limit` int(1) DEFAULT '0' COMMENT '每个账户限购',
  `score` int(8) NOT NULL COMMENT '积分数量',
  `price` varchar(20) NOT NULL COMMENT '商品价格',
  `piclist` varchar(255) DEFAULT NULL COMMENT '商品轮播图',
  `plushtime` int(11) unsigned DEFAULT NULL COMMENT '发布时间',
  `updatetime` int(11) unsigned DEFAULT NULL COMMENT '更新时间',
  `click_count` tinyint(3) unsigned DEFAULT NULL,
  `get` tinyint(3) unsigned DEFAULT NULL,
  `start_time` int(15) NOT NULL COMMENT '活动开始时间',
  `end_time` int(15) NOT NULL COMMENT '活动结束时间',
  `categories_id` int(10) DEFAULT NULL,
  `discount` int(25) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `commodity_supplier`
-- ----------------------------
DROP TABLE IF EXISTS `commodity_supplier`;
CREATE TABLE `commodity_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL COMMENT '商品id ',
  `source` varchar(250) NOT NULL COMMENT '来源',
  `model` varchar(50) NOT NULL COMMENT '接入商品的特殊值，用来确定唯一性',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第三方供应商信息表';

-- ----------------------------
-- Table structure for `commodityaddscorelog`
-- ----------------------------
DROP TABLE IF EXISTS `commodityaddscorelog`;
CREATE TABLE `commodityaddscorelog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `date` int(10) NOT NULL COMMENT '日期',
  `type` int(10) NOT NULL COMMENT '商品类型 1：医疗服务 2：医院购买  3：商城配送',
  `score` int(10) DEFAULT '0' COMMENT '获得积分数量',
  `ip` char(16) NOT NULL COMMENT 'IP地址',
  PRIMARY KEY (`id`),
  KEY `member_id` (`uid`) USING BTREE,
  KEY `score_type` (`type`) USING BTREE,
  CONSTRAINT `commodityaddscorelog_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `commoditycategories`
-- ----------------------------
DROP TABLE IF EXISTS `commoditycategories`;
CREATE TABLE `commoditycategories` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `name` varchar(200) DEFAULT NULL COMMENT '分类名',
  `categories_image` varchar(200) DEFAULT NULL COMMENT '分类图片',
  `categories_status` int(10) DEFAULT '0' COMMENT '分类状态, 0为开启，1为关闭',
  `types` int(5) DEFAULT '1',
  `descript` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品目录表';

-- ----------------------------
-- Table structure for `commoditydescript`
-- ----------------------------
DROP TABLE IF EXISTS `commoditydescript`;
CREATE TABLE `commoditydescript` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_descript` text COMMENT '商品详细内容',
  `product_id` int(10) NOT NULL COMMENT '商品id',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `commoditydescript_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `commodity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品详细内容表';

-- ----------------------------
-- Table structure for `commoditykey`
-- ----------------------------
DROP TABLE IF EXISTS `commoditykey`;
CREATE TABLE `commoditykey` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `remember_key` char(32) NOT NULL COMMENT '随机键值',
  `lose_time` int(11) unsigned NOT NULL COMMENT '失效时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `commoditykey_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商城自动登录表';

-- ----------------------------
-- Table structure for `commoditylog`
-- ----------------------------
DROP TABLE IF EXISTS `commoditylog`;
CREATE TABLE `commoditylog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `orders` char(20) DEFAULT NULL COMMENT '成功换取商品生成的订单号',
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `gid` int(10) DEFAULT NULL COMMENT '消费的商品id',
  `totalscore` int(15) unsigned DEFAULT '0' COMMENT '用户消费积分数',
  `totalcash` decimal(14,2) unsigned DEFAULT '0.00' COMMENT '用户消费现金数',
  `num` int(10) DEFAULT '1' COMMENT '商品数量',
  `buytime` char(12) DEFAULT '0' COMMENT '消费时间',
  `taketime` int(10) DEFAULT NULL COMMENT '提取时间',
  `status` int(10) DEFAULT '0' COMMENT '提取状态:0未提取,1已提取',
  `qrcode` char(10) NOT NULL COMMENT '商品条形码',
  PRIMARY KEY (`id`),
  KEY `member_id` (`uid`) USING BTREE,
  CONSTRAINT `commoditylog_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `commoditylog_ibfk_2` FOREIGN KEY (`gid`) REFERENCES `commodity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商城订单号状态表';

-- ----------------------------
-- Table structure for `commodityorder`
-- ----------------------------
DROP TABLE IF EXISTS `commodityorder`;
CREATE TABLE `commodityorder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders` char(16) NOT NULL COMMENT '订单号',
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `qrcode` char(10) NOT NULL COMMENT '商品条形码',
  PRIMARY KEY (`id`),
  CONSTRAINT `commodityorder_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品订单表';

-- ----------------------------
-- Table structure for `commodityrule`
-- ----------------------------
DROP TABLE IF EXISTS `commodityrule`;
CREATE TABLE `commodityrule` (
  `id` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `descript` text COMMENT '规则说明',
  `score` int(10) DEFAULT NULL COMMENT '获得积分数量',
  `limit` int(10) DEFAULT NULL COMMENT '限制数量',
  `name` varchar(255) DEFAULT NULL COMMENT '规则名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启 0否 1是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品获取积分规则表';

-- ----------------------------
-- Table structure for `draw`
-- ----------------------------
DROP TABLE IF EXISTS `draw`;
CREATE TABLE `draw` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '活动名称',
  `start_time` int(10) NOT NULL COMMENT '活动开始时间',
  `end_time` int(10) NOT NULL COMMENT '活动结束时间',
  `statu` int(1) NOT NULL DEFAULT '0' COMMENT '活动是否开启，0为关闭，1为开启',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '活动的类型:1为砸蛋，2为刮卡，3为转盘',
  `limit` int(2) NOT NULL DEFAULT '0' COMMENT '每个账号限制，0为不限制，1为限制一次',
  `descript` mediumtext CHARACTER SET utf8 COMMENT '跪着说明',
  `bonus` int(10) NOT NULL DEFAULT '0' COMMENT '每次参与消耗积分',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='抽奖活动表';

-- ----------------------------
-- Table structure for `drawlog`
-- ----------------------------
DROP TABLE IF EXISTS `drawlog`;
CREATE TABLE `drawlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `draw_id` int(10) NOT NULL COMMENT '活动id',
  `result` varchar(255) DEFAULT NULL COMMENT '奖品名称',
  `date` int(11) unsigned DEFAULT NULL COMMENT '日期',
  PRIMARY KEY (`id`),
  KEY `log_member` (`member_id`),
  KEY `log_draw` (`draw_id`),
  CONSTRAINT `log_draw` FOREIGN KEY (`draw_id`) REFERENCES `draw` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `log_member` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='抽奖记录表';

-- ----------------------------
-- Table structure for `drawprize`
-- ----------------------------
DROP TABLE IF EXISTS `drawprize`;
CREATE TABLE `drawprize` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '奖品名称',
  `prize_count` int(15) NOT NULL DEFAULT '0' COMMENT '奖品总数',
  `prize_every` int(15) NOT NULL DEFAULT '0',
  `prize_percent` float(11,0) DEFAULT NULL COMMENT '中奖万份机率',
  `prize_position` int(5) unsigned DEFAULT NULL COMMENT '第几等奖',
  `drawid` int(10) NOT NULL COMMENT '活动id',
  `img` varchar(150) CHARACTER SET utf8 DEFAULT NULL COMMENT '奖品图片地址',
  `takeway` int(2) DEFAULT '1' COMMENT '奖品领取方式, 1为到院领取，2为医院配送',
  `type` int(2) DEFAULT NULL COMMENT '奖品类型 1为医院服务类型 2为商品',
  PRIMARY KEY (`id`),
  KEY `draw_id` (`drawid`),
  CONSTRAINT `draw_id` FOREIGN KEY (`drawid`) REFERENCES `draw` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='奖品表';

-- ----------------------------
-- Table structure for `drawwinlog`
-- ----------------------------
DROP TABLE IF EXISTS `drawwinlog`;
CREATE TABLE `drawwinlog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `prize_id` int(10) NOT NULL COMMENT '奖品id',
  `member_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `draw_id` int(10) NOT NULL COMMENT '活动id',
  `statue` int(2) DEFAULT '0' COMMENT '状态0为未领取,1为已领取',
  `date` int(10) DEFAULT NULL COMMENT '日期',
  `flag` char(12) NOT NULL COMMENT '订单号',
  PRIMARY KEY (`id`),
  KEY `winlog_prize` (`prize_id`),
  KEY `winlog_member` (`member_id`),
  KEY `winlog_draw` (`draw_id`),
  CONSTRAINT `winlog_draw` FOREIGN KEY (`draw_id`) REFERENCES `draw` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `winlog_member` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `winlog_prize` FOREIGN KEY (`prize_id`) REFERENCES `drawprize` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='奖品领取状态表';

-- ----------------------------
-- Table structure for `vote`
-- ----------------------------
DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `moban` varchar(20) DEFAULT 'green' COMMENT '活动模板',
  `title` varchar(50) NOT NULL COMMENT '活动标题',
  `fxms` varchar(1000) DEFAULT '' COMMENT '微信分享描述',
  `fxtb` varchar(500) DEFAULT '' COMMENT '微信分享图标',
  `ktcs` int(4) DEFAULT '1' COMMENT '每个微信用户可投票数',
  `ipnubs` int(4) DEFAULT '0' COMMENT '同一个IP下每天能投多少票',
  `btcdxz` int(4) DEFAULT '0' COMMENT '报名期和投票期重叠的时间段每个作品的投票数限额',
  `keyword` varchar(64) NOT NULL COMMENT '活动关键词',
  `checks` int(10) NOT NULL COMMENT '浏览量',
  `wappicurl` varchar(500) NOT NULL COMMENT '活动广告图片',
  `statdate` int(11) NOT NULL COMMENT '投票开始时间',
  `enddate` int(11) NOT NULL COMMENT '投票结束时间',
  `start_time` int(11) NOT NULL COMMENT '报名开始时间',
  `over_time` int(11) NOT NULL COMMENT '报名结束时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '活动开启状态',
  `votelimit` tinyint(4) DEFAULT '1',
  `shuma` text COMMENT '活动说明内容一',
  `shumat` varchar(2000) DEFAULT '' COMMENT '活动说明标题一',
  `shumb` text COMMENT '活动说明内容二',
  `shumbt` varchar(2000) DEFAULT '' COMMENT '活动说明标题二',
  `shumc` text COMMENT '活动说明内容三',
  `shumct` varchar(2000) DEFAULT '' COMMENT '活动说明标题三',
  `xntps` int(10) DEFAULT '0' COMMENT '虚拟投票数',
  `xncheck` int(10) DEFAULT '0' COMMENT '虚拟浏览量',
  `xnbms` int(8) DEFAULT '0' COMMENT '虚拟报名数',
  `wfbmbz` varchar(2000) DEFAULT '' COMMENT '无法在线报名帮助',
  `is_sh` int(1) DEFAULT '1' COMMENT '报名作品是否需要审核',
  `is_sendsms` int(1) NOT NULL DEFAULT '1' COMMENT '审核通过是否通知',
  `sms_content` varchar(500) DEFAULT '' COMMENT '被投票时自动通知模板',
  `gonggao` text COMMENT '首页顶部公告',
  `mcsl` int(5) DEFAULT '1' COMMENT '每次消耗钻石数量',
  `gztb` varchar(500) DEFAULT '' COMMENT '关注二维码',
  `add_time` int(11) NOT NULL COMMENT '活动发布时间',
  `ed_dcount` text COMMENT '每天点击量',
  `gzyd` tinyint(3) unsigned DEFAULT NULL COMMENT '关注引导',
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投票表';

-- ----------------------------
-- Table structure for `voteitem`
-- ----------------------------
DROP TABLE IF EXISTS `voteitem`;
CREATE TABLE `voteitem` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `vid` int(10) NOT NULL COMMENT '活动id',
  `item` varchar(64) NOT NULL COMMENT '姓名',
  `dcount` int(11) DEFAULT '0' COMMENT '点击量',
  `vcount` int(11) NOT NULL COMMENT '票数',
  `startpicurl1` varchar(200) DEFAULT '' COMMENT '照片1',
  `startpicurl2` varchar(200) DEFAULT '' COMMENT '照片2',
  `startpicurl3` varchar(200) DEFAULT '' COMMENT '照片3',
  `startpicurl4` varchar(200) DEFAULT '' COMMENT '照片4',
  `startpicurl5` varchar(200) DEFAULT '' COMMENT '照片5',
  `phone` varchar(11) NOT NULL COMMENT '电话',
  `rank` int(4) unsigned NOT NULL DEFAULT '200' COMMENT '排序',
  `intro` text NOT NULL COMMENT '简介',
  `status` smallint(2) NOT NULL DEFAULT '0' COMMENT '审核状态:0未审核,1审核通过(解锁),2审核不通过(锁定)',
  `wechat_id` varchar(100) DEFAULT '' COMMENT '微信openid',
  `addtime` int(10) NOT NULL COMMENT '报名时间',
  `lockinfo` varchar(260) DEFAULT '' COMMENT '锁定后投票回复',
  `ed_dcount` text COMMENT '每天点击量',
  PRIMARY KEY (`id`),
  KEY `vid` (`vid`),
  CONSTRAINT `vid` FOREIGN KEY (`vid`) REFERENCES `vote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投票报名表';

-- ----------------------------
-- Table structure for `votelog`
-- ----------------------------
DROP TABLE IF EXISTS `votelog`;
CREATE TABLE `votelog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vid` int(10) NOT NULL COMMENT '活动id',
  `vtid` int(10) NOT NULL COMMENT '选手id',
  `openid` char(32) NOT NULL COMMENT '微信openId',
  `tp_num` int(11) NOT NULL COMMENT '投票数量',
  `tp_time` int(11) NOT NULL COMMENT '投票时间',
  PRIMARY KEY (`id`),
  KEY `votelog_ibfk_1` (`vid`),
  CONSTRAINT `votelog_ibfk_1` FOREIGN KEY (`vid`) REFERENCES `vote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投票记录表';

-- ----------------------------
-- Table structure for `votestatisticslog`
-- ----------------------------
DROP TABLE IF EXISTS `votestatisticslog`;
CREATE TABLE `votestatisticslog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vid` int(10) NOT NULL,
  `tj_time` int(11) NOT NULL COMMENT '统计日期',
  `total_votes` int(11) NOT NULL COMMENT '当天投票量',
  PRIMARY KEY (`id`),
  KEY `votestatisticslog_ibfk_1` (`vid`),
  CONSTRAINT `votestatisticslog_ibfk_1` FOREIGN KEY (`vid`) REFERENCES `vote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投票每日统计记表';

-- ----------------------------
-- Table structure for `votewxsz`
-- ----------------------------
DROP TABLE IF EXISTS `votewxsz`;
CREATE TABLE `votewxsz` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `vid` int(10) NOT NULL,
  `appid` char(18) NOT NULL COMMENT '公众号appId',
  `appsecret` char(32) NOT NULL COMMENT '公众号appSecret',
  PRIMARY KEY (`id`),
  KEY `votewxsz_ibfk_1` (`vid`),
  CONSTRAINT `votewxsz_ibfk_1` FOREIGN KEY (`vid`) REFERENCES `vote` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投票公众号';


