-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 10 月 26 日 09:59
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `hwibs_model`
--

-- --------------------------------------------------------

--
-- 表的结构 `website`
--

CREATE TABLE IF NOT EXISTS `website` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `hospital` varchar(255) NOT NULL DEFAULT '' COMMENT '医院名称',
  `domain` varchar(255) NOT NULL DEFAULT '' COMMENT '域名',
  `ip` varchar(255) NOT NULL DEFAULT '' COMMENT 'ip地址',
  `port` varchar(6) NOT NULL DEFAULT '' COMMENT '端口',
  `db` varchar(30) NOT NULL DEFAULT '' COMMENT '数据库',
  `user` varchar(255) NOT NULL DEFAULT '' COMMENT 'root用户',
  `pwd` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='多站点管理' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `websitecontent`
--

CREATE TABLE IF NOT EXISTS `websitecontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `website_id` int(11) NOT NULL COMMENT '站点id',
  `type` tinyint(1) DEFAULT '1' COMMENT '自定义类型：1头 2尾',
  `content` text COMMENT '自定义内容',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='多站点管理' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
