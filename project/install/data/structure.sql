#
# TABLE STRUCTURE FOR: tk_admin
#

DROP TABLE IF EXISTS tk_admin;

CREATE TABLE `tk_admin` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_name` varchar(50) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `last_login_ip` varchar(50) NOT NULL default '',
  `last_login_time` int(10) unsigned NOT NULL default '0',
  `hits` int(10) unsigned NOT NULL default '0',
  `create_date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_name` (`user_name`),
  KEY `password` (`password`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

INSERT INTO tk_admin (`id`, `user_name`, `password`, `last_login_ip`, `last_login_time`, `hits`, `create_date`) VALUES (23, 'admin', '7fef6171469e80d32c0559f88b377245', '127.0.0.1', 1432637770, 2, 1432610209);
#
# TABLE STRUCTURE FOR: tk_del_time
#

DROP TABLE IF EXISTS tk_del_time;

CREATE TABLE `tk_del_time` (
  `id` tinyint(1) unsigned NOT NULL default '0',
  `create_date` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO tk_del_time (`id`, `create_date`) VALUES (1, 1432611942);
#
# TABLE STRUCTURE FOR: tk_hot_cat
#

DROP TABLE IF EXISTS tk_hot_cat;

CREATE TABLE `tk_hot_cat` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `q` varchar(30) NOT NULL default '',
  `cid` varchar(50) NOT NULL default '',
  `cat_name` varchar(30) NOT NULL default '',
  `seqorder` int(10) unsigned NOT NULL default '0',
  `parent_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (1, '上衣', '16', '女上装', 100, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (2, '下装', '16', '女下装', 99, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (3, '内衣 女', '', '内衣', 98, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (4, '上衣', '30', '男上装', 97, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (5, '男裤', '', '男下装', 96, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (6, '童装', '', '童装', 95, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (7, '女鞋', '', '女鞋', 94, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (8, '男鞋', '', '男鞋', 93, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (9, '童鞋', '', '童鞋', 92, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (10, '护肤', '', '基础护肤', 91, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (11, '彩妆', '', '精致妆容', 90, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (12, '香氛', '', '气质香氛', 89, 0);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (13, '大码夏装', '16', '大码夏装', 0, 1);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (14, '蕾丝背心', '16', '蕾丝背心', 0, 1);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (15, '短款开衫', '16', '短款开衫', 0, 1);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (16, '防晒衫', '16', '防晒衫', 0, 1);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (17, '情侣装夏装', '16', '情侣装夏装', 0, 1);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (18, '衬衣裙', '16', '衬衣裙', 0, 1);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (19, '牛仔裤', '16', '牛仔裤', 0, 2);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (20, '白裤', '16', '白裤', 0, 2);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (21, '情侣裤', '16', '情侣裤', 0, 2);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (22, '雪纺哈伦裤', '16', '雪纺哈伦裤', 0, 2);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (23, '裤裙夏', '16', '裤裙夏', 0, 2);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (24, '雪纺连衣裙', '16', '雪纺连衣裙', 0, 2);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (25, '蕾丝性感内裤 女', '', '蕾丝性感内裤', 0, 3);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (33, '耐克t恤', '30', '耐克t恤', 0, 4);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (27, '纯棉睡衣', '1625', '纯棉睡衣', 0, 3);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (28, '运动文胸', '1625', '运动文胸', 0, 3);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (29, '薄款文胸', '1625', '薄款文胸', 0, 3);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (30, '瘦腿袜', '1625', '瘦腿袜', 0, 3);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (31, '短丝袜', '1625', '短丝袜', 0, 3);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (32, '内衣文胸', '1625', '内衣文胸', 0, 3);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (34, '七匹狼夹克', '30', '七匹狼夹克', 0, 4);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (35, '牛仔夹克', '30', '牛仔夹克', 0, 4);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (36, '情侣衬衫', '30', '情侣衬衫', 0, 4);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (37, '衬衣男短袖', '30', '衬衣男短袖', 0, 4);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (38, '半袖男', '30', '半袖男', 0, 4);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (39, '夏男t恤', '30', '夏男t恤', 0, 4);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (40, '修身西裤', '30', '修身西裤', 0, 5);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (41, '男西裤夏', '30', '男西裤夏', 0, 5);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (42, '吉普牛仔裤', '30', '吉普牛仔裤', 0, 5);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (43, '足球裤', '30', '足球裤', 0, 5);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (44, '耐克裤', '30', '耐克裤', 0, 5);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (45, '男牛仔', '30', '男牛仔', 0, 5);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (46, '休闲短裤', '30', '休闲短裤', 0, 5);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (47, '沙滩裤', '30', '沙滩裤', 0, 5);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (48, '条纹t恤', '50008165', '条纹t恤', 0, 6);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (49, '宝宝背带裤', '50008165', '宝宝背带裤', 0, 6);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (50, '女童短裤', '50008165', '女童短裤', 0, 6);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (51, '女童连衣裙', '50008165', '女童连衣裙', 0, 6);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (52, '夏装连衣裙', '50008165', '夏装连衣裙', 0, 6);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (53, '男童装', '50008165', '男童装', 0, 6);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (54, '松糕凉拖', '50006843', '松糕凉拖', 0, 7);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (55, '内增高鞋', '50006843', '内增高鞋', 0, 7);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (56, '单鞋平底', '50006843', '单鞋平底', 0, 7);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (57, '细跟凉鞋', '50006843', '细跟凉鞋', 0, 7);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (58, '坡跟单鞋', '50006843', '坡跟单鞋', 0, 7);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (59, 'tfboys鞋', '50006843', 'tfboys鞋', 0, 7);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (60, '帆布男鞋', '50011740', '帆布男鞋', 0, 8);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (61, '拖鞋男夏', '50011740', '拖鞋男夏', 0, 8);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (62, '男休闲鞋', '50011740', '男休闲鞋', 0, 8);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (63, '网鞋男', '50011740', '网鞋男', 0, 8);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (64, '气垫鞋', '50011740', '气垫鞋', 0, 8);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (65, '跑鞋', '50011740', '跑鞋', 0, 8);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (66, '宝宝凉鞋', '122650005', '宝宝凉鞋', 0, 9);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (67, '儿童凉鞋', '122650005', '儿童凉鞋', 0, 9);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (68, '男童皮鞋', '122650005', '男童皮鞋', 0, 9);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (69, '平跟凉鞋', '122650005', '平跟凉鞋', 0, 9);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (70, '网鞋', '122650005', '网鞋', 0, 9);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (71, '亲子鞋', '122650005', '亲子鞋', 0, 9);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (72, '蜗牛面膜', '', '蜗牛面膜', 0, 10);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (73, '蜗牛霜', '', '蜗牛霜', 0, 10);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (74, '马油霜', '', '马油霜', 0, 10);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (75, '护肤品', '', '护肤品', 0, 10);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (76, '黑面膜', '', '黑面膜', 0, 10);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (77, '睡眠面膜', '', '睡眠面膜', 0, 10);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (78, 'opi指甲油', '', 'opi指甲油', 0, 11);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (79, '可剥指甲油', '', '可剥指甲油', 0, 11);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (80, '变色唇膏', '', '变色唇膏', 0, 11);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (81, '韩国口红', '', '韩国口红', 0, 11);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (82, 'hera', '', 'hera', 0, 11);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (83, 'hera气垫bb霜', '', 'hera气垫bb霜', 0, 11);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (84, '瘦腿精油', '50012000', '瘦腿精油', 0, 12);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (85, '祛疤', '50012000', '祛疤', 0, 12);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (86, 'dior香水', '50010815', 'dior香水', 0, 12);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (87, '男士香水', '50010815', '男士香水', 0, 12);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (88, '纯露', '50012002', '纯露', 0, 12);
INSERT INTO tk_hot_cat (`id`, `q`, `cid`, `cat_name`, `seqorder`, `parent_id`) VALUES (89, '小样香水', '', '小样香水', 0, 12);
#
# TABLE STRUCTURE FOR: tk_link
#

DROP TABLE IF EXISTS tk_link;

CREATE TABLE `tk_link` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(50) NOT NULL default '',
  `hplink` varchar(255) NOT NULL default '',
  `pic_path` varchar(255) NOT NULL default '',
  `seqorder` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO tk_link (`id`, `title`, `hplink`, `pic_path`, `seqorder`) VALUES (1, '搜客淘宝客官方网站', 'http://bbs.soke5.com/', '', 10);
INSERT INTO tk_link (`id`, `title`, `hplink`, `pic_path`, `seqorder`) VALUES (2, 'API自动版本演示', 'http://api.soke5.com/', '', 9);
INSERT INTO tk_link (`id`, `title`, `hplink`, `pic_path`, `seqorder`) VALUES (3, '淘宝网', 'http://www.taobao.com/', '', 7);
INSERT INTO tk_link (`id`, `title`, `hplink`, `pic_path`, `seqorder`) VALUES (4, '爱淘宝', 'http://ai.taobao.com/', '', 5);
INSERT INTO tk_link (`id`, `title`, `hplink`, `pic_path`, `seqorder`) VALUES (5, '支付宝', 'https://www.alipay.com/', '', 6);
INSERT INTO tk_link (`id`, `title`, `hplink`, `pic_path`, `seqorder`) VALUES (6, '天猫商城', 'http://www.tmall.com/', '', 8);
INSERT INTO tk_link (`id`, `title`, `hplink`, `pic_path`, `seqorder`) VALUES (7, '折800官网', 'http://www.zhe800.com/', '', 4);
#
# TABLE STRUCTURE FOR: tk_nav
#

DROP TABLE IF EXISTS tk_nav;

CREATE TABLE `tk_nav` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `is_top` tinyint(1) unsigned NOT NULL default '0',
  `title` varchar(30) NOT NULL default '',
  `hplink` varchar(255) NOT NULL default '',
  `target` varchar(10) NOT NULL default '',
  `seqorder` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `is_top` (`is_top`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (1, 1, '9.9包邮', '/index.php/s?q=9.9%E5%8C%85%E9%82%AE&cid=16&s_price=9&e_price=10', '_self', 20);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (2, 1, '连衣裙', '/index.php/s?q=%E8%BF%9E%E8%A1%A3%E8%A3%99&is_tmall=1', '_self', 19);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (3, 1, '上衣精品', '/index.php/s?q=%E4%B8%8A%E8%A1%A3&cid=16&is_tmall=1', '_self', 18);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (4, 1, '女下装', '/index.php/s?q=%E4%B8%8B%E8%A3%85%20%E5%A5%B3', '_self', 17);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (5, 1, '舒适内衣', '/index.php/s?q=%E8%88%92%E9%80%82%E5%86%85%E8%A1%A3&cid=1625', '_self', 15);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (6, 1, '男上衣', '/index.php/s?q=%E4%B8%8A%E8%A1%A3&cid=30', '_self', 14);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (7, 1, '男下装', '/index.php/s?q=%E8%A3%A4%E5%AD%90&cid=30', '_self', 13);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (8, 1, '童装', '/index.php/s?q=%E7%AB%A5%E8%A3%85', '_self', 12);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (9, 1, '流行女鞋', '/index.php/s?q=%E5%A5%B3%E9%9E%8B', '_self', 11);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (10, 1, '穿衣搭配', '/index.php/dapei', '_self', 18);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (11, 0, '化妆品', '/index.php/s?q=%E5%8C%96%E5%A6%86%E5%93%81', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (12, 0, '口红', '/index.php/s?q=%E5%8F%A3%E7%BA%A2', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (13, 0, '洗面奶', '/index.php/s?q=%E6%B4%97%E9%9D%A2%E5%A5%B6&is_tmall=1', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (14, 0, '连体裤', '/index.php/s?q=%E8%BF%9E%E4%BD%93%E8%A3%A4&cid=16', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (15, 0, '娃娃衫', '/index.php/s?q=%E5%A8%83%E5%A8%83%E8%A1%AB&cid=16', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (16, 0, '宽松衬衫', '/index.php/s?q=%E5%AE%BD%E6%9D%BE%E8%A1%AC%E8%A1%AB&cid=16', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (17, 0, '真丝连衣裙', '/index.php/s?q=%E7%9C%9F%E4%B8%9D%E8%BF%9E%E8%A1%A3%E8%A3%99', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (18, 0, '中裤', '/index.php/s?q=%E4%B8%AD%E8%A3%A4&cid=16', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (19, 0, '男T恤', '/index.php/s?q=%E7%94%B7T%E6%81%A4', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (20, 0, '闺蜜装夏', '/index.php/s?q=%E9%97%BA%E8%9C%9C%E8%A3%85%E5%A4%8F&cid=16', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (21, 0, '长袖连衣裙', '/index.php/s?q=%E9%95%BF%E8%A2%96%E8%BF%9E%E8%A1%A3%E8%A3%99', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (22, 0, '蕾丝雪纺', '/index.php/s?q=%E8%95%BE%E4%B8%9D%E9%9B%AA%E7%BA%BA&is_tmall=1', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (23, 0, '文胸套装', '/index.php/s?q=%E6%96%87%E8%83%B8%E5%A5%97%E8%A3%85&is_tmall=1', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (24, 0, '半身裙', '/index.php/s?q=%E5%8D%8A%E8%BA%AB%E8%A3%99&is_tmall=1', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (25, 0, '休闲裤', '/index.php/s?q=%E4%BC%91%E9%97%B2%E8%A3%A4%20%E5%A5%B3', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (27, 1, '防晒霜', '/index.php/s?q=%E9%98%B2%E6%99%92%E9%9C%9C&cid=50011982', '_self', 0);
INSERT INTO tk_nav (`id`, `is_top`, `title`, `hplink`, `target`, `seqorder`) VALUES (28, 1, '时尚女包', '/index.php/s?q=%E5%A5%B3%E5%8C%85', '_self', 0);
