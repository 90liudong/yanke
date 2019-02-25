-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 �?06 �?30 �?02:03
-- 服务器版本: 5.5.53
-- PHP 版本: 5.5.38

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yanke`
--

-- --------------------------------------------------------

--
-- 表的结构 `addr`
--

CREATE TABLE IF NOT EXISTS `addr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '地址所属人',
  `name` char(80) NOT NULL,
  `tel` bigint(20) NOT NULL,
  `addr` char(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(120) NOT NULL,
  `password` char(80) NOT NULL,
  `type` int(40) NOT NULL COMMENT '超管：type=1  普管:type=0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`) VALUES
(22, 'admin', 'ykzj123', 1);

-- --------------------------------------------------------

--
-- 表的结构 `b1_goods`
--

CREATE TABLE IF NOT EXISTS `b1_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `gid` int(11) NOT NULL COMMENT '商品id',
  `num` int(11) NOT NULL COMMENT '商品库存',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '商品状态，0参与折扣，1个别商品，不参与折扣',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=583 ;

--
-- 转存表中的数据 `b1_goods`
--

INSERT INTO `b1_goods` (`id`, `uid`, `gid`, `num`, `status`) VALUES
(582, 175, 117, 0, 0),
(581, 175, 119, 0, 0),
(580, 175, 120, 0, 0),
(579, 175, 121, 0, 0),
(578, 175, 122, 0, 0),
(577, 169, 122, 0, 0),
(576, 169, 121, 0, 0),
(575, 169, 120, 0, 0),
(574, 169, 119, 0, 0),
(572, 169, 117, 5, 0);

-- --------------------------------------------------------

--
-- 表的结构 `b1_goods_water`
--

CREATE TABLE IF NOT EXISTS `b1_goods_water` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `bgid` int(11) NOT NULL COMMENT 'B1用户的某个商品id',
  `num` int(11) NOT NULL COMMENT '数量',
  `time` bigint(20) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=293 ;

--
-- 转存表中的数据 `b1_goods_water`
--

INSERT INTO `b1_goods_water` (`id`, `uid`, `bgid`, `num`, `time`) VALUES
(292, 169, 117, 5, 1527754503);

-- --------------------------------------------------------

--
-- 表的结构 `bring_money`
--

CREATE TABLE IF NOT EXISTS `bring_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `bank` bigint(20) NOT NULL,
  `name` char(90) NOT NULL,
  `num` double(10,2) NOT NULL,
  `time` bigint(20) NOT NULL COMMENT '发起时间',
  `status` tinyint(4) NOT NULL COMMENT '提现状态0,1,2||申请中，成功，失败',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=168 ;

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL,
  `image` varchar(900) NOT NULL,
  `sell_price1` double(10,2) NOT NULL COMMENT '出货价1',
  `sell_price2` double(10,2) NOT NULL COMMENT '出货价2',
  `retail_price` double(10,2) NOT NULL COMMENT '零售价',
  `coupon_price` double(10,2) NOT NULL COMMENT '优惠价',
  `detail` text NOT NULL COMMENT '商品详情',
  `time` bigint(20) NOT NULL COMMENT '商品上传时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `name`, `image`, `sell_price1`, `sell_price2`, `retail_price`, `coupon_price`, `detail`, `time`) VALUES
(120, '显微结扎镊', '20180607\\42e7a66ffd6784c5d6c9efe27c338aed.png', 88.00, 100.00, 280.00, 245.00, '<p>显微结扎镊 直平台(6mm)/1×2平齿×0.10mm<img src="/ueditor/php/upload/image/20180607/1528360242535917.png" title="1528360242535917.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528360242122472.png" title="1528360242122472.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528360242774356.png" title="1528360242774356.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528360242113001.png" title="1528360242113001.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528360242101942.png" title="1528360242101942.png"/></p><p><br/></p>', 1528361236),
(121, '​显微系线镊', '20180607\\83d2e264881a5b385c92f10ee3b7fba5.png', 89.00, 108.00, 298.00, 280.00, '<p><span style="color: rgb(49, 71, 95); font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: normal; widows: 1; background-color: rgb(255, 255, 255);">显微系线镊 直平台(6mm)×0.12mm、全长110mm</span></p><p><span style="color: rgb(49, 71, 95); font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: normal; widows: 1; background-color: rgb(255, 255, 255);"></span></p><p><img src="/ueditor/php/upload/image/20180607/1528360966136767.png" title="1528360966136767.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528360967338444.png" title="1528360967338444.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528360967726505.png" title="1528360967726505.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528360967134805.png" title="1528360967134805.png"/></p><p><span style="color: rgb(49, 71, 95); font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: normal; widows: 1; background-color: rgb(255, 255, 255);"><br/></span><br/></p>', 1528360977),
(122, '眼用测量器', '20180607\\91780766084f49ea94d143631f75fd9b.png', 88.00, 108.00, 288.00, 258.00, '<table width="98%" align="center"><tbody><tr class="firstRow"><td style="font-size: 12px; color: rgb(49, 71, 95);"><strong>简要说明:</strong>眼用测量器 直双面刻度/0-20mm/全长80mm（微调）</td></tr></tbody></table><p><img src="/ueditor/php/upload/image/20180607/1528361147585103.png" title="1528361147585103.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528361147120579.png" title="1528361147120579.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528361147894071.png" title="1528361147894071.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528361147102979.png" title="1528361147102979.png"/></p><p><br/></p>', 1528361151),
(119, '开睑器', '20180607\\feeec663ebd6d3818d3ce7c5d33095b3.png', 88.00, 100.00, 312.00, 258.00, '<p>61001开睑器 钢丝封口（弧形）<img src="/ueditor/php/upload/image/20180607/1528360031128824.png" title="1528360031128824.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528360031880387.png" title="1528360031880387.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528360031808567.png" title="1528360031808567.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528360032659634.png" title="1528360032659634.png"/></p><p><img src="/ueditor/php/upload/image/20180607/1528360032123720.png" title="1528360032123720.png"/></p><p><br/></p>', 1528361261),
(117, 'Tucson眼用冲洗器', '20180530\\82278e6db3268a9cb90bd558c4243bb5.jpg', 108.00, 188.00, 298.00, 268.00, '<p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><strong><span style="font-family: 宋体, SimSun; font-size: 20px;">①<span style="color: rgb(255, 0, 0); font-family: 宋体, SimSun; background-color: rgb(255, 255, 255);">产品优势</span></span></strong><span style="font-family: 宋体, SimSun; font-size: 20px;"><span style="color: rgb(255, 0, 0); font-family: 宋体, SimSun;"><strong><span style="font-family: 宋体, SimSun; background-color: rgb(255, 255, 255);"></span></strong></span>：</span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;">有效,易于使用眼部灌溉;解放医疗人员治疗其他伤害;由一位执业眼科医生开发的;用于美国95％的应急部门。</span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 20px;"><span style="font-family: 宋体; font-weight: bold;">②</span><strong><span style="color: red; font-family: 宋体; font-weight: bold;">使用范围</span></strong><span style="font-family: 宋体;">：</span></span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;">酸烧伤，碱烧伤，热烧伤，刺激物(汽油,洗涤剂等)，非嵌入式异物，异物对异物的感觉；常规手术前，眼皮手术，严重的感染。</span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><strong><span style="font-family: 宋体, SimSun; font-size: 20px;"><span style="font-family: 宋体; font-weight: bold;">③</span><span style="color: red; font-family: 宋体; font-weight: bold;">所需材料</span><span style="font-family: 宋体; font-weight: bold;">：</span></span></strong></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;">Tucson眼用清洗器注意事项：一只眼睛的疼痛可能会掩盖另一只眼睛的疼痛，除非已知伤害仅限于一只眼睛；Tucson眼用清洗器连接的输液组；合适的灌溉冲洗方案（建议使用乳酸林格氏液）局部眼麻醉剂；pH值试纸等。</span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;"><span style="font-family: 宋体, SimSun; font-size: 16px;"><span style="font-family: 宋体; font-size: 20px; font-weight: bold;"></span></span></span></p><hr/><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;"><span style="font-family: 宋体, SimSun; font-size: 16px;"><span style="font-family: 宋体; font-size: 20px; font-weight: bold;">④</span><strong><span style="color: red; font-family: 宋体; font-size: 20px; font-weight: bold;">使用步骤</span></strong><span style="font-family: Calibri; font-size: 20px; font-weight: bold;">：</span></span></span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体; font-size: 16px;">第一步:局部眼麻醉，将Tucson眼用清洗器连接到Tucson眼用清洗器传送装置或注射器或输液管中；</span><img title="1527664374105001.png" alt="图片1.png" src="/ueditor/php/upload/image/20180530/1527664374105001.png"/></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;"></span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;"></span></p><hr/><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;">第二步: 在放入镜头前先开始小流量；</span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 20px;"><img title="1527664470292745.png" alt="图片2.png" src="/ueditor/php/upload/image/20180530/1527664470292745.png"/></span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;"></span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;"></span></p><hr/><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;">第三步:确保液体收集装置,如病人的面部调节，直到眼睛的pH值恢复正常,不会干涸。</span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 16px;"><img title="1527664849609760.png" alt="图片3.png" src="/ueditor/php/upload/image/20180530/1527664849609760.png"/></span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体; font-size: 12pt; font-weight: bold;"></span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体; font-size: 12pt; font-weight: bold;"></span></p><hr/><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体; font-size: 12pt; font-weight: bold;">⑤</span><span style="font-size: 20px;"><strong><span style="color: red; font-family: 宋体; font-weight: bold;">灌溉时间和方案</span><span style="font-family: Calibri;">：</span></strong></span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体; font-size: 16px;">（1）受刺激物影响：灌溉冲洗时间至少20-30分钟</span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-size: 16px;"><span style="font-family: 宋体; font-size: 16px;">（2）受酸和碱影响:每只眼2升液体灌溉冲洗；等待15-20分钟，测量pH值的大小，直到pH值在7.5-8之间</span>&nbsp;</span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><img title="1527665207189038.png" alt="图片4.png" src="/ueditor/php/upload/image/20180530/1527665207189038.png"/></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-size: 20px;"><strong><span style="font-family: 宋体; font-weight: bold;">⑥</span><span style="color: red; font-family: 宋体; font-weight: bold;">Tucson眼用清洗器的好处</span></strong></span><span style="font-family: Calibri; font-size: 12pt;">：</span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-size: 12pt;"><span style="font-family: 宋体;">100% </span><span style="font-family: 宋体;">的冲洗解决方案直接送到角膜</span><span style="font-family: 宋体;">、</span><span style="font-family: 宋体;">死角和结膜</span></span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-size: 12pt;"><span style="font-family: 宋体;">医务人员可以处理其他病人的伤害</span><span style="font-family: 宋体;">；</span><span style="font-family: 宋体;">在灌溉冲洗期间病人可以移动</span><span style="font-family: 宋体;">；</span><span style="font-family: 宋体;">病人舒适的休息</span><span style="font-family: 宋体;">；</span><span style="font-family: 宋体;">高成本效益</span><span style="font-family: 宋体;">。</span></span></p><p style="line-height: 1.5em; margin-top: 10px; margin-bottom: 10px;"><span style="font-family: 宋体, SimSun; font-size: 20px;"></span></p><p><br/></p>', 1528361294);

-- --------------------------------------------------------

--
-- 表的结构 `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(900) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- 转存表中的数据 `images`
--

INSERT INTO `images` (`id`, `image`) VALUES
(89, '20180531\\45f662955daeef746453d035fb4df2e8.jpg'),
(90, '20180531\\6dcce8787bc3ec58d044253e967528b4.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `moneywater`
--

CREATE TABLE IF NOT EXISTS `moneywater` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '流水所属人',
  `money` double(10,2) NOT NULL COMMENT '提现利润或生成利润的钱数',
  `m_status` tinyint(4) NOT NULL COMMENT '提现利润为0，生成利润为1',
  `time` bigint(20) NOT NULL COMMENT '流水产生的时间',
  `bm_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=539 ;

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` bigint(20) NOT NULL COMMENT '订单日期',
  `code` bigint(20) NOT NULL COMMENT '编号，存时间戳',
  `up_uid` int(11) NOT NULL COMMENT '谁卖给他的用户id',
  `c_uid` char(80) NOT NULL COMMENT '下单用户id',
  `gid` int(11) NOT NULL COMMENT '商品id',
  `unit_price` double(10,2) NOT NULL COMMENT '商品单价',
  `num` int(11) NOT NULL COMMENT '商品数量',
  `price` double(10,2) NOT NULL COMMENT '订单金额',
  `profit` double(10,2) NOT NULL COMMENT '利润',
  `tracking` char(240) NOT NULL COMMENT '快递公司',
  `tracking_number` bigint(20) NOT NULL COMMENT '快递单号',
  `order_type` tinyint(4) NOT NULL COMMENT '1厂家id 2其他订单',
  `status` int(20) NOT NULL DEFAULT '0' COMMENT '未发货:0 已发货:1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=391 ;

-- --------------------------------------------------------

--
-- 表的结构 `profit`
--

CREATE TABLE IF NOT EXISTS `profit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(20) NOT NULL,
  `oid` int(11) NOT NULL COMMENT '订单id',
  `uid` int(11) NOT NULL COMMENT '利润所属人',
  `money` double(10,2) NOT NULL COMMENT '该笔订单利润多少',
  `time` bigint(20) NOT NULL COMMENT '利润产生时间，即下订单的时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=578 ;

-- --------------------------------------------------------

--
-- 表的结构 `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `time_out` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=135 ;

--
-- 转存表中的数据 `token`
--

INSERT INTO `token` (`id`, `user_id`, `token`, `time_out`) VALUES
(134, 176, 'a6cb16f1d0e38895a644a4e5e9d0457c', 1529948406),
(133, 175, 'd2fd4350cbe494957278c83033253c9f', 1529753186),
(132, 174, 'ce7dfa0ee622b46d5a1be49a782405cb', 1529806398),
(131, 173, 'fb64ef3cd27a41980ebbf4784f30344d', 1529656777),
(130, 172, 'fd603b4a9387c3126aab59165f357468', 1529037189),
(129, 171, '505245d2f5eba93c0f2a70e5e78ea422', 1528298808),
(128, 170, '36d3aaeaeae6398d5d14c80d16ab3195', 1529722411),
(127, 169, 'b9636a7e5a4f179e72af6ec8bc76b03a', 1528298476);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '用户类型：1=>B1,2=>B1-2,3=>B2-1,4=>B2-2,5=>患者',
  `tel` bigint(20) NOT NULL,
  `password` char(80) NOT NULL,
  `openid` char(80) NOT NULL,
  `headimg` varchar(600) NOT NULL,
  `nickname` char(120) NOT NULL,
  `true_name` char(120) NOT NULL,
  `up_uid` int(11) NOT NULL COMMENT '上级uid',
  `addr` char(120) NOT NULL COMMENT '地区-只有B1-2和B2有',
  `unit` char(120) NOT NULL COMMENT '单位-只有B1-2和B2有',
  `time` bigint(20) NOT NULL COMMENT '注册时间',
  `discount` int(11) NOT NULL COMMENT '上级给他设的折扣 B1没有',
  `pay_password` char(80) NOT NULL COMMENT '提现密码',
  `goods_price` double(10,2) NOT NULL COMMENT '出货总额 对于患者是0',
  `profit` double(10,2) NOT NULL COMMENT '利润总额 对于患者是0',
  `consume` double(10,2) NOT NULL COMMENT '消费总额 除了患者有,其他是0',
  `invit_code1` char(250) NOT NULL COMMENT '邀请码1,B1针对B1_2用,B1_2针对他下级医生用，B1,B1_2有',
  `invit_code2` char(250) NOT NULL COMMENT '邀请码2,B1针对医生，B1有',
  `ewm1` char(250) NOT NULL COMMENT '邀请二维码1',
  `ewm2` char(250) NOT NULL COMMENT '邀请二维码2',
  `sell_ewm` char(250) NOT NULL COMMENT '出售商品二维码',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态 默认1',
  `totalprofit` double(10,2) NOT NULL COMMENT '利润总额，不会减少',
  `frozen` int(20) NOT NULL DEFAULT '0' COMMENT '0=》正常状态 1=》冻结状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=177 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `type`, `tel`, `password`, `openid`, `headimg`, `nickname`, `true_name`, `up_uid`, `addr`, `unit`, `time`, `discount`, `pay_password`, `goods_price`, `profit`, `consume`, `invit_code1`, `invit_code2`, `ewm1`, `ewm2`, `sell_ewm`, `status`, `totalprofit`, `frozen`) VALUES
(176, 5, 15930012101, '123456', 'otdYI40MPCGFPQb2JmUXJ6T9909I', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLoULcSY53icJia0Yqib1t53eMV5VvfjZ0iaiaSHQyDZdF1G6fFibd390PyHRJTAyeSlWiaHlWiafPMIRbLsg/132', '酷爱晴天', '', 0, '河北', '', 1529861940, 0, '', 0.00, 0.00, 0.00, '', '', '', '', '', 1, 0.00, 0),
(175, 1, 18813974678, '123456', 'otdYI45kqM1lYDolJSRu0O884ezc', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLGHeJbXvZMqgOeI1339BjTia4VJF4sJ9PrmuEOzSxWDN7lbzTQ83haElsu1Cg15MdkygWdM41VRGQ/132', 'rdgztest_65103', '测试号', 0, '', '', 1529666786, 0, '', 0.00, 0.00, 0.00, '', '', '', '', '', 1, 0.00, 0),
(173, 5, 15521973021, 'lxh3393817', 'otdYI47iUzgLZSoaD_bpet1Zz5bY', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJtrdUPz6xhibZfWROUaC31tTD1G2rD9JNNicaa90GCibpQ8Vs2MQ3icN8sibia9vlEC0XNbGjI5Pkrg53A/132', 'Lee San Ho 7', '', 0, '广东', '', 1529570377, 0, '', 0.00, 0.00, 0.00, '', '', '', '', '', 1, 0.00, 0),
(174, 5, 18813974679, '123456', 'otdYI4-ohEpum88-I5V6REe8PuiY', 'https://wx.qlogo.cn/mmopen/vi_32/YoXgZ2WW1JylGXryppghOiaGpIVtBQRBlAF2KOEGt1n9DVgwodMmHmPyJGPn4xxicRicXQ6Xamx9AE4qpE3SN1AYg/132', '安静', '', 0, '梅州', '亚联', 1529662554, 0, '', 0.00, 0.00, 0.00, '', '', '', '', '', 1, 0.00, 0),
(172, 5, 15350659060, 'rty654', 'otdYI46gXpS48wfODRQgbQin789U', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKE03oxPQeNXnHMT72gvVq2xLicxo1vv5pypML0gBOnlibGc5UIpJIbXl1gK1wofnG6c8rugOpXcHAw/132', '娜', '', 0, '唐山', '', 1528950789, 0, '', 0.00, 0.00, 0.00, '', '', '', '', '', 1, 0.00, 0),
(171, 5, 13902938480, '972629', 'otdYI4xMxEZX92N_ysUvyVWRh47o', 'https://wx.qlogo.cn/mmopen/vi_32/DRvqTjTsKE9nCLueXJ5J4Lnm0Pjm6ibanp6NUiczibX3VndNNibuU00TUqDJrfbCwqKkYy8fqPT8qtn3S7s4Y7aGOg/132', '王君伟', '', 0, '深圳市', '', 1528212200, 0, '', 0.00, 0.00, 0.00, '', '', '', '', '', 1, 0.00, 0),
(170, 3, 13217540132, 'feixin09', 'otdYI47u74MDT5bGuV1GNUBNApVI', 'https://wx.qlogo.cn/mmopen/vi_32/plh3lengbMEhYNJSStXCmDMKk7icjvJDRZreEupdfzWFkMJ02Q44ib2hAl3tUibvByibNfNJbeibz6IzkEAGXbefwWA/132', 'CD', '', 169, '深圳', '', 1527759028, 0, '', 0.00, 0.00, 0.00, '', '', '', '', '', 1, 0.00, 0),
(169, 1, 15899794141, 'wang9264', 'otdYI4wmCs6tz6TcesnoMDqWe12Q', 'https://wx.qlogo.cn/mmopen/vi_32/fw6ok8nCqUqmERUa7LB1aAb6EJsiaVuuYOgStprOLcrhax8SOp8SzDaS6AsiaXIVd7gmr3KTWZciadJdE7t7tv8Cw/132', 'Wayde-', 'Wayde', 0, '', '', 1527751549, 0, '', 0.00, 0.00, 0.00, '985xjso', '286tcye', 'https://pxxy.90web.cn/static/ewm/ewm1527754418808.png', 'https://pxxy.90web.cn/static/ewm/ewm1527754418882.png', 'https://pxxy.90web.cn/static/ewm/ewm1527751721138.png', 1, 0.00, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
