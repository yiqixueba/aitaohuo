
CREATE TABLE IF NOT EXISTS `{dbpre}ptx_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name_cn` varchar(80) NOT NULL,
  `category_name_en` varchar(80) NOT NULL,
  `is_system` tinyint(4) NOT NULL DEFAULT '0',
  `category_hot_words` varchar(255) NOT NULL,
  `category_home_shares` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL default '100',
  `is_open` tinyint(4) default '1',
  `is_home` tinyint(1) default '1',
  PRIMARY KEY  (`category_id`),
  KEY `idx_category_name_en` (`category_name_en`),
  KEY `idx_is_system` (`is_system`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


INSERT INTO `{dbpre}ptx_category` (`category_id`, `category_name_cn`, `category_name_en`, `is_system`, `category_hot_words`, `category_home_shares`, `display_order`) VALUES
(1, '家居生活', 'home', 0, '宠物,布艺,绿植,装修,DIY,阁楼,厨房,儿童房,书房,阳台,烛台,工作台,抱枕,灯具', '', 100),
(2, '时装配饰', 'fashion', 0, '连衣裙,吊带,性感,蕾丝,森女,打底,春夏,首饰,水晶', '', 100),
(4, '旅行摄影', 'travel', 0, '马尔代夫,旅行,瑜伽,风景,夜景,城堡,爱琴海,西藏,布拉格', '', 100),
(3, '美食菜谱', 'yammy', 0, '火锅,美食,水果,小吃,吃货,甜品,巧克力,提拉米苏,果酱,抹茶', '', 100),
(5, '更多分享', 'default', 1, '婚纱,新娘,幸福,个性,生活,性感,温馨', '', 100);


CREATE TABLE IF NOT EXISTS `{dbpre}ptx_connector` (
  `connect_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `social_userid` varchar(100) NOT NULL,
  `vendor` varchar(40) NOT NULL,
  `vendor_info` text NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `username` varchar(80) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `homepage` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `location` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`connect_id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_favorite_sharing` (
  `favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `share_id` int(11) NOT NULL,
  `create_time_old` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY  (`favorite_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_share_id` (`share_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_item` (
  `item_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) default NULL,
  `intro` text NOT NULL,
  `intro_search` text,
  `keywords` text NOT NULL,
  `image_path` varchar(255) default NULL,
  `share_type` varchar(20) NOT NULL,
  `share_attribute` text,
  `price` float default NULL,
  `is_show` tinyint(4) NOT NULL,
  `reference_url` varchar(255) default NULL,
  `reference_itemid` varchar(30) default NULL,
  `reference_channel` varchar(255) default NULL,
  `promotion_url` varchar(255) default NULL,
  `create_time_old` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `is_deleted` tinyint(4) default '0',
  `total_images` tinyint(2) default '0',
  `create_time` int(10) NOT NULL,
  `img_pro` text,
  `images_array` text,
  PRIMARY KEY (`item_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_is_show` (`is_show`),
  KEY `idx_reference` (`reference_channel`,`reference_itemid`),
  FULLTEXT KEY `idx_intro_search` (`intro_search`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_share` (
  `share_id` int(11) NOT NULL auto_increment,
  `item_id` int(11) NOT NULL,
  `poster_id` int(11) NOT NULL,
  `poster_nickname` varchar(80) default NULL,
  `original_id` int(11) default NULL,
  `user_id` int(11) NOT NULL,
  `user_nickname` varchar(80) default NULL,
  `total_comments` int(11) default NULL,
  `total_clicks` int(11) NOT NULL default '0',
  `total_likes` int(11) default NULL,
  `total_forwarding` int(11) default '0',
  `create_time_old` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `comments` text,
  `category_id` int(11) NOT NULL,
  `album_id` int(11) default '0',
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`share_id`),
  KEY `idx_item` (`item_id`),
  KEY `idx_poster_id` (`poster_id`),
  KEY `idx_original_id` (`original_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_create_time` (`create_time_old`),
  KEY `idx_total_comments` (`total_comments`),
  KEY `idx_total_likes` (`total_likes`),
  KEY `idx_total_forward` (`total_forwarding`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `tag_group_name_cn` varchar(80) NOT NULL,
  `tag_group_name_en` varchar(80) NOT NULL,
  `tags` text NOT NULL,
  `display_order` int(11) DEFAULT '100',
  `is_system` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tag_id`),
  KEY `idx_category_id` (`category_id`),
  KEY `idx_category_order` (`display_order`),
  KEY `idx_is_system` (`is_system`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

INSERT INTO `{dbpre}ptx_tag` (`tag_id`, `category_id`, `tag_group_name_cn`, `tag_group_name_en`, `tags`, `display_order`, `is_system`) VALUES
(1, 4, '热门标签', 'travel', '马尔代夫,旅行,瑜伽,风景,夜景,城堡,爱琴海,西藏,布拉格', 100, 0),
(2, 3, '热门标签', 'yammy', '美食, 菜谱, 吃货, 早餐, 培根, 曲奇, 慕斯, 寿司, 蛋糕, 提拉米苏, 巧克力', 100, 0),
(3, 1, '热门标签', 'home', '家居, 生活, 楼梯, 阁楼, 儿童房, 厨房, 窗户, 布艺, 沙发, 烛台, 书架, 装修, 照片墙, 废旧, 置物架, 工作台, 露台, 蜡烛, 抱枕, 床品', 100, 0),
(4, 2, '服装', 'clothing', '女装, 男装, 毛衣, 马甲, 牛仔裤, 连衣裙, 斗篷, 卫衣, 打底, 风衣, 百褶裙, 西装, 衬衫, 皮衣, 皮草, 短裙, 丝袜, 文胸, 内裤, 袜子, 短裤, 内衣', 100, 0),
(5, 2, '风格', 'style', '森女, 复古, 欧美, 日系, 英伦, 文艺, 混搭, 学院风, 民族风, 甜美系, 可爱风, 撞色, 日韩范, 牛仔风, 卡哇伊, 萌', 100, 0),
(6, 2, '配饰', 'accessories', '配饰, 包包, 鞋, 钱包, 帽子, 手帕, 围巾, 帆布鞋, 项链, 马丁靴, 戒指, 发箍, 纯银, 手表, 古董包, 耳钉, 腰带, 双肩包', 100, 0),
(7, 2, '元素', 'element', '波点, 条纹, 毛领, 蕾丝, 狐狸毛, 碎花, 豹纹, 彩条, 棉麻, 流苏, 拼接, 格子, 牛仔, 雪纺, 骷髅', 100, 0),
(8, 5, '热门标签', 'more', '婚纱,新娘,幸福,个性,生活,性感,温馨', 100, 0);

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_user` (
  `user_id` int(11) NOT NULL auto_increment,
  `email` varchar(80) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `nickname` varchar(80) NOT NULL,
  `gender` varchar(10) default NULL,
  `province` varchar(20) default NULL,
  `city` varchar(20) default NULL,
  `location` varchar(20) default NULL,
  `bio` varchar(255) default NULL,
  `is_active` tinyint(4) NOT NULL default '1',
  `create_time_old` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `total_follows` int(11) default '0',
  `total_followers` int(11) default '0',
  `total_shares` int(11) default '0',
  `total_albums` int(11) default '0',
  `total_favorite_shares` int(11) default '0',
  `total_favorite_albums` int(11) default '0',
  `avatar_local` varchar(255) default NULL,
  `avatar_remote` varchar(255) default NULL,
  `lost_password_key` varchar(40) default NULL,
  `lost_password_expire` int(11) default NULL,
  `is_social` tinyint(4) default '0',
  `user_title` varchar(255) default NULL,
  `user_type` tinyint(4) NOT NULL default '1',
  `is_deleted` tinyint(4) NOT NULL default '0',
  `total_likes` int(11) default '0',
  `is_star` tinyint(4) default '0',
  `is_shop` tinyint(4) default '0',
  `create_time` int(10) NOT NULL,
  `uc_id` int(11) default NULL,
  `total_messages` int(11) default '0',
  `last_login_time` int(10) default NULL,
  `usergroup_id` smallint(6) default '7',
  `credits` int(10) default '0',
  `ext_credits_1` int(10) default '0',
  `ext_credits_2` int(10) default '0',
  `ext_credits_3` int(10) default '0',
  PRIMARY KEY  (`user_id`),
  KEY `idx_login` (`email`,`passwd`),
  KEY `idx_nickname` (`nickname`),
  KEY `idx_lost_password_key` (`lost_password_key`),
  KEY `idx_email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_album` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` INT(11) NULL DEFAULT 0 ,
  `album_title` VARCHAR(255) NOT NULL ,
  `create_time` int(10) NOT NULL,
  `user_id` INT(11) NOT NULL ,
  `album_cover` TEXT NULL ,
  `total_share` INT(11) NULL DEFAULT 0 ,
  `total_like` INT(11) NULL DEFAULT 0 ,
  PRIMARY KEY (`album_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_subscription` (
  `subscibe_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subscibe_user_id` int(11) NOT NULL,
  `subscibe_status` int(11) NOT NULL,
  PRIMARY KEY (`subscibe_id`),
  KEY `idx_subscibe_user_id` (`subscibe_user_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_subscibe_status` (`subscibe_status`),
  KEY `idx_noduplicate` (`user_id`,`subscibe_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_staruser` (
  `star_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `star_cover` TEXT NULL ,
  `star_reason` TEXT NULL ,
  `display_order` int(11) NOT NULL DEFAULT '100',
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`star_id`),
  KEY `idx_star_id` (`star_id`),
  KEY `idx_category_id` (`category_id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_goodshop` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `shop_cover` TEXT NULL ,
  `shop_desc` TEXT NULL ,
  `display_order` int(11) NOT NULL DEFAULT '100',
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`shop_id`),
  KEY `idx_shop_id` (`shop_id`),
  KEY `idx_category_id` (`category_id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `share_id` int(11) NOT NULL,
  `comment_txt` TEXT NULL ,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `idx_comment_id` (`comment_id`),
  KEY `idx_share_id` (`share_id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message_txt` TEXT NULL ,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `idx_message_id` (`message_id`),
  KEY `idx_from_user_id` (`from_user_id`),
  KEY `idx_to_user_id` (`to_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_relationship` (
  `relation_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `relation_status` tinyint(2) NOT NULL ,
  PRIMARY KEY (`relation_id`),
  KEY `idx_relation_id` (`relation_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_friend_id` (`friend_id`),
  KEY `idx_user_friend_id` (`user_id`,`friend_id`),
  KEY `idx_user_id_status` (`user_id`,`relation_status`),
  KEY `idx_friend_id_status` (`friend_id`,`relation_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_favorite_album` (
  `favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`favorite_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_album_id` (`album_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_apply` (
  `apply_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `message_txt` TEXT NULL ,
  `apply_type` tinyint(2) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`apply_id`),
  KEY `idx_apply_id` (`apply_id`),
  KEY `idx_user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `set_key` varchar(100) NOT NULL,
  `set_value` text NOT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `idx_setting_id` (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `{dbpre}ptx_smile` (
  `smile_id` smallint(6) unsigned NOT NULL auto_increment,
  `typeid` smallint(6) unsigned NOT NULL,
  `displayorder` tinyint(1) NOT NULL default '0',
  `code` varchar(30) NOT NULL default '',
  `url` varchar(30) NOT NULL default '',
  PRIMARY KEY  (`smile_id`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `{dbpre}ptx_smile` (`smile_id`,`typeid`,`displayorder`,`code`,`url`) VALUES 
('1','1','1',':)','smile.gif'),
('2','1','2',':(','sad.gif'),
('3','1','3',':D','biggrin.gif'),
('4','1','4',':cry:','cry.gif'),
('5','1','5',':huf:','huffy.gif'),
('6','1','6',':shock:','shocked.gif'),
('7','1','7',':P','tongue.gif'),
('8','1','8',':shy:','shy.gif'),
('9','1','9',':P','titter.gif'),
('10','1','10',':L','sweat.gif'),
('11','1','11',':Q','mad.gif'),
('12','1','12',':lol','lol.gif'),
('13','1','13',':loveliness:','loveliness.gif'),
('14','1','14',':funk:','funk.gif'),
('15','1','15',':curse:','curse.gif'),
('16','1','16',':dizzy:','dizzy.gif'),
('17','1','17',':shutup:','shutup.gif'),
('18','1','18',':sleepy:','sleepy.gif'),
('19','1','19',':hug:','hug.gif'),
('20','1','20',':victory:','victory.gif'),
('21','1','21',':time:','time.gif'),
('22','1','22',':kiss:','kiss.gif'),
('23','1','23',':handshake','handshake.gif'),
('24','1','24',':call:','call.gif');

CREATE TABLE `{dbpre}ptx_usergroup` (  `usergroup_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `usergroup_type` enum('system','special','member') NOT NULL DEFAULT 'member',
  `usergroup_title` varchar(255) NOT NULL DEFAULT '',
  `credits_lower` int(10) NOT NULL DEFAULT '0',
  `credits_higher` int(10) NOT NULL DEFAULT '0',
  `stars` tinyint(3) NOT NULL DEFAULT '0',
  `color` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '',
  `allow_visit` tinyint(1) NOT NULL DEFAULT '1',
  `allow_share` tinyint(1) NOT NULL DEFAULT '1',
  `need_verify` tinyint(1) NOT NULL DEFAULT '1',
  `other_permission` TEXT NULL,
  PRIMARY KEY (`usergroup_id`),
  KEY `idx_credits_range` (`credits_higher`,`credits_lower`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;


INSERT INTO `{dbpre}ptx_usergroup` (`usergroup_id`,`usergroup_type`,`usergroup_title`,`credits_lower`,`credits_higher`,`stars`,`color`,`icon`,`allow_visit`,`allow_share`,`need_verify`,`other_permission`) VALUES 
(1,'system','admin','0','0','9','','','1','1','1',NULL),
(2,'system','editer','0','0','8','','','1','1','1',NULL),
(3,'system','banned_visit','0','0','0','','','1','1','1',NULL),
(4,'system','banned_post','0','0','0','','','1','1','1',NULL),
(5,'system','waiting_verify','0','0','0','','','1','1','1',NULL),
(6,'system','guest','0','0','0','','','1','1','1',NULL),
(7,'member','level_1','0','50','1','','','1','1','1',NULL),
(8,'member','level_2','50','200','2','','','1','1','1',NULL),
(9,'member','level_3','200','500','3','','','1','1','1',NULL),
(10,'member','level_4','500','1000','4','','','1','1','1',NULL),
(11,'member','level_5','1000','3000','6','','','1','1','1',NULL),
(12,'member','level_6','3000','9999999','8','','','1','1','1',NULL);


CREATE TABLE IF NOT EXISTS `{dbpre}ptx_event_log` (
  `event_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type` enum('warn','alert','reward') NOT NULL DEFAULT 'alert',
  `event_code` varchar(50) NOT NULL DEFAULT '',
  `to_user_id` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`event_log_id`),
  KEY `idx_event_log_id` (`event_log_id`),
  KEY `idx_event_code` (`event_code`),
  KEY `idx_is_read` (`is_read`),
  KEY `idx_to_user_id` (`to_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
