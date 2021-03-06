﻿-- MySQL dump 10.13  Distrib 5.5.37, for linux2.6 (x86_64)
--
-- Host: localhost    Database: boyicmsV10
-- ------------------------------------------------------
-- Server version	5.5.37-log

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
-- Table structure for table `ampnews`
--

DROP TABLE IF EXISTS `ampnews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ampnews` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `picurl` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `keywordid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ampnews`
--

LOCK TABLES `ampnews` WRITE;
/*!40000 ALTER TABLE `ampnews` DISABLE KEYS */;
/*!40000 ALTER TABLE `ampnews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=1033 DEFAULT CHARSET=utf8 COMMENT='在线提问表(回答表)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer`
--

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` VALUES (1032,1033,12,'sdafsdafsadf',1420447157,0,0,0);
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `department_id` (`department_id`),
  KEY `disease_id` (`disease_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2713 DEFAULT CHARSET=utf8 COMMENT='文章资讯表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (2707,'中秋佳节中正口腔优惠多','','中秋佳节中正口腔优惠多','<p style=\\\"line-height: 20.7999992370605px;\\\">每一个笑容都是一米阳光，每个人都期望可以无忧无虑快活生活着，但是缺牙，牙畸形的烦恼让笑容的变得&ldquo;含蓄&rdquo;，让快乐学会隐藏，让笑容变得尴尬，百合倾城岁月，牙齿矫正越早越好，所以福州<a href=\\\"http://www.zzckyy.com/\\\" target=\\\"_blank\\\">华南中正口腔医院</a>，立志让每一位患者拥有灿若朝阳的笑容&hellip;&hellip;</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">常见的牙齿畸形有牙齿排列不齐、上颌前突、下颌后缩，龅牙、地包天等，多发于青少年，如不能及时矫正牙齿，就会影响咀嚼功能，加重胃肠负担，从而影响身体健康、影响面容美观，还会发生龋齿和牙周病。此外，还对心理健康、工作生活及人际交往等产生诸多不利影响。&gt;&gt;&gt;牙齿畸形危害多，点击了解&lt;&lt;&lt;</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><strong>华南中正口腔医院2014年&ldquo;金秋九月，礼献师生&rdquo;优惠活动进行中，活动内容如下：</strong></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><strong>1、做种植牙存100元抵1000元，立即充值立即可以使用。(每人仅限存一次)</strong></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">推荐阅读：<a href=\\\"http://www.zzckyy.com/yczz/3830.html\\\">种植牙使用寿命有多久</a>&nbsp;|&nbsp;<a href=\\\"http://www.zzckyy.com/yczz/3831.html\\\">华南中正口腔无痛种植牙</a></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><strong>2、做牙齿矫正存100元抵1000元，立即充值立即可以使用。(每人仅限存一次)</strong></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">推荐阅读：<a href=\\\"http://www.zzckyy.com/ycjz/3871.html\\\">快速整形量牙定齿,无可挑剔</a>&nbsp;|&nbsp;<a href=\\\"http://www.zzckyy.com/ycjz/3878.html\\\">牙套矫正哪家医院最好</a></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><strong>3、优惠条件：凭教师证、学生证、大学录取通知书、退休证或关注微信，可参加该活动。</strong>&gt;&gt;&gt;了解更多详情</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">活动时间：2014年9月1日&mdash;&mdash;2014年9月30日</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><strong>【华南中正口腔医院】</strong></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">华南中正口腔医院是一家50年国际连锁品牌牙科机构，旗舰店位于福州市台江区二环南路37号(宝龙广场东南眼科旁)，追求品质与服务至上，让微笑更健康,提供高品质牙科服务。</p>\r\n\r\n<ul style=\\\"line-height: 20.7999992370605px;\\\">\r\n	<li>采用国际先进的医疗管理模式，建立了制度化的医疗质量管理和监督体系。</li>\r\n	<li>倡导&ldquo;家庭式私人牙医&rdquo;服务，先进的牙科医疗设备、严格的国际标准消毒程序、五年质量保证。</li>\r\n	<li>国家卫生部统一收费最低标准，价格公开透明，拒绝任何隐性消费。</li>\r\n	<li>提供专业的牙齿正畸、<a href=\\\"http://www.zzckyy.com/yczz/\\\" target=\\\"_blank\\\">牙齿种植</a>、牙齿美容、儿童牙科、牙齿修复、综合治疗等服务。</li>\r\n</ul>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">&nbsp;</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><strong>【如你想来华南中正看牙可以通过】&nbsp;</strong>&gt;&gt;&gt;在线免费咨询，专家为您制定诊疗方案&lt;&lt;&lt;</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">1、进入我院的官方网站或者WAP端网站进行在线咨询和预约;</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">2、拨打免费电话：<strong>0591-83828120</strong>;</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">3、添加QQ<strong>(188227077</strong><u><strong>)</strong></u>在线咨询;</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">4、微信<strong>(fzzzkqyy)</strong>在线咨询。</p>',63,'中秋佳节中正口腔优惠多','中秋佳节中正口腔优惠多','中秋佳节中正口腔优惠多',1419487060,0,47,77,20,NULL,1,5,'',1419498291),(2708,'氟斑牙对人体有什么影响','','','<p style=\\\"line-height: 20.7999992370605px;\\\">出现氟斑牙给人的形象损害比较大，更严重的是影响了身心健康;氟斑牙是牙齿颜色不好看症状当中比较典型的一种，是慢性氟中毒的早期常见的症状之一。那么，<strong>氟斑牙对人体有什么影响</strong>?华南中正口腔医院的专家为大家介绍介绍。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225140531837.jpg\\\" style=\\\"width: 300px; height: 200px;\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">氟斑牙对人体有什么影响?主要表现在以下这几个方面。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">1、氟斑牙属于色素牙的一种，一般呈黄色改变。在同一时期萌出的釉质上有白垩色到褐色的斑块，严重者还可并发牙釉质的实质缺损。临床上常按其轻、中、重度而分为白垩型(轻度)、着色型(中度)和缺损型(重度)三种类型。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">2、严重的慢性氟中毒患者，可发生骨骼的增殖性变化，骨膜、韧带等均可发生钙化，并从而产生腰、腿和全身关节症状。急性中毒症状表现为恶心、呕吐、腹泻等。由于血钙与氟结合，形成不溶性的氟化钙，引起肌痉挛、虚脱和呼吸困难，以致死亡。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">3、患者的牙齿对摩擦的耐受性较差，但对酸蚀的抵抗力很强。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">4、氟牙症一般均见于恒牙，发生在乳牙者很少，程度也很轻。但如氟摄入量过多，超过其筛除功能的限度时，也能不规则地表现在乳牙上。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(0, 0, 255);\\\">&gt;&gt;&gt;出现氟斑牙这种症状，可以去医院做牙齿美白。推荐阅读：</span><a href=\\\"/ycmb/fby/2579.html\\\" target=\\\"_blank\\\"><span style=\\\"color: rgb(0, 0, 255);\\\">氟斑牙如何美白</span></a><span style=\\\"color: rgb(0, 0, 255);\\\">&nbsp;&lt;&lt;&lt;</span></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">以上是福州牙科医院的专家为大家关于氟斑牙对人的影响所做的相关介绍，大家要稍微了解了解。氟斑牙对人体有什么影响?如果大家还有疑问的话，请点击<a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"color: rgb(0, 0, 255);\\\">在线咨询</span></a>，与专家在线沟通交流。</p>',82,'','','氟斑牙是牙齿颜色不好看症状当中比较典型的一种，是慢性氟中毒的早期常见的症状之一；出现氟斑牙给人的形象损害比较大，更严重的是影响了身心健康。那么，氟斑牙对人体有什么影响？看看专家的介绍。',1419487458,0,41,66,18,NULL,1,5,'',1419574927),(2709,'氟斑牙用什么方法美白比较好','','','<p>很多人在生活当中苦于自己的氟斑牙的影响，甚至出现了对生活的积极性。氟斑牙是牙齿变色的一种典型表现，它的存在给人们的生活及社交带来了烦恼。那么，<strong>氟斑牙用什么方法美白比较好?</strong>华南中正口腔医院的专家为大家介绍介绍。</p>\r\n\r\n<p style=\\\"text-align: center;\\\"><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225140908686.jpg\\\" style=\\\"width: 130px; height: 100px;\\\" /></p>\r\n\r\n<p>氟斑牙用什么方法美白比较好?下面大家一起了解一下。</p>\r\n\r\n<p><span style=\\\"color:#b22222;\\\">一、轻度氟斑牙可以采用美国冷光美白技术。</span></p>\r\n\r\n<p>美国冷光美白技术，是一项正流行于欧美的最新兴的牙齿美白技术，它将高强度冷光定点照射，它不仅可以去除牙齿表面的色素沉积，及深层所附着的色素，美白效果持久有效，具有持久、自然、快速、专业、安全等五大优势。</p>\r\n\r\n<p><span style=\\\"color:#b22222;\\\">二、重度氟斑牙可以采用德国3D美容冠技术。</span></p>\r\n\r\n<p>美容冠为近年由欧美引入的新兴美齿技术，针对成人，对龅牙、排列歪斜牙、畸形牙以及色素牙，可彻底、快速矫正修复，无需拔牙，全程无痛。生物相容性好，牙龈不会出现黑线，是目前牙齿修复的最佳技术之一。</p>\r\n\r\n<p><span style=\\\"color:#0000ff;\\\">&gt;&gt;&gt;氟斑牙美白的价格也许是大家关注的焦点。推荐阅读：</span><a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"color:#0000ff;\\\">氟斑牙的价格</span></a><span style=\\\"color:#0000ff;\\\"> &lt;&lt;&lt;</span></p>\r\n\r\n<p>以上是福州牙科医院的专家给大家介绍的关于氟斑牙的美白方法，大家应该也了解了吧?氟斑牙用什么方法美白比较好?如果大家还有疑问的话，请点击<a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"color:#0000ff;\\\">在线咨询</span></a>，与专家在线沟通交流。</p>',66,'氟斑牙用什么方法美白比较好','氟斑牙美白方法,氟斑牙如何美白','氟斑牙是牙齿变色的一种典型表现，它的存在给人们的生活及社交带来了烦恼；很多人在生活当中苦于自己的氟斑牙的影响，甚至出现了对生活的积极性。那么，氟斑牙用什么方法美白比较好？看看专家的介绍。',1419487759,0,41,65,15,NULL,0,5,'',1419492576),(2710,'氟斑牙要如何治疗呢','','','<p>氟斑牙是一种由于摄入氟化物含量过高所引起牙齿着色的疾病，这种疾病可分为白垩型(轻度)，着色型(中度)，缺损型(重度)三种。不同程度的症状其美白方法不同。</p>\r\n\r\n<p><strong>1.白垩型(轻度)：</strong>牙齿上有白色条纹或不规则散布的小面积不透明区，但整个面积不超过牙面的1/2。</p>\r\n\r\n<p><span style=\\\"color: #ff0000\\\">治疗可采用冷光美白技术</span>。冷光美白是利用高强度蓝光照射美白剂，使其作用于牙齿上，快速产生氧化还原作用，从而去除牙齿表面及深层所附着的色素。达到美白效果。对于轻度氟斑牙治疗具有治疗时间短、见效快、对牙齿无损伤、无副作用等优点。&gt;&gt;&gt;<span style=\\\"color: #ff0000\\\">推荐阅读：</span><a href=\\\"/ycmb/lgmb/2440.html\\\"><span style=\\\"color: #ff0000\\\">冷光美白牙齿效果好不好</span></a></p>\r\n\r\n<p><strong>2.着色型(中度)：</strong>牙齿有大面积的着色状况，出现黄色、灰褐色等情况。</p>\r\n\r\n<p><span style=\\\"color: #ff0000\\\">治疗可采用瓷贴面技术</span>。瓷贴面是指在少磨牙的情况下，用粘接材料固定于需要治疗的牙齿上，遮盖牙齿变色来恢复牙齿美观的一种修复方法。具有耐磨损，对牙髓刺激小，颜色稳定、美观等特点。</p>\r\n\r\n<p><strong>3.缺损型(重度)：</strong>牙齿上出现缺损，具有严重发育不全，牙齿表面着色非常明显。</p>\r\n\r\n<p><span style=\\\"color: #ff0000\\\">治疗可采用美容冠技术</span>。美容冠是在不损伤牙齿内部结构的前提下根据牙槽骨的形态对牙齿做修整，用不伤牙齿的材料与牙齿紧密结合，达到牙齿整齐美观的效果。具有修复牙齿不拔牙、不伤牙等优点。</p>\r\n\r\n<p>以上是华南中正口腔医院专家针对氟斑牙要如何美白的介绍，氟斑牙不仅影响我们的容貌美观，严重的氟斑牙还对人体会造成很大的危害，患者一定要引起重视。如果发现患有氟斑牙，一定要及时选择到正规医院进行美白治疗，如果想了解更多关于氟斑牙美白问题，可以通过<a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"color: #ff0000\\\">免费在线咨询</span></a>，和我们的专家进行交流。</p>',68,'氟斑牙要如何治疗呢','氟斑牙要如何治疗呢','氟斑牙是一种由于摄入氟化物含量过高所引起牙齿着色的疾病，这种疾病可分为白垩型(轻度)，着色型(中度)，缺损型(重度)三种。轻度可采用冷光美白治疗，中度可采用瓷贴面治疗，重度可采用美容冠治疗。以下是华南中正口腔医院专家的具体介绍。',1419487866,0,41,66,18,NULL,1,5,'',1419574911),(2711,'龅牙矫正的注意事项有哪些','','华南中正口腔诊所','<p style=\\\"line-height: 20.7999992370605px;\\\">现在，人们的口腔问题越来越多，都没有及时的去医院治疗。今天在我院进行完牙齿矫正后的患者想我院专家问到，龅牙矫正的注意事项?为了解决和着我患者一样的疑惑，我院专家为您做了如下详细介绍。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/2014122514355544.jpg\\\" style=\\\"width: 600px; height: 470px;\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">福州普尔口腔医院专家介绍：</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">龅牙是常见的一种牙齿畸形，严重情况下影响咬合能力，造成牙齿松动、脱落，所以要尽快进行矫正，并且在进行牙齿矫正的时候要遵循它的注意事项，这样才能更安全、有效的对您进行治疗。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">1、从自身角度看问题：现如今，医学技术不断发展，对于牙齿矫正的方法也有很多，面对这种问题，一定要结合自身的实际情况出发，不然对于正畸的效果和安全会存在威胁。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">2、矫正选择正规的医院：要选择一家专业的牙科医院进行矫正治疗，在正规医院中花费的金钱不一定会多，但是一定会保证矫正过程中的安全，不会造成牙齿各种牙病，更安全。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">3、饮食卫生要注意：在牙齿矫正期间是不能吃太硬的食物，吃完东西要积极漱口，不能有残留的牙渍，不然对牙齿的安全和健康不好。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">美国3M陶瓷托槽有如下优点：</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">1、外形小巧，隐形，美观。陶瓷具有与牙齿一样的颜色，陶瓷托槽的美观、隐蔽性是其最大的优点。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">2、抗张强度高，不易变形。这不仅保证了托槽的槽沟通过弓丝能长时间维持足够的矫治力，且使得托槽可以重复利用。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">3、生物相容性好，安全性好。陶瓷的生物惰性使得其无毒、无害，更利于口腔健康。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">4、内衬金属槽沟，强固托槽，并有助于钢丝自由滑动，提高治疗效果。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">5、特殊设计的边缘斜面及翼展，使佩带更舒适，牵引更方便。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">牙齿矫正期间注意事项</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">1、注意口腔卫生：戴用活动矫治器或固定矫治器都要保持口腔卫生，尤其是固定矫治器，因为矫治器粘固在牙齿上，不能取下刷牙，且矫治器周围极易存留食物残渣，造成细菌大量繁殖，易形成龋齿及牙跟炎。所以，患者要养成饭后刷牙的习惯，每次刷牙不少于5分钟，采用横竖交替法，使用含氟牙膏。活动矫治器也要用牙膏刷洗干净，以免形成牙锈。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">2、牙齿正畸期间不要吃硬食、熟食：固定矫治器是用教固剂将矫治器粘结到牙齿上，病人不能进食过硬及较熟的食物。以免损坏矫治器零件，使矫治力量中断，延长疗程。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">3、定期复诊：牙齿正畸治疗需要不断加力调整，因此需要病人不断复诊。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">福州普尔口腔医院温馨提示：当下越来越多的人面临牙齿问题的困扰。如果有一天自己年老了，没有健康的牙齿，连吃饭都困难的话得有多辛酸。福州普尔口腔医院&ldquo;美国3M陶瓷托槽&rdquo;是最好礼物，重新给你有生命的牙齿。</p>',44,'龅牙矫正的注意事项有哪些','龅牙矫正的注意事项有哪些','现在，人们的口腔问题越来越多，都没有及时的去医院治疗。今天在我院进行完牙齿矫正后的患者想我院专家问到，龅牙矫正的注意事项?',1419489403,0,43,75,19,NULL,0,5,'',1419490471),(2712,'矫正歪牙要做什么检查？','','中正','<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\"><strong>矫正歪牙要做什么检查？</strong>中正齿科医院专家指出，现在越来越多的中小学生牙齿出现畸形的情况，面对这些情况，家长首先的最好的办法就是做牙齿矫正，那么选择牙齿矫正，在做矫正歪牙前要做哪些检查呢？牙齿矫正前一般需做如下检查：</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">1、咬牙印：（即取模型）用于医生对错和情况进行诊断和设计和在以后的治疗过程中作对比检查。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">2、照相：治疗前医生要常规给患者照面部照片和牙合的照片，留待日后与治疗结束时作对比。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">3、X线检查：每个患者常规拍摄头颅侧位片和全口曲面断层片。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">4、制定治疗计划：医生根据模型，照片和X线片，经过测量，计算，诊断错合类型，并且制定出一个详细的治疗方案。然后医生向患者及患者家属解释治疗方案，征求患者及家属的意见。治疗方案确定后，患者或患者家属在同意书上签字。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">5、具体治疗过程。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">6、治疗结束后去除矫治器，戴上保持器。</p>',35,'矫正歪牙要做什么检查？','矫正歪牙要做什么检查，矫正歪牙前的检查','矫正歪牙要做什么检查？咬牙印：（即取模型）用于医生对错和情况进行诊断和设计和在以后的治疗过程中作对比检查。照相：治疗前医生要常规给患者照面部照片和牙合的照片，留待日后与治疗结束时作对比。',1419489546,0,43,76,19,NULL,1,5,'',1419493106);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ask`
--

DROP TABLE IF EXISTS `ask`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `isdisplay` tinyint(1) unsigned DEFAULT '0' COMMENT '是否显示，1显示，0不显示，默认不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1034 DEFAULT CHARSET=utf8 COMMENT='在线提问表(主表)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask`
--

LOCK TABLES `ask` WRITE;
/*!40000 ALTER TABLE `ask` DISABLE KEYS */;
INSERT INTO `ask` VALUES (1032,1419929533,'fdsf','fff',1,0,'218.104.231.43',0,5,45,81),(1033,1420442408,'momo','牙齿疼痛',1,1420447157,'218.104.231.42',1,5,45,81);
/*!40000 ALTER TABLE `ask` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `askaddto`
--

DROP TABLE IF EXISTS `askaddto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `askaddto` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mode` tinyint(3) unsigned DEFAULT NULL,
  `ask_id` int(10) unsigned DEFAULT NULL COMMENT '问题唯一编码id',
  `ans_id` int(10) unsigned DEFAULT NULL COMMENT '问题回答外键id',
  `info` text COMMENT '回复或追问内容',
  `plushtime` int(11) unsigned DEFAULT NULL COMMENT '回复或追问时间',
  `useful` int(10) unsigned DEFAULT NULL COMMENT '顶',
  `useless` int(10) unsigned DEFAULT NULL COMMENT '踩',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='在线提问表(追问回复)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `askaddto`
--

LOCK TABLES `askaddto` WRITE;
/*!40000 ALTER TABLE `askaddto` DISABLE KEYS */;
INSERT INTO `askaddto` VALUES (1,0,1033,1032,'sdafsdfsadf',1420447318,0,0);
/*!40000 ALTER TABLE `askaddto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `askassay`
--

DROP TABLE IF EXISTS `askassay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `askassay` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增id',
  `ask_id` int(10) unsigned DEFAULT NULL COMMENT '问题主键id',
  `item` varchar(255) DEFAULT NULL COMMENT '检验项目集合',
  `consult` varchar(255) DEFAULT NULL COMMENT '参考值集合',
  `unit` varchar(255) DEFAULT NULL COMMENT '单位集合',
  `finally` varchar(255) DEFAULT NULL COMMENT '结果值集合',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='在线提问表(详情表)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `askassay`
--

LOCK TABLES `askassay` WRITE;
/*!40000 ALTER TABLE `askassay` DISABLE KEYS */;
INSERT INTO `askassay` VALUES (2,1032,'','','',''),(3,1033,'{血液}','{2.0}','{g/L}','{1.0}');
/*!40000 ALTER TABLE `askassay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `askdesc`
--

DROP TABLE IF EXISTS `askdesc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `askdesc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键自增id',
  `ask_id` int(10) unsigned DEFAULT NULL COMMENT '问题主键id',
  `description` varchar(255) DEFAULT NULL COMMENT '问题详细描述',
  `phone` char(30) DEFAULT NULL COMMENT '联系方式',
  `history` text COMMENT '疾病历史',
  `condtion` varchar(255) DEFAULT NULL COMMENT '目前治疗情况',
  `click_count` tinyint(3) unsigned DEFAULT NULL COMMENT '问题点击量',
  `city` varchar(50) DEFAULT NULL COMMENT '患者城市',
  `pic1` varchar(50) DEFAULT NULL COMMENT '图片1',
  `pic2` varchar(50) DEFAULT NULL COMMENT '图片2',
  `pic3` varchar(50) DEFAULT NULL COMMENT '图片3',
  `age` int(3) unsigned DEFAULT NULL COMMENT '患者年龄',
  `gender` tinyint(3) unsigned DEFAULT NULL,
  `doctor` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1034 DEFAULT CHARSET=utf8 COMMENT='在线提问表(化验单)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `askdesc`
--

LOCK TABLES `askdesc` WRITE;
/*!40000 ALTER TABLE `askdesc` DISABLE KEYS */;
INSERT INTO `askdesc` VALUES (1032,1032,'ffff',NULL,NULL,NULL,69,'福州','','','',33,0,0),(1033,1033,'牙齿疼痛！',NULL,NULL,NULL,60,'福州','','','',18,1,0);
/*!40000 ALTER TABLE `askdesc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buisness`
--

DROP TABLE IF EXISTS `buisness`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buisness` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `swt_id` varchar(50) NOT NULL COMMENT '商务通ID',
  `url` varchar(100) NOT NULL COMMENT '商务通指向地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商务通表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buisness`
--

LOCK TABLES `buisness` WRITE;
/*!40000 ALTER TABLE `buisness` DISABLE KEYS */;
/*!40000 ALTER TABLE `buisness` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '栏目名称',
  `url` varchar(200) DEFAULT NULL COMMENT 'URL名称',
  `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否使用 1是 0否',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='栏目表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channel`
--

DROP TABLE IF EXISTS `channel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `name` varchar(100) NOT NULL COMMENT '频道名称',
  `shortname` varchar(10) DEFAULT NULL COMMENT '短名称',
  `is_use_tpl` tinyint(3) unsigned DEFAULT NULL,
  `tplurl` varchar(255) DEFAULT NULL,
  `detailtplurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='自定义频道表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channel`
--

LOCK TABLES `channel` WRITE;
/*!40000 ALTER TABLE `channel` DISABLE KEYS */;
INSERT INTO `channel` VALUES (26,'特色频道','tesepindao',0,'tpldir/channel/list.htpl','tpldir/channel/detail.htpl');
/*!40000 ALTER TABLE `channel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channelarticle`
--

DROP TABLE IF EXISTS `channelarticle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channelarticle` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `subject` varchar(120) NOT NULL COMMENT '标题字段',
  `pic` varchar(200) DEFAULT NULL COMMENT '标题图片字段',
  `source` varchar(255) DEFAULT NULL COMMENT '文章来源',
  `content` text NOT NULL COMMENT '内容',
  `title` varchar(120) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `plushtime` int(10) NOT NULL COMMENT '发布时间字段',
  `click_count` int(11) NOT NULL DEFAULT '31' COMMENT '点击量',
  `channel_id` int(11) unsigned DEFAULT NULL,
  `updatetime` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_channelarticle_channel` (`channel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='频道文章表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channelarticle`
--

LOCK TABLES `channelarticle` WRITE;
/*!40000 ALTER TABLE `channelarticle` DISABLE KEYS */;
INSERT INTO `channelarticle` VALUES (8,'特色dasd','','特色','<p>特色dsad</p>','特色','特色','特色das',1419558842,0,26,1419933975);
/*!40000 ALTER TABLE `channelarticle` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '科室名称',
  `url` varchar(200) DEFAULT NULL COMMENT '科室URL名称',
  `title` varchar(100) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `tplurl` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='科室表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (41,'牙齿美白','yachimeibai','美白牙齿','美白牙齿','福州怎样才能美白牙齿？福州牙齿怎样美白？福州华南中正口腔医院采用烤瓷牙、冷光美白的方式进行牙齿美白。福州牙齿黄美白多少钱与选择的牙齿美白方法、美白医生及医院等有关，可免费在线咨询预约。',''),(42,'牙齿种植','yachizhongzhi','牙齿种植','牙齿种植','牙齿种植',''),(43,'牙齿矫正','ycjz','福州牙齿矫正价格_牙齿矫正时间_隐形牙齿矫正','福州牙齿矫正价格,福州牙齿矫正时间,福州隐形牙齿矫正','牙齿畸形、牙错位可采用福州隐形牙齿矫正，福州牙齿矫正价格与选择的矫正器、医生等因素有关。福州牙齿矫正时间一般在1-2年，福州华南中正口腔医院开设在线咨询预约服务，为您解答各种口腔问题。',''),(44,'牙齿修复','yacxf','福州牙齿烤瓷修复_修复牙齿要多少钱_牙齿开裂可以修复吗','福州牙齿烤瓷修复,福州修复牙齿要多少钱,福州牙齿开裂可以修复吗','福州华南中正口腔，专注口腔健康问题47年，为福州的朋友介绍福州牙齿烤瓷修复、福州修复牙齿要多少钱、福州牙齿开裂可以修复吗等牙齿修复问题，福州口腔医院为您提供贴心服务。美牙热线：0591－83828120',''),(45,'牙齿治疗','yczl','福州牙齿根管治疗_牙齿脱敏治疗_华南中正牙科医院','福州牙齿根管治疗,福州牙齿脱敏治疗','福州牙齿根管治疗，福州牙齿脱敏治疗是牙齿治疗的两种主要技术，普遍用于治疗牙髓炎，牙周炎，牙齿过敏，蛀牙等牙齿疾',''),(46,'牙周预防','yzfy','福州牙周炎牙齿松怎么办_牙周炎怎么治疗_怎么预防牙周炎','福州牙周炎牙齿松怎么办,福州牙周炎怎么治疗,福州怎么预防牙周炎','常见的牙周疾病有：牙周炎、牙龈炎、牙周创伤、口腔溃疡等。福州牙周炎牙齿松怎么办？福州牙周炎怎么治疗？福州怎么预防牙周炎，福州华南中正口腔医院美牙热线：0591－83828120可免费在线咨询预约。',''),(47,'儿童齿科','etck','什么样的牙齿适合做窝沟封闭呢？','福州儿童牙齿矫正最佳年龄,福州孩子蛀牙疼怎么办,福州儿童牙齿矫正费用','儿童时期是福州儿童牙齿矫正最佳年龄，福州儿童牙齿矫正费用与选择的矫正器等因素有关，福州孩子蛀牙疼怎么办？中正牙科医院特设儿童齿科，多位儿童齿科诊疗经验丰富的专家长期坐诊，为您的孩子设计最佳的牙齿矫正方案。','');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='医院设备表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device`
--

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;
INSERT INTO `device` VALUES (6,'中正牙科设备四：德国3D齿雕美牙系统','device/20141225104419886.jpg','<p>中正牙科设备四：德国3D齿雕美牙系统</p>','','','',NULL,1419475470,48),(7,'中正牙科设备三：BEYOND冷光美白仪','device/20141225105734115.jpg','<p>BEYOND冷光美白仪</p>','BEYOND冷光美白仪','中正牙科设备三：BEYOND冷光美白仪','北京医师协会高血压专委会青年委员会在解放军总医院成立',NULL,1419476271,79),(8,'中正牙科设备二：三次预真空消毒机','device/20141225110143894.jpg','<p><span style=\\\"line-height: 20.7999992370605px;\\\">三次预真空消毒机</span></p>','三次预真空消毒机','中正牙科设备二：三次预真空消毒机','中正引进MJQ- 三次预真空消毒机，对所有牙科手术器械进行严格消毒。确保手术在健康无菌的环境下进行，杜绝感染。',NULL,1419476521,69);
/*!40000 ALTER TABLE `device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disease`
--

DROP TABLE IF EXISTS `disease`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `layer` int(3) unsigned DEFAULT '0',
  `parent_id` int(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_disease_departments` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8 COMMENT='疾病表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disease`
--

LOCK TABLES `disease` WRITE;
/*!40000 ALTER TABLE `disease` DISABLE KEYS */;
INSERT INTO `disease` VALUES (65,'冷光美白','lgmb','福州牙齿冷光美白_牙齿冷光美白价格_冷光美白多少钱','福州牙齿冷光美白,福州牙齿冷光美白价格,福州冷光美白多少钱','福州冷光美白是目前有效及安全的牙齿美白方法,30分钟即可恢复美白牙齿。福州牙齿冷光美白价格与多种因素有关，福州华南中正口腔医院专家告诉我们福州冷光美白多少钱与选择的牙齿美白方法、美白医生及医院等有关，可免费在线咨询预约。',41,'','',0,0),(66,'氟斑牙','fubanya','','','福州氟斑牙可以变白吗是大家关心的问题，氟斑牙与饮用水中氟含量过高有关的牙',41,'','',0,0),(67,'多数牙缺失','duoshuyaqueshi','','','多数牙缺失',42,'','',0,0),(68,'种植牙先进技术','zzyxjjs','种植牙先进技术','福州种植牙先进技术,福州诺贝尔种植系统,福州奥齿泰种植系统','华南中正口腔，专注口腔健康问题47年，为福州的朋友介绍诺贝尔种植系统、奥齿泰种植系统、ITI种植系统、费亚丹种植系统等种植牙先进技术，福州口腔医院为您提供贴心服务。',42,'','',0,0),(69,'美白价格','mbjg','福州把牙齿美白要多少钱','福州牙齿美白多少钱,福州美白牙齿大概多少钱,福州把牙齿美白要多少钱','福州牙齿美白多少钱，福州美白牙齿大概多少钱，福州华南中正口腔医院专家告诉我们福州把牙齿美白要多少钱与多种因素有关，比如选择牙齿美白与选择的牙齿美白方法、美白医生及医院等有关，如有口腔问题可免费在线咨询预约。',41,'','',0,0),(70,'种植牙价格','zzyjg','福州种植牙贵吗_种植牙价位_种植牙一般多少钱','福州种植牙贵吗,福州种植牙价位,福州种植牙一般多少钱','种植牙可以有效修复牙齿，福州种植牙贵吗？福州种植牙价位是怎样的，福州华南中正口腔医院专家告诉我们福州种植牙一般多少钱需要结合患者的口腔情况，选择的材料等有关，华南中正口腔提供在线咨询预约服务，美牙咨询热线：0591－83828120',42,'','',0,0),(71,'矫正年龄','jznl','福州牙齿矫正最佳年龄_牙齿矫正的最佳时期_牙齿矫正适合年龄','福州牙齿矫正最佳年龄,福州牙齿矫正的最佳时期,福州牙齿矫正适合年龄','福州牙齿矫正最佳年龄是在12岁左右儿童发育期，通常在福州牙齿矫正的最佳时期进行牙齿矫正不仅效果好而且费用低。福州华南中正口腔医院是福州专业的口腔医院，专家建议做牙齿矫正在福州牙齿矫正适合年龄。',43,'','',0,0),(72,'牙错位','ycw','福州牙错位怎么办_孩子牙齿错位_什么是牙错位','福州牙错位怎么办,福州孩子牙齿错位,福州什么是牙错位','福州牙齿错位怎么办?歪歪扭扭的牙齿，叫人看上去会觉得很别扭，甚至会受到别人很异样的眼光。华南中正口腔专注口腔健康问题47年，为您提供贴心服务。美牙热线：0591－83828120',43,'','',0,0),(73,'前牙开合','qykh','福州前牙开合_前牙开合怎么办_牙齿开合怎么治疗','福州前牙开合,福州前牙开合怎么办,福州牙齿开合怎么治疗','福州前牙开合怎么办？福州华南中正口腔医院根据患者开合形成的机制、患者的生理年龄，采用最合适的矫治方法。福州牙齿开合怎么治疗？通过对前段及后段牙、牙槽垂直向及水平向位置的调整，达到解除或改善开合的目的。',43,'','',0,0),(74,'牙列拥挤','ylyj','福州牙列拥挤矫治术_牙列拥挤的危害_牙列拥挤如何治疗','福州牙列拥挤矫治术,福州牙列拥挤的危害,福州牙列拥挤如何治疗','福州牙列拥挤矫治术有哪些？福州华南中正口腔医院专家告诉我们福州牙列拥挤的危害很大，不仅会导致饮食不正常同时会影响周边的牙齿。福州牙列拥挤如何治疗，可通过在线咨询预约华南中正口腔医院美牙热线：0591－83828120',43,'','',0,0),(75,'龅牙','by','福州龅牙矫正最佳年龄_矫正龅牙要多少钱_龅牙矫正手术多少钱','福州龅牙矫正最佳年龄,福州矫正龅牙要多少钱,福州龅牙矫正手术多少钱','患有龅牙会影响到我们的美观问题，福州龅牙矫正最佳年龄是在12岁左右，福州矫正龅牙要多少钱并非固定，需要结合患者选择的矫正器等综合考虑。福州华南中正口腔医院开设在线咨询预约服务，解答患者福州龅牙矫正手术多少钱等问题。',43,'','',0,0),(76,'歪牙','wy','福州歪牙矫正_牙长歪了怎么办_牙齿长歪修复','福州歪牙矫正,福州牙长歪了怎么办,福州牙齿长歪修复','福州歪牙长歪了怎么办？福州牙齿长歪修复如何修复，福州华南中正口腔医院采用隐形矫正、烤瓷牙等方式矫正歪牙。问您解决福州歪牙矫正问题。美牙热线：0591－83828120',43,'','',0,0),(77,'窝沟封闭','wgfb','福州牙齿窝沟封闭多少钱_什么叫窝沟封闭_儿童牙齿窝沟封闭','福州牙齿窝沟封闭多少钱,福州什么叫窝沟封闭,福州儿童牙齿窝沟封闭','福州什么叫窝沟封闭，福州儿童牙齿窝沟封闭是针对牙齿发育时候的儿童进行的一种能有效增强牙齿抗龋能力的技术。福州牙齿窝沟封闭多少钱与选择的材料和医生技术有关，中正引进国际最新高分子复合树脂材料，无任何副作用，让您的孩子高效安全的得到治疗。',47,'','',0,0),(78,'牙周炎','yzy','福州牙周炎是怎么形成的','福州牙周炎是怎么形成的,福州怎样治疗牙周炎,福州牙周炎治疗方法','福州牙周炎是怎么形成的？牙石、菌斑等都是导致牙周炎的原因。福州怎样治疗牙周炎，福州牙周炎要多少钱需要与患者的病情及选择的治疗方法有关。福州华南中正口腔医院美牙热线：0591－83828120可免费在线咨询预约。',46,'','',0,0),(79,'瓷贴面','tcm','福州全瓷贴面多少钱_瓷贴面和烤瓷牙价格_全瓷贴面的价格','福州全瓷贴面多少钱,福州瓷贴面和烤瓷牙价格,福州全瓷贴面的价格','福州瓷贴面采用先进的粘结技术将瓷修复材料粘结覆盖其表面,福州全瓷贴面多少钱？福州瓷贴面和烤瓷牙价格是怎样的, 福州华南中正口腔医院专家告诉我们福州瓷贴面的价格要综合考虑，可免费在线咨询预约。',41,'','',0,0),(80,'小儿正畸','xezj','福州儿童牙齿正畸治疗_牙齿正畸的最佳年龄_牙齿正畸多少钱','福州儿童牙齿正畸治疗,福州牙齿正畸的最佳年龄,福州牙齿正畸多少钱','福州儿童牙齿正畸治疗，一般来说12~15岁的孩子是福州儿童正畸的最佳年龄。因此，对牙齿已发育畸形的，应及早到医院进行正畸治疗。福州牙齿正畸多少钱需要综合多种因素考虑。华南中正口腔医院美牙咨询线：0591－83828120',47,'','tpldir/disease/xezj.htpl',0,0),(81,'蛀牙','zy','福州儿童龋齿如何治疗_小孩蛀牙怎么办_龋齿补牙多少钱','福州儿童龋齿如何治疗,福州小孩蛀牙怎么办,福州龋齿补牙多少钱','龋齿俗称“虫牙”、“蛀牙”，是人类发病率极高的疾',45,'','',0,0);
/*!40000 ALTER TABLE `disease` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '医生名称',
  `pic` varchar(200) NOT NULL COMMENT '医生照片',
  `birthday` date NOT NULL COMMENT '生日',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别 0男 1女',
  `content` text,
  `certificate` varchar(200) NOT NULL COMMENT '资格证(图片)',
  `specialty` varchar(50) NOT NULL COMMENT '擅长领域',
  `cultural` varchar(50) NOT NULL COMMENT '学历',
  `university` varchar(50) NOT NULL COMMENT '毕业院校',
  `title` varchar(100) DEFAULT NULL COMMENT '三要素-标题',
  `keywords` varchar(160) DEFAULT NULL COMMENT '三要素-关键字',
  `description` text COMMENT '三要素-描述',
  `department_id` int(11) unsigned DEFAULT NULL,
  `plushtime` char(10) DEFAULT NULL,
  `click_count` int(11) DEFAULT NULL,
  `reserv_id` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '关联预约表中的医生id',
  `position` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_doctor_department` (`department_id`),
  CONSTRAINT `cons_fk_doctor_department_id_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='医生表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (15,'黄淑婷','doctor/20141225162340416.png','1986-07-16',0,'<p><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225141715938.png\\\" style=\\\"width: 523px; height: 366px;\\\" /></p>\r\n\r\n<div>\r\n<p>毕业于山东大学（原山东医科大学）</p>\r\n\r\n<p>服务宗旨：精于齿道 尊崇全人健康，重塑自信笑容</p>\r\n\r\n<p>曾 在山东大学附属医院实习进修牙体牙髓，牙周及口腔修复。师从韩凉、王建宁教授，毕业后曾在省三甲口腔医院从事临床工作多年，曾被指派到台湾医科大学附设医 院进修，在此期间掌握了扎实基础，任中华口腔医学会口腔修复专业委员会常委。擅长牙体缺损分层术脂及固定烤瓷牙的美学修复、冷光美白、牙周病的基础治疗 等。熟练掌握无痛麻醉技术，让患者在轻松的状态下解决病痛。</p>\r\n</div>','','擅长牙体缺损分层术脂及固定烤瓷牙的美学修复、冷光美白、牙周病的基础治疗等。熟练掌握无痛麻醉技术','本科','山东大学','黄淑婷','黄淑婷,','福州冷光美白是目前有效及安全的牙齿美白方法,30分钟即可恢复美白牙齿。福州牙齿冷光美白价格与多种因素有关，福州华南中正口腔医院专家告诉我们福州冷光美白多少钱与选择的牙齿美白方法、美白医生及医院等有关，可免费在线咨询预约。',41,'1419476866',97,'主管医师'),(16,'李荣权','doctor/20141226114021149.gif','1979-04-09',1,'<p style=\\\"line-height: 20.79px;\\\"><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225134024926.jpg\\\" style=\\\"width: 88px; height: 96px;\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.79px;\\\">李荣权，中正口腔特聘韩国专家，口腔科医学博士，毕业于延世大学齿科大学毕业，同时也是嶺南大学医科大学齿科学外来教授，在口腔美容整形方面具有精深的研究，其精湛的技术获得了业内的一致认可！</p>\r\n\r\n<p style=\\\"line-height: 20.79px;\\\">李荣权博士是韩国口腔美容整形最一流的专家，拥有丰富的临床经验，是韩国齿科种植学术研究会正式会员、韩国颌面整形重建外科学会正式会员，承认医师、韩国齿科收复学会会员、韩国口腔颌面整形外科学会会员，多年来已经为无数的顾客重新获得了美丽与健康！</p>\r\n\r\n<p style=\\\"line-height: 20.79px;\\\">李荣权博士精湛的口腔科专业技术，结合中正口腔最新引进的国际一流设备，对口腔整形美容的完美进行做了最佳保证，一定能够及时为您提供最满意的服务！</p>','','在口腔美容整形方面具有精深的研究','博士','延世大学齿科大学','','','李荣权，中正口腔特聘韩国专家，口腔科医学博士，毕业于延世大学齿科大学毕业，同时也是嶺南大学医科大学齿科学外来教授，在口腔美容整形方面具有精深的研究，其精湛的技术获得了业内的一致认可！',41,'1419477338',66,'主任'),(17,'张胜利','doctor/20141225112408418.jpg','1980-12-18',1,'<p><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225134002730.jpg\\\" style=\\\"width: 200px; height: 200px;\\\" /></p>\r\n\r\n<p>张胜利，中正口腔顾问。韩国YE牙科驻中国技术总监、韩国新丘大学口腔修复学教授、Mass.波斯顿种植体学会会员、ROK.AIC种植体研究会会员、ROK.口腔审美修复学会会员。专注仿真牙牙齿美容修复、种植全科、口腔正畸、各种牙病治疗及诊断。</p>','','专注仿真牙牙齿美容修复、种植全科、口腔正畸、各种牙病治疗及诊断','本科','韩国新丘大学','','','专注仿真牙牙齿美容修复、种植全科、口腔正畸、各种牙病治疗及诊断',42,'1419477494',76,'主管医师'),(18,'张刚','doctor/2014122513464418.jpg','1980-07-25',1,'<p><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225141901718.jpg\\\" style=\\\"cursor: pointer; line-height: 20.7999992370605px; height: 270px; width: 230px;\\\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\\\"line-height: 20.7999992370605px;\\\">拥有超过6000例的种植体案例，中国福建省口腔医学会顾问。现任德国KONUS种植系统技术总监，，韩国OSSTEM种植系统公司中国首席技术顾问、讲师。研修了德国Friadent Implant Training课程，韩国首尔CATHOLIC大学口腔外科，美国审美齿科学会Training 课程。</span></p>','','牙齿美白','无','无','','','拥有超过6000例的种植体案例，中国福建省口腔医学会顾问。现任德国KONUS种植系统技术总监，，韩国OSSTEM种植系统公司中国首席技术顾问、讲师。',41,'1419486514',33,'主管医师'),(19,'陈晶晶','doctor/20141225141950192.gif','1986-07-08',0,'<p><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225142003991.gif\\\" style=\\\"width: 200px; height: 200px;\\\" /></p>\r\n\r\n<div style=\\\"line-height: 20.7999992370605px;\\\">陈晶晶<br />\r\n&nbsp;</div>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">医生简介：毕业于福建医科大学口腔医学院（口腔正畸学方向），医学硕士，福建省口腔正畸专业委员会委员，中华口腔医学会正畸专业委员会会员，曾在《临床口腔医学杂志》等国内外核心期刊发表多篇专业论文，多次参加国内口腔正畸学术会议，参加TWEED技术学习班，在口腔正畸学的诊疗上有着扎实的理论功底和丰富的临床经验，擅长儿童及成人各类错牙合畸形的正畸治疗、包括牙列拥挤、牙列稀疏、开牙合、反牙合等牙颌畸形的治疗</p>\r\n\r\n<p>&nbsp;</p>','','擅长儿童及成人各类错牙合畸形的正畸治疗、包括牙列拥挤、牙列稀疏、开牙合、反牙合等牙颌畸形的治疗','硕士','福建医科大学口腔医学院','陈晶晶','陈晶晶,','福州歪牙长歪了怎么办？福州牙齿长歪修复如何修复，福州华南中正口腔医院采用隐形矫正、烤瓷牙等方式矫正歪牙。问您解决福州歪牙矫正问题。美牙热线：0591－83828120',43,'1419487716',61,'主管医师'),(20,'肖永铨','doctor/2014122514232094.gif','1985-07-10',1,'<p><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225142427862.png\\\" style=\\\"width: 329px; height: 299px;\\\" /></p>\r\n\r\n<p><span style=\\\"line-height: 20.7999992370605px;\\\">毕业于福建医科大学口腔医学系，多次参加牙体缺损术脂美容修复交流会，精益求精的工作态度。深得业内人士及患者的好评，擅长各类牙体牙列缺损、缺失的固定活动修复，以及口腔牙髓病、根尖周病的治疗，修复前骨突修整术、系带修整术、口腔外科疾病，阻生齿拔除等。</span></p>','','擅长各类牙体牙列缺损、缺失的固定活动修复，以及口腔牙髓病、根尖周病的治疗，修复前骨突修整术、系带修整','本科','福建医科大学口腔医学系','肖永铨','肖永铨','福州瓷贴面采用先进的粘结技术将瓷修复材料粘结覆盖其表面,福州全瓷贴面多少钱？福州瓷贴面和烤瓷牙价格是怎样的, 福州华南中正口腔医院专家告诉我们福州瓷贴面的价格要综合考虑，可免费在线咨询预约。',47,'1419488690',59,'主管医师');
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctortodisease`
--

DROP TABLE IF EXISTS `doctortodisease`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctortodisease` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `doctor_id` int(11) unsigned NOT NULL,
  `disease_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8 COMMENT='医生疾病多对多表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctortodisease`
--

LOCK TABLES `doctortodisease` WRITE;
/*!40000 ALTER TABLE `doctortodisease` DISABLE KEYS */;
INSERT INTO `doctortodisease` VALUES (221,18,65),(222,18,66),(223,19,71),(224,19,72),(225,19,73),(226,19,74),(227,19,75),(228,19,76),(233,20,77),(234,20,80),(235,17,68),(236,17,70),(239,15,65),(240,16,65);
/*!40000 ALTER TABLE `doctortodisease` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `environment`
--

DROP TABLE IF EXISTS `environment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='医院环境表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `environment`
--

LOCK TABLES `environment` WRITE;
/*!40000 ALTER TABLE `environment` DISABLE KEYS */;
INSERT INTO `environment` VALUES (13,'医院走道','environment/20141225104336361.jpg','<p>医院走道</p>','','','医院走道','医院走道',1419475424,41),(14,'医院导医台','environment/2014122510550551.jpg','<p>医院导医台</p>','医院导医台','台,导医,医院,','','医院导医台',1419476108,81),(15,'手术台','environment/20141225110032754.jpg','<p>手术台</p>','手术台','手术台','','手术台',1419476445,65);
/*!40000 ALTER TABLE `environment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `errorpage`
--

DROP TABLE IF EXISTS `errorpage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `errorpage` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `code` varchar(30) NOT NULL COMMENT '错误编码',
  `content` text NOT NULL COMMENT '页面显示内容文字',
  `page` varchar(200) DEFAULT NULL COMMENT '指向页面',
  `defaultpage` varchar(200) NOT NULL DEFAULT 'error.html' COMMENT '默认页面',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='异常页面表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `errorpage`
--

LOCK TABLES `errorpage` WRITE;
/*!40000 ALTER TABLE `errorpage` DISABLE KEYS */;
INSERT INTO `errorpage` VALUES (7,'404','找不到页面啦~~~!','404.html','404.html'),(8,'500','服务器出问题了哦！','500.html','500.html'),(9,'301','请求的网页已移动到新位置了~','301.html','301.html'),(10,'401','请求身份验证','401.html','401.html');
/*!40000 ALTER TABLE `errorpage` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `honor`
--

DROP TABLE IF EXISTS `honor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='医院荣誉表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `honor`
--

LOCK TABLES `honor` WRITE;
/*!40000 ALTER TABLE `honor` DISABLE KEYS */;
INSERT INTO `honor` VALUES (11,'杰出证书','honor/20141225104132946.jpg','<p>杰出证书</p>','杰出证书','杰出证书','杰出证书',NULL,1419475301,99),(12,'合作商','honor/20141225104159308.jpg','<p>合作商</p>','','合作商','合作商',NULL,1419475329,96),(13,'美国BICON种植体临床基地','honor/20141225105030644.jpg','<p>美国BICON种植体临床</p>','美国BICON种植体临床','临床,基地,体,种植,BICON,美国,','',NULL,1419475836,44),(14,'台湾总部（美国医生）亲临中正','honor/20141225105138592.jpg','<p>台湾总部（美国医生）</p>','台湾总部（美国医生）','亲临,中正,医生,美国,总部,台湾,','',NULL,1419475917,71),(15,'牙医沙龙','honor/20141225105434299.jpg','<p><span style=\\\"line-height: 20.7999992370605px;\\\">牙医沙龙</span></p>','牙医沙龙','沙龙,牙医,','',NULL,1419476090,68),(16,'党员诚信店','honor/20141225105542626.jpg','<p><span style=\\\"line-height: 20.7999992370605px;\\\">党员诚信店</span></p>','党员诚信店','党员诚信店,福州华南中正口腔医院','2013年7月，中共台江区委组织部、台江区工商行政管理局，授予福州台江区华南中正口腔门诊部“党员诚信店”的荣誉称号。',NULL,1419476161,84);
/*!40000 ALTER TABLE `honor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inspection`
--

DROP TABLE IF EXISTS `inspection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inspection`
--

LOCK TABLES `inspection` WRITE;
/*!40000 ALTER TABLE `inspection` DISABLE KEYS */;
/*!40000 ALTER TABLE `inspection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inspectionitem`
--

DROP TABLE IF EXISTS `inspectionitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inspectionitem`
--

LOCK TABLES `inspectionitem` WRITE;
/*!40000 ALTER TABLE `inspectionitem` DISABLE KEYS */;
/*!40000 ALTER TABLE `inspectionitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keywords`
--

DROP TABLE IF EXISTS `keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keywords`
--

LOCK TABLES `keywords` WRITE;
/*!40000 ALTER TABLE `keywords` DISABLE KEYS */;
/*!40000 ALTER TABLE `keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link`
--

DROP TABLE IF EXISTS `link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '链接ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '站点名称',
  `pic` varchar(160) NOT NULL DEFAULT '' COMMENT '站点图标',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '站点地址',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `isdisplay` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示 1为显示，0为不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='友情链接表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link`
--

LOCK TABLES `link` WRITE;
/*!40000 ALTER TABLE `link` DISABLE KEYS */;
INSERT INTO `link` VALUES (5,'全球医院网','','http://www.qqyy.com',1,1),(6,'福州最好的牙科医院','','http://www.zzyake120.com/',2,1),(7,'泉州南方医院','','http://www.qznfyy.com/',3,1),(8,'博医','','www.boyicms.com',4,1);
/*!40000 ALTER TABLE `link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mediareport`
--

DROP TABLE IF EXISTS `mediareport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='媒体报道表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mediareport`
--

LOCK TABLES `mediareport` WRITE;
/*!40000 ALTER TABLE `mediareport` DISABLE KEYS */;
INSERT INTO `mediareport` VALUES (16,'中正口腔荣获台江“党员诚信店”','media/20141225104019637.jpg',NULL,'<p>中正口腔荣获台江&ldquo;党员诚信店&rdquo;</p>',64,'','中正口腔荣获台江“党员诚信店”','中正口腔荣获台江“党员诚信店”',1419475204,1419475223),(17,'我院举办介入治疗新技术论坛','',NULL,'<p>我院举办介入治疗新技术论坛</p>',53,'我院举办介入治疗新技术论坛','我院举办介入治疗新技术论坛','我院举办介入治疗新技术论坛',1419475262,1419475262),(18,'整形医学年会成功举办','',NULL,'<p>由我院承办的2013年北京市医学会整形外科学分会暨医学美学与美容分会年会日前举行，年会邀请整形美容、修复重建领域的专家和代表共300余人参 会。我院整形修复科主任韩岩教授主持大会开幕式。本次会议以&ldquo;交流、探讨、发展&rdquo;为主题，围绕整形美容及相关领域的热点难点问题进行专题讨论，共有30位 专家学者作了精彩发言。此次会议的举行，展示了北京整形外科和医学美学和美容最新研究成果，推动了该学科的全面发展。</p>',82,'整形医学年会成功举办','整形医学年会成功举办','整形医学年会成功举办',1419475620,1419475620),(19,'北京医师协会高血压专委会青年委员会在解放军总医院成立','',NULL,'<p>北京医师协会高血压专家委员会青年委员会日前在解放军总医院成立，22名成员均是业内公认的一流人才，分别来自12家北京大型医院。</p>\r\n\r\n<p>北京医师协会高血压专家委员会成立于2011年，由38位西医、中医和中西医结合方面的高血压专家组成。这次成立青年委员会，旨在为北京地区广大年轻心内科医师提供一个展示和交流的平台，使首都的高血压防治工作做得更好，在全国起引领作用。</p>\r\n\r\n<p>据 了解，北京医师协会高血压专委会近年来多次组 织在京权威医学专家，走进大讲堂、走上咨询台、走进社区，向百姓普及推广高血压防控知识，惠及患者数万人。作为专委会的重要成员，解放军总医院积极参与高 血压防控知识的推广普及。他们编写了高血压防病小贴士，组织心血管、肾病、内分泌专业专家及青年医护工作者开展多次义诊活动，向百姓发放宣传册，传授稳 压、控压知识。总医院还与总后有关部门合作举办全军网络保健医学新进展学习班培训讲座，设立远程医学网络双向站点360个，受到各界广泛好评。</p>',51,'北京医师协会高血压专委会青年委员会在解放军总医院成立','北京医师协会高血压专委会青年委员会在解放军总医院成立','北京医师协会高血压专委会青年委员会在解放军总医院成立',1419475713,1419475713),(21,'由黄烽教授牵头的研究成果将在全球知名学术期刊刊登','',NULL,'<p style=\\\"line-height: 20.7999992370605px;\\\">近日，《中华内科杂志》以&ldquo;国际舞台上的中国好声音&rdquo;为题，介绍我院风湿科将于2014年3月发表在《风湿性疾病纪要》（Annals of Rheumatic Disease）的&ldquo;阿达木单抗治疗中国成年人活动性强直性脊柱炎的有效性和安全性&rdquo;一文，即【Huang F, 等.&nbsp; Efficacy and safety of adalimumab in Chinese adults with active ankylosing spondylitis: results of a randomised, controlled trial.&nbsp; Ann Rheum Dis, 2014,73(3):587-94.】。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">该项研究是由黄烽教授牵头、全国九家大型三甲医院共同完成的多中心临床研究，重点关注中国人群的疗效和安全性特点，除了纳入疾病活动度、炎症及功能指标等作为有效性终点外，还设计了患者自我评估的生活质量（HAQ-S、SF-36）及工作活动障碍评估（WPAI-SHP）等作为次要终点，以更全面地展示强直性脊柱炎患者治疗后的获益情况。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">据悉，《风湿性疾病纪要》是全球风湿领域影响因子最高的学术期刊（影响因子9.12），而本研究是第一篇发表于该期刊上的由中国风湿医生牵头进行的多中心、随机、双盲、对照临床研究，也是国际上首次采用ASDAS作为预设研究终点的大样本随机双盲对照研究。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">我院风湿科近年来除了保质保量完成常规医教研工作外，还非常重视开展临床研究，2013年底申请到了国家科技部十二五支撑计划和973项目，重点对强直性脊柱炎的早期临床诊断和治疗开展综合研究。国内外风湿病学界里不断传来301的好声音，近3年来发表SCI论文11篇，Medline论文34篇，研究成果获军队医疗成果一等奖和中华医学科技奖二等奖。</p>',36,'由黄烽教授牵头的研究成果将在全球知名学术期刊刊登','由黄烽教授牵头的研究成果将在全球知名学术期刊刊登','由黄烽教授牵头的研究成果将在全球知名学术期刊刊登',1419475869,1419475869),(22,'韩国百岁针灸大师金南洙来我院进行学术交流','',NULL,'<p style=\\\"line-height: 20.7999992370605px;\\\">2月27日，韩国百岁针灸大师金南洙先生来我院针灸科进行艾灸治疗的学术交流。来自中医科学院专家、北京市多家三甲医院的针灸科主任和我院部分医务人员等50余人参加了学术交流。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">金南洙先生是韩国著名的针灸医师，在国际针灸界有很高的知名度和影响力。他多年致力于推广中国传统的直接灸法治疗慢性疾病，并用于预防保健。金老先生自己也坚持每日艾灸，保持着良好的身体状态。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">在这次学术交流中，针灸科关玲主任介绍了中国传统的麦粒灸疗法在肿瘤治疗中的应用，金南洙先生介绍了他使用的无极保养灸的方法和体会，并亲自做了示范。</p>',71,'韩国百岁针灸大师金南洙来我院进行学术交流','韩国百岁针灸大师金南洙来我院进行学术交流','韩国百岁针灸大师金南洙来我院进行学术交流',1419475902,1419475902);
/*!40000 ALTER TABLE `mediareport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moon`
--

DROP TABLE IF EXISTS `moon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moon` (
  `code` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moon`
--

LOCK TABLES `moon` WRITE;
/*!40000 ALTER TABLE `moon` DISABLE KEYS */;
/*!40000 ALTER TABLE `moon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movie` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) NOT NULL COMMENT '标题字段',
  `pic` varchar(200) DEFAULT NULL COMMENT '标题图片字段',
  `content` text NOT NULL COMMENT '在线观看地址',
  `plushtime` int(11) unsigned DEFAULT NULL,
  `title` text,
  `keywords` text,
  `description` text,
  `link` varchar(255) DEFAULT NULL,
  `updatetime` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='视频表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie`
--

LOCK TABLES `movie` WRITE;
/*!40000 ALTER TABLE `movie` DISABLE KEYS */;
INSERT INTO `movie` VALUES (27,'华南中正口腔医院走进福州祥板小学','movie/201412251423584.jpg','<p><span style=\\\"white-space: normal; word-spacing: 0px; text-transform: none; float: none; color: rgb(0,0,0); font: 12px/20px arial, helvetica, verdana, tahoma, sans-serif; orphans: 2; widows: 2; display: inline !important; letter-spacing: normal; background-color: rgb(255,255,255); text-indent: 0px; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px\\\">华南中正口腔医院走进福州祥板小学，为学校的师生进行口腔健康检查，并对师生的牙齿情况进行了抽样统计。同时宣传口腔健康知识，引导广大师生正确地护理牙齿，并给予治疗建议。希望每个人能够对牙齿的健康引起重视，从小做起保护自己的牙齿，让每个人都能够拥有一个良好口腔。</span><br />\r\n&nbsp;</p>',1419488640,NULL,NULL,NULL,'http://player.youku.com/player.php/sid/XNjMzODgyMDI0/v.swf',1420446355),(28,'49秒看牙齿矫正','movie/20141225142514326.jpg','<p style=\\\"text-indent: 2em\\\">牙齿矫正是通过正畸或外科手术等方法治疗错颌畸形，错颌畸形是指儿童生长发育过程中，由先天因素或后天因素导致的牙齿、颌骨、颅面的畸形，错颌畸形与龋齿、牙周病一起被列为口腔三大常见病，其患病率高达人口的50%以上。</p>',1419488716,NULL,NULL,NULL,'http://player.youku.com/player.php/sid/XNDc1MTk5NDAw/v.swf',1419488716),(29,'中正齿科专家教您如何保持口腔健康','movie/20141225143147397.png','<p><span style=\\\"line-height: 20.7999992370605px; text-indent: 26px;\\\">口腔健康使人充分地咀嚼，享受美味佳肴，获得充足的营养；口腔健康使人口齿清晰，尽情表达自己的意愿，自由地与人交流；口腔健康使人增强自信，在社会舞台上充分地层现自我；口腔健康还能避免和减少&ldquo;病灶感染&rdquo;和糖尿病、冠心病、胃病、新生儿低体重等病症的发生，口腔健康使人活得更健康，更愉快，更长寿。维护口腔健康，增进全身健康，提高生命质量是现代人普遍追求的目标。</span></p>',1419489042,NULL,NULL,NULL,'http://player.freeovp.com/videos/hl82uibub594c75f0f21a02d840cd26d_h.swf',1419489109),(30,'《中正星工厂》爆笑情景剧','movie/20141225143253374.jpg','<p style=\\\"text-indent: 2em\\\">他们是现实生活中牙医，每集一段搞笑趣闻，每集一个温馨提示。全景式的展现牙科医馆人文景观， 讲述发生在牙科医馆的各种搞笑趣事，他们对多彩生活各有期盼，他们对牙齿健康各有心得，如果我们用心领悟，你会发现这些事似曾相识地发生在我们身边。（福 建省福州市中正口腔门诊部位于西二环南路37号，比邻福州东南眼科医院。）</p>',1419489175,NULL,NULL,NULL,'http://player.youku.com/player.php/Type/Folder/Fid/18523712/Ob/1/sid/XMzU4MDYyODU2/v.swf',1419489175),(31,'中正齿科为您再现全瓷牙制作技术亮点','movie/20141225161405407.gif','<p><span style=\\\"line-height: 20.7999992370605px; text-indent: 26px;\\\">华南中正口腔拥有国内领先的技术设备和专家团队，遵循美国牙医协会（ADA）标准，从海外购进先进的牙种植系统、根管治疗系统、X光检查诊断设备等，并引进台湾、新加坡先进的口腔感染控制理念，杜绝交叉感染。</span></p>',1419495255,NULL,NULL,NULL,'http://player.youku.com/player.php/sid/XNDgxNDkyMDg4/v.swf',1419495255),(32,'华南中正齿科种植牙科普演示','movie/20141225161438484.gif','<p><span style=\\\"line-height: 20.7999992370605px; text-indent: 26px;\\\">种植牙作为人类的第三副牙齿，已经受到越来越多人的青睐，也是牙齿修复的一个过程，种植牙手术分为七个过程，每个流程都有特定的手术方案。想了解种植牙手术的过程，就必须先了解下种植牙的原理，种植牙是在牙槽骨内植入种植牙体(仿真压根)，然后在其上部安装基台及烤瓷牙冠。无论植入一颗或几颗牙齿，甚至上下腭的全部牙齿，植牙过程基本上都是一样的。</span></p>',1419495288,NULL,NULL,NULL,'http://player.youku.com/player.php/Type/Folder/Fid/18523712/Ob/1/sid/XNDc0OTM1ODI4/v.swf',1419495288);
/*!40000 ALTER TABLE `movie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `navigation`
--

DROP TABLE IF EXISTS `navigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COMMENT='导航表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `navigation`
--

LOCK TABLES `navigation` WRITE;
/*!40000 ALTER TABLE `navigation` DISABLE KEYS */;
INSERT INTO `navigation` VALUES (114,'首页','index.html',0,0,1,1,1,NULL),(115,'牙齿种植','yachizhongzhi/index.html',0,0,1,1,1,NULL),(116,'中正品牌','hospital/introduce.html',1,114,1,1,0,NULL),(117,'牙齿矫正','ycjz/index.html',0,0,2,1,1,NULL),(118,'牙齿修复','yacxf/index.html',0,0,3,1,1,NULL),(119,'牙齿治疗','yczl/index.html',0,0,4,1,1,NULL);
/*!40000 ALTER TABLE `navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `networkpic`
--

DROP TABLE IF EXISTS `networkpic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `networkpic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `networkpic`
--

LOCK TABLES `networkpic` WRITE;
/*!40000 ALTER TABLE `networkpic` DISABLE KEYS */;
/*!40000 ALTER TABLE `networkpic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COMMENT='动态新闻表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (54,'华南中正获福州2014年十佳口腔品牌','',NULL,'<p><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225120205252.jpg\\\" style=\\\"width: 200px; height: 200px;\\\" />华南中正获福州2014年十佳口腔品牌</p>',67,'华南中正获福州2014年十佳口腔品牌','华南中正获福州2014年十佳口腔品牌','华南中正获福州2014年十佳口腔品牌',1419475086,0,1419480131),(55,'华南中正口腔荣封“党员诚信店”','news/2014122510392784.jpg',NULL,'<p>华南中正口腔荣封&ldquo;党员诚信店&rdquo;</p>',90,'华南中正口腔荣封“党员诚信店”','华南中正口腔荣封“党员诚信店”','华南中正口腔荣封“党员诚信店”',1419475156,1,1419475170),(56,'东南快报报道：华南中正口腔医院积极团购爱心竹竿','news/20141225120737793.jpg',NULL,'<p>一位66岁的老人，扛着百来斤的竹竿走街串巷地叫卖，一天下来，收入不超百元，舍不得买个饼、喝口水&hellip;&hellip;</p>\r\n\r\n<p>2013年11月19日，东南快报报道了陈依伯进城卖竹竿的艰辛生活和团购征集，引起了榕城市民的关注。许多市民纷纷拨打东快新闻热线968977，对陈依伯以及晋安区寿山乡叶洋村卖竹竿老人的生活表示关心。</p>\r\n\r\n<p>除了关心，更多的读者从中得到满满的正能量。&ldquo;66岁，靠自己的双手挣钱，生活积极向上，卖竹竿也实在，这些品质，值得我们学习。我们年轻人还有什么理由不努力工作?&rdquo;</p>\r\n\r\n<p><strong>中正口腔爱心商家预订200根还为陈依伯免费看牙</strong></p>\r\n\r\n<p>得知东南快报正在组织爱心晾衣竿团购活动，华南中正口腔医院赖经理第一时间联系该报，表示先预订200根。</p>\r\n\r\n<p>赖经理说，华南中正口腔医院常举办口腔义诊进小区的活动。由此得知附近小区居民需要竹竿用来晾衣服。&ldquo;很多居民想买竹竿，可要么是买不着，要么是携带不方便。&rdquo;赖经理希望团购一批竹竿，送给小区里有需要的人。既可以帮助老人销售竹竿，又可以为小区的居民提供便民服务。</p>\r\n\r\n<p>不仅如此，细心的赖经理还从陈依伯的见报图片上看出，他的牙齿有缺失。&ldquo;如果陈依伯需要解决口腔问题，我们愿意免费为他提供治疗。&rdquo;</p>\r\n\r\n<p style=\\\"text-align: center;\\\"><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225120750364.jpg\\\" style=\\\"width: 200px; height: 200px;\\\" /><br />\r\n转载：<a href=\\\"http://digi.dnkb.com.cn/dnkb/html/2013-11/20/content_292871.htm\\\" rel=\\\"nofollow\\\">http://digi.dnkb.com.cn/dnkb/html/2013-11/20/content_292871.htm</a></p>',31,'东南快报报道：华南中正口腔医院积极团购爱心竹竿','华南中正口腔医院积极团购爱心竹竿,中正爱心团购','一位66岁的老人进城卖竹竿的艰辛生活和团购征集，引起了榕城市民的关注。华南中正口腔医院赖经理第一时间联系本报，表示先预订200根。既可以帮助老人销售竹竿，又可以为小区的居民提供便民服务。',1419475236,0,1419480479),(57,'华南中正口腔医院三八节整牙送优惠','news/20141225104437944.jpg',NULL,'<p>3月8日又到了三八国际劳动妇女节了，爱美是女人的天性，追求美更是女人的权利，谁说女人只能&ldquo;为悦己者容&rdquo;，&ldquo;孤芳自赏&rdquo;也未尝不可。华南中正口腔医院在这个重大的节日，推出针对妇女的美牙优惠活动，为各广大女性群体带来了&ldquo;礼物&rdquo;。</p>\r\n\r\n<p style=\\\"text-align: center;\\\"><a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"font-size: 16px;\\\"><strong><span style=\\\"color: rgb(255, 0, 0);\\\"><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225120830664.jpg\\\" style=\\\"width: 240px; height: 174px;\\\" /></span></strong></span></a></p>\r\n\r\n<p style=\\\"text-align: center;\\\"><a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"font-size: 16px;\\\"><strong><span style=\\\"color: rgb(255, 0, 0);\\\">&gt;&gt;&gt;了解详情，点击在线咨询&lt;&lt;&lt;</span></strong></span></a></p>\r\n\r\n<p>中 正齿科(华南)会所源自台湾，拥有国内领先的技术设备和专家团队。中正齿科会所定期与台、 韩、美等国齿科界进行广泛的交流与合作。为确保专业水准， 斥巨资引进最先进的齿科设备与器材。配备有德国sirona牙椅 、美国NOBEL 牙种植系统;德国Densply根管治疗系统;德国sirona低辐射数字化X光检查诊断设备;德国sirona三维口腔CT;美国Beyond冷光美 白，美国无痛麻醉仪。全球最大中文口腔管理软件台湾小天使医疗管理系统;另外还配备法国Pierre Rollad无痛麻醉技术，由种植、正畸、修复、治疗等口腔资深专家团队领衔，遵循美国牙医协会(ADA)标准，从台湾购进最新的高温高压消毒炉，并引进 台湾、新加坡先进的口腔感染控制理念，杜绝交叉感染，使您看牙在轻松中度过。</p>\r\n\r\n<p>如果你对华南中正口腔医院想要深入了解，或者对本次三八妇女节优惠活动，还有其他什么疑问，请点击<a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\">在线咨询</a>，与中正口腔专家在线沟通交流。</p>',78,'华南中正口腔医院三八节整牙送优惠','三八节美牙优惠,牙齿修复优惠活动','3月8日又到了三八国际劳动妇女节了，爱美是女人的天性，追求美更是女人的权利，谁说女人只能“为悦己者容”，“孤芳自赏”也未尝不可。华南中正口腔医院在这个重大的节日，推出针对妇女的美牙优惠活动，为各广大女性群体带来了“礼物”。',1419475317,0,1419480516),(58,'华南中正口腔受邀联合开展“四个万家”主题实践服务活动','',NULL,'<p style=\\\"line-height: 20.7999992370605px;\\\">12月27日，为认真贯彻落实党的十八届三中全会精神和决定及迎接省市科协代表大会的召开，在专业法、公众法宣传和科普益民活动暨在服务民生上下功夫。经研究决定在宁化地区开展&ldquo;<strong>四个万家</strong>&rdquo;主题实践为民服务活动日。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">华南中正口腔医院积极响应福州市委、市政府的号召，受邀于福州市科协、台江区老科协、宁化街道、台江卫生局、疾控中心卫生监督所等机构在宝龙城市广场开展了名为&ldquo;四个万家&rdquo;的主题实践宣传活动。&ldquo;四个万家&rdquo;指的是&ldquo;进万家门、知万家情、解万家忧、办万家事&rdquo;， 华南中正口腔医院一直以来热衷公益活动，自然是积极投入，派出最专业的医师团队参与其中。当日，现场气氛非常热闹，有二三百名市民参加了该活动，华南中正口腔医师不仅为附近的居民、过往的路人做了详细的口腔检查，更悉心地讲解了日常口腔保健知识、牙齿的预防保健、刷牙的正确方法等口腔知识，针对不同的口腔情况提出科学的治疗建议，并为现场咨询的市民免费测量血压，发放口腔健康宣传资料上千份，得到了市民一致好评，现场还有福州电视台新闻频道的记者进行全程跟踪采访。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">活动现场照片：</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">1、活动现场腰鼓队热情表演</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><img alt=\\\"\\\" src=\\\"/upload/allimg/140106/27-14010615120X20.jpg\\\" style=\\\"width: 550px; height: 365px;\\\" title=\\\"华南中正口腔医院\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">2、市民积极踊跃到义诊区咨询如何口腔健康如何保健、并认真听取专家的讲解</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><img alt=\\\"\\\" src=\\\"/upload/allimg/140106/27-140106151302W0.jpg\\\" style=\\\"width: 550px; height: 365px;\\\" title=\\\"华南中正口腔医院\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">3、福州电视台新闻频道记者拍摄本单位义诊现场</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><img alt=\\\"\\\" src=\\\"/upload/allimg/140106/27-140106151339135.jpg\\\" style=\\\"width: 550px; height: 364px;\\\" title=\\\"华南中正口腔医院\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">4、市民排起了长队&hellip;&hellip;</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><img alt=\\\"\\\" src=\\\"/upload/allimg/140106/27-14010615140B37.jpg\\\" style=\\\"width: 550px; height: 364px;\\\" title=\\\"华南中正口腔医院\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">相关材料复印件：</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><img alt=\\\"\\\" src=\\\"/upload/allimg/140106/27-14010615154G27.jpg\\\" style=\\\"width: 450px; height: 626px;\\\" title=\\\"华南中正口腔医院\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">工作报告：</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><img alt=\\\"\\\" src=\\\"/upload/allimg/140106/27-140106152050152.jpg\\\" style=\\\"width: 540px; height: 399px;\\\" title=\\\"华南中正口腔医院\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">华南中正口腔积极参加福州市就深入开展&ldquo;进万家门、知万家情、解万家忧、办万家事&rdquo;主题实践活动。单位先后在宁化街道的宁化社区、福瑞社区、长汀社区、祥坂社区、福祥社区开展15场以&ldquo;科学饮食、科学护齿、健康生活&rdquo;为主题，进社区大型口腔健康免费义诊活动，并发放了口腔健康科普宣传手册十万余份，赠送礼品二万余份。</p>',36,'华南中正口腔受邀联合开展“四个万家”主题实践服务活动','“四个万家”主题实践服务活动','12月27日，为认真贯彻落实党的十八届三中全会精神和决定及迎接省市科协代表大会的召开，在专业法、公众法宣传和科普益民活动暨在服务民生上下功夫。经研究决定在宁化地区开展“四个万家”主题实践为民服务活动日。',1419475596,0,1419475596),(59,'东南快报报道：华南中正口腔医院爱心团购竹竿送达困难户','news/20141225104758625.jpg',NULL,'<p style=\\\"line-height: 20.79px;\\\">2013年11月23日，由东南快报发起的&ldquo;买根爱心竹竿，让陈依伯的肩膀歇歇吧&rdquo;的爱心团购活动圆满收官。为了方便社区居民，华南中正口腔医院将订购的竹竿送给困难户&hellip;&hellip;</p>\r\n\r\n<p style=\\\"line-height: 20.79px;\\\">村民的竹竿有了好去处;陈依伯不仅能稍微歇歇，口腔问题也得到解决;市民也有了好用的竹竿晒被子&hellip;&hellip;一场爱心团购活动，使所有参与者都有不同的收获。村民等来订单时灿烂的笑容，市民收到竹竿时的喜悦，陈依伯拔去烂牙时的轻松，活动的意义，就在他们的脸上。</p>\r\n\r\n<p style=\\\"line-height: 20.79px;\\\">作为订购&ldquo;大户&rdquo;的华南中正口腔医院的工作人员们，对这次订购的200根竹竿相当满意，&ldquo;粗细适中，长短也一致，送给宁化街道下辖社区里的困难户，他们一定很满意。工作人员还特意向老福州人讨教了竹竿的派送方式，&ldquo;在福州送竹竿是有讲究的，要送一对，而且要用红绳绑住两根竹竿。&rdquo;中正口腔医院赖经理说，这意味着好事成双，红绳可以讨个好彩头，希望社区居民开心。&rdquo;而在竹竿的运输途中，语言不通、又没有通讯工具的陈依伯在弟弟陈亨灿的陪同下，来到华南中正口腔医院。在赖经理的安排下，陈依伯两兄弟直接由专家会诊。陈依伯指着自己的牙齿说：&ldquo;不仅门牙没了，两边的大牙也很疼，平常不敢用力吃东西。&rdquo;经过一番检查，王医生表示，目前只能为陈依伯拔去烂掉的牙，等伤口愈合，才能为其安活动牙。</p>\r\n\r\n<p style=\\\"line-height: 20.79px;\\\">从寻找卖竹竿的依伯，再到团购爱心竹竿，在这场声势浩大的爱心行动中，不管是读者、社区还是爱心商家，大家纷纷用自己的实际行动，向依伯诠释集体的力量。</p>\r\n\r\n<p style=\\\"text-align: center; line-height: 20.79px;\\\"><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225120327929.jpg\\\" style=\\\"width: 133px; height: 180px;\\\" /></p>\r\n\r\n<p style=\\\"text-align: center; line-height: 20.79px;\\\">转载：<a href=\\\"http://digi.dnkb.com.cn/dnkb/html/2013-11/26/content_293965.htm\\\" rel=\\\"nofollow\\\">http://digi.dnkb.com.cn/dnkb/html/2013-11/26/content_293965.htm</a></p>',39,'东南快报报道：华南中正口腔医院爱心团购竹竿送达困难户','中正口腔医院竹竿团购,中正口腔医院爱心团购','12月27日，为认真贯彻落实党的十八届三中全会精神和决定及迎接省市科协代表大会的召开，在专业法、公众法宣传和科普益民活动暨在服务民生上下功夫。经研究决定在宁化地区开展“四个万家”主题实践为民服务活动日。',1419475697,0,1419480406),(60,'华南中正口腔荣封“党员诚信店”','news/20141230091400805.jpg',NULL,'<p>31日上午，台江区举行第七批&ldquo;党员诚信店&rdquo;授牌仪式，暨2012年度&ldquo;模范党员诚信店&rdquo;表彰大会。在现场有52家党员经营户荣获了&ldquo;党员诚信店&rdquo;称号，【华南中正口腔医院】也获此殊荣。</p>\r\n\r\n<div><img alt=\\\"华南中正口腔获荣誉称号\\\" src=\\\"http://hwibs.boyicms.com/upload/img/201412251205203.jpg\\\" /></div>\r\n\r\n<p>　　中正口腔专家【黄淑婷】代表上台领奖</p>\r\n\r\n<p>华南中正口腔医院做为&ldquo;党员诚信店&rdquo;单位出席了本次会议，在大会上认真听取了各领导做出的重要报告。做为&ldquo;党员诚信店&rdquo;的一员，华南中正口腔一直坚信诚信是发展的根本，医疗技术精、医疗服务好、医疗质量高是医疗行业要秉承的服务理念，华南中正口腔通过多年经营获得了老百姓们的信赖和喜爱。</p>\r\n\r\n<div><img alt=\\\"华南中正口腔获荣誉称号\\\" src=\\\"/upload/allimg/131107/16-13110G62540618.png\\\" /></div>\r\n\r\n<p>　　黄医生与其它单位做深入交流</p>\r\n\r\n<p>华南中正口腔始终坚持&ldquo;诚信、以人为本&rdquo;的服务理念接待每位患者朋友；承诺不因商业利益影响对患者进行讲解、诊断和治疗，确保每个人有充足的选择权利!经过多年的发展，获得了患者和业界的一致好评，在老百姓心中树立了良好的口碑。</p>',62,'华南中正口腔荣封“党员诚信店”','党员诚信店','华南中正口腔医院做为“党员诚信店”单位出席了本次会议，在大会上认真听取了各领导做出的重要报告。做为“党员诚信店”的一员，华南中正口腔一直坚信诚信是发展的根本，医疗技术精、医疗服务好、医疗质量高是医疗行业要秉承的服务理念，华南中正口腔通过多年经营获得了',1419479185,1,1419902045);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_copy`
--

DROP TABLE IF EXISTS `news_copy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_copy` (
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='动态新闻表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_copy`
--

LOCK TABLES `news_copy` WRITE;
/*!40000 ALTER TABLE `news_copy` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_copy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plugin`
--

DROP TABLE IF EXISTS `plugin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugin`
--

LOCK TABLES `plugin` WRITE;
/*!40000 ALTER TABLE `plugin` DISABLE KEYS */;
/*!40000 ALTER TABLE `plugin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recommendlist`
--

DROP TABLE IF EXISTS `recommendlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recommendlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性ID',
  `is_top` tinyint(1) DEFAULT '0' COMMENT '是否置顶 0否1是',
  `recommendposition_id` smallint(6) unsigned NOT NULL COMMENT '推荐位置ID',
  `article_id` int(11) unsigned DEFAULT '0' COMMENT '文章ID',
  `category_id` int(11) unsigned DEFAULT '0' COMMENT '栏目ID',
  `topic_id` int(10) unsigned DEFAULT '0' COMMENT '专题ID',
  `success_id` int(11) DEFAULT '0' COMMENT '案例ID',
  `technology_id` int(11) DEFAULT '0' COMMENT '技术ID',
  PRIMARY KEY (`id`),
  KEY `recommendposition_id` (`recommendposition_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=911 DEFAULT CHARSET=utf8 COMMENT='article位置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recommendlist`
--

LOCK TABLES `recommendlist` WRITE;
/*!40000 ALTER TABLE `recommendlist` DISABLE KEYS */;
INSERT INTO `recommendlist` VALUES (817,0,6,2711,NULL,NULL,NULL,NULL),(818,0,7,2711,NULL,NULL,NULL,NULL),(819,0,8,2711,NULL,NULL,NULL,NULL),(820,0,9,2711,NULL,NULL,NULL,NULL),(821,0,10,2711,NULL,NULL,NULL,NULL),(853,0,6,2709,NULL,NULL,NULL,NULL),(854,0,7,2709,NULL,NULL,NULL,NULL),(855,0,8,2709,NULL,NULL,NULL,NULL),(856,0,9,2709,NULL,NULL,NULL,NULL),(857,0,10,2709,NULL,NULL,NULL,NULL),(858,1,6,2712,NULL,NULL,NULL,NULL),(859,1,7,2712,NULL,NULL,NULL,NULL),(860,1,8,2712,NULL,NULL,NULL,NULL),(861,1,9,2712,NULL,NULL,NULL,NULL),(862,1,10,2712,NULL,NULL,NULL,NULL),(896,1,6,2707,NULL,NULL,NULL,NULL),(897,1,7,2707,NULL,NULL,NULL,NULL),(898,1,8,2707,NULL,NULL,NULL,NULL),(899,1,9,2707,NULL,NULL,NULL,NULL),(900,1,10,2707,NULL,NULL,NULL,NULL),(901,1,6,2710,NULL,NULL,NULL,NULL),(902,1,7,2710,NULL,NULL,NULL,NULL),(903,1,8,2710,NULL,NULL,NULL,NULL),(904,1,9,2710,NULL,NULL,NULL,NULL),(905,1,10,2710,NULL,NULL,NULL,NULL),(906,1,6,2708,NULL,NULL,NULL,NULL),(907,1,7,2708,NULL,NULL,NULL,NULL),(908,1,8,2708,NULL,NULL,NULL,NULL),(909,1,9,2708,NULL,NULL,NULL,NULL),(910,1,10,2708,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `recommendlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recommendposition`
--

DROP TABLE IF EXISTS `recommendposition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recommendposition` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'article属性类型ID',
  `name` varchar(20) NOT NULL COMMENT '所属位置名称',
  `shortname` varchar(10) DEFAULT NULL COMMENT '短名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='article支持位置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recommendposition`
--

LOCK TABLES `recommendposition` WRITE;
/*!40000 ALTER TABLE `recommendposition` DISABLE KEYS */;
INSERT INTO `recommendposition` VALUES (6,'首页头版头条',''),(7,'首页头版列表',''),(8,'首页疾病列表',''),(9,'疾病列表置顶',''),(10,'科室列表置顶','');
/*!40000 ALTER TABLE `recommendposition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reseruser`
--

DROP TABLE IF EXISTS `reseruser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reseruser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `sex` int(1) DEFAULT NULL COMMENT '性别',
  `age` int(3) DEFAULT NULL COMMENT '年龄',
  `date` int(10) DEFAULT NULL COMMENT '预约日期',
  `time` varchar(10) DEFAULT NULL COMMENT '上午还是下午',
  `address` varchar(100) DEFAULT NULL,
  `hometel` int(11) DEFAULT NULL COMMENT '电话号码',
  `email` varchar(50) DEFAULT NULL COMMENT '电子邮箱',
  `ill` text COMMENT '病情描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户预约表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reseruser`
--

LOCK TABLES `reseruser` WRITE;
/*!40000 ALTER TABLE `reseruser` DISABLE KEYS */;
INSERT INTO `reseruser` VALUES (2,'ccc',0,22,2014,'8:00','111',2147483647,'','病了'),(3,'ccc',0,22,2014,'8:00','111',2147483647,'','????o?'),(4,'jjj',1,22,2014,'8:00','222222',2147483647,'','病了');
/*!40000 ALTER TABLE `reseruser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

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
  `state` int(11) NOT NULL DEFAULT '0' COMMENT '排班状态，0为开启，1为关闭',
  `mark` int(11) NOT NULL DEFAULT '0' COMMENT '已预约人数',
  PRIMARY KEY (`id`),
  KEY `doctor_department_date` (`department_id`,`doctor_id`,`date`),
  KEY `doctor_department` (`department_id`,`doctor_id`),
  KEY `doctor_reser` (`doctor_id`),
  CONSTRAINT `depart_reser` FOREIGN KEY (`department_id`) REFERENCES `departmentmanager` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `doctor_reser` FOREIGN KEY (`doctor_id`) REFERENCES `doctormanager` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='预约排班表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (23,41,18,20,1419782400,'8:00-12:00','-','-'),(24,41,18,20,1419868800,'-','14:00-18:00','19:00-22:00'),(25,41,18,20,1419955200,'8:00-12:00','14:00-18:00','-'),(26,41,18,20,1420041600,'8:00-12:00','-','-'),(27,41,18,20,1420128000,'-','14:00-18:00','-'),(28,41,15,15,1419523200,'8:00-12:00','14:00-18:00','-'),(29,41,15,15,1419782400,'8:00-12:00','14:00-18:00','-'),(30,42,17,20,1419868800,'8:00-12:00','-','-'),(31,42,17,20,1419955200,'8:00-12:00','-','-');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservationdetail`
--

DROP TABLE IF EXISTS `reservationdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=630 DEFAULT CHARSET=utf8 COMMENT='预约详细表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservationdetail`
--

LOCK TABLES `reservationdetail` WRITE;
/*!40000 ALTER TABLE `reservationdetail` DISABLE KEYS */;
INSERT INTO `reservationdetail` VALUES (461,41,18,1419782400,'1419811200','待约',NULL,NULL,NULL),(462,41,18,1419782400,'1419812400','待约',NULL,NULL,NULL),(463,41,18,1419782400,'1419813600','待约',NULL,NULL,NULL),(464,41,18,1419782400,'1419814800','待约',NULL,NULL,NULL),(465,41,18,1419782400,'1419816000','待约',NULL,NULL,NULL),(466,41,18,1419782400,'1419817200','待约',NULL,NULL,NULL),(467,41,18,1419782400,'1419818400','待约',NULL,NULL,NULL),(468,41,18,1419782400,'1419819600','待约',NULL,NULL,NULL),(469,41,18,1419782400,'1419820800','待约',NULL,NULL,NULL),(470,41,18,1419782400,'1419822000','待约',NULL,NULL,NULL),(471,41,18,1419782400,'1419823200','待约',NULL,NULL,NULL),(472,41,18,1419782400,'1419824400','待约',NULL,NULL,NULL),(473,41,18,1419868800,'1419919200','待约',NULL,NULL,NULL),(474,41,18,1419868800,'1419920400','待约',NULL,NULL,NULL),(475,41,18,1419868800,'1419921600','待约',NULL,NULL,NULL),(476,41,18,1419868800,'1419922800','待约',NULL,NULL,NULL),(477,41,18,1419868800,'1419924000','待约',NULL,NULL,NULL),(478,41,18,1419868800,'1419925200','待约',NULL,NULL,NULL),(479,41,18,1419868800,'1419926400','待约',NULL,NULL,NULL),(480,41,18,1419868800,'1419927600','待约',NULL,NULL,NULL),(481,41,18,1419868800,'1419928800','待约',NULL,NULL,NULL),(482,41,18,1419868800,'1419930000','待约',NULL,NULL,NULL),(483,41,18,1419868800,'1419931200','待约',NULL,NULL,NULL),(484,41,18,1419868800,'1419932400','待约',NULL,NULL,NULL),(485,41,18,1419868800,'1419937200','待约',NULL,NULL,NULL),(486,41,18,1419868800,'1419938400','待约',NULL,NULL,NULL),(487,41,18,1419868800,'1419939600','待约',NULL,NULL,NULL),(488,41,18,1419868800,'1419940800','待约',NULL,NULL,NULL),(489,41,18,1419868800,'1419942000','待约',NULL,NULL,NULL),(490,41,18,1419868800,'1419943200','待约',NULL,NULL,NULL),(491,41,18,1419868800,'1419944400','待约',NULL,NULL,NULL),(492,41,18,1419868800,'1419945600','待约',NULL,NULL,NULL),(493,41,18,1419868800,'1419946800','待约',NULL,NULL,NULL),(494,41,18,1419955200,'1419984000','待约',NULL,NULL,NULL),(495,41,18,1419955200,'1419985200','待约',NULL,NULL,NULL),(496,41,18,1419955200,'1419986400','待约',NULL,NULL,NULL),(497,41,18,1419955200,'1419987600','待约',NULL,NULL,NULL),(498,41,18,1419955200,'1419988800','待约',NULL,NULL,NULL),(499,41,18,1419955200,'1419990000','待约',NULL,NULL,NULL),(500,41,18,1419955200,'1419991200','待约',NULL,NULL,NULL),(501,41,18,1419955200,'1419992400','待约',NULL,NULL,NULL),(502,41,18,1419955200,'1419993600','待约',NULL,NULL,NULL),(503,41,18,1419955200,'1419994800','待约',NULL,NULL,NULL),(504,41,18,1419955200,'1419996000','待约',NULL,NULL,NULL),(505,41,18,1419955200,'1419997200','待约',NULL,NULL,NULL),(506,41,18,1419955200,'1420005600','待约',NULL,NULL,NULL),(507,41,18,1419955200,'1420006800','待约',NULL,NULL,NULL),(508,41,18,1419955200,'1420008000','待约',NULL,NULL,NULL),(509,41,18,1419955200,'1420009200','待约',NULL,NULL,NULL),(510,41,18,1419955200,'1420010400','待约',NULL,NULL,NULL),(511,41,18,1419955200,'1420011600','待约',NULL,NULL,NULL),(512,41,18,1419955200,'1420012800','待约',NULL,NULL,NULL),(513,41,18,1419955200,'1420014000','待约',NULL,NULL,NULL),(514,41,18,1419955200,'1420015200','待约',NULL,NULL,NULL),(515,41,18,1419955200,'1420016400','待约',NULL,NULL,NULL),(516,41,18,1419955200,'1420017600','待约',NULL,NULL,NULL),(517,41,18,1419955200,'1420018800','待约',NULL,NULL,NULL),(518,41,18,1420041600,'1420070400','待约',NULL,NULL,NULL),(519,41,18,1420041600,'1420071600','待约',NULL,NULL,NULL),(520,41,18,1420041600,'1420072800','待约',NULL,NULL,NULL),(521,41,18,1420041600,'1420074000','待约',NULL,NULL,NULL),(522,41,18,1420041600,'1420075200','待约',NULL,NULL,NULL),(523,41,18,1420041600,'1420076400','待约',NULL,NULL,NULL),(524,41,18,1420041600,'1420077600','待约',NULL,NULL,NULL),(525,41,18,1420041600,'1420078800','待约',NULL,NULL,NULL),(526,41,18,1420041600,'1420080000','待约',NULL,NULL,NULL),(527,41,18,1420041600,'1420081200','待约',NULL,NULL,NULL),(528,41,18,1420041600,'1420082400','待约',NULL,NULL,NULL),(529,41,18,1420041600,'1420083600','待约',NULL,NULL,NULL),(530,41,18,1420128000,'1420178400','待约',NULL,NULL,NULL),(531,41,18,1420128000,'1420179600','待约',NULL,NULL,NULL),(532,41,18,1420128000,'1420180800','待约',NULL,NULL,NULL),(533,41,18,1420128000,'1420182000','待约',NULL,NULL,NULL),(534,41,18,1420128000,'1420183200','待约',NULL,NULL,NULL),(535,41,18,1420128000,'1420184400','待约',NULL,NULL,NULL),(536,41,18,1420128000,'1420185600','待约',NULL,NULL,NULL),(537,41,18,1420128000,'1420186800','待约',NULL,NULL,NULL),(538,41,18,1420128000,'1420188000','待约',NULL,NULL,NULL),(539,41,18,1420128000,'1420189200','待约',NULL,NULL,NULL),(540,41,18,1420128000,'1420190400','待约',NULL,NULL,NULL),(541,41,18,1420128000,'1420191600','待约',NULL,NULL,NULL),(542,41,15,1419523200,'1419552000','待约',NULL,NULL,NULL),(543,41,15,1419523200,'1419552900','待约',NULL,NULL,NULL),(544,41,15,1419523200,'1419553800','待约',NULL,NULL,NULL),(545,41,15,1419523200,'1419554700','待约',NULL,NULL,NULL),(546,41,15,1419523200,'1419555600','待约',NULL,NULL,NULL),(547,41,15,1419523200,'1419556500','待约',NULL,NULL,NULL),(548,41,15,1419523200,'1419557400','待约',NULL,NULL,NULL),(549,41,15,1419523200,'1419558300','待约',NULL,NULL,NULL),(550,41,15,1419523200,'1419559200','待约',NULL,NULL,NULL),(551,41,15,1419523200,'1419560100','待约',NULL,NULL,NULL),(552,41,15,1419523200,'1419561000','待约',NULL,NULL,NULL),(553,41,15,1419523200,'1419561900','待约',NULL,NULL,NULL),(554,41,15,1419523200,'1419562800','待约',NULL,NULL,NULL),(555,41,15,1419523200,'1419563700','待约',NULL,NULL,NULL),(556,41,15,1419523200,'1419564600','待约',NULL,NULL,NULL),(557,41,15,1419523200,'1419565500','待约',NULL,NULL,NULL),(558,41,15,1419523200,'1419573600','待约',NULL,NULL,NULL),(559,41,15,1419523200,'1419574500','待约',NULL,NULL,NULL),(560,41,15,1419523200,'1419575400','待约',NULL,NULL,NULL),(561,41,15,1419523200,'1419576300','待约',NULL,NULL,NULL),(562,41,15,1419523200,'1419577200','待约',NULL,NULL,NULL),(563,41,15,1419523200,'1419578100','待约',NULL,NULL,NULL),(564,41,15,1419523200,'1419579000','待约',NULL,NULL,NULL),(565,41,15,1419523200,'1419579900','待约',NULL,NULL,NULL),(566,41,15,1419523200,'1419580800','待约',NULL,NULL,NULL),(567,41,15,1419523200,'1419581700','待约',NULL,NULL,NULL),(568,41,15,1419523200,'1419582600','待约',NULL,NULL,NULL),(569,41,15,1419523200,'1419583500','待约',NULL,NULL,NULL),(570,41,15,1419523200,'1419584400','待约',NULL,NULL,NULL),(571,41,15,1419523200,'1419585300','待约',NULL,NULL,NULL),(572,41,15,1419523200,'1419586200','待约',NULL,NULL,NULL),(573,41,15,1419523200,'1419587100','待约',NULL,NULL,NULL),(574,41,15,1419782400,'1419811200','已约','jjj','22222222222',NULL),(575,41,15,1419782400,'1419812100','待约',NULL,NULL,NULL),(576,41,15,1419782400,'1419813000','待约',NULL,NULL,NULL),(577,41,15,1419782400,'1419813900','待约',NULL,NULL,NULL),(578,41,15,1419782400,'1419814800','待约',NULL,NULL,NULL),(579,41,15,1419782400,'1419815700','待约',NULL,NULL,NULL),(580,41,15,1419782400,'1419816600','待约',NULL,NULL,NULL),(581,41,15,1419782400,'1419817500','待约',NULL,NULL,NULL),(582,41,15,1419782400,'1419818400','待约',NULL,NULL,NULL),(583,41,15,1419782400,'1419819300','待约',NULL,NULL,NULL),(584,41,15,1419782400,'1419820200','待约',NULL,NULL,NULL),(585,41,15,1419782400,'1419821100','待约',NULL,NULL,NULL),(586,41,15,1419782400,'1419822000','待约',NULL,NULL,NULL),(587,41,15,1419782400,'1419822900','待约',NULL,NULL,NULL),(588,41,15,1419782400,'1419823800','待约',NULL,NULL,NULL),(589,41,15,1419782400,'1419824700','待约',NULL,NULL,NULL),(590,41,15,1419782400,'1419832800','待约',NULL,NULL,NULL),(591,41,15,1419782400,'1419833700','待约',NULL,NULL,NULL),(592,41,15,1419782400,'1419834600','待约',NULL,NULL,NULL),(593,41,15,1419782400,'1419835500','待约',NULL,NULL,NULL),(594,41,15,1419782400,'1419836400','待约',NULL,NULL,NULL),(595,41,15,1419782400,'1419837300','待约',NULL,NULL,NULL),(596,41,15,1419782400,'1419838200','待约',NULL,NULL,NULL),(597,41,15,1419782400,'1419839100','待约',NULL,NULL,NULL),(598,41,15,1419782400,'1419840000','待约',NULL,NULL,NULL),(599,41,15,1419782400,'1419840900','待约',NULL,NULL,NULL),(600,41,15,1419782400,'1419841800','待约',NULL,NULL,NULL),(601,41,15,1419782400,'1419842700','待约',NULL,NULL,NULL),(602,41,15,1419782400,'1419843600','待约',NULL,NULL,NULL),(603,41,15,1419782400,'1419844500','待约',NULL,NULL,NULL),(604,41,15,1419782400,'1419845400','待约',NULL,NULL,NULL),(605,41,15,1419782400,'1419846300','待约',NULL,NULL,NULL),(606,42,17,1419868800,'1419897600','待约',NULL,NULL,NULL),(607,42,17,1419868800,'1419898800','待约',NULL,NULL,NULL),(608,42,17,1419868800,'1419900000','待约',NULL,NULL,NULL),(609,42,17,1419868800,'1419901200','待约',NULL,NULL,NULL),(610,42,17,1419868800,'1419902400','待约',NULL,NULL,NULL),(611,42,17,1419868800,'1419903600','待约',NULL,NULL,NULL),(612,42,17,1419868800,'1419904800','待约',NULL,NULL,NULL),(613,42,17,1419868800,'1419906000','待约',NULL,NULL,NULL),(614,42,17,1419868800,'1419907200','待约',NULL,NULL,NULL),(615,42,17,1419868800,'1419908400','待约',NULL,NULL,NULL),(616,42,17,1419868800,'1419909600','待约',NULL,NULL,NULL),(617,42,17,1419868800,'1419910800','待约',NULL,NULL,NULL),(619,42,17,1419955200,'1419985200','待约',NULL,NULL,NULL),(620,42,17,1419955200,'1419986400','待约',NULL,NULL,NULL),(621,42,17,1419955200,'1419987600','待约',NULL,NULL,NULL),(622,42,17,1419955200,'1419988800','待约',NULL,NULL,NULL),(623,42,17,1419955200,'1419990000','待约',NULL,NULL,NULL),(624,42,17,1419955200,'1419991200','待约',NULL,NULL,NULL),(625,42,17,1419955200,'1419992400','待约',NULL,NULL,NULL),(626,42,17,1419955200,'1419993600','待约',NULL,NULL,NULL),(627,42,17,1419955200,'1419994800','待约',NULL,NULL,NULL),(628,42,17,1419955200,'1419996000','待约',NULL,NULL,NULL),(629,42,17,1419955200,'1419997200','待约',NULL,NULL,NULL);
/*!40000 ALTER TABLE `reservationdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spiteip`
--

DROP TABLE IF EXISTS `spiteip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spiteip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL COMMENT 'IP地址',
  `times` int(11) NOT NULL COMMENT '来访时间',
  `url` varchar(200) NOT NULL COMMENT '访问的URL',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='IP列表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spiteip`
--

LOCK TABLES `spiteip` WRITE;
/*!40000 ALTER TABLE `spiteip` DISABLE KEYS */;
/*!40000 ALTER TABLE `spiteip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statisticslog`
--

DROP TABLE IF EXISTS `statisticslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statisticslog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `ip` varchar(21) DEFAULT NULL COMMENT 'ip地址',
  `visittime` int(10) NOT NULL COMMENT '访问时间 时间戳',
  `sessionid` varchar(100) DEFAULT NULL COMMENT 'sessionID',
  `fromurl` varchar(255) DEFAULT NULL COMMENT '来路url 空是直接地址栏输入',
  `url` varchar(255) NOT NULL COMMENT '受访问url',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=772 DEFAULT CHARSET=utf8 COMMENT='统计日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statisticslog`
--

LOCK TABLES `statisticslog` WRITE;
/*!40000 ALTER TABLE `statisticslog` DISABLE KEYS */;
INSERT INTO `statisticslog` VALUES (538,'218.104.231.42',1419408341,'11fit3ogt3pdpunoe7ehu9cq53','','http://hwibs.boyicms.com/'),(539,'218.104.231.42',1419408344,'11fit3ogt3pdpunoe7ehu9cq53','','http://hwibs.boyicms.com/'),(540,'218.104.231.43',1419408498,'hk0u292g7l2aastnto8hhuop10','','http://hwibs.boyicms.com/'),(541,'218.104.231.42',1419412324,'11fit3ogt3pdpunoe7ehu9cq53','','http://hwibs.boyicms.com/'),(542,'218.104.231.42',1419412331,'11fit3ogt3pdpunoe7ehu9cq53','','http://hwibs.boyicms.com/'),(543,'218.104.231.42',1419412333,'11fit3ogt3pdpunoe7ehu9cq53','','http://hwibs.boyicms.com/'),(544,'218.104.231.43',1419412873,'lu3k1l1id5k6i5ogpklosfd463','','http://121.41.36.17:8000/'),(545,'218.104.231.43',1419412876,'lu3k1l1id5k6i5ogpklosfd463','','http://121.41.36.17:8000/'),(546,'218.104.231.43',1419412879,'lu3k1l1id5k6i5ogpklosfd463','','http://121.41.36.17:8000/'),(547,'218.104.231.43',1419413046,'11fit3ogt3pdpunoe7ehu9cq53','','http://hwibs.boyicms.com/'),(548,'218.104.231.43',1419413105,'11fit3ogt3pdpunoe7ehu9cq53','','http://hwibs.boyicms.com/'),(549,'218.104.231.43',1419413241,'11fit3ogt3pdpunoe7ehu9cq53','','http://hwibs.boyicms.com/'),(550,'218.104.231.43',1419413242,'11fit3ogt3pdpunoe7ehu9cq53','','http://hwibs.boyicms.com/'),(551,'218.104.231.43',1419468825,'qod1a0pfqbhvda3q4nub5lil64','','http://hwibs.boyicms.com/'),(552,'218.104.231.42',1419474868,'qod1a0pfqbhvda3q4nub5lil64','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(553,'218.104.231.42',1419477710,'3obnu79o4ddc1naq0nfv5jg5e0','','http://hwibs.boyicms.com/'),(554,'218.104.231.42',1419477713,'3obnu79o4ddc1naq0nfv5jg5e0','','http://hwibs.boyicms.com/'),(555,'218.104.231.42',1419478081,'4t079b31uqjo0vvhce5aj6p941','','http://hwibs.boyicms.com/'),(556,'218.104.231.42',1419479018,'h7tt9s8cm48b6uhpkvqfm3kq22','','http://hwibs.boyicms.com/'),(557,'218.104.231.42',1419479368,'4t079b31uqjo0vvhce5aj6p941','','http://hwibs.boyicms.com/'),(558,'218.104.231.42',1419487833,'rr08rs90hsuqnkbv05lam7jk07','','http://hwibs.boyicms.com/'),(559,'218.104.231.42',1419489518,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=79'),(560,'218.104.231.43',1419489606,'vl06p12bjj33q30brg59ld6e74','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(561,'218.104.231.43',1419490563,'vl06p12bjj33q30brg59ld6e74','','http://hwibs.boyicms.com/'),(562,'218.104.231.43',1419490568,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(563,'218.104.231.43',1419490590,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(564,'218.104.231.43',1419490612,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(565,'218.104.231.43',1419490653,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(566,'218.104.231.43',1419490677,'rr08rs90hsuqnkbv05lam7jk07','','http://hwibs.boyicms.com/'),(567,'218.104.231.43',1419490679,'rr08rs90hsuqnkbv05lam7jk07','','http://hwibs.boyicms.com/'),(568,'218.104.231.43',1419490695,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(569,'218.104.231.43',1419490695,'rr08rs90hsuqnkbv05lam7jk07','','http://hwibs.boyicms.com/'),(570,'218.104.231.43',1419492040,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(571,'218.104.231.43',1419492501,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(572,'218.104.231.43',1419492588,'vl06p12bjj33q30brg59ld6e74','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(573,'218.104.231.43',1419493080,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(574,'218.104.231.43',1419493119,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(575,'218.104.231.43',1419493127,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(576,'218.104.231.43',1419493201,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(577,'218.104.231.43',1419493208,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(578,'218.104.231.43',1419493257,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(579,'218.104.231.43',1419493313,'vl06p12bjj33q30brg59ld6e74','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(580,'218.104.231.43',1419493318,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(581,'218.104.231.43',1419493320,'vl06p12bjj33q30brg59ld6e74','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(582,'218.104.231.43',1419493322,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(583,'218.104.231.43',1419493334,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(584,'218.104.231.43',1419493347,'vl06p12bjj33q30brg59ld6e74','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(585,'218.104.231.43',1419493432,'vl06p12bjj33q30brg59ld6e74','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(586,'218.104.231.42',1419493506,'vl06p12bjj33q30brg59ld6e74','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(587,'218.104.231.42',1419493554,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=article&op=article&id=2712'),(588,'218.104.231.43',1419494967,'vl06p12bjj33q30brg59ld6e74','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(589,'218.104.231.42',1419496259,'trkfvpka7b74qemf360meau1u7','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=doctor&op=doctor&id=15'),(590,'218.104.231.42',1419496512,'vl06p12bjj33q30brg59ld6e74','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(591,'218.104.231.42',1419496533,'vl06p12bjj33q30brg59ld6e74','','http://hwibs.boyicms.com/'),(592,'218.104.231.42',1419496662,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(593,'218.104.231.42',1419496666,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(594,'218.104.231.43',1419497128,'rr08rs90hsuqnkbv05lam7jk07','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(595,'218.104.231.43',1419497136,'rr08rs90hsuqnkbv05lam7jk07','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(596,'218.104.231.43',1419497184,'rr08rs90hsuqnkbv05lam7jk07','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(597,'218.104.231.43',1419497954,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(598,'218.104.231.43',1419497964,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(599,'218.104.231.43',1419497978,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(600,'218.104.231.42',1419498127,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(601,'218.104.231.42',1419498193,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(602,'218.104.231.42',1419498256,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(603,'218.104.231.42',1419498261,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(604,'218.104.231.42',1419498303,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(605,'218.104.231.42',1419499122,'vl06p12bjj33q30brg59ld6e74','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(606,'218.104.231.43',1419499431,'vl06p12bjj33q30brg59ld6e74','','http://hwibs.boyicms.com/'),(607,'218.104.231.42',1419499900,'h8qhu9uetngbtpn0tnosb1r7r6','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(608,'218.104.231.42',1419557648,'v9nil5r6uv6cl57q4anf3d5t13','','http://hwibs.boyicms.com/'),(609,'218.104.231.42',1419557685,'nfnumqddnqcfss39dth47cic40','','http://hwibs.boyicms.com/'),(610,'218.104.231.42',1419558016,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(611,'218.104.231.43',1419558024,'mj04e53rf0gbo2ncp99pgf0lp3','','http://hwibs.boyicms.com/'),(612,'218.104.231.43',1419558037,'mj04e53rf0gbo2ncp99pgf0lp3','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/fubanya/2708.html'),(613,'218.104.231.42',1419558045,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(614,'218.104.231.43',1419558134,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(615,'218.104.231.43',1419558151,'mj04e53rf0gbo2ncp99pgf0lp3','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/index.html'),(616,'218.104.231.43',1419558156,'mj04e53rf0gbo2ncp99pgf0lp3','','http://hwibs.boyicms.com/index.html'),(617,'218.104.231.42',1419558438,'mj04e53rf0gbo2ncp99pgf0lp3','','http://hwibs.boyicms.com/'),(618,'218.104.231.42',1419558789,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(619,'218.104.231.42',1419558792,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(620,'218.104.231.43',1419558899,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=news&op=news&id=58'),(621,'218.104.231.43',1419558942,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=81'),(622,'218.104.231.43',1419558952,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=80'),(623,'218.104.231.43',1419559002,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=81'),(624,'218.104.231.42',1419559012,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(625,'218.104.231.42',1419559034,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=81'),(626,'218.104.231.42',1419559072,'mj04e53rf0gbo2ncp99pgf0lp3','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(627,'218.104.231.42',1419559088,'mj04e53rf0gbo2ncp99pgf0lp3','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(628,'218.104.231.42',1419559123,'mj04e53rf0gbo2ncp99pgf0lp3','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/hospital/environment/14.html'),(629,'218.104.231.42',1419559128,'mj04e53rf0gbo2ncp99pgf0lp3','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/hospital/device/8.html'),(630,'218.104.231.42',1419559384,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=81'),(631,'218.104.231.42',1419559454,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=77'),(632,'218.104.231.42',1419559557,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=80'),(633,'218.104.231.43',1419559925,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=81'),(634,'218.104.231.43',1419559939,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=77'),(635,'218.104.231.42',1419560068,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=77'),(636,'218.104.231.42',1419560075,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=77'),(637,'218.104.231.42',1419560100,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=77'),(638,'218.104.231.42',1419560109,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=77'),(639,'218.104.231.42',1419560173,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(640,'218.104.231.42',1419560177,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/etck/wgfb/'),(641,'218.104.231.42',1419560181,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/etck/wgfb/','http://hwibs.boyicms.com/etck/wgfb/list_1.html'),(642,'218.104.231.42',1419560211,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=article&op=article&id=2710'),(643,'218.104.231.42',1419560570,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(644,'218.104.231.42',1419560789,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(645,'218.104.231.42',1419561291,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/etck/wgfb/'),(646,'218.104.231.43',1419562075,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(647,'218.104.231.43',1419562105,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=disease&op=disease&id=81'),(648,'218.104.231.43',1419562199,'nfnumqddnqcfss39dth47cic40','','http://hwibs.boyicms.com/'),(649,'218.104.231.42',1419564592,'mj04e53rf0gbo2ncp99pgf0lp3','','http://hwibs.boyicms.com/'),(650,'218.104.231.42',1419564856,'mj04e53rf0gbo2ncp99pgf0lp3','','http://hwibs.boyicms.com/'),(651,'218.104.231.42',1419564945,'mj04e53rf0gbo2ncp99pgf0lp3','','http://hwibs.boyicms.com/'),(652,'218.104.231.42',1419565298,'mj04e53rf0gbo2ncp99pgf0lp3','','http://hwibs.boyicms.com/'),(653,'218.104.231.43',1419566136,'mj04e53rf0gbo2ncp99pgf0lp3','','http://hwibs.boyicms.com/'),(654,'218.104.231.43',1419566150,'mj04e53rf0gbo2ncp99pgf0lp3','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(655,'218.104.231.43',1419566169,'mj04e53rf0gbo2ncp99pgf0lp3','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(656,'218.104.231.43',1419566197,'mj04e53rf0gbo2ncp99pgf0lp3','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(657,'218.104.231.43',1419566204,'mj04e53rf0gbo2ncp99pgf0lp3','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/wy/2712.html'),(658,'218.104.231.42',1419566208,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/etck/wgfb/'),(659,'218.104.231.42',1419566226,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(660,'218.104.231.42',1419566243,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(661,'218.104.231.42',1419566357,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(662,'218.104.231.42',1419566360,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(663,'218.104.231.42',1419566363,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(664,'218.104.231.42',1419566372,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(665,'218.104.231.42',1419566379,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(666,'218.104.231.42',1419566463,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(667,'218.104.231.42',1419566464,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(668,'218.104.231.42',1419566476,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(669,'218.104.231.42',1419566481,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(670,'218.104.231.43',1419566587,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(671,'218.104.231.43',1419566591,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(672,'218.104.231.42',1419573475,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(673,'218.104.231.42',1419573478,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(674,'218.104.231.42',1419573665,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(675,'218.104.231.42',1419573678,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/etck/index.html'),(676,'218.104.231.42',1419573697,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(677,'218.104.231.42',1419573708,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(678,'218.104.231.42',1419573738,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/etck/index.html'),(679,'218.104.231.42',1419574626,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(680,'218.104.231.42',1419574629,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/etck/index.html'),(681,'218.104.231.42',1419574640,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(682,'218.104.231.42',1419574654,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(683,'218.104.231.42',1419574667,'t8cd1aq8ldkjf2jhr1vha35fc4','','http://hwibs.boyicms.com/yachimeibai/index.html'),(684,'218.104.231.43',1419574942,'t8cd1aq8ldkjf2jhr1vha35fc4','','http://hwibs.boyicms.com/yachimeibai/index.html'),(685,'218.104.231.42',1419575699,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(686,'218.104.231.42',1419575704,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(687,'218.104.231.42',1419575724,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(688,'218.104.231.42',1419575735,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(689,'218.104.231.42',1419575972,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(690,'218.104.231.42',1419576138,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(691,'218.104.231.42',1419576146,'t8cd1aq8ldkjf2jhr1vha35fc4','','http://hwibs.boyicms.com/yachimeibai/index.html'),(692,'218.104.231.42',1419576151,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(693,'218.104.231.42',1419576182,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(694,'218.104.231.42',1419576269,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(695,'218.104.231.42',1419576277,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(696,'218.104.231.42',1419576301,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(697,'218.104.231.42',1419576321,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(698,'218.104.231.42',1419576338,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(699,'218.104.231.42',1419576362,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(700,'218.104.231.43',1419576445,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(701,'218.104.231.43',1419576448,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(702,'218.104.231.43',1419576458,'t8cd1aq8ldkjf2jhr1vha35fc4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/etck/index.html'),(703,'218.104.231.42',1419576702,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(704,'218.104.231.43',1419576905,'v9nil5r6uv6cl57q4anf3d5t13','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(705,'218.104.231.42',1419576907,'nfnumqddnqcfss39dth47cic40','','http://hwibs.boyicms.com/yachimeibai/index.html'),(706,'218.104.231.42',1419578708,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(707,'218.104.231.42',1419579057,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/etck/index.html'),(708,'218.104.231.42',1419579066,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(709,'218.104.231.42',1419579380,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(710,'218.104.231.42',1419579385,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/index.html'),(711,'218.104.231.42',1419579440,'nfnumqddnqcfss39dth47cic40','','http://hwibs.boyicms.com/'),(712,'218.104.231.42',1419579453,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/etck/index.html'),(713,'218.104.231.42',1419579460,'nfnumqddnqcfss39dth47cic40','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/ycjz/index.html'),(714,'218.104.231.42',1419579688,'1gvop1u5ih33rbef044jicmje4','','http://hwibs.boyicms.com/'),(715,'218.104.231.42',1419580159,'nksn0aqfqqmie68nh1uequql13','','http://hwibs.boyicms.com/'),(716,'218.104.231.42',1419580378,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(717,'218.104.231.42',1419580494,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(718,'218.104.231.42',1419580806,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(719,'218.104.231.42',1419580841,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(720,'218.104.231.42',1419580952,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(721,'218.104.231.42',1419580963,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/reservation.html'),(722,'218.104.231.42',1419581125,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/sitemap.html'),(723,'218.104.231.42',1419581164,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/sitemap.html','http://hwibs.boyicms.com/hospital/success/index.html'),(724,'218.104.231.42',1419582390,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(725,'218.104.231.42',1419582393,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/sitemap.html'),(726,'218.104.231.42',1419582402,'1gvop1u5ih33rbef044jicmje4','','http://hwibs.boyicms.com/sitemap.html'),(727,'218.104.231.42',1419588299,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(728,'218.104.231.42',1419588326,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/doctor/19.html','http://hwibs.boyicms.com/yachimeibai/fubanya/2708.html'),(729,'218.104.231.42',1419588335,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/doctor/19.html','http://hwibs.boyicms.com/reservation.html'),(730,'218.104.231.42',1419588339,'1gvop1u5ih33rbef044jicmje4','http://hwibs.boyicms.com/doctor/19.html','http://hwibs.boyicms.com/doctor/19.html'),(731,'218.104.231.43',1419815604,'i04p27a25k0d5gcep4kb7p2e21','','http://hwibs.boyicms.com/'),(732,'218.104.231.42',1419816209,'so7uigvlgekeiffac5bg26bhk7','','http://hwibs.boyicms.com/'),(733,'218.104.231.42',1419821583,'npjm5qm0q3ah0ej7iqme3i5hi3','','http://hwibs.boyicms.com/'),(734,'218.104.231.42',1419831877,'npjm5qm0q3ah0ej7iqme3i5hi3','','http://hwibs.boyicms.com/'),(735,'218.104.231.42',1419834507,'so7uigvlgekeiffac5bg26bhk7','','http://hwibs.boyicms.com/'),(736,'218.104.231.43',1419841415,'8h9qi9n93it720u4smff6nk8k4','','http://hwibs.boyicms.com/'),(737,'101.199.108.53',1419851735,'cdehcb93trbrhmen4qj61ro0e7','','http://hwibs.boyicms.com/'),(738,'218.104.231.42',1419901953,'b43fl16vgl2gak35kcpkii1513','','http://hwibs.boyicms.com/'),(739,'218.104.231.42',1419902139,'57bbriq8ocobl84e9po3n0umo2','','http://hwibs.boyicms.com/'),(740,'218.104.231.43',1419904213,'57bbriq8ocobl84e9po3n0umo2','','http://hwibs.boyicms.com/'),(741,'218.104.231.42',1419905145,'qc3ir6rnstjrlj4v4j15jcv1j7','','http://hwibs.boyicms.com/'),(742,'218.104.231.42',1419923592,'b43fl16vgl2gak35kcpkii1513','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(743,'218.104.231.42',1419923616,'b43fl16vgl2gak35kcpkii1513','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(744,'218.104.231.42',1419923628,'b43fl16vgl2gak35kcpkii1513','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(745,'218.104.231.42',1419923630,'b43fl16vgl2gak35kcpkii1513','','http://hwibs.boyicms.com/'),(746,'218.104.231.42',1419923632,'b43fl16vgl2gak35kcpkii1513','','http://hwibs.boyicms.com/'),(747,'218.104.231.42',1419923642,'b43fl16vgl2gak35kcpkii1513','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/sitemap.html'),(748,'218.104.231.43',1419924431,'um0vrf8d11bs65e5un5s09n487','','http://hwibs.boyicms.com/'),(749,'218.104.231.42',1419928423,'df2upi5f5opv4us5k3db3apr93','','http://hwibs.boyicms.com/'),(750,'218.104.231.42',1419929417,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(751,'218.104.231.42',1419929421,'107h6t5u42ka5r90pm8pntvms4','','http://hwibs.boyicms.com/ask/'),(752,'218.104.231.42',1419929456,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=ask&op=ask&id=1031'),(753,'218.104.231.42',1419929502,'107h6t5u42ka5r90pm8pntvms4','','http://hwibs.boyicms.com/ask/'),(754,'218.104.231.42',1419929509,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/ask/','http://hwibs.boyicms.com/ask/1031.html'),(755,'218.104.231.42',1419929523,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/ask/','http://hwibs.boyicms.com/ask/#'),(756,'218.104.231.42',1419929560,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=ask&op=ask&id=1032'),(757,'218.104.231.42',1419929576,'107h6t5u42ka5r90pm8pntvms4','','http://hwibs.boyicms.com/ask/'),(758,'218.104.231.42',1419929581,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/ask/','http://hwibs.boyicms.com/ask/#'),(759,'218.104.231.42',1419929588,'107h6t5u42ka5r90pm8pntvms4','','http://hwibs.boyicms.com/ask/'),(760,'218.104.231.42',1419929594,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/controller/?controller=ViewHtml&method=ask&op=ask&id=1032'),(761,'218.104.231.42',1419929615,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(762,'218.104.231.42',1419929618,'107h6t5u42ka5r90pm8pntvms4','','http://hwibs.boyicms.com/ask/'),(763,'218.104.231.42',1419929622,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/ask/','http://hwibs.boyicms.com/ask/1032.html'),(764,'218.104.231.43',1419929939,'vplp58esf3387g1j61j47mk590','','http://hwibs.boyicms.com/'),(765,'218.104.231.42',1419933616,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(766,'218.104.231.43',1419933836,'434cun8fg8gdgbqefllvir19j6','','http://hwibs.boyicms.com/'),(767,'218.104.231.42',1419933932,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(768,'218.104.231.42',1419934479,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(769,'218.104.231.42',1419934842,'107h6t5u42ka5r90pm8pntvms4','http://hwibs.boyicms.com/hcc/main.html','http://hwibs.boyicms.com/'),(770,'218.104.231.43',1419992231,'iafdf4rls5bnlks3kfguem0ih2','','http://hwibs.boyicms.com/'),(771,'218.104.231.43',1419992961,'iafdf4rls5bnlks3kfguem0ih2','http://hwibs.boyicms.com/','http://hwibs.boyicms.com/yachimeibai/fubanya/2708.html');
/*!40000 ALTER TABLE `statisticslog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `success`
--

DROP TABLE IF EXISTS `success`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `recommendposition_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `worker_id` tinyint(3) unsigned DEFAULT NULL,
  `is_top` tinyint(3) unsigned DEFAULT NULL,
  `updatetime` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='案例表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `success`
--

LOCK TABLES `success` WRITE;
/*!40000 ALTER TABLE `success` DISABLE KEYS */;
INSERT INTO `success` VALUES (23,'智齿得到有效治疗','','','','<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">患者：秦女士</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">年龄：20岁</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">情况：右下后牙疼痛1周，影响进食，要求治疗。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">诊断：智齿阻生牙。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">治疗方案：拔除智齿。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">秦女士因为右下后牙疼痛1周了，对生活影响很大，严重影响着进食等。最后，经过朋友的介绍，她来到了华南中正口腔医院，经过医院专家的检查，发现秦女士是因为智齿阻生牙引起的，需要拔除智齿。经过华南中正口腔医院专家的专业精心操作，现在秦女士的牙齿恢复了健康，也不在疼了。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">华南中正口腔医院专家指出，有些人因为牙龈间隙太小，或者吃的食物太精细等原因导致智齿发育不全，或形成阻生齿，这样的智齿严重影响了口腔健康，影响着人们的饮食和生活，所以应该予以拔除。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">拔智齿后咬住止血棉球，等到半小时后再吐掉，一般来说，两小时内不要进食饮水。拔智齿当天不要漱口或者刷牙，以预防再出血。拔智齿当日可进软食，食物不宜过热，避免用拔智齿侧咀嚼。拔智齿后勿用舌舔创口，更不宜反复吮吸，以便保护拔智齿创内的血凝块。拔智齿后口内有少量渗血亦属正常，如大量出血且出血不止，请尽快就诊。</p>',73,'智齿得到有效治疗','','氟斑牙是牙齿颜色不好看症状当中比较典型的一种，是慢性氟中毒的早期常见的症状之一；出现氟斑牙给人的形象损害比较大，更严重的是影响了身心健康。那么，氟斑牙对人体有什么影响？看看专家的介绍。',1419488078,0,71,43,'',5,0,1419488078),(24,'牙周炎的成功案例','','','中正','<p style=\\\"text-indent: 2em\\\">姓名：黄先生</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">病症：牙周炎</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">治疗方案：控制细菌和菌斑，超声波洗牙</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">黄先生患有牙周炎，对于口腔牙齿影响很大，不仅造成牙齿上层组织被破坏，而且对于牙齿的伤害很大。黄先生在朋友的介绍下来到了华南中正口腔医院进行治疗。通过华南中正口腔医院专家的检查治疗后，现在黄先生的牙齿健康了，也把多年来的牙齿疾病给去除掉了。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">华南中正口腔医院专家介绍。牙周炎是侵犯牙龈和牙周组织的慢性炎症，导致牙周袋的形成及袋壁的炎症。牙周病不是刷牙能够刷掉的，每天要刷牙三次，每次三分钟，才能保持口腔最基本的清洁，通过每半年到一年定期的洁牙，配合每天正确的刷牙，才能很好地保护自己的牙周组织。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">牙 周病的治疗主要是控制细菌和菌斑。首先，顾客要掌握有效的口腔卫生控制措施，学会正确的刷牙方法，正确使用牙线、牙间隙刷，这和医生的治疗同等重要。其 次，要由专业的牙科医生进行系统的治疗，包括洁治等多项基础治疗，同时去除口腔中细菌滞留因素等。最后，顾客需要定期维护治疗。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">华南中正口腔医院专家介绍：牙周炎的进展缓慢, 早期症状不明显, 有的只是在刷牙时偶尔出血, 随着病变发展, 可出现刷牙出血, 咬硬物时食物上有血迹, 病变再发展就会出现牙床肿胀、发痒、牙周脓肿等等。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">目 前超声波洗牙机是比较理想的治疗仪器。超声波洗牙是指由医生用超声震动洁齿器或手工器械去除牙齿表面和牙间隙中的牙石和菌斑，牙周病的基础治疗之一，预防 牙周病的重要手段。牙周病应早防早治，预防方面就是要注意口腔卫生，合理调节营养，养成良好的饮食习惯。要加强营养，增强人体机能的抗病能力。</p>',47,'牙周炎的成功案例','牙周炎的成功案例','黄先生患有牙周炎，对于口腔牙齿影响很大，不仅造成牙齿上层组织被破坏，而且对于牙齿的伤害很大。黄先生在朋友的介绍下来到了华南中正口腔医院进行治疗。通过华南中正口腔医院专家的检查治疗后，现在黄先生的牙齿健康了，也把多年来的牙齿疾病给去除掉了。',1419488210,0,78,46,'',5,1,1420446304),(25,'60岁李先生种植牙成功','','','','<p style=\\\"text-indent: 2em\\\">60岁的李先生，非常注重身体健康，每天早晨7点左右准时出门，陪同老伴到离家2公里的菜场买菜，锻炼身体。平时他也爱好吃保健品，讲起养生一套一套的，做什么运动、吃什么东西等健康养生知识是样样精通。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">可 是李先生却有一件烦心事，那就是他的牙口一直都不好，李先生自述说以前年轻的时候老是喜欢吃一些甜零食，并且由于口腔清洁工作做的不到位，导致40来岁的 时候牙齿慢慢的脱落，自己孩子比较爱自己，会带他去医院活动假牙，但是活动假牙不牢靠，清洁起来也不是非常的容易，最终牙齿问题越来越严重，现牙齿全口缺 失。已经是全口的活动假牙，像瓜子、甘蔗这类东西根本都不能想，饭菜稍稍硬一些，他吃起来就很艰难。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">一天，李先生无意中听到自己的儿媳说华南中正口腔植得口腔牙齿种植中心的种植牙技术，就想来试试看，于是问老伴是否可行，老伴都说你先当个试验品，好了我再去种。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">这 天，李先生按照预约时间来到植得口腔，之后种植牙专家给他做了详细的检查，首先给王先生做了口腔全景片的检查，然后一边在电脑上给他演示种牙的精确位置、 颗数，一边给他分析这样设计的优势和好处。考虑到李先生的年纪和经济原因，全口种植牙又昂贵，根据实际情况，做出折中的修复方法是&ldquo;打桩&rdquo;(种植牙)+ &ldquo;搭桥&rdquo;(镶假牙)。手术很顺利，也很成功。李先生觉的种牙比拔牙还轻松，一点都不痛，还很好看哩。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">回 到家中，老伴儿看到王先生漂亮的种植牙，边嚷嚷着：&ldquo;花这钱干啥!&rdquo;一边找李先生的种植牙病例本，并找到了预约电话&hellip;&hellip;随着口腔医学技术的进步，全口无牙 的治疗趋势是：种植牙结合传统的镶牙。种植牙好比在口腔里&ldquo;打桩&rdquo;，再在桩上&ldquo;搭桥&rdquo;，即镶假牙。这种&ldquo;种植覆盖义齿&rdquo;的方法比全口种植牙要经济很多，比 传统镶牙要牢固很多，功能也更好。</p>',93,'60岁李先生种植牙成功','牙,成功,种植,先生,李,60岁,','牙,成功,种植,先生,李,60岁,',1419488306,1,68,42,'',5,1,1419488306),(27,'种植牙失败后选择我院种植牙修复成功','','','','<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">前些日子一位32岁的胡女士下口牙缺失，听她说在半年前曾经在一家小诊所做了种植牙修复，可是却因为手术的失败，需要重做种植牙手术。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">这次她来到了我们华南中正口腔医院，我院牙齿种植专家在为胡女士做了仔细检查之后，在和专家团队经过研究，最后经过制定了一下的修复方案：先修复胡女士的牙槽，再通过电脑技术为胡女士重做种植牙。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">因为上次吸取了教训，这次，胡女士要求做全院最好的种植体，于是，专家们决定使用美国bincon种植体为胡女士修复。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">种植牙是一项高新医学技术，世界口腔种植技术首推欧美，为了与国际潮流接轨，华南中正口腔医院凭借雄厚的实力引进国际知名品牌&mdash;&mdash;美国 NOBEL种植系统，目前成功为1500多位牙齿缺失者进行过牙齿种植手术，并一致获得好评，获得良好口碑。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">手术相当成功，胡女士苏醒之后，第一件事就是照镜子，她看了自己的牙齿表示十分满意，连上次因为种植牙失败造成的疼痛也消失了，专家团队也感到非常的高兴击掌欢呼&hellip;&hellip;</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">目前全球牙医公认的种植牙系统，美国&nbsp;NOBEL种植牙较其他种植牙，体积更小，由于选用的是与人体相容性极好的生物材料，人体不产生任何不良的副作用，预防了骨吸引，保住了牙槽骨，使面部不会变型、得以永保青春形象。</p>',41,'种植牙失败后选择我院种植牙修复成功','','前些日子一位32岁的胡女士下口牙缺失，听她说在半年前曾经在一家小诊所做了种植牙修复，可是却因为手术的失败，需要重做种植牙手术。',1419488605,0,79,41,'',5,0,1419488605),(28,'儿童牙齿矫正成功案例','','','中正','<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">患者：杨杨</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">年龄：12岁</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">牙症：牙齿地包天</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">检查：上下牙齿咬颌不齐，有轻微地包天现象</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">矫正方法：直丝弓矫正方式进行牙齿矫正</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">矫正后：咬合关系正常了，牙齿变整齐漂亮了。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">林女士12岁的杨杨因为牙齿上下牙齿咬颌不齐，下排牙齿向右边倾斜，常常被同学取笑，因此，非常厌学，跟同学相处也不愉快，逐渐变得沉默寡言了，他还因为这个原因逃课，经常因为这样被老师叫去批评，后来经过林女士对其进行了解，询问，才知道儿子因为这个问题而烦恼。通过朋友对林女士的介绍后，林女士带杨杨来到了华南中正口腔医院进行了矫正治疗。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">通过华南中正口腔医院专家的检查发现，杨杨上下牙齿咬颌不齐，下排牙齿向右边倾斜，伴有轻微地包天现象。经过华南中正口腔医院专家与林女士协商之后，决定为杨杨进行直丝弓矫正方式进行牙齿矫正。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">陈专家先为杨杨进行全面的口腔检查，根据患者实际情况选择合适的弓丝，做符合患者的特性化设计。较于传统牙齿矫正方式，直丝弓矫正全程仅需几根弓丝，使得矫正时间缩短近三分之一，复诊时间缩短二分之一，次数也大大减少。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">因为小杨杨的密切配合，使得牙齿矫正过程很顺利，牙齿矫正也大功告成。前不久，家长带杨杨前来做最后一次复诊，都十分兴奋，林先生（杨杨的爸爸）说到，做了牙齿矫正之后，杨杨不仅牙齿整齐了，脸上的笑容一天多于一天，最近胃口也越来越好了，全家人都十分高兴。</p>',74,'儿童牙齿矫正成功案例','儿童牙齿矫正成功案例','林女士12岁的杨杨因为牙齿上下牙齿咬颌不齐，下排牙齿向右边倾斜，常常被同学取笑，因此，非常厌学，跟同学相处也不愉快，逐渐变得沉默寡言了，他还因为这个原因逃课，经常因为这样被老师叫去批评，后来经过林女士对其进行了解，儿子因为这个问题而烦恼。',1419490435,1,80,47,'',5,0,1419490435),(29,'反复口腔溃疡成功治疗案例','','','中正','<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">患者：张女士 年龄：27</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">患者主诉：反复口腔糜烂、灼热、疼痛1年。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">患者病历：1年多来反复口腔溃疡及牙龈肿痛，继之口腔黏膜出现白色条纹，触之糜烂，疼痛，灼热，口干苦，不欲饮，咽喉不适，心烦易怒，眼胀，失眠多梦，记忆力差，疲乏无力，大便时干时稀，小便正常，月经量多，色暗红。白带量多。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">诊断: 中医诊断口糜，属湿热阻滞，兼肝肾阴虚的扁平苔藓。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">治疗：根据多年临床经验研究出免疫平衡疗法，采用辩证施治，结合患者本身体质进行药物加减治疗，治宜清热除湿，补益肝肾，患友服用药物一个半月后糜烂面全愈合，睡眼质量得到很大的改善，症状基本上都消失。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-indent: 2em;\\\">预后：继续服用两个月后病愈，回访没有在发作。</p>',73,'反复口腔溃疡成功治疗案例','反复口腔溃疡成功治疗案例','张女士因为患有口腔溃疡，1年多来反复口腔溃疡及牙龈肿痛，继之口腔黏膜出现白色条纹，触之糜烂，疼痛，灼热，口干苦，不欲饮，咽喉不适，心烦易怒，眼胀，失眠多梦，记忆力差，疲乏无力，大便时干时稀，小便正常，月经量多，色暗红。白带量多。',1419494512,1,79,41,'',5,1,1419494512);
/*!40000 ALTER TABLE `success` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tag` varchar(50) NOT NULL COMMENT 'tag',
  `plushtime` int(10) NOT NULL COMMENT '写入时间戳 与文章写入时间相关',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=utf8 COMMENT='Tags与文章联系表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (262,'华南中正口腔荣封“党员诚信店”',1419475156),(264,'中正口腔荣获台江“党员诚信店”',1419475204),(265,'华南中正获福州2014年十佳口腔品牌',1419475086),(276,'中秋佳节中正口腔优惠多',1419487060),(277,'本院，保健，特色',1419558227),(278,'特色',1419558842),(279,'特色',1419933975);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `technology`
--

DROP TABLE IF EXISTS `technology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `recommendposition_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '推荐位置',
  `updatetime` int(11) unsigned DEFAULT NULL,
  `is_top` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COMMENT='特色技术表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `technology`
--

LOCK TABLES `technology` WRITE;
/*!40000 ALTER TABLE `technology` DISABLE KEYS */;
INSERT INTO `technology` VALUES (100,'福州种植牙的优势有哪些','','<p style=\\\"text-indent: 2em\\\">种植牙的优势有美观，舒适方便，不磨牙，功能强等优势。种植牙技术是采用生物材料制成的一种仿生牙，通过计算机精确计算加工出的牙种植体，将其植入颌骨内，作为人造牙根，然后塑造牙冠外形，获得与天然牙一样的形态及功能。以下是专家针对<strong>福州种植牙的优势有哪些</strong>的介绍。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><strong>1、种植牙美观</strong></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">根据就诊者的脸型、其他牙齿的形状与颜色制作牙冠，达到整体协调和美观的最佳效果。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><strong>2、舒适方便</strong></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">不同于传统假牙的有钩、套等等，严重影响爱美者的形象与外观。种植牙美学效果良好，自然、舒适，最大限度接近真牙形态。种植牙通过自身的牙根固定，不无需基托与卡环，因此患者没有异物感，而且有利于保持口腔的清洁卫生。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><strong>3 、种植牙不磨牙</strong></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">依靠自身的人工牙根进行修复，不用磨旁边的健康牙齿，对牙齿没有任何伤害。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><strong>4 、种植牙功能强</strong></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">天然牙将口腔内的咀嚼压力通过牙根传递至牙槽骨，而种植牙将咀嚼压力通过人工牙根(种植体)传递至牙槽骨，生物力学原理相同，故能承受强大的力量，咀嚼效率较传统假牙有大幅度提高。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><strong>5 、种植牙固位好</strong></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">不使用传统镶牙的卡环或牙套，人工牙根牙槽骨紧密结合，像真牙一样扎根在口腔里，具有很强的固位力与稳定性。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><strong>6、种植牙操作简单</strong></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">种植牙手术是一个较小的牙槽外科手术，类似拔牙，采用局部麻醉，创伤小，术后即可进食，几乎无痛苦。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><span style=\\\"color: #ff0000\\\"><strong>&gt;&gt;&gt;做种植牙要多少钱？推荐阅读：</strong></span><a href=\\\"http://www.zzckyy.com/yczz/zzyjg/2605.html\\\" target=\\\"_blank\\\"><span style=\\\"color: #ff0000\\\"><strong>种植牙的价格是多少</strong></span></a></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">以上就是华南中正口腔医院专家对于福州种植牙的优势有哪些的介绍，福州牙科医院专家指出，种植牙由于选用的是与人体相容性极好的生物材料，种植牙对人体不产生任何不良的副作用。如果你还存在着疑问，可以通过在线咨询链接，和专家进行一对一交谈。</p>',94,'福州种植牙的优势有哪些','福州种植牙的优势有哪些，种植牙的优势','福州种植牙的优势有哪些？种植牙的优势有美观，舒适方便，不磨牙，功能强等优势。种植牙可以根据就诊者的脸型、其他牙齿的形状与颜色制作牙冠，达到整体协调和美观的最佳效果。',1419488380,0,41,0,'',1419488380,0),(101,'种植牙的好处','technology/20141225142230755.jpg','<p style=\\\"text-indent: 2em\\\"><strong><span id=\\\"fck_dom_range_temp_1345790043046_857\\\">种植牙的好处</span></strong><span id=\\\"fck_dom_range_temp_1345790043046_857\\\">？ 牙齿缺失采用种植牙具有功能强、不磨牙、固位好、舒适方便等效果。种植牙适应症主要有以下5点。种植义齿是由牙种植体及其支持的上部结构组成的修复体。牙 种植又称下部结构，为人工材料（钛合金类）所制，经手术植入失牙区颌骨内或骨膜下。以下是华南中正口腔医院专家针对种植牙的好处的具体介绍。</span></p>\r\n\r\n<div style=\\\"text-align: center\\\"><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225142251119.jpg\\\" style=\\\"width: 200px; height: 200px;\\\" /><br />\r\n种植牙的好处<br />\r\n&nbsp;</div>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><strong>种植牙的优势</strong></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">1、功能强：能很好地恢复牙齿功能，咀嚼功能大大优于其他传统假牙，研究显示假牙的咬合力只有自然牙的1/20，而自然牙的垂直咬合力40-50kg，种植牙的垂直咬合力35-40kg接近自然牙。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">2、不磨牙：依靠自身的人工牙根进行修复，不用磨旁边的健康牙齿，避免基牙预备可能带来的不良后果。对牙齿没有任何伤害。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">3、固位好：不使用传统镶牙的卡环或牙套，人工牙根牙槽骨紧密结合，像真牙一样扎根在口腔里，很强的固位与稳定功能，像真牙般固定于口腔中。具有很强的固位力与稳定性。<span style=\\\"color: #ff0000\\\">想了解牙齿种植的步骤，请点击：</span><a href=\\\"http://www.zzckyy.com/yczz/zzyxjjs/1606.html\\\"><span style=\\\"color: #ff0000\\\">牙齿种植的步骤有哪些？</span></a></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">4、舒适方便：不使用活动假牙必需的基托与卡环，没有异物感，非常舒适、方便，而且有利于保持口腔的清洁卫生。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><strong>种植牙适应症</strong>。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">1、牙槽骨骨量不足，可以通过植骨的方式解决。<span style=\\\"color: #ff0000\\\">想了解牙齿种植的时间，请点击：<a href=\\\"http://www.zzckyy.com/yczz/zzyxjjs/1622.html\\\"><span style=\\\"color: #ff0000\\\">种植牙齿能用多长时间</span></a></span></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">2、上颌窦与下颌管的问题，可通过x光片和ct指导下种植，螺旋ct可较准确地指导方向。选择适当种植体长度，和准确的植入角度。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">3、拔牙后即刻进行种植。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">4、对于经济条件不足的病人可以使用覆盖义齿修复的方法。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">5、对颌骨缺损、面部组织和器官的缺损也可以通过种植的方法修复。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">总体来说，根据口腔医学界统计得出：种植牙的失败率低于人类自身牙齿的失牙率，它在使用、维护得当的情况下可终身使用。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\">以上就是华南中正口腔医院专家针对种植牙的好处的介绍。日常生活中，我们要养成好的习惯，保障种植牙的效果，让种植牙的寿命更加的长久。如果你想了解更多，立即点击在线专家咨询。</p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><strong>华南中正口腔医院专家特别推荐阅读</strong></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><a href=\\\"http://www.zzckyy.com/yczz/zzyjg/1423.html\\\" target=\\\"_blank\\\">种植牙一颗要多少钱 </a></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><a href=\\\"http://www.zzckyy.com/yczz/zzyjg/1403.html\\\" target=\\\"_blank\\\"><span style=\\\"color: #ff0000\\\">种植牙如何正确护理 </span></a></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><a href=\\\"http://www.zzckyy.com/yczz/zzyjg/1402.html\\\" target=\\\"_blank\\\"><span style=\\\"color: #ff0000\\\">种植牙有没有副作用 </span></a></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><a href=\\\"http://www.zzckyy.com/yczz/zzyjg/1401.html\\\" target=\\\"_blank\\\">做种植牙需要具备哪些条件 </a></p>\r\n\r\n<p style=\\\"text-indent: 2em\\\"><a href=\\\"http://www.zzckyy.com/yczz/zzyjg/1366.html\\\" target=\\\"_blank\\\">种植牙修复牙齿好吗 </a></p>',41,'种植牙的好处','种植牙的好处','福州种植牙的优势有哪些？种植牙的优势有美观，舒适方便，不磨牙，功能强等优势。种植牙可以根据就诊者的脸型、其他牙齿的形状与颜色制作牙冠，达到整体协调和美观的最佳效果。',1419488587,1,42,0,'',1419488587,1),(102,'美国3M lava仿生美容冠','','<p><span style=\\\"line-height: 20.7999992370605px;\\\">什么是仿生美容冠？</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">&ldquo;仿生美容冠&rdquo;牙齿美容技术是仿生设计学的最新科技成果，是在&ldquo;美容冠&rdquo;牙齿美容技术上新的突破，更强调牙齿的美容效果，对错位牙、畸形牙的临床冠部分施以专业手段，最后用仿生美容冠加以修复。不仅具有美牙不拔牙，无痛苦，时间短，牙齿坚固，多年后牙龈不会出现黑线等优点。从而达到终生有保障的美牙效果。它在牙齿的&ldquo;形态&rdquo;、&ldquo;色泽&rdquo;、&ldquo;功能&rdquo;、&ldquo;结构&rdquo;、&ldquo;相容&rdquo;等各个方面完全比照真正牙齿，每颗仿生冠都由外部的瓷结构、中间的瓷粉、内部的进口瓷经由1120度高温融合而成，在结构上与真牙的牙釉质、牙本质完全相同。让仿生冠与您的口腔完美融合。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">装美容冠不影响牙齿功能，制作美容冠需要磨除一些牙体组织，有些患者因为这个会有点害怕;其实医生磨去的只是凹凸不平、已经伤痕累累的牙釉质而不是牙本质，因此不会伤害牙齿，反而是给牙齿穿上坚固的&ldquo;防弹衣&rdquo;，让它避免受到外界细菌的侵害，这样不仅可以恢复牙齿的美观，还不影响原有的咀嚼功能。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">哪些人适合做美容冠？</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">3M Lava全瓷美容冠非常适合一些先天畸形牙错过矫正黄金期的成年人，无需像传统矫正或者植牙不一样，不需要长期配到矫正器，更为方便快捷，只需短短7天时间内，上两次医院，就可以完美解决四环素牙、氟斑牙、暴牙、虎牙、老鼠牙（个小牙）、地包天、前牙拥挤、前牙稀疏、牙列不齐、牙齿缺损、烤瓷失败、错过矫正黄金期的成年人以及重度四环素牙等。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">美国3M Lava仿生美容冠，六大优点</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">1、身份代码保证质量，世界独一无二。来自美国的3M Lava?仿生美容冠是世界上惟一拥有身份代码，每一颗都可以通过3M ESPE网站验明真伪，杜绝假冒伪劣产品，保证质量，同时保护消费者利益。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">2、强度最高。美国3M Lava仿生美容冠，其具有超强韧性和钻石般强硬的表面，使用的氧化锆材料已被用于航天飞机的热屏蔽、保时捷汽车制动盘等的制作上。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">3、边缘密合度达到100%，保护牙齿的&ldquo;无菌盔甲&rdquo;。精确的密合度是临床成功的决定因素之一，3M LAVA仿生美容冠可确保高密合度，有效预防牙体损伤和牙周组织病变。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">4、专利内冠染色技术--8种不同的内冠颜色。美国3M Lava的内外颜色均匀一致，非常美观。由于具有8种内冠颜色，可以根据不同肤色、不同脸型来选择合适自己的牙齿。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">5、3D数码定位，个体化设计，不是真牙，超越真牙。以其卓越的材质、创新的工艺、出色的效果脱颖而出，精确的数字化制作工艺以及对原材料的精益求精，确保了每一颗LAVA牙冠都是艺术级的精品，依据求美者需求打造了不是真牙，超越真牙的效果。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">6、0疼痛，0损伤，7天拥有皓白牙齿。采用现代的麻醉技术及结合权威专家的精湛技术、丰富的临床实践经验，完美无失败案例的分析，保证牙神经不受到损伤，整个治疗过程无痛舒适，只需7天，就可以拥有一口皓白牙齿。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">美国 3M LAVA 仿生美容冠 6大美牙保障</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">1、不伤原牙</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">美容冠在不损伤牙齿、牙龈的前提下根据牙槽骨的形态对牙齿做修整，仅对不整齐的凸出部位进行精细打磨，无需拨牙。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">2、自然持久</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">德国VITA比色技术，以26阶牙色层次化类比，为你调配最适合牙色，更采用三维数字成型，使之呈现持久天然光泽。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">3、坚固耐磨</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">选用国际顶级材料，令修复后牙齿坚固耐磨，美容冠与原牙紧密贴合，有效保护原牙，自然美观。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">4、终生美齿</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">如能按医嘱进行保养，可相伴终生。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">5、无不良反应</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">无以往存在的牙龈红肿、黑线等现象。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">6、高效无痛</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">全程无痛，高效快速，2次治疗，只需等待5天，即可完成。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">美容冠与烤瓷牙区别：</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">比传统烤瓷牙更坚固、牙龈终身不会出现黑线。完美的生物相容性，不会出现红肿。全新科技的应用突破传统矫治工艺，体验舒适。整个过程均采用国际先进技术及精密设备，矫治更细致定位精确，牙齿更美观。&ldquo;美容冠&rdquo;因其精密、先进成为失败烤瓷牙的&ldquo;克星&rdquo;。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">其实美容冠和烤瓷牙可以说是牙齿美容中的&ldquo;双胞胎兄弟&rdquo;，息息相关，都是&ldquo;美&rdquo;的使者，但又有着一些区别。通常来说，烤瓷牙的作用主要是用来对患者的畸形牙齿进行改良端正，而美容冠的作用是在牙齿矫正的基础上对牙齿进一步美化。美容冠的主要步骤就是烤瓷牙的安置，因此，也可以说美容冠是烤瓷牙的延伸。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">美容冠美牙过程：</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">第一次， 上医院检查，确认牙齿的健康状况，对牙冠进行必要的打磨，有些还需进行牙髓治疗。然后，电脑会根据矫正者的脸型、肤色等因素设计出虚拟的最佳牙冠外形，并且据此迅速制作出一副临时牙让矫正者佩戴，以便让矫正者有个适应过程。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">第二次， 第二次，6天后再上医院，取下临时牙，换上已经制作好的全瓷牙，整个治疗过程便完成了。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">仿生美容冠术后注意事项：</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">1. 初戴仿生美容冠时有轻度不适感患者应耐心练习使用，逐渐适应。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">2. 初戴时应吃软的食物，适应后再吃正常食物。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">3. 仿生美容冠受到超过它的应力范围的压力会碎瓷，所以不要咬太硬的食物，比如核桃一类的东西。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">4. 初期与修复前相比，上下牙尖对位可能会有变化，要缓慢进食，逐渐适应，以免咬伤颊舌粘膜。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">5. 美容冠与基牙的接合处容易聚集菌斑，形成牙石，应注意 保持口腔清洁，养成餐后刷牙的习惯，牙缝间可以使用牙线清洁，并定期到医院检查、洁牙。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">6. 由于牙体预备时磨除了部分牙釉质，初戴美容冠时，会出现冷热敏感或疼痛，随时间推移会慢慢缓解。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">7. 初戴美容冠避免吃过凉过热的食物，以免引起激发痛。大约两周以后可以正常进食。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">8. 美容冠受到超过它的应力范围的压力会碎瓷，所以不要咬太硬的食物，比如核桃一类的东西;再者镶牙初期与修复前相比，上下牙尖对位不同，要缓慢进食，以免咬伤颊舌粘膜;还有美容冠与基牙的接合处容易聚集菌斑，形成牙石，应注意清洁，牙缝间可用牙线自洁。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">9. 认真执行医嘱，定期回医院复诊。一般1、3、6、12个月时复诊。</span><br style=\\\"line-height: 20.7999992370605px;\\\" />\r\n<span style=\\\"line-height: 20.7999992370605px;\\\">福州鼓楼医院口腔科作为福建省口腔科齿科的重点口腔医院，拥有全省最先进的口腔诊疗设备，率先引进了具有&ldquo;美牙王牌&rdquo;之称的美国3M LAVA仿生美容冠系统，它是福建省唯一一台用于临床上的最高端美齿设备。此外，福州鼓楼医院口腔科与多家三甲医院口腔医院和地区的口腔医疗单位建立了良好的学术交流与技术合作关系，你也可以通过我们和省内著名口腔专家预约诊疗，让你不出国门就可以享受国际美齿尖端体验。</span></p>',57,'美国3M lava仿生美容冠','美国3M lava仿生美容冠','美国3M lava仿生美容冠',1419488639,0,42,0,'',1419488639,0),(103,'全瓷牙量身定制独一无二','technology/20141225142923171.png','<p style=\\\"line-height: 20.7999992370605px;\\\">全瓷牙生物相容性好，对龅牙、排列歪斜牙、畸形牙以及色素牙等，可彻底、快速矫正修复，无需拔牙，全程无痛。牙龈不会出现黑线，全瓷牙仅需7天，还你洁白整齐牙齿，终生美齿。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225142848222.png\\\" style=\\\"width: 328px; height: 271px;\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">在福州做全瓷牙的口腔医院有很多，但是质量参差不齐，作为福州<span style=\\\"color: rgb(0, 0, 255);\\\">全瓷牙引领者之一</span>的华南中正口腔医院在这方面特别有发言权。全瓷牙一定要到正规的口腔机构。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">普通牙科室、小型口腔诊所因设备及技术落后，根本无法做到流程化、规范化的严谨消毒，直接影响全瓷牙效果和健康。华南中正口腔医院在为顾客制作全瓷牙的过程中，<span style=\\\"color: rgb(255, 0, 0);\\\">严格遵循国际标准消毒流程</span>，强化消毒管理，使用全自动预真空高压灭菌炉消毒系统，从口腔消毒到诊疗器械消毒、手术区消毒等，关注每一个细节，避免任何交叉感染。如果还有其他的疑问，可咨询在线医生他们将给您详细的解答。<a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"color: rgb(255, 0, 0);\\\"><strong>&gt;&gt;&gt;咨询在线医生</strong></span></a></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">华南中正口腔医院作为50年国际连锁品牌牙科机构，不断引进国际潮流领先的技术和设备，构建单病种特色，凝聚国内外顶级牙科专家，用科技造福顾客，以特色服务大众。如果想要了解更多有关牙齿方面的信息，可随时与我们的专家进行免费的在线咨询。通过网上预约，还可以免挂号费，无需排队，并且优先安排专家为您亲诊。<a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"color: rgb(255, 0, 0);\\\"><strong>&gt;&gt;&gt;咨询在线医生</strong></span></a></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">华南中正口腔医院作为一家拥有50年品牌的牙科机构，为每一位爱美人士打造一个<span style=\\\"color: rgb(255, 0, 0);\\\">专属全瓷牙</span>，让每个爱美人士的牙齿都<span style=\\\"color: rgb(255, 0, 0);\\\">独一无二,无可挑剔</span>。与世界级加工厂合作，保证全瓷牙的每一道工艺都做到极致。不仅如此，从爱美人士想打造自己专属全瓷牙开始，每一步都是权威的牙齿美容专家在精心操作，确保每一颗全瓷牙的品质，<span style=\\\"color: rgb(0, 0, 255);\\\">全瓷牙终身维护</span>，这是作为50年品牌牙科对顾客的承诺。</p>\r\n\r\n<div style=\\\"line-height: 20.7999992370605px; text-align: center;\\\">&nbsp;</div>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><strong>华南中正口腔全瓷牙有优势:</strong></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">★采用进口陶瓷材料制作，导热性为黄金的1/17，切实保护牙髓牙龈，质量为黄金的1/4，佩戴舒适。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">★专有金属基底冠，有效避免金属过敏、牙龈黑线等，对牙齿健康无毒副作用。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">★个性化及可预见可视化模拟整个治疗过程，更好地选择个性化的矫正方案，突破了年龄限制。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">★具备真牙的功能，抗压强度高，不必担心瓷崩裂，不影响咀嚼、发音。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">★与真牙一样逼真，其层次、色泽完全接近于真牙，对光线的反射如天然牙一样自然、柔和。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">★不伤害真牙，磨牙很少，最大化保留自己的牙齿组织，无疼痛，无伤害。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">★个性化量身打造，率先应用&quot;牙模&quot;设计理念，电脑设计与精密测量，与顾客基牙完美贴合。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><strong>华南中正口腔医院温馨提示：</strong>正规牙科机构做出来的全瓷牙不管是色泽还是抗压度都非常的好，不会出现牙龈黑线,异物感强，崩瓷等情况，全瓷牙效果自然美观。</p>',76,'','','全瓷牙量身定制独一无二',1419488715,0,41,0,'',1419488965,0),(104,'种植牙有几种不同方法','','<p style=\\\"line-height: 20.7999992370605px;\\\">目前，不少朋友修复了缺失的牙齿，有部分朋友选择的是种植牙，种植牙效果受到了人们的关注。种植牙修复可以让人们的牙齿变得更加整齐，满足人们对美的追求。那么，<strong>种植牙有几种不同方法?</strong>华南中正口腔医院的专家为大家解答一下。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225160805963.jpg\\\" style=\\\"width: 300px; height: 184px;\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"color: rgb(255, 0, 0);\\\"><strong>&gt;&gt;&gt;想要更加深入地了解，请点击咨询&lt;&lt;&lt;</strong></span></a></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">种植牙有几种不同方法?</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">1、普通植牙：</span>是指采用常规方法开展的植牙手术，需要经过切开牙龈、植入牙根、缝合牙龈等外科手术，在植入人工牙根2至3个月后，安装牙冠/牙桥。普通植牙不采用电脑导航、微创手术等先进技术;不会在拔牙后即可植入人工牙根;不会在植入人工牙根后，立即安装牙冠。普通植牙是高级植牙技术的基础，也是牙医开展植牙的入门技术，植牙费用较为经济节约。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">2、高级植牙：</span>是相对普通植牙而言，通过综合运用更高级的诊断设备、外科技术提高植牙的安全性、舒适感以及植牙效率。包括植牙CT诊断、植牙电脑设计、微创植入人工牙根等。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">3、缺骨植牙：</span>是指牙槽骨量不足时采用的植牙方法。长期牙缺失会导致牙槽骨萎缩，很多人都因牙槽高度或宽度不足无法立即植牙。如果选择普通植牙方法，就不得不先采用痛苦、耗时、昂贵的骨移植手术，6个月后才可植牙。其实，80%的牙骨不足者都可以通过高级的植牙外科技术缩短植牙过程。包括超短植体植牙、增加骨高度的上颌窦提升植牙、增加骨宽度的骨扩张植牙等。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">4、快速植牙：</span>是指与普通植牙相比，节约手术次数，节约就诊时间的植牙方法。目前，全球广泛采用的快速植牙技术包括拔病牙后即刻植牙、植牙后即刻装牙、植骨与植牙同期完成等技术。对于复杂病例，这些技术可以协同使用，以缩短植牙疗程。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(0, 0, 255);\\\">&gt;&gt;&gt;大家也许更加关心的是种植牙的价格。推荐阅读：</span><a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"color: rgb(0, 0, 255);\\\">种植牙的价格</span></a><span style=\\\"color: rgb(0, 0, 255);\\\">&lt;&lt;&lt;</span></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">以上是福州口腔医院的专家给大家介绍的关于种植牙的几种不同方法，希望对大家能够起到一定的参考作用。种植牙有几种不同方法?如果大家心中还有其他疑问的话，请点击<a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\">在线咨询</a>，与专家在线沟通交流。</p>',67,'种植牙有几种不同方法','种植牙有几种不同方法','种植牙的出现受到了广大患者朋友的喜爱。种植牙完全突破了传统的假牙的弊端，也因此被称为“人类的第三幅牙齿”。然而，种植牙的方法有很多。那么，种植牙有几种不同方法？看看专家的介绍。',1419494889,1,41,0,'',1419494889,0),(105,'种植牙怎么做比较好','','<p style=\\\"line-height: 20.7999992370605px;\\\">种植牙有人工牙根，如果后期修复时选择全瓷冠等美观性好的人工牙冠的话，足以达到以假乱真的效果。种植牙不仅外形美观逼真，而且舒适、无任何异物感，功能强大，咀嚼效率高，因此被誉为人类的第三副牙齿。也正因为种植牙的修复效果非常好，使得一部分患者误认为可以一劳永逸。那么，<strong>种植牙怎么做比较好?牙齿缺失有哪些危害呢?</strong>华南中正口腔医院的专家为大家做个简单地介绍。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><img alt=\\\"\\\" src=\\\"http://hwibs.boyicms.com/upload/img/20141225161010945.jpg\\\" style=\\\"width: 311px; height: 264px;\\\" /></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px; text-align: center;\\\"><a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"color: rgb(255, 0, 0);\\\"><strong>&gt;&gt;&gt;详细了解种植牙请点击在线咨询&lt;&lt;&lt;</strong></span></a></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><strong>种植牙怎么做比较好?</strong>中正齿科种植牙修复方法有以下这几种：</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">1、普通植牙：</span>是指采用常规方法开展的植牙手术，需要经过切开牙龈、植入牙根、缝合牙龈等外科手术，在植入人工牙根2至3个月后，安装牙冠/牙桥。普通植牙不采用电脑导航、微创手术等先进技术;不会在拔牙后即可植入人工牙根;不会在植入人工牙根后，立即安装牙冠。普通植牙是高级植牙技术的基础，也是牙医开展植牙的入门技术，植牙费用较为经济节约。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">2、高级植牙：</span>是相对普通植牙而言，通过综合运用更高级的诊断设备、外科技术提高植牙的安全性、舒适感以及植牙效率。包括植牙CT诊断、植牙电脑设计、微创植入人工牙根等。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">3、缺骨植牙：</span>是指牙槽骨量不足时采用的植牙方法。长期牙缺失会导致牙槽骨萎缩，很多人都因牙槽高度或宽度不足无法立即植牙。如果选择普通植牙方法，就不得不先采用痛苦、耗时、昂贵的骨移植手术，6个月后才可植牙。其实，80%的牙骨不足者都可以通过高级的植牙外科技术缩短植牙过程。包括超短植体植牙、增加骨高度的上颌窦提升植牙、增加骨宽度的骨扩张植牙等。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">4、快速植牙：</span>是指与普通植牙相比，节约手术次数，节约就诊时间的植牙方法。目前，全球广泛采用的快速植牙技术包括拔病牙后即刻植牙、植牙后即刻装牙、植骨与植牙同期完成等技术。对于复杂病例，这些技术可以协同使用，以缩短植牙疗程。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><strong>牙齿缺失有哪些危害呢?</strong>牙齿缺失的危害主要有以下这几个方面：</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">1、咀嚼功能的减退：</span>如果长时间缺牙，将会造成邻牙向缺牙区域倾斜，缺牙间隙变小，对颌牙伸长，食物无法嚼烂，影响消化和吸收。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">2、发音功能的障碍：</span>前牙缺失对发音功能影响很大，特别是影响齿音，说话时漏&ldquo;风&rdquo;，从而影响讲话时的清晰度。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">3、影响面部美观：</span>当人们缺一个前牙，甚至前牙缺一个切角都会影响面部的美观，牙齿部分或全部缺失后，由于上、下颌骨间失去了牙齿的支持，而且牙槽骨或整个颌骨因缺乏正常咀嚼力量的刺激，将会逐渐退变、吸收，造成面下部高度变短，面颊部和周围肌肉松弛，面部变形及皱纹增多，整个人看起来要比同龄人显得苍老。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(75, 0, 130);\\\">4、对剩余牙有不利影响：</span>牙齿承受的咀嚼力是有一定限度的，当个别牙齿缺失后，咀嚼力集中在余留牙上，由于咀嚼力超过了余留牙的承受限度，致使余留牙齿造成创伤而产生牙周膜水肿、牙龈萎缩、牙槽骨吸收、牙齿松动等牙周疾患。</p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\"><span style=\\\"color: rgb(0, 0, 255);\\\">&gt;&gt;&gt;相信大家比较看重的是牙齿种植的价格问题吧?推荐阅读：</span><a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\"><span style=\\\"color: rgb(0, 0, 255);\\\">种植牙的价格</span></a><span style=\\\"color: rgb(0, 0, 255);\\\">&lt;&lt;&lt;</span></p>\r\n\r\n<p style=\\\"line-height: 20.7999992370605px;\\\">以上是福州牙科医院的专家给大家介绍的关于种植牙的价格问题，现在大家应该都明白了吧?如果出现牙齿缺失，要及时去医院做种植牙修复。华南中正口腔医院拥有专业的牙科专家团队，医生师资高，医院拥有国内一流的牙科专家，选择中正口腔医院是你重新找回美观的正确出路。种植牙怎么做比较好?要是你心中还有其他疑问的话，可以点击<a href=\\\"javascript:Layout.openWindow(\\\'chat\\\');\\\">在线咨询</a>，与专家在线沟通交流。</p>',73,'种植牙怎么做比较好','种植牙怎么做比较好','种植牙的出现受到了广大患者朋友的喜爱。种植牙完全突破了传统的假牙的弊端，也因此被称为“人类的第三幅牙齿”。然而，种植牙的方法有很多。那么，种植牙怎么做比较好？看看专家的介绍。',1419495022,1,41,0,'',1419495022,0);
/*!40000 ALTER TABLE `technology` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thirdstat`
--

DROP TABLE IF EXISTS `thirdstat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thirdstat` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `subject` varchar(80) NOT NULL COMMENT '名称',
  `js` text NOT NULL COMMENT 'js代码',
  `isuse` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否使用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='第三方统计代码';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thirdstat`
--

LOCK TABLES `thirdstat` WRITE;
/*!40000 ALTER TABLE `thirdstat` DISABLE KEYS */;
INSERT INTO `thirdstat` VALUES (6,'cnzz','<script src=\\\"http://s21.cnzz.com/stat.php?id=4979955&web_id=4979955\\\" language=\\\"JavaScript\\\"></script>',1);
/*!40000 ALTER TABLE `thirdstat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic`
--

DROP TABLE IF EXISTS `topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  `disease_id` int(11) unsigned NOT NULL COMMENT '关联栏目ID 疾病ID',
  `tpl` varchar(100) DEFAULT NULL COMMENT '模板文件',
  PRIMARY KEY (`id`),
  KEY `disease_id` (`disease_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='专题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic`
--

LOCK TABLES `topic` WRITE;
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trendip`
--

DROP TABLE IF EXISTS `trendip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trendip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'IP地址',
  `times` int(11) NOT NULL COMMENT '来访时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trendip`
--

LOCK TABLES `trendip` WRITE;
/*!40000 ALTER TABLE `trendip` DISABLE KEYS */;
/*!40000 ALTER TABLE `trendip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uservar`
--

DROP TABLE IF EXISTS `uservar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uservar`
--

LOCK TABLES `uservar` WRITE;
/*!40000 ALTER TABLE `uservar` DISABLE KEYS */;
/*!40000 ALTER TABLE `uservar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workerloghistory`
--

DROP TABLE IF EXISTS `workerloghistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workerloghistory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `logtime` int(10) NOT NULL COMMENT '操作时间',
  `op` varchar(100) NOT NULL COMMENT '操作名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=396 DEFAULT CHARSET=utf8 COMMENT='工作人员操作日志表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workerloghistory`
--

LOCK TABLES `workerloghistory` WRITE;
/*!40000 ALTER TABLE `workerloghistory` DISABLE KEYS */;
INSERT INTO `workerloghistory` VALUES (21,1419408522,'5|boyicms|1|Login|login|登录'),(22,1419408564,'5|boyicms|1|Login|login|登录'),(23,1419412046,'5|boyicms|1|Login|login|登录'),(24,1419469705,'5|boyicms|1|Login|login|登录'),(25,1419470641,'5|boyicms|1|Login|login|登录'),(26,1419474840,'5|boyicms|1|Login|login|登录'),(27,1419474870,'5|boyicms|1|Introduce|save|添加'),(28,1419474881,'5|boyicms|1|Introduce|save|添加'),(29,1419474894,'5|boyicms|1|Introduce|save|添加'),(30,1419474901,'5|boyicms|1|Introduce|save|添加'),(31,1419474926,'5|boyicms|1|Introduce|save|添加'),(32,1419475029,'5|boyicms|1|Introduce|save|添加'),(33,1419475086,'5|boyicms|1|News|add|添加'),(34,1419475156,'5|boyicms|1|News|add|添加'),(35,1419475169,'5|boyicms|1|News|edit|更改'),(36,1419475204,'5|boyicms|1|MediaReport|add|添加'),(37,1419475223,'5|boyicms|1|MediaReport|edit|更改'),(38,1419475236,'5|boyicms|1|News|add|添加'),(39,1419475262,'5|boyicms|1|MediaReport|add|添加'),(40,1419475301,'5|boyicms|1|Honor|add|添加'),(41,1419475317,'5|boyicms|1|News|add|添加'),(42,1419475329,'5|boyicms|1|Honor|add|添加'),(43,1419475424,'5|boyicms|1|Environment|add|添加'),(44,1419475470,'5|boyicms|1|Device|add|添加'),(45,1419475480,'5|boyicms|1|News|edit|更改'),(46,1419475596,'5|boyicms|1|News|add|添加'),(47,1419475620,'5|boyicms|1|MediaReport|add|添加'),(48,1419475697,'5|boyicms|1|News|add|添加'),(49,1419475713,'5|boyicms|1|MediaReport|add|添加'),(50,1419475821,'5|boyicms|1|MediaReport|add|添加'),(51,1419475835,'5|boyicms|1|Contact|save|添加'),(52,1419475836,'5|boyicms|1|Honor|add|添加'),(53,1419475869,'5|boyicms|1|MediaReport|add|添加'),(54,1419475876,'5|boyicms|1|MediaReport|del|删除'),(55,1419475885,'5|boyicms|1|Contact|del|删除'),(56,1419475898,'5|boyicms|1|Introduce|save|添加'),(57,1419475902,'5|boyicms|1|MediaReport|add|添加'),(58,1419475917,'5|boyicms|1|Honor|add|添加'),(59,1419475979,'5|boyicms|1|Department|add|添加'),(60,1419475979,'5|boyicms|1|Honor|edit|更改'),(61,1419476050,'5|boyicms|1|Department|add|添加'),(62,1419476090,'5|boyicms|1|Honor|add|添加'),(63,1419476108,'5|boyicms|1|Environment|add|添加'),(64,1419476161,'5|boyicms|1|Honor|add|添加'),(65,1419476271,'5|boyicms|1|Device|add|添加'),(66,1419476349,'5|boyicms|1|Channel|save|添加'),(67,1419476445,'5|boyicms|1|Environment|add|添加'),(68,1419476487,'5|boyicms|1|Department|add|添加'),(69,1419476521,'5|boyicms|1|Device|add|添加'),(70,1419476533,'5|boyicms|1|Department|add|添加'),(71,1419476569,'5|boyicms|1|Channel|save|添加'),(72,1419476620,'5|boyicms|1|Department|add|添加'),(73,1419476662,'5|boyicms|1|Disease|add|添加'),(74,1419476671,'5|boyicms|1|Department|add|添加'),(75,1419476833,'5|boyicms|1|Disease|add|添加'),(76,1419476866,'5|boyicms|1|Doctor|add|添加'),(77,1419477077,'5|boyicms|1|Disease|add|添加'),(78,1419477331,'5|boyicms|1|Disease|add|添加'),(79,1419477338,'5|boyicms|1|Doctor|add|添加'),(80,1419477494,'5|boyicms|1|Doctor|add|添加'),(81,1419477752,'5|boyicms|1|Login|login|登录'),(82,1419477835,'5|boyicms|1|Doctor|edit|更改'),(83,1419477842,'5|boyicms|1|Doctor|edit|更改'),(84,1419477860,'5|boyicms|1|Doctor|edit|更改'),(85,1419477891,'5|boyicms|1|Introduce|save|添加'),(86,1419477895,'5|boyicms|1|Introduce|save|添加'),(87,1419477902,'5|boyicms|1|Introduce|save|添加'),(88,1419477913,'5|boyicms|1|Introduce|save|添加'),(89,1419478179,'5|boyicms|1|Introduce|save|添加'),(90,1419478818,'5|boyicms|1|Login|logout|注销'),(91,1419478837,'5|boyicms|1|Login|login|登录'),(92,1419478853,'5|boyicms|1|Doctor|edit|更改'),(93,1419478898,'5|boyicms|1|Doctor|edit|更改'),(94,1419479076,'5|boyicms|1|Introduce|save|添加'),(95,1419479185,'5|boyicms|1|News|add|添加'),(96,1419480024,'5|boyicms|1|Doctor|edit|更改'),(97,1419480131,'5|boyicms|1|News|edit|更改'),(98,1419480231,'5|boyicms|1|News|edit|更改'),(99,1419480326,'5|boyicms|1|News|edit|更改'),(100,1419480378,'5|boyicms|1|News|edit|更改'),(101,1419480406,'5|boyicms|1|News|edit|更改'),(102,1419480479,'5|boyicms|1|News|edit|更改'),(103,1419480516,'5|boyicms|1|News|edit|更改'),(104,1419486008,'5|boyicms|1|Doctor|edit|更改'),(105,1419486030,'5|boyicms|1|Doctor|edit|更改'),(106,1419486050,'5|boyicms|1|Doctor|edit|更改'),(107,1419486271,'5|boyicms|1|Disease|add|添加'),(108,1419486494,'5|boyicms|1|Disease|add|添加'),(109,1419486514,'5|boyicms|1|Doctor|add|添加'),(110,1419486621,'5|boyicms|1|Login|login|登录'),(111,1419486987,'5|boyicms|1|Doctor|edit|更改'),(112,1419487060,'5|boyicms|1|Article|add|添加'),(113,1419487142,'5|boyicms|1|Disease|add|添加'),(114,1419487183,'5|boyicms|1|Disease|add|添加'),(115,1419487240,'5|boyicms|1|Disease|add|添加'),(116,1419487285,'5|boyicms|1|Disease|add|添加'),(117,1419487324,'5|boyicms|1|Disease|add|添加'),(118,1419487391,'5|boyicms|1|Disease|add|添加'),(119,1419487400,'5|boyicms|1|Disease|edit|更改'),(120,1419487424,'5|boyicms|1|Department|add|添加'),(121,1419487458,'5|boyicms|1|Article|add|添加'),(122,1419487510,'5|boyicms|1|Article|edit|更改'),(123,1419487540,'5|boyicms|1|Disease|add|添加'),(124,1419487568,'5|boyicms|1|Article|edit|更改'),(125,1419487716,'5|boyicms|1|Doctor|add|添加'),(126,1419487759,'5|boyicms|1|Article|add|添加'),(127,1419487866,'5|boyicms|1|Article|add|添加'),(128,1419488078,'5|boyicms|1|Success|add|添加'),(129,1419488141,'5|boyicms|1|Disease|add|添加'),(130,1419488210,'5|boyicms|1|Success|add|添加'),(131,1419488245,'5|boyicms|1|Doctor|edit|更改'),(132,1419488281,'5|boyicms|1|Doctor|edit|更改'),(133,1419488306,'5|boyicms|1|Success|add|添加'),(134,1419488348,'5|boyicms|1|Doctor|edit|更改'),(135,1419488380,'5|boyicms|1|Technology|add|添加'),(136,1419488408,'5|boyicms|1|Doctor|edit|更改'),(137,1419488482,'5|boyicms|1|Success|add|添加'),(138,1419488488,'5|boyicms|1|Disease|add|添加'),(139,1419488500,'5|boyicms|1|Success|del|删除'),(140,1419488587,'5|boyicms|1|Technology|add|添加'),(141,1419488605,'5|boyicms|1|Success|add|添加'),(142,1419488639,'5|boyicms|1|Technology|add|添加'),(143,1419488640,'5|boyicms|1|Movie|add|添加'),(144,1419488690,'5|boyicms|1|Doctor|add|添加'),(145,1419488715,'5|boyicms|1|Technology|add|添加'),(146,1419488716,'5|boyicms|1|Movie|add|添加'),(147,1419488935,'5|boyicms|1|Technology|edit|更改'),(148,1419488965,'5|boyicms|1|Technology|edit|更改'),(149,1419489042,'5|boyicms|1|Movie|add|添加'),(150,1419489109,'5|boyicms|1|Movie|edit|更改'),(151,1419489175,'5|boyicms|1|Movie|add|添加'),(152,1419489403,'5|boyicms|1|Article|add|添加'),(153,1419489546,'5|boyicms|1|Article|add|添加'),(154,1419489700,'5|boyicms|1|Disease|add|添加'),(155,1419490435,'5|boyicms|1|Success|add|添加'),(156,1419490452,'5|boyicms|1|Article|edit|更改'),(157,1419490471,'5|boyicms|1|Article|edit|更改'),(158,1419490483,'5|boyicms|1|Article|edit|更改'),(159,1419490495,'5|boyicms|1|Article|edit|更改'),(160,1419490507,'5|boyicms|1|Article|edit|更改'),(161,1419490514,'5|boyicms|1|Article|edit|更改'),(162,1419490534,'5|boyicms|1|Article|edit|更改'),(163,1419490539,'5|boyicms|1|Disease|add|添加'),(164,1419490544,'5|boyicms|1|Article|edit|更改'),(165,1419490572,'5|boyicms|1|Disease|edit|更改'),(166,1419490685,'5|boyicms|1|Article|edit|更改'),(167,1419492576,'5|boyicms|1|Article|edit|更改'),(168,1419493106,'5|boyicms|1|Article|edit|更改'),(169,1419493189,'5|boyicms|1|Article|edit|更改'),(170,1419493242,'5|boyicms|1|Article|edit|更改'),(171,1419493292,'5|boyicms|1|Doctor|edit|更改'),(172,1419493305,'5|boyicms|1|Article|edit|更改'),(173,1419493496,'5|boyicms|1|Doctor|edit|更改'),(174,1419494512,'5|boyicms|1|Success|add|添加'),(175,1419494889,'5|boyicms|1|Technology|add|添加'),(176,1419495022,'5|boyicms|1|Technology|add|添加'),(177,1419495255,'5|boyicms|1|Movie|add|添加'),(178,1419495288,'5|boyicms|1|Movie|add|添加'),(179,1419495807,'5|boyicms|1|Doctor|edit|更改'),(180,1419495808,'5|boyicms|1|Doctor|edit|更改'),(181,1419495823,'5|boyicms|1|Doctor|edit|更改'),(182,1419496501,'5|boyicms|1|Article|edit|更改'),(183,1419496637,'5|boyicms|1|Article|edit|更改'),(184,1419497089,'5|boyicms|1|Login|login|登录'),(185,1419497116,'5|boyicms|1|Article|edit|更改'),(186,1419497170,'5|boyicms|1|Article|edit|更改'),(187,1419498244,'5|boyicms|1|Article|edit|更改'),(188,1419498291,'5|boyicms|1|Article|edit|更改'),(189,1419557323,'5|boyicms|1|Login|login|登录'),(190,1419557702,'5|boyicms|1|Login|login|登录'),(191,1419557734,'5|boyicms|1|Login|login|登录'),(192,1419557991,'5|boyicms|1|Navigation|add|添加'),(193,1419558046,'5|boyicms|1|Login|login|登录'),(194,1419558116,'5|boyicms|1|Navigation|add|添加'),(195,1419558150,'5|boyicms|1|Channel|save|添加'),(196,1419558161,'5|boyicms|1|ErrorPage|add|添加'),(197,1419558165,'5|boyicms|1|Channel|update|更改'),(198,1419558168,'5|boyicms|1|ErrorPage|edit|更改'),(199,1419558172,'5|boyicms|1|ErrorPage|edit|更改'),(200,1419558227,'5|boyicms|1|ChannelArticle|save|添加'),(201,1419558306,'5|boyicms|1|Seo|add|添加'),(202,1419558386,'5|boyicms|1|Navigation|add|添加'),(203,1419558424,'5|boyicms|1|Navigation|add|添加'),(204,1419558464,'5|boyicms|1|ErrorPage|add|添加'),(205,1419558560,'5|boyicms|1|Seo|add|添加'),(206,1419558595,'5|boyicms|1|ThirdStat|add|添加'),(207,1419558626,'5|boyicms|1|Link|add|添加'),(208,1419558637,'5|boyicms|1|ThirdStat|add|添加'),(209,1419558646,'5|boyicms|1|ThirdStat|del|删除'),(210,1419558657,'5|boyicms|1|ThirdStat|add|添加'),(211,1419558666,'5|boyicms|1|ThirdStat|del|删除'),(212,1419558693,'5|boyicms|1|Reservation|add|添加'),(213,1419558706,'5|boyicms|1|Link|add|添加'),(214,1419558827,'5|boyicms|1|Channel|save|添加'),(215,1419558842,'5|boyicms|1|ChannelArticle|save|添加'),(216,1419558881,'5|boyicms|1|Reservation|add|添加'),(217,1419559108,'5|boyicms|1|Channel|update|更改'),(218,1419559168,'5|boyicms|1|Disease|edit|更改'),(219,1419559205,'5|boyicms|1|Channel|update|更改'),(220,1419559380,'5|boyicms|1|Disease|edit|更改'),(221,1419559552,'5|boyicms|1|Disease|edit|更改'),(222,1419559933,'5|boyicms|1|Channel|update|更改'),(223,1419560037,'5|boyicms|1|Worker|reg|注册'),(224,1419560259,'5|boyicms|1|PicManager|add|添加'),(225,1419560554,'5|boyicms|1|Pic|add|添加'),(226,1419560770,'5|boyicms|1|PicManager|add|添加'),(227,1419562171,'5|boyicms|1|Pic|add|添加'),(228,1419562303,'5|boyicms|1|PicManager|add|添加'),(229,1419562366,'5|boyicms|1|Pic|edit|更改'),(230,1419562418,'5|boyicms|1|Pic|edit|更改'),(231,1419564821,'5|boyicms|1|Pic|add|添加'),(232,1419564843,'5|boyicms|1|Pic|edit|更改'),(233,1419565224,'5|boyicms|1|Doctor|edit|更改'),(234,1419573939,'5|boyicms|1|Login|login|登录'),(235,1419574911,'5|boyicms|1|Article|edit|更改'),(236,1419574927,'5|boyicms|1|Article|edit|更改'),(237,1419579430,'5|boyicms|1|Pic|add|添加'),(238,1419580169,'5|boyicms|1|Login|login|登录'),(239,1419580467,'5|boyicms|1|Navigation|add|添加'),(240,1419580486,'5|boyicms|1|Navigation|add|添加'),(241,1419580627,'5|boyicms|1|ErrorPage|add|添加'),(242,1419580704,'5|boyicms|1|ErrorPage|add|添加'),(243,1419580723,'5|boyicms|1|ErrorPage|edit|更改'),(244,1419580769,'5|boyicms|1|Link|add|添加'),(245,1419580797,'5|boyicms|1|Link|add|添加'),(246,1419580825,'5|boyicms|1|Link|edit|更改'),(247,1419580909,'5|boyicms|1|Reservation|add|添加'),(248,1419589676,'5|boyicms|1|Introduce|save|添加'),(249,1419589697,'5|boyicms|1|Disease|edit|更改'),(250,1419815727,'5|boyicms|1|Login|login|登录'),(251,1419816243,'5|boyicms|1|Login|login|登录'),(252,1419816263,'5|boyicms|1|Login|login|登录'),(253,1419821603,'5|boyicms|1|Login|login|登录'),(254,1419841547,'5|boyicms|1|Login|login|登录'),(255,1419841596,'5|boyicms|1|Login|login|登录'),(256,1419902045,'5|boyicms|1|News|edit|更改'),(257,1419902149,'5|boyicms|1|Login|login|登录'),(258,1419902365,'5|boyicms|1|Login|login|登录'),(259,1419905160,'5|boyicms|1|Login|login|登录'),(260,1419905196,'5|boyicms|1|Login|login|登录'),(261,1419911159,'5|boyicms|1|Login|login|登录'),(262,1419922919,'5|boyicms|1|Introduce|save|添加'),(263,1419922932,'5|boyicms|1|Introduce|save|添加'),(264,1419922936,'5|boyicms|1|Introduce|save|添加'),(265,1419923122,'5|boyicms|1|Introduce|save|添加'),(266,1419923162,'5|boyicms|1|Introduce|save|添加'),(267,1419923242,'5|boyicms|1|Introduce|save|添加'),(268,1419923525,'5|boyicms|1|Introduce|save|添加'),(269,1419923559,'5|boyicms|1|Introduce|save|添加'),(270,1419929484,'5|boyicms|1|Answer|save|添加'),(271,1419929759,'5|boyicms|1|Channel|update|更改'),(272,1419929830,'5|boyicms|1|Channel|update|更改'),(273,1419929926,'5|boyicms|1|Channel|delBatch|批量删除'),(274,1419929943,'5|boyicms|1|Channel|update|更改'),(275,1419930047,'5|boyicms|1|Channel|update|更改'),(276,1419930259,'5|boyicms|1|Channel|update|更改'),(277,1419930267,'5|boyicms|1|Channel|update|更改'),(278,1419930280,'5|boyicms|1|Channel|update|更改'),(279,1419933698,'5|boyicms|1|Channel|update|更改'),(280,1419933714,'5|boyicms|1|Channel|update|更改'),(281,1419933766,'5|boyicms|1|Channel|update|更改'),(282,1419933850,'5|boyicms|1|Channel|delBatch|批量删除'),(283,1419933850,'5|boyicms|1|Login|login|登录'),(284,1419933864,'5|boyicms|1|Channel|update|更改'),(285,1419933867,'5|boyicms|1|Channel|update|更改'),(286,1419933897,'5|boyicms|1|Channel|update|更改'),(287,1419933975,'5|boyicms|1|ChannelArticle|update|更改'),(288,1419934071,'5|boyicms|1|Channel|save|添加'),(289,1419934475,'5|boyicms|1|Channel|update|更改'),(290,1419934598,'5|boyicms|1|Channel|update|更改'),(291,1419934600,'5|boyicms|1|Channel|delBatch|批量删除'),(292,1419934621,'5|boyicms|1|Channel|update|更改'),(293,1419992256,'5|boyicms|1|Login|login|登录'),(294,1419992576,'5|boyicms|1|Login|login|登录'),(295,1420019330,'5|boyicms|1|Login|login|登录'),(296,1420332576,'5|boyicms|1|Login|login|登录'),(297,1420334630,'5|boyicms|1|Login|login|登录'),(298,1420335929,'5|boyicms|1|Login|login|登录'),(299,1420336049,'5|boyicms|1|Login|login|登录'),(300,1420368066,'5|boyicms|1|Login|login|登录'),(301,1420420043,'5|boyicms|1|Login|login|登录'),(302,1420423347,'5|boyicms|1|Login|login|登录'),(303,1420425599,'5|boyicms|1|Navigation|edit|更改'),(304,1420441646,'5|boyicms|1|Login|login|登录'),(305,1420441800,'5|boyicms|1|WorkHistory|add|添加'),(306,1420441869,'5|boyicms|1|WorkHistory|edit|更改'),(307,1420441911,'5|boyicms|1|WorkHistory|add|添加'),(308,1420442145,'5|boyicms|1|Login|login|登录'),(309,1420443440,'5|boyicms|1|Login|login|登录'),(310,1420443639,'5|boyicms|1|Login|login|登录'),(311,1420444125,'5|boyicms|1|Login|login|登录'),(312,1420444186,'5|boyicms|1|Introduce|save|添加'),(313,1420444197,'5|boyicms|1|Introduce|save|添加'),(314,1420445829,'5|boyicms|1|Channel|update|更改'),(315,1420445888,'5|boyicms|1|Contact|save|添加'),(316,1420445890,'5|boyicms|1|Contact|del|删除'),(317,1420446052,'5|boyicms|1|WorkHistory|add|添加'),(318,1420446213,'5|boyicms|1|WorkHistory|del|删除'),(319,1420446304,'5|boyicms|1|Success|edit|更改'),(320,1420446355,'5|boyicms|1|Movie|edit|更改'),(321,1420446374,'5|boyicms|1|Movie|add|添加'),(322,1420446378,'5|boyicms|1|Movie|del|删除'),(323,1420446397,'5|boyicms|1|PicManager|add|添加'),(324,1420446403,'5|boyicms|1|PicManager|add|添加'),(325,1420446410,'5|boyicms|1|PicManager|edit|更改'),(326,1420446413,'5|boyicms|1|PicManager|del|删除'),(327,1420446599,'5|boyicms|1|PicManager|edit|更改'),(328,1420446616,'5|boyicms|1|Pic|add|添加'),(329,1420446621,'5|boyicms|1|Pic|del|删除'),(330,1420446717,'5|boyicms|1|Navigation|add|添加'),(331,1420446725,'5|boyicms|1|Navigation|del|删除'),(332,1420446950,'5|boyicms|1|ThirdStat|add|添加'),(333,1420446960,'5|boyicms|1|ThirdStat|edit|更改'),(334,1420446971,'5|boyicms|1|ThirdStat|del|删除'),(335,1420447083,'5|boyicms|1|Link|add|添加'),(336,1420447087,'5|boyicms|1|Link|del|删除'),(337,1420447157,'5|boyicms|1|Answer|save|添加'),(338,1420447847,'5|boyicms|1|Login|login|登录'),(339,1420447980,'5|boyicms|1|Login|login|登录'),(340,1420448394,'5|boyicms|1|Login|login|登录'),(341,1420510121,'5|boyicms|1|WorkHistory|edit|更改'),(342,1420522772,'5|boyicms|1|Login|login|登录'),(343,1420523173,'5|boyicms|1|Login|login|登录'),(344,1420523388,'5|boyicms|1|Login|login|登录'),(345,1420594519,'5|boyicms|1|Login|login|登录'),(346,1420594950,'5|boyicms|1|Login|login|登录'),(347,1420597043,'5|boyicms|1|Login|login|登录'),(348,1420597471,'5|boyicms|1|Login|login|登录'),(349,1420599840,'5|boyicms|1|Contact|update|更改'),(350,1420599867,'5|boyicms|1|Contact|update|更改'),(351,1420618314,'5|boyicms|1|Login|login|登录'),(352,1420680148,'5|boyicms|1|Login|login|登录'),(353,1420681971,'5|boyicms|1|Login|login|登录'),(354,1420682514,'5|boyicms|1|Login|login|登录'),(355,1420689091,'5|boyicms|1|Login|login|登录'),(356,1420701536,'5|boyicms|1|Login|login|登录'),(357,1420772600,'5|boyicms|1|Login|login|登录'),(358,1420790143,'5|boyicms|1|Login|login|登录'),(359,1420792689,'5|boyicms|1|Login|login|登录'),(360,1421024312,'5|boyicms|1|Login|login|登录'),(361,1421027085,'5|boyicms|1|Login|login|登录'),(362,1421027943,'5|boyicms|1|Login|login|登录'),(363,1421030467,'5|boyicms|1|Login|login|登录'),(364,1421034087,'5|boyicms|1|Login|login|登录'),(365,1421041508,'5|boyicms|1|Contact|update|更改'),(366,1421041694,'5|boyicms|1|PicManager|edit|更改'),(367,1421050901,'5|boyicms|1|Login|logout|注销'),(368,1421050934,'5|boyicms|1|Login|login|登录'),(369,1421059154,'5|boyicms|1|Login|login|登录'),(370,1421115463,'5|boyicms|1|Login|login|登录'),(371,1421115551,'5|boyicms|1|Login|login|登录'),(372,1421115801,'5|boyicms|1|Login|login|登录'),(373,1421116201,'5|boyicms|1|Login|logout|注销'),(374,1421116223,'5|boyicms|1|Login|login|登录'),(375,1421116238,'5|boyicms|1|Login|logout|注销'),(376,1421116274,'5|boyicms|1|Login|login|登录'),(377,1421116999,'5|boyicms|1|Login|login|登录'),(378,1421117038,'5|boyicms|1|Contact|update|更改'),(379,1421117300,'5|boyicms|1|Contact|update|更改'),(380,1421118747,'5|boyicms|1|Login|login|登录'),(381,1421120861,'5|boyicms|1|Contact|update|更改'),(382,1421143666,'5|boyicms|1|Login|login|登录'),(383,1421143685,'5|boyicms|1|Contact|update|更改'),(384,1421143690,'5|boyicms|1|Contact|update|更改'),(385,1421143749,'5|boyicms|1|Contact|save|添加'),(386,1421143754,'5|boyicms|1|Contact|save|添加'),(387,1421143763,'5|boyicms|1|Contact|save|添加'),(388,1421143770,'5|boyicms|1|Contact|del|删除'),(389,1421144013,'5|boyicms|1|Login|login|登录'),(390,1421201396,'5|boyicms|1|Login|login|登录'),(391,1421203336,'5|boyicms|1|Login|login|登录'),(392,1421205381,'5|boyicms|1|Login|login|登录'),(393,1421215149,'5|boyicms|1|Login|login|登录'),(394,1421222850,'5|boyicms|1|Login|login|登录'),(395,1421226362,'5|boyicms|1|Login|login|登录');
/*!40000 ALTER TABLE `workerloghistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workhistory`
--

DROP TABLE IF EXISTS `workhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='工作资历表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workhistory`
--

LOCK TABLES `workhistory` WRITE;
/*!40000 ALTER TABLE `workhistory` DISABLE KEYS */;
INSERT INTO `workhistory` VALUES (1,'1283356800','1355328000','山东大学附属医院','医师','曾在山东大学附属医院实习进修牙体牙髓，牙周及口腔修复。师从韩凉、王建宁教授，毕业后曾在省三甲口腔医院从事临床工作多年，曾被指派到台湾医科大学附设医 院进修，在此期间掌握了扎实基础，任中华口腔医学会口腔修复专业委员会常委。擅长牙体缺损分层术脂及固定烤瓷牙的美学修复、冷光美白、牙周病的基础治疗 等。熟练掌握无痛麻醉技术，让患者在轻松的状态下解决病痛。',15),(2,'1380643200','1418745600','福州市省立医院','医师','',15);
/*!40000 ALTER TABLE `workhistory` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-14 17:13:42
