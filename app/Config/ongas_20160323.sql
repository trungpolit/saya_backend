/*
Navicat MySQL Data Transfer

Source Server         : locahost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : saya

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-03-23 01:18:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ads
-- ----------------------------
DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ads
-- ----------------------------
INSERT INTO `ads` VALUES ('1', 'Quảng cáo tại trang danh mục sản phẩm', '<p style=\"text-align: center;\">Vị tr&iacute; n&agrave;y d&agrave;nh cho quảng c&aacute;o, mời li&ecirc;n hệ onGas: 0912863698 hoặc 0904614756</p>', '1', null, '2016-02-29 00:04:00', '2016-03-23 01:08:16');

-- ----------------------------
-- Table structure for bundles
-- ----------------------------
DROP TABLE IF EXISTS `bundles`;
CREATE TABLE `bundles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `weight` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bundles
-- ----------------------------
INSERT INTO `bundles` VALUES ('1', null, 'Thực phẩm sạch', '<p>&nbsp;Thực phẩm sạch</p>', null, null, '2', '2015-09-17 06:09:37', '2015-09-17 06:09:37');
INSERT INTO `bundles` VALUES ('2', null, 'Thời trang', '<p>Thời trang</p>', null, null, '2', '2015-09-17 06:09:55', '2015-09-17 06:09:55');
INSERT INTO `bundles` VALUES ('3', null, 'Làm đẹp', '<p>L&agrave;m đẹp</p>', null, null, '2', '2015-09-17 06:10:25', '2015-09-17 06:10:25');
INSERT INTO `bundles` VALUES ('4', null, 'Sieu KM', '', null, null, '2', '2016-03-15 08:21:20', '2016-03-15 08:21:20');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `logo_uri` text,
  `weight` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', null, 'Hàng Nam', '<p>B&aacute;n chạy</p>', 'a:1:{i:0;s:69:\"data_files//categories/image/201603/22/diem-g-cua-dan-ong-1_avcxo.jpg\";}', null, '2', null, '2015-09-13 19:28:19', '2016-03-22 15:59:27');
INSERT INTO `categories` VALUES ('2', null, 'Gia đình', '<p>Khuyến m&atilde;i</p>', 'a:1:{i:0;s:52:\"data_files//categories/image/201603/22/gd1_huxqr.JPG\";}', null, '2', null, '2015-09-17 06:16:03', '2016-03-22 16:43:18');
INSERT INTO `categories` VALUES ('4', null, 'Hàng Nữ', '<p><span style=\"font-size: 12pt;\">H&agrave;ng d&agrave;nh cho ph&aacute;i đẹp</span></p>', 'a:1:{i:0;s:73:\"data_files//categories/image/201603/22/new-new-hoa-hau-ngoc-anh_ocvgy.jpg\";}', '0', '2', null, '2015-09-17 06:29:29', '2016-03-22 13:48:06');
INSERT INTO `categories` VALUES ('5', null, 'Hàng HOT', '', 'a:1:{i:0;s:72:\"data_files//categories/image/201603/22/doi-moi-dep1-1421219834_vxcxh.jpg\";}', '2', '2', null, '2016-03-13 13:33:39', '2016-03-22 15:56:15');
INSERT INTO `categories` VALUES ('6', null, 'Cực Sốc', '', 'a:1:{i:0;s:61:\"data_files//categories/image/201603/22/82648406-180_infqh.jpg\";}', '1', '2', null, '2016-03-15 08:24:13', '2016-03-22 15:21:10');

-- ----------------------------
-- Table structure for client_versions
-- ----------------------------
DROP TABLE IF EXISTS `client_versions`;
CREATE TABLE `client_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `platform_os` varchar(255) NOT NULL,
  `platform_version` int(11) NOT NULL,
  `download_link` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of client_versions
-- ----------------------------
INSERT INTO `client_versions` VALUES ('1', 'Phiên bản app cho Android', 'Phiên bản app cho Android', 'Android', '1', 'https://www.youtube.com/watch?v=D9TpswDIBS8', null, '2016-02-29 18:04:06', '2016-03-08 15:39:37');
INSERT INTO `client_versions` VALUES ('2', 'Phiên bản app cho iOS', 'Phiên bản app cho iOS', 'iOS', '1', 'https://www.youtube.com/watch?v=5rWhvIJTSzI', null, '2016-02-29 18:06:15', '2016-03-01 16:07:41');

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `region_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `mobile2` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text,
  `platform_os` varchar(255) DEFAULT NULL,
  `platform_version` varchar(255) DEFAULT NULL,
  `client_ip` varchar(255) DEFAULT NULL,
  `user_agent` text,
  `host` varchar(255) DEFAULT NULL,
  `total_order` int(11) DEFAULT '0',
  `total_order_success` int(11) DEFAULT '0',
  `total_order_pending` int(11) DEFAULT '0',
  `total_order_processing` int(11) DEFAULT '0',
  `total_order_fail` int(11) DEFAULT '0',
  `total_order_bad` int(11) DEFAULT '0',
  `total_order_bundle` int(11) DEFAULT '0',
  `total_order_bundle_success` int(11) DEFAULT '0',
  `total_order_bundle_pending` int(11) DEFAULT '0',
  `total_order_bundle_processing` int(11) DEFAULT '0',
  `total_order_bundle_fail` int(11) DEFAULT '0',
  `total_order_bundle_bad` int(11) DEFAULT '0',
  `status` tinyint(4) DEFAULT '2',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customers
-- ----------------------------

-- ----------------------------
-- Table structure for daily_reports
-- ----------------------------
DROP TABLE IF EXISTS `daily_reports`;
CREATE TABLE `daily_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `bundle_id` int(11) DEFAULT NULL,
  `total_order_bundle` int(11) DEFAULT '0',
  `total_order_bundle_success` int(11) DEFAULT '0',
  `total_order_bundle_pending` int(11) DEFAULT '0',
  `total_order_bundle_processing` int(11) DEFAULT '0',
  `total_order_bundle_fail` int(11) DEFAULT '0',
  `total_order_bundle_bad` int(11) DEFAULT '0',
  `total_revernue` int(11) DEFAULT '0',
  `total_customer` int(11) DEFAULT '0',
  `total_customer_good` int(11) DEFAULT '0',
  `total_customer_bad` int(11) DEFAULT '0',
  `total_customer_black` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_region_id_bundle_id` (`date`,`region_id`,`bundle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of daily_reports
-- ----------------------------

-- ----------------------------
-- Table structure for feedbacks
-- ----------------------------
DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_code` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_mobile` varchar(255) DEFAULT NULL,
  `customer_mobile2` varchar(255) DEFAULT NULL,
  `platform_os` varchar(255) DEFAULT NULL,
  `platform_version` varchar(255) DEFAULT NULL,
  `client_ip` varchar(255) DEFAULT NULL,
  `user_agent` text,
  `host` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of feedbacks
-- ----------------------------
INSERT INTO `feedbacks` VALUES ('1', 'Yuhhdh', 'Ghdjjdhkdis', '6', '9f453cc6a651d89', 'Cao bằng', '123456', '', 'Android', '5.0', '117.6.58.24', 'Mozilla/5.0 (Linux; Android 5.0; SM-N9005 Build/LRX21V; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/48.0.2564.106 Mobile Safari/537.36', 'cms.goga.mobi', null, '2016-03-13 13:17:17', '2016-03-13 13:17:17');
INSERT INTO `feedbacks` VALUES ('2', 'Abcd', 'Abnnjk', '6', '9f453cc6a651d89', 'Cao bằng', '123456', '', 'Android', '5.0', '117.6.58.24', 'Mozilla/5.0 (Linux; Android 5.0; SM-N9005 Build/LRX21V; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/48.0.2564.106 Mobile Safari/537.36', 'cms.goga.mobi', null, '2016-03-13 13:20:43', '2016-03-13 13:20:43');

-- ----------------------------
-- Table structure for file_managed
-- ----------------------------
DROP TABLE IF EXISTS `file_managed`;
CREATE TABLE `file_managed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `uri` varchar(2000) DEFAULT NULL,
  `mime` varchar(30) DEFAULT NULL,
  `size` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of file_managed
-- ----------------------------
INSERT INTO `file_managed` VALUES ('1', 'aslan-narnia-by-tralala1984_ruvlg.jpg', 'data_files/categories/image/201509/13/aslan-narnia-by-tralala1984_ruvlg.jpg', 'image/jpeg', '310428', '1', null, '2015-09-13 19:28:17', '2015-09-13 19:28:17');
INSERT INTO `file_managed` VALUES ('2', 'best-seller-logo_qmwsf.png', 'data_files/categories/image/201509/17/best-seller-logo_qmwsf.png', 'image/png', '61684', '1', null, '2015-09-17 06:13:22', '2015-09-17 06:13:22');
INSERT INTO `file_managed` VALUES ('3', 'sale-logo_zjuvb.png', 'data_files/categories/image/201509/17/sale-logo_zjuvb.png', 'image/png', '32779', '1', null, '2015-09-17 06:15:57', '2015-09-17 06:15:57');
INSERT INTO `file_managed` VALUES ('4', 'new-arrival-270x250_ijizt.png', 'data_files/categories/image/201509/17/new-arrival-270x250_ijizt.png', 'image/png', '3037', '1', null, '2015-09-17 06:23:00', '2015-09-17 06:23:00');
INSERT INTO `file_managed` VALUES ('5', 'save-money_qtarf.png', 'data_files/categories/image/201509/17/save-money_qtarf.png', 'image/png', '27859', '1', null, '2015-09-17 06:29:26', '2015-09-17 06:29:26');
INSERT INTO `file_managed` VALUES ('6', 'rau-mam-rau-muong-1_lbrce.jpg', 'data_files/categories/image/201509/17/rau-mam-rau-muong-1_lbrce.jpg', 'image/jpeg', '299373', '1', null, '2015-09-17 06:56:17', '2015-09-17 06:56:17');
INSERT INTO `file_managed` VALUES ('7', 'rau-mam-rau-muong-1_ckgsm.jpg', 'data_files/categories/image/201509/20/rau-mam-rau-muong-1_ckgsm.jpg', 'image/jpeg', '299373', '1', null, '2015-09-20 05:46:16', '2015-09-20 05:46:16');
INSERT INTO `file_managed` VALUES ('8', 'rau-mam-rau-muong-1_nwtyy.jpg', 'data_files/categories/image/201509/20/rau-mam-rau-muong-1_nwtyy.jpg', 'image/jpeg', '299373', '1', null, '2015-09-20 05:53:24', '2015-09-20 05:53:24');
INSERT INTO `file_managed` VALUES ('9', 'rau-mam-cu-cai-do-1_hfjnr.jpg', 'data_files/categories/image/201509/20/rau-mam-cu-cai-do-1_hfjnr.jpg', 'image/jpeg', '28924', '1', null, '2015-09-20 06:43:41', '2015-09-20 06:43:41');
INSERT INTO `file_managed` VALUES ('10', 'rau-cai-thia_ognml.jpg', 'data_files/categories/image/201509/20/rau-cai-thia_ognml.jpg', 'image/jpeg', '48013', '1', null, '2015-09-20 07:31:13', '2015-09-20 07:31:13');
INSERT INTO `file_managed` VALUES ('11', 'cai-ngot_nwrav.jpg', 'data_files/categories/image/201509/20/cai-ngot_nwrav.jpg', 'image/jpeg', '55171', '1', null, '2015-09-20 07:34:47', '2015-09-20 07:34:47');
INSERT INTO `file_managed` VALUES ('12', 'mut-ca-chua-bi-5_mruqb.jpg', 'data_files/categories/image/201509/22/mut-ca-chua-bi-5_mruqb.jpg', 'image/jpeg', '89815', '1', null, '2015-09-22 17:27:17', '2015-09-22 17:27:17');
INSERT INTO `file_managed` VALUES ('13', 'cai-bap-ti-hon_dxeit.jpg', 'data_files/categories/image/201509/27/cai-bap-ti-hon_dxeit.jpg', 'image/jpeg', '44702', '1', null, '2015-09-27 12:23:46', '2015-09-27 12:23:46');
INSERT INTO `file_managed` VALUES ('14', 'dua-hau-ti-hon_ibhca.jpg', 'data_files/categories/image/201509/27/dua-hau-ti-hon_ibhca.jpg', 'image/jpeg', '119949', '1', null, '2015-09-27 12:25:59', '2015-09-27 12:25:59');
INSERT INTO `file_managed` VALUES ('15', 'dua-hau-ti-hon_txuwq.jpg', 'webroot/data_files//categories/image/201509/27/dua-hau-ti-hon_txuwq.jpg', 'image/jpeg', '119949', '1', null, '2015-09-27 20:24:30', '2015-09-27 20:24:30');
INSERT INTO `file_managed` VALUES ('16', 'dua-hau-ti-hon_oqlow.jpg', 'data_files//products/image/201510/17/dua-hau-ti-hon_oqlow.jpg', 'image/jpeg', '119949', '1', null, '2015-10-17 17:27:47', '2015-10-17 17:27:47');
INSERT INTO `file_managed` VALUES ('17', 'daubepvietnam-bap-cai-tim-6392-2951-5020-1440382721_vrelh.jpg', 'data_files//products/image/201603/08/daubepvietnam-bap-cai-tim-6392-2951-5020-1440382721_vrelh.jpg', 'image/jpeg', '50990', '1', null, '2016-03-08 16:11:42', '2016-03-08 16:11:42');
INSERT INTO `file_managed` VALUES ('18', 'ao-somi-nam-8th15w005-12-1_pjkfk.jpg', 'data_files//products/image/201603/09/ao-somi-nam-8th15w005-12-1_pjkfk.jpg', 'image/jpeg', '112975', '1', null, '2016-03-09 04:51:56', '2016-03-09 04:51:56');
INSERT INTO `file_managed` VALUES ('19', 'ao-phong-raglan-tay-den-dep_vmimw.jpg', 'data_files//products/image/201603/11/ao-phong-raglan-tay-den-dep_vmimw.jpg', 'image/jpeg', '44884', '1', null, '2016-03-11 16:06:02', '2016-03-11 16:06:02');
INSERT INTO `file_managed` VALUES ('20', 'images_kzqae.jpg', 'data_files//products/image/201603/13/images_kzqae.jpg', 'image/jpeg', '6083', '1', null, '2016-03-13 10:06:10', '2016-03-13 10:06:10');
INSERT INTO `file_managed` VALUES ('21', '20000101-082512_dnjsq.jpg', 'data_files//products/image/201603/13/20000101-082512_dnjsq.jpg', 'image/jpeg', '257669', '1', null, '2016-03-13 10:19:25', '2016-03-13 10:19:25');
INSERT INTO `file_managed` VALUES ('22', 'anh1_nowqf.png', 'data_files//products/image/201603/13/anh1_nowqf.png', 'image/png', '8265', '1', null, '2016-03-13 10:22:34', '2016-03-13 10:22:34');
INSERT INTO `file_managed` VALUES ('23', 'anh1_mocsb.png', 'data_files//categories/image/201603/13/anh1_mocsb.png', 'image/png', '8265', '1', null, '2016-03-13 10:57:34', '2016-03-13 10:57:34');
INSERT INTO `file_managed` VALUES ('24', '20140110-091509_adffi.jpg', 'data_files//products/image/201603/13/20140110-091509_adffi.jpg', 'image/jpeg', '139694', '1', null, '2016-03-13 11:04:46', '2016-03-13 11:04:46');
INSERT INTO `file_managed` VALUES ('25', '20131231-193349_diggr.jpg', 'data_files//products/image/201603/13/20131231-193349_diggr.jpg', 'image/jpeg', '238580', '1', null, '2016-03-13 11:12:16', '2016-03-13 11:12:16');
INSERT INTO `file_managed` VALUES ('26', 'loet-da-day_tucag.jpg', 'data_files//categories/image/201603/13/loet-da-day_tucag.jpg', 'image/jpeg', '88396', '1', null, '2016-03-13 13:33:36', '2016-03-13 13:33:36');
INSERT INTO `file_managed` VALUES ('27', '20140102-212955_zstcs.jpg', 'data_files//products/image/201603/13/20140102-212955_zstcs.jpg', 'image/jpeg', '238554', '1', null, '2016-03-13 15:53:58', '2016-03-13 15:53:58');
INSERT INTO `file_managed` VALUES ('28', '20131216-143025_incei.jpg', 'webroot/tmp/20131216-143025_incei.jpg', 'image/jpeg', '259184', '0', null, '2016-03-13 22:29:42', '2016-03-13 22:29:42');
INSERT INTO `file_managed` VALUES ('29', '20131216-145315_bfqdy.jpg', 'data_files//products/image/201603/13/20131216-145315_bfqdy.jpg', 'image/jpeg', '161883', '1', null, '2016-03-13 22:34:10', '2016-03-13 22:34:10');
INSERT INTO `file_managed` VALUES ('30', '20131216-145459_qhmwo.jpg', 'data_files//products/image/201603/13/20131216-145459_qhmwo.jpg', 'image/jpeg', '201587', '1', null, '2016-03-13 22:36:51', '2016-03-13 22:36:51');
INSERT INTO `file_managed` VALUES ('31', '20131228-121638_buarn.jpg', 'data_files//products/image/201603/13/20131228-121638_buarn.jpg', 'image/jpeg', '231709', '1', null, '2016-03-13 22:39:24', '2016-03-13 22:39:24');
INSERT INTO `file_managed` VALUES ('32', '20140127-103833_pxzxo.jpg', 'webroot/tmp/20140127-103833_pxzxo.jpg', 'image/jpeg', '147300', '0', null, '2016-03-13 22:42:39', '2016-03-13 22:42:39');
INSERT INTO `file_managed` VALUES ('33', '20131216-145459_rrtod.jpg', 'data_files//products/image/201603/13/20131216-145459_rrtod.jpg', 'image/jpeg', '201587', '1', null, '2016-03-13 22:43:16', '2016-03-13 22:43:16');
INSERT INTO `file_managed` VALUES ('34', 'clip-image001_glysg.jpg', 'data_files//categories/image/201603/15/clip-image001_glysg.jpg', 'image/jpeg', '19419', '1', null, '2016-03-15 08:24:07', '2016-03-15 08:24:07');
INSERT INTO `file_managed` VALUES ('35', 'clip-image001_zcvlw.jpg', 'data_files//products/image/201603/15/clip-image001_zcvlw.jpg', 'image/jpeg', '19419', '1', null, '2016-03-15 08:26:29', '2016-03-15 08:26:29');
INSERT INTO `file_managed` VALUES ('36', 'clip-image001_pvaqb.jpg', 'data_files//products/image/201603/15/clip-image001_pvaqb.jpg', 'image/jpeg', '19419', '1', null, '2016-03-15 11:48:39', '2016-03-15 11:48:39');
INSERT INTO `file_managed` VALUES ('37', 'new-hoa-hau-ngoc-anh_ryztm.jpg', 'data_files//categories/image/201603/22/new-hoa-hau-ngoc-anh_ryztm.jpg', 'image/jpeg', '6468', '1', null, '2016-03-22 13:05:32', '2016-03-22 13:05:32');
INSERT INTO `file_managed` VALUES ('38', 'new-hoa-hau-ngoc-anh_uqyvu.jpg', 'data_files//categories/image/201603/22/new-hoa-hau-ngoc-anh_uqyvu.jpg', 'image/jpeg', '9495', '1', null, '2016-03-22 13:14:26', '2016-03-22 13:14:26');
INSERT INTO `file_managed` VALUES ('39', 'new-new-hoa-hau-ngoc-anh_ocvgy.jpg', 'data_files//categories/image/201603/22/new-new-hoa-hau-ngoc-anh_ocvgy.jpg', 'image/jpeg', '12873', '1', null, '2016-03-22 13:39:45', '2016-03-22 13:39:45');
INSERT INTO `file_managed` VALUES ('40', 'new-images_pelgw.jpg', 'data_files//categories/image/201603/22/new-images_pelgw.jpg', 'image/jpeg', '6338', '1', null, '2016-03-22 13:46:51', '2016-03-22 13:46:51');
INSERT INTO `file_managed` VALUES ('41', 'tai-xuong_fpzqc.jpg', 'data_files//categories/image/201603/22/tai-xuong_fpzqc.jpg', 'image/jpeg', '10306', '1', null, '2016-03-22 13:59:34', '2016-03-22 13:59:34');
INSERT INTO `file_managed` VALUES ('42', 'images_kfjbg.jpg', 'data_files//categories/image/201603/22/images_kfjbg.jpg', 'image/jpeg', '5200', '1', null, '2016-03-22 14:01:59', '2016-03-22 14:01:59');
INSERT INTO `file_managed` VALUES ('43', 'images-1-_qnuyl.jpg', 'data_files//categories/image/201603/22/images-1-_qnuyl.jpg', 'image/jpeg', '7782', '1', null, '2016-03-22 14:04:17', '2016-03-22 14:04:17');
INSERT INTO `file_managed` VALUES ('44', 'quy-dinh-cua-phap-luat-ve-toi-cuong-dam-tre-em_hqnuh.jpg', 'data_files//categories/image/201603/22/quy-dinh-cua-phap-luat-ve-toi-cuong-dam-tre-em_hqnuh.jpg', 'image/jpeg', '23921', '1', null, '2016-03-22 14:06:08', '2016-03-22 14:06:08');
INSERT INTO `file_managed` VALUES ('45', 'cho-be-an-yen-sao2_llruo.jpg', 'data_files//categories/image/201603/22/cho-be-an-yen-sao2_llruo.jpg', 'image/jpeg', '44983', '1', null, '2016-03-22 15:02:48', '2016-03-22 15:02:48');
INSERT INTO `file_managed` VALUES ('46', '82648406-180_infqh.jpg', 'data_files//categories/image/201603/22/82648406-180_infqh.jpg', 'image/jpeg', '9146', '1', null, '2016-03-22 15:21:08', '2016-03-22 15:21:08');
INSERT INTO `file_managed` VALUES ('47', 'doi-moi-dep1-1421219834_vxcxh.jpg', 'data_files//categories/image/201603/22/doi-moi-dep1-1421219834_vxcxh.jpg', 'image/jpeg', '24767', '1', null, '2016-03-22 15:56:05', '2016-03-22 15:56:05');
INSERT INTO `file_managed` VALUES ('48', 'diem-g-cua-dan-ong-1_avcxo.jpg', 'data_files//categories/image/201603/22/diem-g-cua-dan-ong-1_avcxo.jpg', 'image/jpeg', '39177', '1', null, '2016-03-22 15:59:25', '2016-03-22 15:59:25');
INSERT INTO `file_managed` VALUES ('49', 'alotin-vn-1404361711-4fbaaa7a8382c7d97dabe9dde3f75688_gbzsx.jpg', 'data_files//categories/image/201603/22/alotin-vn-1404361711-4fbaaa7a8382c7d97dabe9dde3f75688_gbzsx.jpg', 'image/jpeg', '42672', '1', null, '2016-03-22 16:02:51', '2016-03-22 16:02:51');
INSERT INTO `file_managed` VALUES ('50', 'gd1_huxqr.JPG', 'data_files//categories/image/201603/22/gd1_huxqr.JPG', 'image/jpeg', '27734', '1', null, '2016-03-22 16:43:16', '2016-03-22 16:43:16');

-- ----------------------------
-- Table structure for file_mappings
-- ----------------------------
DROP TABLE IF EXISTS `file_mappings`;
CREATE TABLE `file_mappings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_managed_id` int(11) DEFAULT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `row_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of file_mappings
-- ----------------------------
INSERT INTO `file_mappings` VALUES ('99', '4', 'categories', '3', 'logo', '1', '2016-03-09 12:24:40', '2016-03-09 12:24:40');
INSERT INTO `file_mappings` VALUES ('129', '39', 'categories', '4', 'logo', '1', '2016-03-22 13:48:06', '2016-03-22 13:48:06');
INSERT INTO `file_mappings` VALUES ('135', '46', 'categories', '6', 'logo', '1', '2016-03-22 15:21:10', '2016-03-22 15:21:10');
INSERT INTO `file_mappings` VALUES ('136', '47', 'categories', '5', 'logo', '1', '2016-03-22 15:56:15', '2016-03-22 15:56:15');
INSERT INTO `file_mappings` VALUES ('137', '48', 'categories', '1', 'logo', '1', '2016-03-22 15:59:27', '2016-03-22 15:59:27');
INSERT INTO `file_mappings` VALUES ('139', '50', 'categories', '2', 'logo', '1', '2016-03-22 16:43:18', '2016-03-22 16:43:18');

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `notification_group_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `begin_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notifications
-- ----------------------------

-- ----------------------------
-- Table structure for notification_groups
-- ----------------------------
DROP TABLE IF EXISTS `notification_groups`;
CREATE TABLE `notification_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `weight` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notification_groups
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_mobile` varchar(255) DEFAULT NULL,
  `customer_mobile2` varchar(255) DEFAULT NULL,
  `customer_address` text,
  `region_id` int(11) NOT NULL,
  `region_name` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `no` int(11) DEFAULT NULL,
  `total_qty` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `notes` text,
  `platform_os` varchar(255) DEFAULT NULL,
  `platform_version` varchar(255) DEFAULT NULL,
  `client_ip` varchar(255) DEFAULT NULL,
  `user_agent` text,
  `host` varchar(255) DEFAULT NULL,
  `raw_data` text,
  `cache_data` text,
  `status` tinyint(4) DEFAULT '2',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for orders_bundles
-- ----------------------------
DROP TABLE IF EXISTS `orders_bundles`;
CREATE TABLE `orders_bundles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `order_code` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `no` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `region_name` varchar(255) DEFAULT NULL,
  `bundle_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_code` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_mobile` varchar(255) DEFAULT NULL,
  `customer_mobile2` varchar(255) DEFAULT NULL,
  `customer_address` text,
  `total_qty` int(11) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '2',
  `notes` text,
  `platform_os` varchar(255) DEFAULT NULL,
  `platform_version` varchar(255) DEFAULT NULL,
  `client_ip` varchar(255) DEFAULT NULL,
  `user_agent` text,
  `host` varchar(255) DEFAULT NULL,
  `raw_data` text,
  `cache_data` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders_bundles
-- ----------------------------

-- ----------------------------
-- Table structure for orders_products
-- ----------------------------
DROP TABLE IF EXISTS `orders_products`;
CREATE TABLE `orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_code` varchar(255) DEFAULT NULL,
  `orders_bundle_id` int(11) DEFAULT NULL,
  `orders_bundle_code` varchar(255) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `region_name` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_code` varchar(255) DEFAULT NULL,
  `bundle_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_logo_uri` varchar(255) DEFAULT NULL,
  `product_unit` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `platform_os` varchar(255) DEFAULT NULL,
  `platform_version` varchar(255) DEFAULT NULL,
  `client_ip` varchar(255) DEFAULT NULL,
  `user_agent` text,
  `host` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders_products
-- ----------------------------

-- ----------------------------
-- Table structure for perms
-- ----------------------------
DROP TABLE IF EXISTS `perms`;
CREATE TABLE `perms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) DEFAULT '2',
  `weight` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of perms
-- ----------------------------
INSERT INTO `perms` VALUES ('1', 'AdminUsers/index', 'AdminUsers/index', 'AdminUsers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('2', 'AdminUsers/add', 'AdminUsers/add', 'AdminUsers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('3', 'AdminUsers/edit', 'AdminUsers/edit', 'AdminUsers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('4', 'AdminUsers/reqUpload', 'AdminUsers/reqUpload', 'AdminUsers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('5', 'AdminUsers/reqDeleteFile', 'AdminUsers/reqDeleteFile', 'AdminUsers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('6', 'AdminUsers/reqDelete', 'AdminUsers/reqDelete', 'AdminUsers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('7', 'AdminUsers/reqEdit', 'AdminUsers/reqEdit', 'AdminUsers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('8', 'AdminUsers/isAuthorized', 'AdminUsers/isAuthorized', 'AdminUsers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('9', 'Ads/index', 'Ads/index', 'Ads', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('10', 'Ads/reqUpload', 'Ads/reqUpload', 'Ads', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('11', 'Ads/reqDeleteFile', 'Ads/reqDeleteFile', 'Ads', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('12', 'Ads/reqDelete', 'Ads/reqDelete', 'Ads', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('13', 'Ads/reqEdit', 'Ads/reqEdit', 'Ads', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('14', 'Ads/isAuthorized', 'Ads/isAuthorized', 'Ads', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('15', 'Bundles/add', 'Bundles/add', 'Bundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('16', 'Bundles/edit', 'Bundles/edit', 'Bundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('17', 'Bundles/index', 'Bundles/index', 'Bundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('18', 'Bundles/reqUpload', 'Bundles/reqUpload', 'Bundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('19', 'Bundles/reqDeleteFile', 'Bundles/reqDeleteFile', 'Bundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('20', 'Bundles/reqDelete', 'Bundles/reqDelete', 'Bundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('21', 'Bundles/reqEdit', 'Bundles/reqEdit', 'Bundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('22', 'Bundles/isAuthorized', 'Bundles/isAuthorized', 'Bundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('23', 'Categories/add', 'Categories/add', 'Categories', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('24', 'Categories/edit', 'Categories/edit', 'Categories', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('25', 'Categories/index', 'Categories/index', 'Categories', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('26', 'Categories/reqUpload', 'Categories/reqUpload', 'Categories', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('27', 'Categories/reqDeleteFile', 'Categories/reqDeleteFile', 'Categories', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('28', 'Categories/reqDelete', 'Categories/reqDelete', 'Categories', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('29', 'Categories/reqEdit', 'Categories/reqEdit', 'Categories', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('30', 'Categories/isAuthorized', 'Categories/isAuthorized', 'Categories', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('31', 'ClientVersions/index', 'ClientVersions/index', 'ClientVersions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('32', 'ClientVersions/add', 'ClientVersions/add', 'ClientVersions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('33', 'ClientVersions/edit', 'ClientVersions/edit', 'ClientVersions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('34', 'ClientVersions/reqUpload', 'ClientVersions/reqUpload', 'ClientVersions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('35', 'ClientVersions/reqDeleteFile', 'ClientVersions/reqDeleteFile', 'ClientVersions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('36', 'ClientVersions/reqDelete', 'ClientVersions/reqDelete', 'ClientVersions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('37', 'ClientVersions/reqEdit', 'ClientVersions/reqEdit', 'ClientVersions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('38', 'ClientVersions/isAuthorized', 'ClientVersions/isAuthorized', 'ClientVersions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('39', 'CustomerServices/detail', 'CustomerServices/detail', 'CustomerServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('40', 'CustomerServices/resError', 'CustomerServices/resError', 'CustomerServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('41', 'CustomerServices/resFail', 'CustomerServices/resFail', 'CustomerServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('42', 'CustomerServices/resSuccess', 'CustomerServices/resSuccess', 'CustomerServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('43', 'Customers/detail', 'Customers/detail', 'Customers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('44', 'Customers/reqUpload', 'Customers/reqUpload', 'Customers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('45', 'Customers/reqDeleteFile', 'Customers/reqDeleteFile', 'Customers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('46', 'Customers/reqDelete', 'Customers/reqDelete', 'Customers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('47', 'Customers/reqEdit', 'Customers/reqEdit', 'Customers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('48', 'Customers/isAuthorized', 'Customers/isAuthorized', 'Customers', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('49', 'DailyReports/index', 'DailyReports/index', 'DailyReports', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('50', 'DailyReports/reqUpload', 'DailyReports/reqUpload', 'DailyReports', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('51', 'DailyReports/reqDeleteFile', 'DailyReports/reqDeleteFile', 'DailyReports', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('52', 'DailyReports/reqDelete', 'DailyReports/reqDelete', 'DailyReports', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('53', 'DailyReports/reqEdit', 'DailyReports/reqEdit', 'DailyReports', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('54', 'DailyReports/isAuthorized', 'DailyReports/isAuthorized', 'DailyReports', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('55', 'DataFiles/index', 'DataFiles/index', 'DataFiles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('56', 'DataFiles/reqUpload', 'DataFiles/reqUpload', 'DataFiles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('57', 'DataFiles/reqDeleteFile', 'DataFiles/reqDeleteFile', 'DataFiles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('58', 'DataFiles/reqDelete', 'DataFiles/reqDelete', 'DataFiles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('59', 'DataFiles/reqEdit', 'DataFiles/reqEdit', 'DataFiles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('60', 'DataFiles/isAuthorized', 'DataFiles/isAuthorized', 'DataFiles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('61', 'FeedbackServices/create', 'FeedbackServices/create', 'FeedbackServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('62', 'FeedbackServices/resError', 'FeedbackServices/resError', 'FeedbackServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('63', 'FeedbackServices/resFail', 'FeedbackServices/resFail', 'FeedbackServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('64', 'FeedbackServices/resSuccess', 'FeedbackServices/resSuccess', 'FeedbackServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('65', 'Import/region', 'Import/region', 'Import', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('66', 'Import/reqUpload', 'Import/reqUpload', 'Import', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('67', 'Import/reqDeleteFile', 'Import/reqDeleteFile', 'Import', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('68', 'Import/reqDelete', 'Import/reqDelete', 'Import', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('69', 'Import/reqEdit', 'Import/reqEdit', 'Import', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('70', 'Import/isAuthorized', 'Import/isAuthorized', 'Import', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('71', 'Notifications/add', 'Notifications/add', 'Notifications', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('72', 'Notifications/edit', 'Notifications/edit', 'Notifications', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('73', 'Notifications/index', 'Notifications/index', 'Notifications', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('74', 'Notifications/reqEdit', 'Notifications/reqEdit', 'Notifications', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('75', 'Notifications/reqUpload', 'Notifications/reqUpload', 'Notifications', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('76', 'Notifications/reqDeleteFile', 'Notifications/reqDeleteFile', 'Notifications', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('77', 'Notifications/reqDelete', 'Notifications/reqDelete', 'Notifications', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('78', 'Notifications/isAuthorized', 'Notifications/isAuthorized', 'Notifications', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('79', 'OrderBundleServices/resError', 'OrderBundleServices/resError', 'OrderBundleServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('80', 'OrderBundleServices/resFail', 'OrderBundleServices/resFail', 'OrderBundleServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('81', 'OrderBundleServices/resSuccess', 'OrderBundleServices/resSuccess', 'OrderBundleServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('82', 'OrderServices/create', 'OrderServices/create', 'OrderServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('83', 'OrderServices/resError', 'OrderServices/resError', 'OrderServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('84', 'OrderServices/resFail', 'OrderServices/resFail', 'OrderServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('85', 'OrderServices/resSuccess', 'OrderServices/resSuccess', 'OrderServices', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('86', 'OrdersBundles/index', 'OrdersBundles/index', 'OrdersBundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('87', 'OrdersBundles/edit', 'OrdersBundles/edit', 'OrdersBundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('88', 'OrdersBundles/reqUpload', 'OrdersBundles/reqUpload', 'OrdersBundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('89', 'OrdersBundles/reqDeleteFile', 'OrdersBundles/reqDeleteFile', 'OrdersBundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('90', 'OrdersBundles/reqDelete', 'OrdersBundles/reqDelete', 'OrdersBundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('91', 'OrdersBundles/reqEdit', 'OrdersBundles/reqEdit', 'OrdersBundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('92', 'OrdersBundles/isAuthorized', 'OrdersBundles/isAuthorized', 'OrdersBundles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('93', 'Perms/refresh', 'Perms/refresh', 'Perms', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('94', 'Perms/add', 'Perms/add', 'Perms', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('95', 'Perms/edit', 'Perms/edit', 'Perms', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('96', 'Perms/index', 'Perms/index', 'Perms', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('97', 'Perms/reqUpload', 'Perms/reqUpload', 'Perms', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('98', 'Perms/reqDeleteFile', 'Perms/reqDeleteFile', 'Perms', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('99', 'Perms/reqDelete', 'Perms/reqDelete', 'Perms', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('100', 'Perms/reqEdit', 'Perms/reqEdit', 'Perms', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('101', 'Perms/isAuthorized', 'Perms/isAuthorized', 'Perms', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('102', 'Products/add', 'Products/add', 'Products', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('103', 'Products/edit', 'Products/edit', 'Products', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('104', 'Products/index', 'Products/index', 'Products', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('105', 'Products/reqUpload', 'Products/reqUpload', 'Products', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('106', 'Products/reqDeleteFile', 'Products/reqDeleteFile', 'Products', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('107', 'Products/reqDelete', 'Products/reqDelete', 'Products', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('108', 'Products/reqEdit', 'Products/reqEdit', 'Products', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('109', 'Products/isAuthorized', 'Products/isAuthorized', 'Products', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('110', 'Regions/add', 'Regions/add', 'Regions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('111', 'Regions/edit', 'Regions/edit', 'Regions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('112', 'Regions/index', 'Regions/index', 'Regions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('113', 'Regions/recover', 'Regions/recover', 'Regions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('114', 'Regions/reorder', 'Regions/reorder', 'Regions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('115', 'Regions/reqUpload', 'Regions/reqUpload', 'Regions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('116', 'Regions/reqDeleteFile', 'Regions/reqDeleteFile', 'Regions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('117', 'Regions/reqDelete', 'Regions/reqDelete', 'Regions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('118', 'Regions/reqEdit', 'Regions/reqEdit', 'Regions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('119', 'Regions/isAuthorized', 'Regions/isAuthorized', 'Regions', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('120', 'Roles/index', 'Roles/index', 'Roles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('121', 'Roles/add', 'Roles/add', 'Roles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('122', 'Roles/edit', 'Roles/edit', 'Roles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('123', 'Roles/reqUpload', 'Roles/reqUpload', 'Roles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('124', 'Roles/reqDeleteFile', 'Roles/reqDeleteFile', 'Roles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('125', 'Roles/reqDelete', 'Roles/reqDelete', 'Roles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('126', 'Roles/reqEdit', 'Roles/reqEdit', 'Roles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('127', 'Roles/isAuthorized', 'Roles/isAuthorized', 'Roles', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('128', 'ServiceApp/resError', 'ServiceApp/resError', 'ServiceApp', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('129', 'ServiceApp/resFail', 'ServiceApp/resFail', 'ServiceApp', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('130', 'ServiceApp/resSuccess', 'ServiceApp/resSuccess', 'ServiceApp', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('131', 'Settings/index', 'Settings/index', 'Settings', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('132', 'Settings/reqEdit', 'Settings/reqEdit', 'Settings', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('133', 'Settings/reqUpload', 'Settings/reqUpload', 'Settings', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('134', 'Settings/reqDeleteFile', 'Settings/reqDeleteFile', 'Settings', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('135', 'Settings/reqDelete', 'Settings/reqDelete', 'Settings', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('136', 'Settings/isAuthorized', 'Settings/isAuthorized', 'Settings', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('137', 'Tests/regionCache', 'Tests/regionCache', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('138', 'Tests/categoryCache', 'Tests/categoryCache', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('139', 'Tests/categoryProduct', 'Tests/categoryProduct', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('140', 'Tests/syncRegionNotificationGroup', 'Tests/syncRegionNotificationGroup', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('141', 'Tests/notificationCache', 'Tests/notificationCache', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('142', 'Tests/orderCache', 'Tests/orderCache', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('143', 'Tests/ordersBundleCache', 'Tests/ordersBundleCache', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('144', 'Tests/customerCache', 'Tests/customerCache', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('145', 'Tests/makeOrderJson', 'Tests/makeOrderJson', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('146', 'Tests/reqUpload', 'Tests/reqUpload', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('147', 'Tests/reqDeleteFile', 'Tests/reqDeleteFile', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('148', 'Tests/reqDelete', 'Tests/reqDelete', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('149', 'Tests/reqEdit', 'Tests/reqEdit', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('150', 'Tests/isAuthorized', 'Tests/isAuthorized', 'Tests', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('151', 'Users/index', 'Users/index', 'Users', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('152', 'Users/add', 'Users/add', 'Users', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('153', 'Users/edit', 'Users/edit', 'Users', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('154', 'Users/resetPassword', 'Users/resetPassword', 'Users', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('155', 'Users/login', 'Users/login', 'Users', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('156', 'Users/logout', 'Users/logout', 'Users', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('157', 'Users/reqUpload', 'Users/reqUpload', 'Users', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('158', 'Users/reqDeleteFile', 'Users/reqDeleteFile', 'Users', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('159', 'Users/reqDelete', 'Users/reqDelete', 'Users', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('160', 'Users/reqEdit', 'Users/reqEdit', 'Users', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('161', 'Users/isAuthorized', 'Users/isAuthorized', 'Users', null, '2', null, null, '2016-03-06 18:15:28', '2016-03-06 18:15:28');
INSERT INTO `perms` VALUES ('162', 'Feedbacks/index', 'Feedbacks/index', 'Feedbacks', null, '2', null, null, '2016-03-13 11:49:10', '2016-03-13 11:49:10');
INSERT INTO `perms` VALUES ('163', 'Feedbacks/reqUpload', 'Feedbacks/reqUpload', 'Feedbacks', null, '2', null, null, '2016-03-13 11:49:10', '2016-03-13 11:49:10');
INSERT INTO `perms` VALUES ('164', 'Feedbacks/reqDeleteFile', 'Feedbacks/reqDeleteFile', 'Feedbacks', null, '2', null, null, '2016-03-13 11:49:10', '2016-03-13 11:49:10');
INSERT INTO `perms` VALUES ('165', 'Feedbacks/reqDelete', 'Feedbacks/reqDelete', 'Feedbacks', null, '2', null, null, '2016-03-13 11:49:10', '2016-03-13 11:49:10');
INSERT INTO `perms` VALUES ('166', 'Feedbacks/reqEdit', 'Feedbacks/reqEdit', 'Feedbacks', null, '2', null, null, '2016-03-13 11:49:10', '2016-03-13 11:49:10');
INSERT INTO `perms` VALUES ('167', 'Feedbacks/isAuthorized', 'Feedbacks/isAuthorized', 'Feedbacks', null, '2', null, null, '2016-03-13 11:49:10', '2016-03-13 11:49:10');
INSERT INTO `perms` VALUES ('168', 'Notifications/indexView', 'Notifications/indexView', 'Notifications', null, '2', null, null, '2016-03-13 11:49:10', '2016-03-13 11:49:10');
INSERT INTO `perms` VALUES ('169', 'Products/indexView', 'Products/indexView', 'Products', null, '2', null, null, '2016-03-13 11:49:10', '2016-03-13 11:49:10');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `bundle_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `contact` text,
  `description` text,
  `logo_uri` varchar(2000) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------

-- ----------------------------
-- Table structure for products_categories
-- ----------------------------
DROP TABLE IF EXISTS `products_categories`;
CREATE TABLE `products_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products_categories
-- ----------------------------
INSERT INTO `products_categories` VALUES ('29', '10', '2', '2015-10-17 17:27:51', '2015-10-17 17:27:51');
INSERT INTO `products_categories` VALUES ('31', '8', '1', '2015-10-17 17:30:39', '2015-10-17 17:30:39');
INSERT INTO `products_categories` VALUES ('32', '7', '1', '2015-10-17 17:33:54', '2015-10-17 17:33:54');
INSERT INTO `products_categories` VALUES ('33', '6', '1', '2015-10-17 17:34:49', '2015-10-17 17:34:49');
INSERT INTO `products_categories` VALUES ('34', '5', '1', '2015-10-17 17:35:50', '2015-10-17 17:35:50');
INSERT INTO `products_categories` VALUES ('35', '4', '1', '2015-10-17 17:37:21', '2015-10-17 17:37:21');
INSERT INTO `products_categories` VALUES ('40', '9', '4', '2016-03-08 16:01:28', '2016-03-08 16:01:28');
INSERT INTO `products_categories` VALUES ('46', '12', '4', '2016-03-10 01:14:08', '2016-03-10 01:14:08');
INSERT INTO `products_categories` VALUES ('50', '13', '2', '2016-03-11 16:09:16', '2016-03-11 16:09:16');
INSERT INTO `products_categories` VALUES ('57', '18', '2', '2016-03-13 11:12:21', '2016-03-13 11:12:21');
INSERT INTO `products_categories` VALUES ('58', '17', '5', '2016-03-13 13:34:08', '2016-03-13 13:34:08');
INSERT INTO `products_categories` VALUES ('59', '15', '4', '2016-03-13 15:53:13', '2016-03-13 15:53:13');
INSERT INTO `products_categories` VALUES ('60', '16', '2', '2016-03-13 15:54:02', '2016-03-13 15:54:02');
INSERT INTO `products_categories` VALUES ('61', '19', '4', '2016-03-13 22:34:13', '2016-03-13 22:34:13');
INSERT INTO `products_categories` VALUES ('62', '20', '4', '2016-03-13 22:37:47', '2016-03-13 22:37:47');
INSERT INTO `products_categories` VALUES ('63', '21', '4', '2016-03-13 22:39:26', '2016-03-13 22:39:26');
INSERT INTO `products_categories` VALUES ('64', '22', '1', '2016-03-13 22:43:31', '2016-03-13 22:43:31');
INSERT INTO `products_categories` VALUES ('65', '23', '6', '2016-03-15 08:26:30', '2016-03-15 08:26:30');
INSERT INTO `products_categories` VALUES ('66', '24', '6', '2016-03-15 11:48:43', '2016-03-15 11:48:43');

-- ----------------------------
-- Table structure for regions
-- ----------------------------
DROP TABLE IF EXISTS `regions`;
CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` text,
  `weight` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '2',
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=772 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of regions
-- ----------------------------
INSERT INTO `regions` VALUES ('1', null, 'Hồ Chí Minh', 'SG', null, '0', '2', '1', '50', null, '2016-03-23 00:53:55', '2016-03-23 00:53:55');
INSERT INTO `regions` VALUES ('2', '1', 'Bình Chánh', null, null, '0', '2', '2', '3', null, '2016-03-23 00:53:55', '2016-03-23 00:53:55');
INSERT INTO `regions` VALUES ('3', '1', 'Bình Tân', null, null, '1', '2', '4', '5', null, '2016-03-23 00:53:55', '2016-03-23 00:53:55');
INSERT INTO `regions` VALUES ('4', '1', 'Bình Thạnh', null, null, '2', '2', '6', '7', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('5', '1', 'Cần Giờ', null, null, '3', '2', '8', '9', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('6', '1', 'Củ Chi', null, null, '4', '2', '10', '11', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('7', '1', 'Gò Vấp', null, null, '5', '2', '12', '13', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('8', '1', 'Hóc Môn', null, null, '6', '2', '14', '15', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('9', '1', 'Nhà Bè', null, null, '7', '2', '16', '17', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('10', '1', 'Phú Nhuận', null, null, '8', '2', '18', '19', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('11', '1', 'Quận 1', null, null, '9', '2', '20', '21', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('12', '1', 'Quận 10', null, null, '10', '2', '22', '23', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('13', '1', 'Quận 11', null, null, '11', '2', '24', '25', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('14', '1', 'Quận 12', null, null, '12', '2', '26', '27', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('15', '1', 'Quận 2', null, null, '13', '2', '28', '29', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('16', '1', 'Quận 3', null, null, '14', '2', '30', '31', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('17', '1', 'Quận 4', null, null, '15', '2', '32', '33', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('18', '1', 'Quận 5', null, null, '16', '2', '34', '35', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('19', '1', 'Quận 6', null, null, '17', '2', '36', '37', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('20', '1', 'Quận 7', null, null, '18', '2', '38', '39', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('21', '1', 'Quận 8', null, null, '19', '2', '40', '41', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('22', '1', 'Quận 9', null, null, '20', '2', '42', '43', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('23', '1', 'Tân Bình', null, null, '21', '2', '44', '45', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('24', '1', 'Tân Phú', null, null, '22', '2', '46', '47', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('25', '1', 'Thủ Đức', null, null, '23', '2', '48', '49', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('26', null, 'Hà Nội', 'HN', null, '1', '2', '51', '112', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('27', '26', 'Hoàn Kiếm', null, null, '0', '2', '52', '53', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('28', '26', 'Ba Đình', null, null, '1', '2', '54', '55', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('29', '26', 'Đống Đa', null, null, '2', '2', '56', '57', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('30', '26', 'Hai Bà Trưng', null, null, '3', '2', '58', '59', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('31', '26', 'Thanh Xuân', null, null, '4', '2', '60', '61', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('32', '26', 'Tây Hồ', null, null, '5', '2', '62', '63', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('33', '26', 'Cầu Giấy', null, null, '6', '2', '64', '65', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('34', '26', 'Hoàng Mai', null, null, '7', '2', '66', '67', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('35', '26', 'Long Biên', null, null, '8', '2', '68', '69', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('36', '26', 'Đông Anh', null, null, '9', '2', '70', '71', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('37', '26', 'Gia Lâm', null, null, '10', '2', '72', '73', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('38', '26', 'Sóc Sơn', null, null, '11', '2', '74', '75', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('39', '26', 'Thanh Trì', null, null, '12', '2', '76', '77', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('40', '26', 'Nam Từ Liêm', null, null, '13', '2', '78', '79', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('41', '26', 'Bắc Từ Liêm', null, null, '14', '2', '80', '81', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('42', '26', 'Hà Đông', null, null, '15', '2', '82', '83', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('43', '26', 'Sơn Tây', null, null, '16', '2', '84', '85', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('44', '26', 'Mê Linh', null, null, '17', '2', '86', '87', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('45', '26', 'Ba Vì', null, null, '18', '2', '88', '89', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('46', '26', 'Phúc Thọ', null, null, '19', '2', '90', '91', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('47', '26', 'Đan Phượng', null, null, '20', '2', '92', '93', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('48', '26', 'Hoài Đức', null, null, '21', '2', '94', '95', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('49', '26', 'Quốc Oai', null, null, '22', '2', '96', '97', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('50', '26', 'Thạch Thất', null, null, '23', '2', '98', '99', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('51', '26', 'Chương Mỹ', null, null, '24', '2', '100', '101', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('52', '26', 'Thanh Oai', null, null, '25', '2', '102', '103', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('53', '26', 'Thường Tín', null, null, '26', '2', '104', '105', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('54', '26', 'Phú Xuyên', null, null, '27', '2', '106', '107', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('55', '26', 'Ứng Hòa', null, null, '28', '2', '108', '109', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('56', '26', 'Mỹ Đức', null, null, '29', '2', '110', '111', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('57', null, 'Bình Dương', 'BD', null, '2', '2', '113', '130', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('58', '57', 'Bến Cát', null, null, '0', '2', '114', '115', null, '2016-03-23 00:53:56', '2016-03-23 00:53:56');
INSERT INTO `regions` VALUES ('59', '57', 'Dầu Tiếng', null, null, '1', '2', '116', '117', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('60', '57', 'Dĩ An', null, null, '2', '2', '118', '119', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('61', '57', 'Phú Giáo', null, null, '3', '2', '120', '121', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('62', '57', 'Tân Uyên', null, null, '4', '2', '122', '123', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('63', '57', 'Thuận An', null, null, '5', '2', '124', '125', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('64', '57', 'Thủ Dầu Một', null, null, '6', '2', '126', '127', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('65', '57', 'Bàu Bàng', null, null, '7', '2', '128', '129', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('66', null, 'Đà Nẵng', 'DDN', null, '3', '2', '131', '148', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('67', '66', 'Cẩm Lệ', null, null, '0', '2', '132', '133', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('68', '66', 'Hải Châu', null, null, '1', '2', '134', '135', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('69', '66', 'Liên Chiểu', null, null, '2', '2', '136', '137', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('70', '66', 'Ngũ Hành Sơn', null, null, '3', '2', '138', '139', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('71', '66', 'Sơn Trà', null, null, '4', '2', '140', '141', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('72', '66', 'Thanh Khê', null, null, '5', '2', '142', '143', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('73', '66', 'Hòa Vang', null, null, '6', '2', '144', '145', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('74', '66', 'Hoàng Sa', null, null, '7', '2', '146', '147', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('75', null, 'Hải Phòng', 'HP', null, '4', '2', '149', '180', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('76', '75', 'An Dương', null, null, '0', '2', '150', '151', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('77', '75', 'An Lão', null, null, '1', '2', '152', '153', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('78', '75', 'Bạch Long Vĩ', null, null, '2', '2', '154', '155', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('79', '75', 'Cát Hải', null, null, '3', '2', '156', '157', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('80', '75', 'Đồ Sơn', null, null, '4', '2', '158', '159', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('81', '75', 'Dương Kinh', null, null, '5', '2', '160', '161', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('82', '75', 'Hải An', null, null, '6', '2', '162', '163', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('83', '75', 'Hồng Bàng', null, null, '7', '2', '164', '165', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('84', '75', 'Kiến An', null, null, '8', '2', '166', '167', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('85', '75', 'Kiến Thụy', null, null, '9', '2', '168', '169', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('86', '75', 'Lê Chân', null, null, '10', '2', '170', '171', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('87', '75', 'Ngô Quyền', null, null, '11', '2', '172', '173', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('88', '75', 'Thủy Nguyên', null, null, '12', '2', '174', '175', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('89', '75', 'Tiên Lãng', null, null, '13', '2', '176', '177', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('90', '75', 'Vĩnh Bảo', null, null, '14', '2', '178', '179', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('91', null, 'Long An', 'LA', null, '5', '2', '181', '212', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('92', '91', 'Bến Lức', null, null, '0', '2', '182', '183', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('93', '91', 'Cần Đước', null, null, '1', '2', '184', '185', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('94', '91', 'Cần Giuộc', null, null, '2', '2', '186', '187', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('95', '91', 'Châu Thành', null, null, '3', '2', '188', '189', null, '2016-03-23 00:53:57', '2016-03-23 00:53:57');
INSERT INTO `regions` VALUES ('96', '91', 'Đức Hòa', null, null, '4', '2', '190', '191', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('97', '91', 'Đức Huệ', null, null, '5', '2', '192', '193', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('98', '91', 'Kiến Tường', null, null, '6', '2', '194', '195', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('99', '91', 'Mộc Hóa', null, null, '7', '2', '196', '197', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('100', '91', 'Tân An', null, null, '8', '2', '198', '199', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('101', '91', 'Tân Hưng', null, null, '9', '2', '200', '201', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('102', '91', 'Tân Thạnh', null, null, '10', '2', '202', '203', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('103', '91', 'Tân Trụ', null, null, '11', '2', '204', '205', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('104', '91', 'Thạnh Hóa', null, null, '12', '2', '206', '207', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('105', '91', 'Thủ Thừa', null, null, '13', '2', '208', '209', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('106', '91', 'Vĩnh Hưng', null, null, '14', '2', '210', '211', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('107', null, 'Bà Rịa Vũng Tàu', 'VT', null, '6', '2', '213', '230', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('108', '107', 'Bà Rịa', null, null, '0', '2', '214', '215', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('109', '107', 'Châu Đức', null, null, '1', '2', '216', '217', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('110', '107', 'Côn Đảo', null, null, '2', '2', '218', '219', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('111', '107', 'Đất Đỏ', null, null, '3', '2', '220', '221', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('112', '107', 'Long Điền', null, null, '4', '2', '222', '223', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('113', '107', 'Tân Thành', null, null, '5', '2', '224', '225', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('114', '107', 'Vũng Tàu', null, null, '6', '2', '226', '227', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('115', '107', 'Xuyên Mộc', null, null, '7', '2', '228', '229', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('116', null, 'An Giang', 'AG', null, '7', '2', '231', '254', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('117', '116', 'An Phú', null, null, '0', '2', '232', '233', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('118', '116', 'Châu Đốc', null, null, '1', '2', '234', '235', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('119', '116', 'Châu Phú', null, null, '2', '2', '236', '237', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('120', '116', 'Châu Thành', null, null, '3', '2', '238', '239', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('121', '116', 'Chợ Mới', null, null, '4', '2', '240', '241', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('122', '116', 'Long Xuyên', null, null, '5', '2', '242', '243', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('123', '116', 'Phú Tân', null, null, '6', '2', '244', '245', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('124', '116', 'Tân Châu', null, null, '7', '2', '246', '247', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('125', '116', 'Thoại Sơn', null, null, '8', '2', '248', '249', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('126', '116', 'Tịnh Biên', null, null, '9', '2', '250', '251', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('127', '116', 'Tri Tôn', null, null, '10', '2', '252', '253', null, '2016-03-23 00:53:58', '2016-03-23 00:53:58');
INSERT INTO `regions` VALUES ('128', null, 'Bắc Giang', 'BG', null, '8', '2', '255', '276', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('129', '128', 'Bắc Giang', null, null, '0', '2', '256', '257', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('130', '128', 'Hiệp Hòa', null, null, '1', '2', '258', '259', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('131', '128', 'Lạng Giang', null, null, '2', '2', '260', '261', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('132', '128', 'Lục Nam', null, null, '3', '2', '262', '263', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('133', '128', 'Lục Ngạn', null, null, '4', '2', '264', '265', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('134', '128', 'Sơn Động', null, null, '5', '2', '266', '267', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('135', '128', 'Tân Yên', null, null, '6', '2', '268', '269', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('136', '128', 'Việt Yên', null, null, '7', '2', '270', '271', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('137', '128', 'Yên Dũng', null, null, '8', '2', '272', '273', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('138', '128', 'Yên Thế', null, null, '9', '2', '274', '275', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('139', null, 'Bắc Kạn', 'BK', null, '9', '2', '277', '294', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('140', '139', 'Ba Bể', null, null, '0', '2', '278', '279', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('141', '139', 'Bắc Kạn', null, null, '1', '2', '280', '281', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('142', '139', 'Bạch Thông', null, null, '2', '2', '282', '283', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('143', '139', 'Chợ Đồn', null, null, '3', '2', '284', '285', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('144', '139', 'Chợ Mới', null, null, '4', '2', '286', '287', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('145', '139', 'Na Rì', null, null, '5', '2', '288', '289', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('146', '139', 'Ngân Sơn', null, null, '6', '2', '290', '291', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('147', '139', 'Pác Nặm', null, null, '7', '2', '292', '293', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('148', null, 'Bạc Liêu', 'BL', null, '10', '2', '295', '310', null, '2016-03-23 00:53:59', '2016-03-23 00:53:59');
INSERT INTO `regions` VALUES ('149', '148', 'Bạc Liêu', null, null, '0', '2', '296', '297', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('150', '148', 'Đông Hải', null, null, '1', '2', '298', '299', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('151', '148', 'Giá Rai', null, null, '2', '2', '300', '301', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('152', '148', 'Hòa Bình', null, null, '3', '2', '302', '303', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('153', '148', 'Hồng Dân', null, null, '4', '2', '304', '305', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('154', '148', 'Phước Long', null, null, '5', '2', '306', '307', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('155', '148', 'Vĩnh Lợi', null, null, '6', '2', '308', '309', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('156', null, 'Bắc Ninh', 'BN', null, '11', '2', '311', '328', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('157', '156', 'Bắc Ninh', null, null, '0', '2', '312', '313', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('158', '156', 'Gia Bình', null, null, '1', '2', '314', '315', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('159', '156', 'Lương Tài', null, null, '2', '2', '316', '317', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('160', '156', 'Quế Võ', null, null, '3', '2', '318', '319', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('161', '156', 'Thuận Thành', null, null, '4', '2', '320', '321', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('162', '156', 'Tiên Du', null, null, '5', '2', '322', '323', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('163', '156', 'Từ Sơn', null, null, '6', '2', '324', '325', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('164', '156', 'Yên Phong', null, null, '7', '2', '326', '327', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('165', null, 'Bến Tre', 'BTR', null, '12', '2', '329', '348', null, '2016-03-23 00:54:00', '2016-03-23 00:54:00');
INSERT INTO `regions` VALUES ('166', '165', 'Ba Tri', null, null, '0', '2', '330', '331', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('167', '165', 'Bến Tre', null, null, '1', '2', '332', '333', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('168', '165', 'Bình Đại', null, null, '2', '2', '334', '335', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('169', '165', 'Châu Thành', null, null, '3', '2', '336', '337', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('170', '165', 'Chợ Lách', null, null, '4', '2', '338', '339', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('171', '165', 'Giồng Trôm', null, null, '5', '2', '340', '341', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('172', '165', 'Mỏ Cày Bắc', null, null, '6', '2', '342', '343', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('173', '165', 'Mỏ Cày Nam', null, null, '7', '2', '344', '345', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('174', '165', 'Thạnh Phú', null, null, '8', '2', '346', '347', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('175', null, 'Bình Định', 'BDD', null, '13', '2', '349', '372', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('176', '175', 'An Lão', null, null, '0', '2', '350', '351', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('177', '175', 'An Nhơn', null, null, '1', '2', '352', '353', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('178', '175', 'Hoài Ân', null, null, '2', '2', '354', '355', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('179', '175', 'Hoài Nhơn', null, null, '3', '2', '356', '357', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('180', '175', 'Phù Cát', null, null, '4', '2', '358', '359', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('181', '175', 'Phù Mỹ', null, null, '5', '2', '360', '361', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('182', '175', 'Quy Nhơn', null, null, '6', '2', '362', '363', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('183', '175', 'Tây Sơn', null, null, '7', '2', '364', '365', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('184', '175', 'Tuy Phước', null, null, '8', '2', '366', '367', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('185', '175', 'Vân Canh', null, null, '9', '2', '368', '369', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('186', '175', 'Vĩnh Thạnh', null, null, '10', '2', '370', '371', null, '2016-03-23 00:54:01', '2016-03-23 00:54:01');
INSERT INTO `regions` VALUES ('187', null, 'Bình Phước', 'BP', null, '14', '2', '373', '396', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('188', '187', 'Bình Long', null, null, '0', '2', '374', '375', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('189', '187', 'Bù Đăng', null, null, '1', '2', '376', '377', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('190', '187', 'Bù Đốp', null, null, '2', '2', '378', '379', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('191', '187', 'Bù Gia Mập', null, null, '3', '2', '380', '381', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('192', '187', 'Chơn Thành', null, null, '4', '2', '382', '383', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('193', '187', 'Đồng Phú', null, null, '5', '2', '384', '385', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('194', '187', 'Đồng Xoài', null, null, '6', '2', '386', '387', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('195', '187', 'Hớn Quản', null, null, '7', '2', '388', '389', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('196', '187', 'Lộc Ninh', null, null, '8', '2', '390', '391', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('197', '187', 'Phú Riềng', null, null, '9', '2', '392', '393', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('198', '187', 'Phước Long', null, null, '10', '2', '394', '395', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('199', null, 'Bình Thuận  ', 'BTH', null, '15', '2', '397', '418', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('200', '199', 'Bắc Bình', null, null, '0', '2', '398', '399', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('201', '199', 'Đảo Phú Quý', null, null, '1', '2', '400', '401', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('202', '199', 'Đức Linh', null, null, '2', '2', '402', '403', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('203', '199', 'Hàm Tân', null, null, '3', '2', '404', '405', null, '2016-03-23 00:54:02', '2016-03-23 00:54:02');
INSERT INTO `regions` VALUES ('204', '199', 'Hàm Thuận Bắc', null, null, '4', '2', '406', '407', null, '2016-03-23 00:54:03', '2016-03-23 00:54:03');
INSERT INTO `regions` VALUES ('205', '199', 'Hàm Thuận Nam', null, null, '5', '2', '408', '409', null, '2016-03-23 00:54:03', '2016-03-23 00:54:03');
INSERT INTO `regions` VALUES ('206', '199', 'La Gi', null, null, '6', '2', '410', '411', null, '2016-03-23 00:54:03', '2016-03-23 00:54:03');
INSERT INTO `regions` VALUES ('207', '199', 'Phan Thiết', null, null, '7', '2', '412', '413', null, '2016-03-23 00:54:03', '2016-03-23 00:54:03');
INSERT INTO `regions` VALUES ('208', '199', 'Tánh Linh', null, null, '8', '2', '414', '415', null, '2016-03-23 00:54:03', '2016-03-23 00:54:03');
INSERT INTO `regions` VALUES ('209', '199', 'Tuy Phong', null, null, '9', '2', '416', '417', null, '2016-03-23 00:54:03', '2016-03-23 00:54:03');
INSERT INTO `regions` VALUES ('210', null, 'Cà Mau', 'CM', null, '16', '2', '419', '438', null, '2016-03-23 00:54:03', '2016-03-23 00:54:03');
INSERT INTO `regions` VALUES ('211', '210', 'Cà Mau', null, null, '0', '2', '420', '421', null, '2016-03-23 00:54:03', '2016-03-23 00:54:03');
INSERT INTO `regions` VALUES ('212', '210', 'Cái Nước', null, null, '1', '2', '422', '423', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('213', '210', 'Đầm Dơi', null, null, '2', '2', '424', '425', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('214', '210', 'Năm Căn', null, null, '3', '2', '426', '427', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('215', '210', 'Ngọc Hiển', null, null, '4', '2', '428', '429', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('216', '210', 'Phú Tân', null, null, '5', '2', '430', '431', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('217', '210', 'Thới Bình', null, null, '6', '2', '432', '433', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('218', '210', 'Trần Văn Thời', null, null, '7', '2', '434', '435', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('219', '210', 'U Minh', null, null, '8', '2', '436', '437', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('220', null, 'Cần Thơ', 'CT', null, '17', '2', '439', '458', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('221', '220', ' Thới Lai', null, null, '0', '2', '440', '441', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('222', '220', 'Bình Thủy', null, null, '1', '2', '442', '443', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('223', '220', 'Cái Răng', null, null, '2', '2', '444', '445', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('224', '220', 'Cờ Đỏ', null, null, '3', '2', '446', '447', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('225', '220', 'Ninh Kiều', null, null, '4', '2', '448', '449', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('226', '220', 'Ô Môn', null, null, '5', '2', '450', '451', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('227', '220', 'Phong Điền', null, null, '6', '2', '452', '453', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('228', '220', 'Thốt Nốt', null, null, '7', '2', '454', '455', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('229', '220', 'Vĩnh Thạnh', null, null, '8', '2', '456', '457', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('230', null, 'Cao Bằng', 'CB', null, '18', '2', '459', '486', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('231', '230', 'Bảo Lạc', null, null, '0', '2', '460', '461', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('232', '230', 'Bảo Lâm', null, null, '1', '2', '462', '463', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('233', '230', 'Cao Bằng', null, null, '2', '2', '464', '465', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('234', '230', 'Hạ Lang', null, null, '3', '2', '466', '467', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('235', '230', 'Hà Quảng', null, null, '4', '2', '468', '469', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('236', '230', 'Hòa An', null, null, '5', '2', '470', '471', null, '2016-03-23 00:54:04', '2016-03-23 00:54:04');
INSERT INTO `regions` VALUES ('237', '230', 'Nguyên Bình', null, null, '6', '2', '472', '473', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('238', '230', 'Phục Hòa', null, null, '7', '2', '474', '475', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('239', '230', 'Quảng Uyên', null, null, '8', '2', '476', '477', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('240', '230', 'Thạch An', null, null, '9', '2', '478', '479', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('241', '230', 'Thông Nông', null, null, '10', '2', '480', '481', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('242', '230', 'Trà Lĩnh', null, null, '11', '2', '482', '483', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('243', '230', 'Trùng Khánh', null, null, '12', '2', '484', '485', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('244', null, 'Đắk Lắk', 'DDL', null, '19', '2', '487', '518', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('245', '244', 'Buôn Đôn', null, null, '0', '2', '488', '489', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('246', '244', 'Buôn Hồ', null, null, '1', '2', '490', '491', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('247', '244', 'Buôn Ma Thuột', null, null, '2', '2', '492', '493', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('248', '244', 'Cư Kuin', null, null, '3', '2', '494', '495', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('249', '244', 'Cư M\'gar', null, null, '4', '2', '496', '497', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('250', '244', 'Ea H\'Leo', null, null, '5', '2', '498', '499', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('251', '244', 'Ea Kar', null, null, '6', '2', '500', '501', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('252', '244', 'Ea Súp', null, null, '7', '2', '502', '503', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('253', '244', 'Krông Ana', null, null, '8', '2', '504', '505', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('254', '244', 'Krông Bông', null, null, '9', '2', '506', '507', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('255', '244', 'Krông Buk', null, null, '10', '2', '508', '509', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('256', '244', 'Krông Năng', null, null, '11', '2', '510', '511', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('257', '244', 'Krông Pắc', null, null, '12', '2', '512', '513', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('258', '244', 'Lăk', null, null, '13', '2', '514', '515', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('259', '244', 'M\'Đrăk', null, null, '14', '2', '516', '517', null, '2016-03-23 00:54:05', '2016-03-23 00:54:05');
INSERT INTO `regions` VALUES ('260', null, 'Đắk Nông', 'DNO', null, '20', '2', '519', '536', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('261', '260', 'Cư Jút', null, null, '0', '2', '520', '521', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('262', '260', 'Dăk GLong', null, null, '1', '2', '522', '523', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('263', '260', 'Dăk Mil', null, null, '2', '2', '524', '525', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('264', '260', 'Dăk R\'Lấp', null, null, '3', '2', '526', '527', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('265', '260', 'Dăk Song', null, null, '4', '2', '528', '529', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('266', '260', 'Gia Nghĩa', null, null, '5', '2', '530', '531', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('267', '260', 'Krông Nô', null, null, '6', '2', '532', '533', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('268', '260', 'Tuy Đức', null, null, '7', '2', '534', '535', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('269', null, 'Điện Biên', 'DDB', null, '21', '2', '537', '558', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('270', '269', 'Điện Biên', null, null, '0', '2', '538', '539', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('271', '269', 'Điện Biên Đông', null, null, '1', '2', '540', '541', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('272', '269', 'Điện Biên Phủ', null, null, '2', '2', '542', '543', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('273', '269', 'Mường Ảng', null, null, '3', '2', '544', '545', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('274', '269', 'Mường Chà', null, null, '4', '2', '546', '547', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('275', '269', 'Mường Lay', null, null, '5', '2', '548', '549', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('276', '269', 'Mường Nhé', null, null, '6', '2', '550', '551', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('277', '269', 'Nậm Pồ', null, null, '7', '2', '552', '553', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('278', '269', 'Tủa Chùa', null, null, '8', '2', '554', '555', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('279', '269', 'Tuần Giáo', null, null, '9', '2', '556', '557', null, '2016-03-23 00:54:06', '2016-03-23 00:54:06');
INSERT INTO `regions` VALUES ('280', null, 'Đồng Nai', 'DNA', null, '22', '2', '559', '582', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('281', '280', 'Biên Hòa', null, null, '0', '2', '560', '561', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('282', '280', 'Cẩm Mỹ', null, null, '1', '2', '562', '563', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('283', '280', 'Định Quán', null, null, '2', '2', '564', '565', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('284', '280', 'Long Khánh', null, null, '3', '2', '566', '567', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('285', '280', 'Long Thành', null, null, '4', '2', '568', '569', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('286', '280', 'Nhơn Trạch', null, null, '5', '2', '570', '571', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('287', '280', 'Tân Phú', null, null, '6', '2', '572', '573', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('288', '280', 'Thống Nhất', null, null, '7', '2', '574', '575', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('289', '280', 'Trảng Bom', null, null, '8', '2', '576', '577', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('290', '280', 'Vĩnh Cửu', null, null, '9', '2', '578', '579', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('291', '280', 'Xuân Lộc', null, null, '10', '2', '580', '581', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('292', null, 'Đồng Tháp', 'DDT', null, '23', '2', '583', '608', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('293', '292', 'Châu Thành', null, null, '0', '2', '584', '585', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('294', '292', 'Huyện Cao Lãnh', null, null, '1', '2', '586', '587', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('295', '292', 'Huyện Hồng Ngự', null, null, '2', '2', '588', '589', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('296', '292', 'Lai Vung', null, null, '3', '2', '590', '591', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('297', '292', 'Lấp Vò', null, null, '4', '2', '592', '593', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('298', '292', 'Sa Đéc', null, null, '5', '2', '594', '595', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('299', '292', 'Tam Nông', null, null, '6', '2', '596', '597', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('300', '292', 'Tân Hồng', null, null, '7', '2', '598', '599', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('301', '292', 'Thanh Bình', null, null, '8', '2', '600', '601', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('302', '292', 'Tháp Mười', null, null, '9', '2', '602', '603', null, '2016-03-23 00:54:07', '2016-03-23 00:54:07');
INSERT INTO `regions` VALUES ('303', '292', 'Thị xã Hồng Ngự', null, null, '10', '2', '604', '605', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('304', '292', 'Tp. Cao Lãnh', null, null, '11', '2', '606', '607', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('305', null, 'Gia Lai', 'GL', null, '24', '2', '609', '644', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('306', '305', 'An Khê', null, null, '0', '2', '610', '611', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('307', '305', 'AYun Pa', null, null, '1', '2', '612', '613', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('308', '305', 'Chư Păh', null, null, '2', '2', '614', '615', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('309', '305', 'Chư Pưh', null, null, '3', '2', '616', '617', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('310', '305', 'Chư Sê', null, null, '4', '2', '618', '619', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('311', '305', 'ChưPRông', null, null, '5', '2', '620', '621', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('312', '305', 'Đăk Đoa', null, null, '6', '2', '622', '623', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('313', '305', 'Đăk Pơ', null, null, '7', '2', '624', '625', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('314', '305', 'Đức Cơ', null, null, '8', '2', '626', '627', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('315', '305', 'Ia Grai', null, null, '9', '2', '628', '629', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('316', '305', 'Ia Pa', null, null, '10', '2', '630', '631', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('317', '305', 'KBang', null, null, '11', '2', '632', '633', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('318', '305', 'Kông Chro', null, null, '12', '2', '634', '635', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('319', '305', 'Krông Pa', null, null, '13', '2', '636', '637', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('320', '305', 'Mang Yang', null, null, '14', '2', '638', '639', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('321', '305', 'Phú Thiện', null, null, '15', '2', '640', '641', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('322', '305', 'Plei Ku', null, null, '16', '2', '642', '643', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('323', null, 'Hà Giang', 'HG', null, '25', '2', '645', '668', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('324', '323', 'Bắc Mê', null, null, '0', '2', '646', '647', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('325', '323', 'Bắc Quang', null, null, '1', '2', '648', '649', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('326', '323', 'Đồng Văn', null, null, '2', '2', '650', '651', null, '2016-03-23 00:54:08', '2016-03-23 00:54:08');
INSERT INTO `regions` VALUES ('327', '323', 'Hà Giang', null, null, '3', '2', '652', '653', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('328', '323', 'Hoàng Su Phì', null, null, '4', '2', '654', '655', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('329', '323', 'Mèo Vạc', null, null, '5', '2', '656', '657', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('330', '323', 'Quản Bạ', null, null, '6', '2', '658', '659', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('331', '323', 'Quang Bình', null, null, '7', '2', '660', '661', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('332', '323', 'Vị Xuyên', null, null, '8', '2', '662', '663', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('333', '323', 'Xín Mần', null, null, '9', '2', '664', '665', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('334', '323', 'Yên Minh', null, null, '10', '2', '666', '667', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('335', null, 'Hà Nam', 'HNA', null, '26', '2', '669', '682', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('336', '335', 'Bình Lục', null, null, '0', '2', '670', '671', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('337', '335', 'Duy Tiên', null, null, '1', '2', '672', '673', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('338', '335', 'Kim Bảng', null, null, '2', '2', '674', '675', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('339', '335', 'Lý Nhân', null, null, '3', '2', '676', '677', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('340', '335', 'Phủ Lý', null, null, '4', '2', '678', '679', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('341', '335', 'Thanh Liêm', null, null, '5', '2', '680', '681', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('342', null, 'Hà Tĩnh', 'HT', null, '27', '2', '683', '708', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('343', '342', 'Cẩm Xuyên', null, null, '0', '2', '684', '685', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('344', '342', 'Can Lộc', null, null, '1', '2', '686', '687', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('345', '342', 'Đức Thọ', null, null, '2', '2', '688', '689', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('346', '342', 'Hà Tĩnh', null, null, '3', '2', '690', '691', null, '2016-03-23 00:54:09', '2016-03-23 00:54:09');
INSERT INTO `regions` VALUES ('347', '342', 'Hồng Lĩnh', null, null, '4', '2', '692', '693', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('348', '342', 'Hương Khê', null, null, '5', '2', '694', '695', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('349', '342', 'Hương Sơn', null, null, '6', '2', '696', '697', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('350', '342', 'Kỳ Anh', null, null, '7', '2', '698', '699', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('351', '342', 'Lộc Hà', null, null, '8', '2', '700', '701', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('352', '342', 'Nghi Xuân', null, null, '9', '2', '702', '703', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('353', '342', 'Thạch Hà', null, null, '10', '2', '704', '705', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('354', '342', 'Vũ Quang', null, null, '11', '2', '706', '707', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('355', null, 'Hải Dương', 'HD', null, '28', '2', '709', '734', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('356', '355', 'Bình Giang', null, null, '0', '2', '710', '711', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('357', '355', 'Cẩm Giàng', null, null, '1', '2', '712', '713', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('358', '355', 'Chí Linh', null, null, '2', '2', '714', '715', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('359', '355', 'Gia Lộc', null, null, '3', '2', '716', '717', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('360', '355', 'Hải Dương', null, null, '4', '2', '718', '719', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('361', '355', 'Kim Thành', null, null, '5', '2', '720', '721', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('362', '355', 'Kinh Môn', null, null, '6', '2', '722', '723', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('363', '355', 'Nam Sách', null, null, '7', '2', '724', '725', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('364', '355', 'Ninh Giang', null, null, '8', '2', '726', '727', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('365', '355', 'Thanh Hà', null, null, '9', '2', '728', '729', null, '2016-03-23 00:54:10', '2016-03-23 00:54:10');
INSERT INTO `regions` VALUES ('366', '355', 'Thanh Miện', null, null, '10', '2', '730', '731', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('367', '355', 'Tứ Kỳ', null, null, '11', '2', '732', '733', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('368', null, 'Hậu Giang', 'HGI', null, '29', '2', '735', '750', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('369', '368', 'Châu Thành', null, null, '0', '2', '736', '737', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('370', '368', 'Châu Thành A', null, null, '1', '2', '738', '739', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('371', '368', 'Long Mỹ', null, null, '2', '2', '740', '741', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('372', '368', 'Ngã Bảy', null, null, '3', '2', '742', '743', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('373', '368', 'Phụng Hiệp', null, null, '4', '2', '744', '745', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('374', '368', 'Vị Thanh', null, null, '5', '2', '746', '747', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('375', '368', 'Vị Thủy', null, null, '6', '2', '748', '749', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('376', null, 'Hòa Bình', 'HB', null, '30', '2', '751', '774', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('377', '376', 'Cao Phong', null, null, '0', '2', '752', '753', null, '2016-03-23 00:54:11', '2016-03-23 00:54:11');
INSERT INTO `regions` VALUES ('378', '376', 'Đà Bắc', null, null, '1', '2', '754', '755', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('379', '376', 'Hòa Bình', null, null, '2', '2', '756', '757', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('380', '376', 'Kim Bôi', null, null, '3', '2', '758', '759', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('381', '376', 'Kỳ Sơn', null, null, '4', '2', '760', '761', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('382', '376', 'Lạc Sơn', null, null, '5', '2', '762', '763', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('383', '376', 'Lạc Thủy', null, null, '6', '2', '764', '765', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('384', '376', 'Lương Sơn', null, null, '7', '2', '766', '767', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('385', '376', 'Mai Châu', null, null, '8', '2', '768', '769', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('386', '376', 'Tân Lạc', null, null, '9', '2', '770', '771', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('387', '376', 'Yên Thủy', null, null, '10', '2', '772', '773', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('388', null, 'Hưng Yên', 'HY', null, '31', '2', '775', '796', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('389', '388', 'Ân Thi', null, null, '0', '2', '776', '777', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('390', '388', 'Hưng Yên', null, null, '1', '2', '778', '779', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('391', '388', 'Khoái Châu', null, null, '2', '2', '780', '781', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('392', '388', 'Kim Động', null, null, '3', '2', '782', '783', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('393', '388', 'Mỹ Hào', null, null, '4', '2', '784', '785', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('394', '388', 'Phù Cừ', null, null, '5', '2', '786', '787', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('395', '388', 'Tiên Lữ', null, null, '6', '2', '788', '789', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('396', '388', 'Văn Giang', null, null, '7', '2', '790', '791', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('397', '388', 'Văn Lâm', null, null, '8', '2', '792', '793', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('398', '388', 'Yên Mỹ', null, null, '9', '2', '794', '795', null, '2016-03-23 00:54:12', '2016-03-23 00:54:12');
INSERT INTO `regions` VALUES ('399', null, 'Khánh Hòa', 'KH', null, '32', '2', '797', '816', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('400', '399', 'Cam Lâm', null, null, '0', '2', '798', '799', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('401', '399', 'Cam Ranh', null, null, '1', '2', '800', '801', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('402', '399', 'Diên Khánh', null, null, '2', '2', '802', '803', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('403', '399', 'Khánh Sơn', null, null, '3', '2', '804', '805', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('404', '399', 'Khánh Vĩnh', null, null, '4', '2', '806', '807', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('405', '399', 'Nha Trang', null, null, '5', '2', '808', '809', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('406', '399', 'Ninh Hòa', null, null, '6', '2', '810', '811', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('407', '399', 'Trường Sa', null, null, '7', '2', '812', '813', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('408', '399', 'Vạn Ninh', null, null, '8', '2', '814', '815', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('409', null, 'Kiên Giang', 'KG', null, '33', '2', '817', '848', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('410', '409', 'An Biên', null, null, '0', '2', '818', '819', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('411', '409', 'An Minh', null, null, '1', '2', '820', '821', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('412', '409', 'Châu Thành', null, null, '2', '2', '822', '823', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('413', '409', 'Giang Thành', null, null, '3', '2', '824', '825', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('414', '409', 'Giồng Riềng', null, null, '4', '2', '826', '827', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('415', '409', 'Gò Quao', null, null, '5', '2', '828', '829', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('416', '409', 'Hà Tiên', null, null, '6', '2', '830', '831', null, '2016-03-23 00:54:13', '2016-03-23 00:54:13');
INSERT INTO `regions` VALUES ('417', '409', 'Hòn Đất', null, null, '7', '2', '832', '833', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('418', '409', 'Kiên Hải', null, null, '8', '2', '834', '835', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('419', '409', 'Kiên Lương', null, null, '9', '2', '836', '837', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('420', '409', 'Phú Quốc', null, null, '10', '2', '838', '839', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('421', '409', 'Rạch Giá', null, null, '11', '2', '840', '841', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('422', '409', 'Tân Hiệp', null, null, '12', '2', '842', '843', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('423', '409', 'U minh Thượng', null, null, '13', '2', '844', '845', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('424', '409', 'Vĩnh Thuận', null, null, '14', '2', '846', '847', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('425', null, 'Kon Tum', 'KT', null, '34', '2', '849', '868', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('426', '425', 'Đăk Glei', null, null, '0', '2', '850', '851', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('427', '425', 'Đăk Hà', null, null, '1', '2', '852', '853', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('428', '425', 'Đăk Tô', null, null, '2', '2', '854', '855', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('429', '425', 'Kon Plông', null, null, '3', '2', '856', '857', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('430', '425', 'Kon Rẫy', null, null, '4', '2', '858', '859', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('431', '425', 'KonTum', null, null, '5', '2', '860', '861', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('432', '425', 'Ngọc Hồi', null, null, '6', '2', '862', '863', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('433', '425', 'Sa Thầy', null, null, '7', '2', '864', '865', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('434', '425', 'Tu Mơ Rông', null, null, '8', '2', '866', '867', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('435', null, 'Lai Châu', 'LCH', null, '35', '2', '869', '886', null, '2016-03-23 00:54:14', '2016-03-23 00:54:14');
INSERT INTO `regions` VALUES ('436', '435', 'Lai Châu', null, null, '0', '2', '870', '871', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('437', '435', 'Mường Tè', null, null, '1', '2', '872', '873', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('438', '435', 'Nậm Nhùn', null, null, '2', '2', '874', '875', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('439', '435', 'Phong Thổ', null, null, '3', '2', '876', '877', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('440', '435', 'Sìn Hồ', null, null, '4', '2', '878', '879', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('441', '435', 'Tam Đường', null, null, '5', '2', '880', '881', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('442', '435', 'Tân Uyên', null, null, '6', '2', '882', '883', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('443', '435', 'Than Uyên', null, null, '7', '2', '884', '885', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('444', null, 'Lâm Đồng', 'LDD', null, '36', '2', '887', '912', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('445', '444', 'Bảo Lâm', null, null, '0', '2', '888', '889', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('446', '444', 'Bảo Lộc', null, null, '1', '2', '890', '891', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('447', '444', 'Cát Tiên', null, null, '2', '2', '892', '893', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('448', '444', 'Đạ Huoai', null, null, '3', '2', '894', '895', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('449', '444', 'Đà Lạt', null, null, '4', '2', '896', '897', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('450', '444', 'Đạ Tẻh', null, null, '5', '2', '898', '899', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('451', '444', 'Đam Rông', null, null, '6', '2', '900', '901', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('452', '444', 'Di Linh', null, null, '7', '2', '902', '903', null, '2016-03-23 00:54:15', '2016-03-23 00:54:15');
INSERT INTO `regions` VALUES ('453', '444', 'Đơn Dương', null, null, '8', '2', '904', '905', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('454', '444', 'Đức Trọng', null, null, '9', '2', '906', '907', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('455', '444', 'Lạc Dương', null, null, '10', '2', '908', '909', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('456', '444', 'Lâm Hà', null, null, '11', '2', '910', '911', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('457', null, 'Lạng Sơn', 'LS', null, '37', '2', '913', '936', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('458', '457', 'Bắc Sơn', null, null, '0', '2', '914', '915', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('459', '457', 'Bình Gia', null, null, '1', '2', '916', '917', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('460', '457', 'Cao Lộc', null, null, '2', '2', '918', '919', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('461', '457', 'Chi Lăng', null, null, '3', '2', '920', '921', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('462', '457', 'Đình Lập', null, null, '4', '2', '922', '923', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('463', '457', 'Hữu Lũng', null, null, '5', '2', '924', '925', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('464', '457', 'Lạng Sơn', null, null, '6', '2', '926', '927', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('465', '457', 'Lộc Bình', null, null, '7', '2', '928', '929', null, '2016-03-23 00:54:16', '2016-03-23 00:54:16');
INSERT INTO `regions` VALUES ('466', '457', 'Tràng Định', null, null, '8', '2', '930', '931', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('467', '457', 'Văn Lãng', null, null, '9', '2', '932', '933', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('468', '457', 'Văn Quan', null, null, '10', '2', '934', '935', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('469', null, 'Lào Cai', 'LCA', null, '38', '2', '937', '956', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('470', '469', 'Bắc Hà', null, null, '0', '2', '938', '939', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('471', '469', 'Bảo Thắng', null, null, '1', '2', '940', '941', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('472', '469', 'Bảo Yên', null, null, '2', '2', '942', '943', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('473', '469', 'Bát Xát', null, null, '3', '2', '944', '945', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('474', '469', 'Lào Cai', null, null, '4', '2', '946', '947', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('475', '469', 'Mường Khương', null, null, '5', '2', '948', '949', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('476', '469', 'Sa Pa', null, null, '6', '2', '950', '951', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('477', '469', 'Văn Bàn', null, null, '7', '2', '952', '953', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('478', '469', 'Xi Ma Cai', null, null, '8', '2', '954', '955', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('479', null, 'Nam Định', 'NDD', null, '39', '2', '957', '978', null, '2016-03-23 00:54:17', '2016-03-23 00:54:17');
INSERT INTO `regions` VALUES ('480', '479', 'Giao Thủy', null, null, '0', '2', '958', '959', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('481', '479', 'Hải Hậu', null, null, '1', '2', '960', '961', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('482', '479', 'Mỹ Lộc', null, null, '2', '2', '962', '963', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('483', '479', 'Nam Định', null, null, '3', '2', '964', '965', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('484', '479', 'Nam Trực', null, null, '4', '2', '966', '967', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('485', '479', 'Nghĩa Hưng', null, null, '5', '2', '968', '969', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('486', '479', 'Trực Ninh', null, null, '6', '2', '970', '971', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('487', '479', 'Vụ Bản', null, null, '7', '2', '972', '973', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('488', '479', 'Xuân Trường', null, null, '8', '2', '974', '975', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('489', '479', 'Ý Yên', null, null, '9', '2', '976', '977', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('490', null, 'Nghệ An', 'NA', null, '40', '2', '979', '1022', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('491', '490', 'Anh Sơn', null, null, '0', '2', '980', '981', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('492', '490', 'Con Cuông', null, null, '1', '2', '982', '983', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('493', '490', 'Cửa Lò', null, null, '2', '2', '984', '985', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('494', '490', 'Diễn Châu', null, null, '3', '2', '986', '987', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('495', '490', 'Đô Lương', null, null, '4', '2', '988', '989', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('496', '490', 'Hoàng Mai', null, null, '5', '2', '990', '991', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('497', '490', 'Hưng Nguyên', null, null, '6', '2', '992', '993', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('498', '490', 'Kỳ Sơn', null, null, '7', '2', '994', '995', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('499', '490', 'Nam Đàn', null, null, '8', '2', '996', '997', null, '2016-03-23 00:54:18', '2016-03-23 00:54:18');
INSERT INTO `regions` VALUES ('500', '490', 'Nghi Lộc', null, null, '9', '2', '998', '999', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('501', '490', 'Nghĩa Đàn', null, null, '10', '2', '1000', '1001', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('502', '490', 'Quế Phong', null, null, '11', '2', '1002', '1003', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('503', '490', 'Quỳ Châu', null, null, '12', '2', '1004', '1005', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('504', '490', 'Quỳ Hợp', null, null, '13', '2', '1006', '1007', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('505', '490', 'Quỳnh Lưu', null, null, '14', '2', '1008', '1009', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('506', '490', 'Tân Kỳ', null, null, '15', '2', '1010', '1011', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('507', '490', 'Thái Hòa', null, null, '16', '2', '1012', '1013', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('508', '490', 'Thanh Chương', null, null, '17', '2', '1014', '1015', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('509', '490', 'Tương Dương', null, null, '18', '2', '1016', '1017', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('510', '490', 'Vinh', null, null, '19', '2', '1018', '1019', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('511', '490', 'Yên Thành', null, null, '20', '2', '1020', '1021', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('512', null, 'Ninh Bình', 'NB', null, '41', '2', '1023', '1040', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('513', '512', 'Gia Viễn', null, null, '0', '2', '1024', '1025', null, '2016-03-23 00:54:19', '2016-03-23 00:54:19');
INSERT INTO `regions` VALUES ('514', '512', 'Hoa Lư', null, null, '1', '2', '1026', '1027', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('515', '512', 'Kim Sơn', null, null, '2', '2', '1028', '1029', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('516', '512', 'Nho Quan', null, null, '3', '2', '1030', '1031', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('517', '512', 'Ninh Bình', null, null, '4', '2', '1032', '1033', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('518', '512', 'Tam Điệp', null, null, '5', '2', '1034', '1035', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('519', '512', 'Yên Khánh', null, null, '6', '2', '1036', '1037', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('520', '512', 'Yên Mô', null, null, '7', '2', '1038', '1039', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('521', null, 'Ninh Thuận', 'NT', null, '42', '2', '1041', '1056', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('522', '521', 'Bác Ái', null, null, '0', '2', '1042', '1043', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('523', '521', 'Ninh Hải', null, null, '1', '2', '1044', '1045', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('524', '521', 'Ninh Phước', null, null, '2', '2', '1046', '1047', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('525', '521', 'Ninh Sơn', null, null, '3', '2', '1048', '1049', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('526', '521', 'Phan Rang - Tháp Chàm', null, null, '4', '2', '1050', '1051', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('527', '521', 'Thuận Bắc', null, null, '5', '2', '1052', '1053', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('528', '521', 'Thuận Nam', null, null, '6', '2', '1054', '1055', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('529', null, 'Phú Thọ', 'PT', null, '43', '2', '1057', '1084', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('530', '529', 'Cẩm Khê', null, null, '0', '2', '1058', '1059', null, '2016-03-23 00:54:20', '2016-03-23 00:54:20');
INSERT INTO `regions` VALUES ('531', '529', 'Đoan Hùng', null, null, '1', '2', '1060', '1061', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('532', '529', 'Hạ Hòa', null, null, '2', '2', '1062', '1063', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('533', '529', 'Lâm Thao', null, null, '3', '2', '1064', '1065', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('534', '529', 'Phù Ninh', null, null, '4', '2', '1066', '1067', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('535', '529', 'Phú Thọ', null, null, '5', '2', '1068', '1069', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('536', '529', 'Tam Nông', null, null, '6', '2', '1070', '1071', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('537', '529', 'Tân Sơn', null, null, '7', '2', '1072', '1073', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('538', '529', 'Thanh Ba', null, null, '8', '2', '1074', '1075', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('539', '529', 'Thanh Sơn', null, null, '9', '2', '1076', '1077', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('540', '529', 'Thanh Thủy', null, null, '10', '2', '1078', '1079', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('541', '529', 'Việt Trì', null, null, '11', '2', '1080', '1081', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('542', '529', 'Yên Lập', null, null, '12', '2', '1082', '1083', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('543', null, 'Phú Yên', 'PY', null, '44', '2', '1085', '1104', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('544', '543', 'Đông Hòa', null, null, '0', '2', '1086', '1087', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('545', '543', 'Đồng Xuân', null, null, '1', '2', '1088', '1089', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('546', '543', 'Phú Hòa', null, null, '2', '2', '1090', '1091', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('547', '543', 'Sơn Hòa', null, null, '3', '2', '1092', '1093', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('548', '543', 'Sông Cầu', null, null, '4', '2', '1094', '1095', null, '2016-03-23 00:54:21', '2016-03-23 00:54:21');
INSERT INTO `regions` VALUES ('549', '543', 'Sông Hinh', null, null, '5', '2', '1096', '1097', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('550', '543', 'Tây Hòa', null, null, '6', '2', '1098', '1099', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('551', '543', 'Tuy An', null, null, '7', '2', '1100', '1101', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('552', '543', 'Tuy Hòa', null, null, '8', '2', '1102', '1103', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('553', null, 'Quảng Bình', 'QB', null, '45', '2', '1105', '1122', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('554', '553', 'Ba Đồn', null, null, '0', '2', '1106', '1107', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('555', '553', 'Bố Trạch', null, null, '1', '2', '1108', '1109', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('556', '553', 'Đồng Hới', null, null, '2', '2', '1110', '1111', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('557', '553', 'Lệ Thủy', null, null, '3', '2', '1112', '1113', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('558', '553', 'Minh Hóa', null, null, '4', '2', '1114', '1115', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('559', '553', 'Quảng Ninh', null, null, '5', '2', '1116', '1117', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('560', '553', 'Quảng Trạch', null, null, '6', '2', '1118', '1119', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('561', '553', 'Tuyên Hóa', null, null, '7', '2', '1120', '1121', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('562', null, 'Quảng Nam', 'QNA', null, '46', '2', '1123', '1160', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('563', '562', 'Bắc Trà My', null, null, '0', '2', '1124', '1125', null, '2016-03-23 00:54:22', '2016-03-23 00:54:22');
INSERT INTO `regions` VALUES ('564', '562', 'Đại Lộc', null, null, '1', '2', '1126', '1127', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('565', '562', 'Điện Bàn', null, null, '2', '2', '1128', '1129', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('566', '562', 'Đông Giang', null, null, '3', '2', '1130', '1131', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('567', '562', 'Duy Xuyên', null, null, '4', '2', '1132', '1133', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('568', '562', 'Hiệp Đức', null, null, '5', '2', '1134', '1135', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('569', '562', 'Hội An', null, null, '6', '2', '1136', '1137', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('570', '562', 'Nam Giang', null, null, '7', '2', '1138', '1139', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('571', '562', 'Nam Trà My', null, null, '8', '2', '1140', '1141', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('572', '562', 'Nông Sơn', null, null, '9', '2', '1142', '1143', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('573', '562', 'Núi Thành', null, null, '10', '2', '1144', '1145', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('574', '562', 'Phú Ninh', null, null, '11', '2', '1146', '1147', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('575', '562', 'Phước Sơn', null, null, '12', '2', '1148', '1149', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('576', '562', 'Quế Sơn', null, null, '13', '2', '1150', '1151', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('577', '562', 'Tam Kỳ', null, null, '14', '2', '1152', '1153', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('578', '562', 'Tây Giang', null, null, '15', '2', '1154', '1155', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('579', '562', 'Thăng Bình', null, null, '16', '2', '1156', '1157', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('580', '562', 'Tiên Phước', null, null, '17', '2', '1158', '1159', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('581', null, 'Quảng Ngãi', 'QNG', null, '47', '2', '1161', '1190', null, '2016-03-23 00:54:23', '2016-03-23 00:54:23');
INSERT INTO `regions` VALUES ('582', '581', 'Ba Tơ', null, null, '0', '2', '1162', '1163', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('583', '581', 'Bình Sơn', null, null, '1', '2', '1164', '1165', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('584', '581', 'Đức Phổ', null, null, '2', '2', '1166', '1167', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('585', '581', 'Lý Sơn', null, null, '3', '2', '1168', '1169', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('586', '581', 'Minh Long', null, null, '4', '2', '1170', '1171', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('587', '581', 'Mộ Đức', null, null, '5', '2', '1172', '1173', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('588', '581', 'Nghĩa Hành', null, null, '6', '2', '1174', '1175', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('589', '581', 'Quảng Ngãi', null, null, '7', '2', '1176', '1177', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('590', '581', 'Sơn Hà', null, null, '8', '2', '1178', '1179', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('591', '581', 'Sơn Tây', null, null, '9', '2', '1180', '1181', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('592', '581', 'Sơn Tịnh', null, null, '10', '2', '1182', '1183', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('593', '581', 'Tây Trà', null, null, '11', '2', '1184', '1185', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('594', '581', 'Trà Bồng', null, null, '12', '2', '1186', '1187', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('595', '581', 'Tư Nghĩa', null, null, '13', '2', '1188', '1189', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('596', null, 'Quảng Ninh', 'QNI', null, '48', '2', '1191', '1220', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('597', '596', 'Ba Chẽ', null, null, '0', '2', '1192', '1193', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('598', '596', 'Bình Liêu', null, null, '1', '2', '1194', '1195', null, '2016-03-23 00:54:24', '2016-03-23 00:54:24');
INSERT INTO `regions` VALUES ('599', '596', 'Cẩm Phả', null, null, '2', '2', '1196', '1197', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('600', '596', 'Cô Tô', null, null, '3', '2', '1198', '1199', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('601', '596', 'Đầm Hà', null, null, '4', '2', '1200', '1201', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('602', '596', 'Đông Triều', null, null, '5', '2', '1202', '1203', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('603', '596', 'Hạ Long', null, null, '6', '2', '1204', '1205', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('604', '596', 'Hải Hà', null, null, '7', '2', '1206', '1207', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('605', '596', 'Hoành Bồ', null, null, '8', '2', '1208', '1209', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('606', '596', 'Móng Cái', null, null, '9', '2', '1210', '1211', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('607', '596', 'Quảng Yên', null, null, '10', '2', '1212', '1213', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('608', '596', 'Tiên Yên', null, null, '11', '2', '1214', '1215', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('609', '596', 'Uông Bí', null, null, '12', '2', '1216', '1217', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('610', '596', 'Vân Đồn', null, null, '13', '2', '1218', '1219', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('611', null, 'Quảng Trị', 'QT', null, '49', '2', '1221', '1242', null, '2016-03-23 00:54:25', '2016-03-23 00:54:25');
INSERT INTO `regions` VALUES ('612', '611', 'Cam Lộ', null, null, '0', '2', '1222', '1223', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('613', '611', 'Đăk Rông', null, null, '1', '2', '1224', '1225', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('614', '611', 'Đảo Cồn cỏ', null, null, '2', '2', '1226', '1227', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('615', '611', 'Đông Hà', null, null, '3', '2', '1228', '1229', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('616', '611', 'Gio Linh', null, null, '4', '2', '1230', '1231', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('617', '611', 'Hải Lăng', null, null, '5', '2', '1232', '1233', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('618', '611', 'Hướng Hóa', null, null, '6', '2', '1234', '1235', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('619', '611', 'Quảng Trị', null, null, '7', '2', '1236', '1237', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('620', '611', 'Triệu Phong', null, null, '8', '2', '1238', '1239', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('621', '611', 'Vĩnh Linh', null, null, '9', '2', '1240', '1241', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('622', null, 'Sóc Trăng', 'ST', null, '50', '2', '1243', '1266', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('623', '622', 'Châu Thành', null, null, '0', '2', '1244', '1245', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('624', '622', 'Cù Lao Dung', null, null, '1', '2', '1246', '1247', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('625', '622', 'Kế Sách', null, null, '2', '2', '1248', '1249', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('626', '622', 'Long Phú', null, null, '3', '2', '1250', '1251', null, '2016-03-23 00:54:26', '2016-03-23 00:54:26');
INSERT INTO `regions` VALUES ('627', '622', 'Mỹ Tú', null, null, '4', '2', '1252', '1253', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('628', '622', 'Mỹ Xuyên', null, null, '5', '2', '1254', '1255', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('629', '622', 'Ngã Năm', null, null, '6', '2', '1256', '1257', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('630', '622', 'Sóc Trăng', null, null, '7', '2', '1258', '1259', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('631', '622', 'Thạnh Trị', null, null, '8', '2', '1260', '1261', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('632', '622', 'Trần Đề', null, null, '9', '2', '1262', '1263', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('633', '622', 'Vĩnh Châu', null, null, '10', '2', '1264', '1265', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('634', null, 'Sơn La', 'SL', null, '51', '2', '1267', '1292', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('635', '634', 'Bắc Yên', null, null, '0', '2', '1268', '1269', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('636', '634', 'Mai Sơn', null, null, '1', '2', '1270', '1271', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('637', '634', 'Mộc Châu', null, null, '2', '2', '1272', '1273', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('638', '634', 'Mường La', null, null, '3', '2', '1274', '1275', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('639', '634', 'Phù Yên', null, null, '4', '2', '1276', '1277', null, '2016-03-23 00:54:27', '2016-03-23 00:54:27');
INSERT INTO `regions` VALUES ('640', '634', 'Quỳnh Nhai', null, null, '5', '2', '1278', '1279', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('641', '634', 'Sơn La', null, null, '6', '2', '1280', '1281', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('642', '634', 'Sông Mã', null, null, '7', '2', '1282', '1283', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('643', '634', 'Sốp Cộp', null, null, '8', '2', '1284', '1285', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('644', '634', 'Thuận Châu', null, null, '9', '2', '1286', '1287', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('645', '634', 'Vân Hồ', null, null, '10', '2', '1288', '1289', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('646', '634', 'Yên Châu', null, null, '11', '2', '1290', '1291', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('647', null, 'Tây Ninh', 'TNI', null, '52', '2', '1293', '1312', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('648', '647', 'Bến Cầu', null, null, '0', '2', '1294', '1295', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('649', '647', 'Châu Thành', null, null, '1', '2', '1296', '1297', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('650', '647', 'Dương Minh Châu', null, null, '2', '2', '1298', '1299', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('651', '647', 'Gò Dầu', null, null, '3', '2', '1300', '1301', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('652', '647', 'Hòa Thành', null, null, '4', '2', '1302', '1303', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('653', '647', 'Tân Biên', null, null, '5', '2', '1304', '1305', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('654', '647', 'Tân Châu', null, null, '6', '2', '1306', '1307', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('655', '647', 'Tây Ninh', null, null, '7', '2', '1308', '1309', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('656', '647', 'Trảng Bàng', null, null, '8', '2', '1310', '1311', null, '2016-03-23 00:54:28', '2016-03-23 00:54:28');
INSERT INTO `regions` VALUES ('657', null, 'Thái Bình', 'TB', null, '53', '2', '1313', '1330', null, '2016-03-23 00:54:29', '2016-03-23 00:54:29');
INSERT INTO `regions` VALUES ('658', '657', 'Đông Hưng', null, null, '0', '2', '1314', '1315', null, '2016-03-23 00:54:29', '2016-03-23 00:54:29');
INSERT INTO `regions` VALUES ('659', '657', 'Hưng Hà', null, null, '1', '2', '1316', '1317', null, '2016-03-23 00:54:29', '2016-03-23 00:54:29');
INSERT INTO `regions` VALUES ('660', '657', 'Kiến Xương', null, null, '2', '2', '1318', '1319', null, '2016-03-23 00:54:29', '2016-03-23 00:54:29');
INSERT INTO `regions` VALUES ('661', '657', 'Quỳnh Phụ', null, null, '3', '2', '1320', '1321', null, '2016-03-23 00:54:29', '2016-03-23 00:54:29');
INSERT INTO `regions` VALUES ('662', '657', 'Thái Bình', null, null, '4', '2', '1322', '1323', null, '2016-03-23 00:54:29', '2016-03-23 00:54:29');
INSERT INTO `regions` VALUES ('663', '657', 'Thái Thuỵ', null, null, '5', '2', '1324', '1325', null, '2016-03-23 00:54:29', '2016-03-23 00:54:29');
INSERT INTO `regions` VALUES ('664', '657', 'Tiền Hải', null, null, '6', '2', '1326', '1327', null, '2016-03-23 00:54:29', '2016-03-23 00:54:29');
INSERT INTO `regions` VALUES ('665', '657', 'Vũ Thư', null, null, '7', '2', '1328', '1329', null, '2016-03-23 00:54:29', '2016-03-23 00:54:29');
INSERT INTO `regions` VALUES ('666', null, 'Thái Nguyên', 'TN', null, '54', '2', '1331', '1350', null, '2016-03-23 00:54:29', '2016-03-23 00:54:29');
INSERT INTO `regions` VALUES ('667', '666', 'Đại Từ', null, null, '0', '2', '1332', '1333', null, '2016-03-23 00:54:30', '2016-03-23 00:54:30');
INSERT INTO `regions` VALUES ('668', '666', 'Định Hóa', null, null, '1', '2', '1334', '1335', null, '2016-03-23 00:54:30', '2016-03-23 00:54:30');
INSERT INTO `regions` VALUES ('669', '666', 'Đồng Hỷ', null, null, '2', '2', '1336', '1337', null, '2016-03-23 00:54:30', '2016-03-23 00:54:30');
INSERT INTO `regions` VALUES ('670', '666', 'Phổ Yên', null, null, '3', '2', '1338', '1339', null, '2016-03-23 00:54:30', '2016-03-23 00:54:30');
INSERT INTO `regions` VALUES ('671', '666', 'Phú Bình', null, null, '4', '2', '1340', '1341', null, '2016-03-23 00:54:30', '2016-03-23 00:54:30');
INSERT INTO `regions` VALUES ('672', '666', 'Phú Lương', null, null, '5', '2', '1342', '1343', null, '2016-03-23 00:54:30', '2016-03-23 00:54:30');
INSERT INTO `regions` VALUES ('673', '666', 'Sông Công', null, null, '6', '2', '1344', '1345', null, '2016-03-23 00:54:30', '2016-03-23 00:54:30');
INSERT INTO `regions` VALUES ('674', '666', 'Thái Nguyên', null, null, '7', '2', '1346', '1347', null, '2016-03-23 00:54:30', '2016-03-23 00:54:30');
INSERT INTO `regions` VALUES ('675', '666', 'Võ Nhai', null, null, '8', '2', '1348', '1349', null, '2016-03-23 00:54:30', '2016-03-23 00:54:30');
INSERT INTO `regions` VALUES ('676', null, 'Thanh Hóa', 'TH', null, '55', '2', '1351', '1406', null, '2016-03-23 00:54:30', '2016-03-23 00:54:30');
INSERT INTO `regions` VALUES ('677', '676', 'Bá Thước', null, null, '0', '2', '1352', '1353', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('678', '676', 'Bỉm Sơn', null, null, '1', '2', '1354', '1355', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('679', '676', 'Cẩm Thủy', null, null, '2', '2', '1356', '1357', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('680', '676', 'Đông Sơn', null, null, '3', '2', '1358', '1359', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('681', '676', 'Hà Trung', null, null, '4', '2', '1360', '1361', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('682', '676', 'Hậu Lộc', null, null, '5', '2', '1362', '1363', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('683', '676', 'Hoằng Hóa', null, null, '6', '2', '1364', '1365', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('684', '676', 'Lang Chánh', null, null, '7', '2', '1366', '1367', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('685', '676', 'Mường Lát', null, null, '8', '2', '1368', '1369', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('686', '676', 'Nga Sơn', null, null, '9', '2', '1370', '1371', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('687', '676', 'Ngọc Lặc', null, null, '10', '2', '1372', '1373', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('688', '676', 'Như Thanh', null, null, '11', '2', '1374', '1375', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('689', '676', 'Như Xuân', null, null, '12', '2', '1376', '1377', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('690', '676', 'Nông Cống', null, null, '13', '2', '1378', '1379', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('691', '676', 'Quan Hóa', null, null, '14', '2', '1380', '1381', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('692', '676', 'Quan Sơn', null, null, '15', '2', '1382', '1383', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('693', '676', 'Quảng Xương', null, null, '16', '2', '1384', '1385', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('694', '676', 'Sầm Sơn', null, null, '17', '2', '1386', '1387', null, '2016-03-23 00:54:31', '2016-03-23 00:54:31');
INSERT INTO `regions` VALUES ('695', '676', 'Thạch Thành', null, null, '18', '2', '1388', '1389', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('696', '676', 'Thanh Hóa', null, null, '19', '2', '1390', '1391', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('697', '676', 'Thiệu Hóa', null, null, '20', '2', '1392', '1393', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('698', '676', 'Thọ Xuân', null, null, '21', '2', '1394', '1395', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('699', '676', 'Thường Xuân', null, null, '22', '2', '1396', '1397', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('700', '676', 'Tĩnh Gia', null, null, '23', '2', '1398', '1399', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('701', '676', 'Triệu Sơn', null, null, '24', '2', '1400', '1401', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('702', '676', 'Vĩnh Lộc', null, null, '25', '2', '1402', '1403', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('703', '676', 'Yên Định', null, null, '26', '2', '1404', '1405', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('704', null, 'Thừa Thiên Huế', 'TTH', null, '56', '2', '1407', '1426', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('705', '704', 'A Lưới', null, null, '0', '2', '1408', '1409', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('706', '704', 'Huế', null, null, '1', '2', '1410', '1411', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('707', '704', 'Hương Thủy', null, null, '2', '2', '1412', '1413', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('708', '704', 'Hương Trà', null, null, '3', '2', '1414', '1415', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('709', '704', 'Nam Đông', null, null, '4', '2', '1416', '1417', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('710', '704', 'Phong Điền', null, null, '5', '2', '1418', '1419', null, '2016-03-23 00:54:32', '2016-03-23 00:54:32');
INSERT INTO `regions` VALUES ('711', '704', 'Phú Lộc', null, null, '6', '2', '1420', '1421', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('712', '704', 'Phú Vang', null, null, '7', '2', '1422', '1423', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('713', '704', 'Quảng Điền', null, null, '8', '2', '1424', '1425', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('714', null, 'Tiền Giang', 'TG', null, '57', '2', '1427', '1450', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('715', '714', 'Cái Bè', null, null, '0', '2', '1428', '1429', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('716', '714', 'Châu Thành', null, null, '1', '2', '1430', '1431', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('717', '714', 'Chợ Gạo', null, null, '2', '2', '1432', '1433', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('718', '714', 'Gò Công', null, null, '3', '2', '1434', '1435', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('719', '714', 'Gò Công Đông', null, null, '4', '2', '1436', '1437', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('720', '714', 'Gò Công Tây', null, null, '5', '2', '1438', '1439', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('721', '714', 'Huyện Cai Lậy', null, null, '6', '2', '1440', '1441', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('722', '714', 'Mỹ Tho', null, null, '7', '2', '1442', '1443', null, '2016-03-23 00:54:33', '2016-03-23 00:54:33');
INSERT INTO `regions` VALUES ('723', '714', 'Tân Phú Đông', null, null, '8', '2', '1444', '1445', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('724', '714', 'Tân Phước', null, null, '9', '2', '1446', '1447', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('725', '714', 'Thị Xã Cai Lậy', null, null, '10', '2', '1448', '1449', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('726', null, 'Trà Vinh', 'TV', null, '58', '2', '1451', '1468', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('727', '726', 'Càng Long', null, null, '0', '2', '1452', '1453', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('728', '726', 'Cầu Kè', null, null, '1', '2', '1454', '1455', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('729', '726', 'Cầu Ngang', null, null, '2', '2', '1456', '1457', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('730', '726', 'Châu Thành', null, null, '3', '2', '1458', '1459', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('731', '726', 'Duyên Hải', null, null, '4', '2', '1460', '1461', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('732', '726', 'Tiểu Cần', null, null, '5', '2', '1462', '1463', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('733', '726', 'Trà Cú', null, null, '6', '2', '1464', '1465', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('734', '726', 'Trà Vinh', null, null, '7', '2', '1466', '1467', null, '2016-03-23 00:54:34', '2016-03-23 00:54:34');
INSERT INTO `regions` VALUES ('735', null, 'Tuyên Quang', 'TQ', null, '59', '2', '1469', '1484', null, '2016-03-23 00:54:35', '2016-03-23 00:54:35');
INSERT INTO `regions` VALUES ('736', '735', 'Chiêm Hóa', null, null, '0', '2', '1470', '1471', null, '2016-03-23 00:54:35', '2016-03-23 00:54:35');
INSERT INTO `regions` VALUES ('737', '735', 'Hàm Yên', null, null, '1', '2', '1472', '1473', null, '2016-03-23 00:54:35', '2016-03-23 00:54:35');
INSERT INTO `regions` VALUES ('738', '735', 'Lâm Bình', null, null, '2', '2', '1474', '1475', null, '2016-03-23 00:54:35', '2016-03-23 00:54:35');
INSERT INTO `regions` VALUES ('739', '735', 'Na Hang', null, null, '3', '2', '1476', '1477', null, '2016-03-23 00:54:35', '2016-03-23 00:54:35');
INSERT INTO `regions` VALUES ('740', '735', 'Sơn Dương', null, null, '4', '2', '1478', '1479', null, '2016-03-23 00:54:35', '2016-03-23 00:54:35');
INSERT INTO `regions` VALUES ('741', '735', 'Tuyên Quang', null, null, '5', '2', '1480', '1481', null, '2016-03-23 00:54:35', '2016-03-23 00:54:35');
INSERT INTO `regions` VALUES ('742', '735', 'Yên Sơn', null, null, '6', '2', '1482', '1483', null, '2016-03-23 00:54:35', '2016-03-23 00:54:35');
INSERT INTO `regions` VALUES ('743', null, 'Vĩnh Long', 'VL', null, '60', '2', '1485', '1502', null, '2016-03-23 00:54:35', '2016-03-23 00:54:35');
INSERT INTO `regions` VALUES ('744', '743', 'Bình Minh', null, null, '0', '2', '1486', '1487', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('745', '743', 'Bình Tân', null, null, '1', '2', '1488', '1489', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('746', '743', 'Long Hồ', null, null, '2', '2', '1490', '1491', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('747', '743', 'Mang Thít', null, null, '3', '2', '1492', '1493', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('748', '743', 'Tam Bình', null, null, '4', '2', '1494', '1495', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('749', '743', 'Trà Ôn', null, null, '5', '2', '1496', '1497', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('750', '743', 'Vĩnh Long', null, null, '6', '2', '1498', '1499', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('751', '743', 'Vũng Liêm', null, null, '7', '2', '1500', '1501', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('752', null, 'Vĩnh Phúc', 'VP', null, '61', '2', '1503', '1522', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('753', '752', 'Bình Xuyên', null, null, '0', '2', '1504', '1505', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('754', '752', 'Lập Thạch', null, null, '1', '2', '1506', '1507', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('755', '752', 'Phúc Yên', null, null, '2', '2', '1508', '1509', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('756', '752', 'Sông Lô', null, null, '3', '2', '1510', '1511', null, '2016-03-23 00:54:36', '2016-03-23 00:54:36');
INSERT INTO `regions` VALUES ('757', '752', 'Tam Đảo', null, null, '4', '2', '1512', '1513', null, '2016-03-23 00:54:37', '2016-03-23 00:54:37');
INSERT INTO `regions` VALUES ('758', '752', 'Tam Dương', null, null, '5', '2', '1514', '1515', null, '2016-03-23 00:54:37', '2016-03-23 00:54:37');
INSERT INTO `regions` VALUES ('759', '752', 'Vĩnh Tường', null, null, '6', '2', '1516', '1517', null, '2016-03-23 00:54:37', '2016-03-23 00:54:37');
INSERT INTO `regions` VALUES ('760', '752', 'Vĩnh Yên', null, null, '7', '2', '1518', '1519', null, '2016-03-23 00:54:37', '2016-03-23 00:54:37');
INSERT INTO `regions` VALUES ('761', '752', 'Yên Lạc', null, null, '8', '2', '1520', '1521', null, '2016-03-23 00:54:37', '2016-03-23 00:54:37');
INSERT INTO `regions` VALUES ('762', null, 'Yên Bái', 'YB', null, '62', '2', '1523', '1542', null, '2016-03-23 00:54:37', '2016-03-23 00:54:37');
INSERT INTO `regions` VALUES ('763', '762', 'Lục Yên', null, null, '0', '2', '1524', '1525', null, '2016-03-23 00:54:37', '2016-03-23 00:54:37');
INSERT INTO `regions` VALUES ('764', '762', 'Mù Cang Chải', null, null, '1', '2', '1526', '1527', null, '2016-03-23 00:54:37', '2016-03-23 00:54:37');
INSERT INTO `regions` VALUES ('765', '762', 'Nghĩa Lộ', null, null, '2', '2', '1528', '1529', null, '2016-03-23 00:54:37', '2016-03-23 00:54:37');
INSERT INTO `regions` VALUES ('766', '762', 'Trạm Tấu', null, null, '3', '2', '1530', '1531', null, '2016-03-23 00:54:38', '2016-03-23 00:54:38');
INSERT INTO `regions` VALUES ('767', '762', 'Trấn Yên', null, null, '4', '2', '1532', '1533', null, '2016-03-23 00:54:38', '2016-03-23 00:54:38');
INSERT INTO `regions` VALUES ('768', '762', 'Văn Chấn', null, null, '5', '2', '1534', '1535', null, '2016-03-23 00:54:38', '2016-03-23 00:54:38');
INSERT INTO `regions` VALUES ('769', '762', 'Văn Yên', null, null, '6', '2', '1536', '1537', null, '2016-03-23 00:54:38', '2016-03-23 00:54:38');
INSERT INTO `regions` VALUES ('770', '762', 'Yên Bái', null, null, '7', '2', '1538', '1539', null, '2016-03-23 00:54:38', '2016-03-23 00:54:38');
INSERT INTO `regions` VALUES ('771', '762', 'Yên Bình', null, null, '8', '2', '1540', '1541', null, '2016-03-23 00:54:38', '2016-03-23 00:54:38');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `weight` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'admin', 'Nhóm quyền admin cao nhất', null, '2', null, '2016-03-04 18:07:22', '2016-03-13 11:50:04');
INSERT INTO `roles` VALUES ('2', 'Nhà phân phối', 'Nhóm quyền dành cho nhà phân phối', null, '2', null, '2016-03-04 18:11:57', '2016-03-13 11:49:35');

-- ----------------------------
-- Table structure for roles_perms
-- ----------------------------
DROP TABLE IF EXISTS `roles_perms`;
CREATE TABLE `roles_perms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `perm_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=478 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles_perms
-- ----------------------------
INSERT INTO `roles_perms` VALUES ('280', '2', '169', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('281', '2', '168', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('282', '2', '87', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('283', '2', '88', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('284', '2', '89', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('285', '2', '90', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('286', '2', '91', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('287', '2', '92', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('288', '2', '86', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('289', '2', '42', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('290', '2', '41', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('291', '2', '40', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('292', '2', '39', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('293', '2', '51', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('294', '2', '50', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('295', '2', '49', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('296', '2', '48', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('297', '2', '47', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('298', '2', '46', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('299', '2', '45', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('300', '2', '44', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('301', '2', '52', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('302', '2', '53', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('303', '2', '54', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('304', '2', '60', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('305', '2', '59', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('306', '2', '58', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('307', '2', '57', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('308', '2', '56', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('309', '2', '55', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('310', '2', '43', '2016-03-13 11:49:35', '2016-03-13 11:49:35');
INSERT INTO `roles_perms` VALUES ('311', '1', '164', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('312', '1', '162', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('313', '1', '163', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('314', '1', '165', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('315', '1', '166', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('316', '1', '167', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('317', '1', '112', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('318', '1', '111', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('319', '1', '113', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('320', '1', '110', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('321', '1', '109', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('322', '1', '108', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('323', '1', '107', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('324', '1', '114', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('325', '1', '115', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('326', '1', '123', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('327', '1', '122', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('328', '1', '121', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('329', '1', '120', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('330', '1', '119', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('331', '1', '118', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('332', '1', '117', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('333', '1', '116', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('334', '1', '106', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('335', '1', '105', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('336', '1', '104', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('337', '1', '87', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('338', '1', '88', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('339', '1', '89', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('340', '1', '90', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('341', '1', '91', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('342', '1', '92', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('343', '1', '93', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('344', '1', '94', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('345', '1', '95', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('346', '1', '96', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('347', '1', '97', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('348', '1', '98', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('349', '1', '99', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('350', '1', '100', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('351', '1', '101', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('352', '1', '102', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('353', '1', '103', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('354', '1', '86', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('355', '1', '124', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('356', '1', '145', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('357', '1', '146', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('358', '1', '147', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('359', '1', '148', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('360', '1', '149', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('361', '1', '150', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('362', '1', '151', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('363', '1', '152', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('364', '1', '153', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('365', '1', '154', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('366', '1', '155', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('367', '1', '156', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('368', '1', '157', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('369', '1', '158', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('370', '1', '159', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('371', '1', '160', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('372', '1', '161', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('373', '1', '144', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('374', '1', '143', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('375', '1', '125', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('376', '1', '126', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('377', '1', '137', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('378', '1', '128', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('379', '1', '129', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('380', '1', '130', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('381', '1', '131', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('382', '1', '132', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('383', '1', '133', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('384', '1', '134', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('385', '1', '135', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('386', '1', '136', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('387', '1', '138', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('388', '1', '139', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('389', '1', '140', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('390', '1', '141', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('391', '1', '142', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('392', '1', '127', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('393', '1', '85', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('394', '1', '42', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('395', '1', '30', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('396', '1', '29', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('397', '1', '28', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('398', '1', '27', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('399', '1', '26', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('400', '1', '25', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('401', '1', '24', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('402', '1', '23', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('403', '1', '31', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('404', '1', '32', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('405', '1', '33', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('406', '1', '41', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('407', '1', '40', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('408', '1', '39', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('409', '1', '38', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('410', '1', '37', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('411', '1', '36', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('412', '1', '35', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('413', '1', '34', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('414', '1', '22', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('415', '1', '21', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('416', '1', '9', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('417', '1', '8', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('418', '1', '7', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('419', '1', '6', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('420', '1', '5', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('421', '1', '4', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('422', '1', '3', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('423', '1', '2', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('424', '1', '10', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('425', '1', '11', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('426', '1', '12', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('427', '1', '20', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('428', '1', '19', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('429', '1', '18', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('430', '1', '17', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('431', '1', '16', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('432', '1', '15', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('433', '1', '14', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('434', '1', '13', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('435', '1', '1', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('436', '1', '84', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('437', '1', '72', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('438', '1', '71', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('439', '1', '70', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('440', '1', '69', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('441', '1', '68', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('442', '1', '67', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('443', '1', '66', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('444', '1', '65', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('445', '1', '73', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('446', '1', '74', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('447', '1', '75', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('448', '1', '83', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('449', '1', '82', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('450', '1', '81', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('451', '1', '80', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('452', '1', '79', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('453', '1', '78', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('454', '1', '77', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('455', '1', '76', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('456', '1', '64', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('457', '1', '63', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('458', '1', '51', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('459', '1', '50', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('460', '1', '49', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('461', '1', '48', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('462', '1', '47', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('463', '1', '46', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('464', '1', '45', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('465', '1', '44', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('466', '1', '52', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('467', '1', '53', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('468', '1', '54', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('469', '1', '62', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('470', '1', '61', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('471', '1', '60', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('472', '1', '59', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('473', '1', '58', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('474', '1', '57', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('475', '1', '56', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('476', '1', '55', '2016-03-13 11:50:04', '2016-03-13 11:50:04');
INSERT INTO `roles_perms` VALUES ('477', '1', '43', '2016-03-13 11:50:04', '2016-03-13 11:50:04');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `description` text,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'MAX_PRODUCT_QTY', '3', 'Giá trị số lượng sản phẩm giới hạn có thể đặt hàng', null, '2015-10-16 21:31:32', '2015-10-16 17:49:31');
INSERT INTO `settings` VALUES ('2', 'EMPTY_PRODUCT_IN_REGION', '<p style=\"text-align: center;\"><em>Địa phương bạn chưa c&oacute; sản phẩm mới</em></p>\r\n<p style=\"text-align: justify;\">Ch&uacute;ng t&ocirc;i đang mong đợi bạn l&agrave; người ho&agrave;n to&agrave;n c&oacute; thể đem sản phẩm của m&igrave;nh cung cấp cho mọi gia đ&igrave;nh th&ocirc;ng qua onGas, với c&aacute;c ti&ecirc;u ch&iacute;:<br />- Sản phẩm thiết yếu cho cuộc sống.<br />- Xuất xứ, chất lượng sản phẩm đảm bảo.<br />- Gi&aacute; cả cạnh tranh.<br />- Phục vụ kh&aacute;ch h&agrave;ng chu đ&aacute;o, nhanh ch&oacute;ng .<br />H&atilde;y vui l&ograve;ng li&ecirc;n hệ với ch&uacute;ng t&ocirc;i : Mr Thắng, số điện thoại: 0912863689 hoặc 0904614756.</p>', 'Thông báo mô tả khi không có sản phẩm nào được bán ở 1 tỉnh/thành phố nào đó', null, '2015-10-16 21:31:38', '2016-03-23 00:58:52');
INSERT INTO `settings` VALUES ('3', 'ADD_CART_THAN_MAX', '<p>&nbsp;Số lượng sản phẩm kh&ocirc;ng thể đặt vượt qu&aacute; 3 sản phẩm.</p>', 'Thông báo khi khách hàng đặt số lượng vượt quá số lượng sản phẩm giới hạn', null, '2015-10-16 21:33:00', '2015-10-17 04:01:24');
INSERT INTO `settings` VALUES ('4', 'DELETE_CART', '<p>Bạn muốn hủy đơn h&agrave;ng n&agrave;y?</p>', 'Thông báo khi khách hàng ấn vào nút \"Hủy bỏ\" đơn hàng', null, '2015-10-16 23:09:39', '2015-10-16 18:25:59');
INSERT INTO `settings` VALUES ('5', 'REMOVE_ITEM_IN_CART', '<p>Bạn c&oacute; muốn x&oacute;a sản phẩm n&agrave;y khỏi giỏ h&agrave;ng?</p>', 'Thông báo khi khách hàng xóa bỏ 1 sản phẩm ra khỏi đơn hàng', null, '2015-10-16 23:10:34', '2015-10-16 18:27:08');
INSERT INTO `settings` VALUES ('6', 'NOT_FULLFILL_FORM', '<p>Bạn chưa điền v&agrave;o đủ c&aacute;c th&ocirc;ng tin bắt buộc (*).</p>', 'Thông báo khi khách hàng chưa điền đủ các thông tin bắt buộc', null, '2015-10-16 23:12:29', '2015-10-17 03:31:17');
INSERT INTO `settings` VALUES ('7', 'OFFLINE_NETWORK', '<p>H&atilde;y bật dữ liệu mạng hoặc wifi.</p>', 'Thông báo khi mất kết nối mạng', null, '2015-10-16 23:14:34', '2015-10-17 03:31:05');
INSERT INTO `settings` VALUES ('8', 'CHECKOUT_SUCCESS', '<p>Cảm ơn, bạn đ&atilde; đặt h&agrave;ng th&agrave;nh c&ocirc;ng qua <strong>onGas</strong>.&nbsp;Nh&acirc;n vi&ecirc;n của ch&uacute;ng t&ocirc;i sẽ li&ecirc;n hệ ngay với bạn.</p>', 'Thông báo khi khách hàng đặt hàng thành công', null, '2015-10-16 23:18:37', '2016-02-23 16:31:59');
INSERT INTO `settings` VALUES ('9', 'CHECKOUT_ERROR', '<p>Bạn chưa đặt mua h&agrave;ng th&agrave;nh c&ocirc;ng, xin vui l&ograve;ng thử lại.</p>', 'Thông báo khi khách hàng đặt hàng thất bại', null, '2015-10-16 23:19:26', '2015-10-16 18:30:28');
INSERT INTO `settings` VALUES ('10', 'SYSTEM_EXCEPTION', '<p>Hệ thống đang bảo tr&igrave;! Rất mong qu&yacute; kh&aacute;ch bỏ qua v&igrave; sự bất tiện n&agrave;y. Xin mời quay lại qu&yacute; kh&aacute;ch quay lại sau.</p>', 'Thông báo khi hệ thống gặp lỗi ngoại lệ', null, '2015-10-16 23:20:25', '2015-10-16 18:25:20');
INSERT INTO `settings` VALUES ('11', 'API_KEY', '', 'Mã bảo mật dành cho việc thao tác api', null, '2015-10-17 19:28:14', '2015-10-17 19:28:17');
INSERT INTO `settings` VALUES ('12', 'EMPTY_CART', '<p>Giỏ h&agrave;ng hiện tại kh&ocirc;ng chứa sản phẩm n&agrave;o.</p>', 'Thông báo khi giỏ hàng không chứa sản phẩm nào', null, '2015-10-18 16:49:33', '2015-10-18 12:01:41');
INSERT INTO `settings` VALUES ('13', 'ABOUT_US', '<p style=\"text-align: justify;\"><span style=\"color: #222222; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: #ffffff;\">onGas l&agrave; một ứng dụng tr&ecirc;n điện thoại di động, d&agrave;nh ri&ecirc;ng cho một số sản phẩm thiết yếu d&ugrave;ng trong gia đ&igrave;nh. </span><br style=\"color: #222222; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: #ffffff;\">Bạn c&oacute; thể tham khảo gi&aacute;, đặt mua h&agrave;ng online với chất lượng, gi&aacute; cả v&agrave; dịch vụ tốt</span><br style=\"color: #222222; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: #ffffff;\">Ch&uacute;ng t&ocirc;i mong rằng bạn sẽ g&oacute;p phần l&agrave;m phong ph&uacute; ứng dụng, bằng c&aacute;ch đưa sản phẩm của m&igrave;nh l&ecirc;n onGas hoặc giới thiệu onGas đến với bạn b&egrave;. H&atilde;y li&ecirc;n hệ với ch&uacute;ng t&ocirc;i.</span><br style=\"color: #222222; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: #ffffff;\">Ch&uacute;ng t&ocirc;i hy vọng l&agrave;m h&agrave;i l&ograve;ng bạn v&agrave; những người th&acirc;n y&ecirc;u của bạn:</span><br style=\"color: #222222; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" /><span style=\"color: #222222; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: #ffffff;\">Tải onGas qua website:</span><br style=\"color: #222222; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" /><a style=\"color: #1155cc; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;\" href=\"http://ongas.vn/\" target=\"_blank\">http://onGas.vn</a><span style=\"color: #222222; font-family: arial, sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: #ffffff;\"> hoặc li&ecirc;n hệ Mr Thắng, số điện thoại: 0912863689 hoặc 0904614756.<br /></span></p>\r\n<p dir=\"ltr\" style=\"color: #222222; font-family: arial,sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-align: center; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: #ffffff;\">**********************************************</p>\r\n<p dir=\"ltr\" style=\"color: #222222; font-family: arial,sans-serif; font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; background-color: #ffffff;\">Cảm ơn bạn đ&atilde; sử dụng ứng dụng n&agrave;y, ch&uacute;c bạn một ng&agrave;y l&agrave;m việc hiệu quả v&agrave; vui vẻ !</p>', 'Thông tin giới thiệu về app', null, '2015-10-18 21:29:36', '2016-03-23 01:03:40');
INSERT INTO `settings` VALUES ('14', 'NOTIFICATION_ON_PAUSE_TIMEOUT', '3888000', '', null, '2015-11-09 23:55:47', '2016-03-23 01:00:28');
INSERT INTO `settings` VALUES ('15', 'NOTIFICATION_ON_EXIT_TIMEOUT', '3888000', '', null, '2015-11-09 23:55:52', '2016-03-23 01:00:16');
INSERT INTO `settings` VALUES ('16', 'NOTIFICATION_ON_PAUSE_MESSAGE', 'Xin mời ghé thăm onGas để tham khảo sản phẩm và giá cả mới cập nhật !', '', null, '2015-12-13 19:52:29', '2016-03-23 01:05:23');
INSERT INTO `settings` VALUES ('17', 'NOTIFICATION_ON_EXIT_MESSAGE', 'Xin mời ghé thăm onGas để tham khảo sản phẩm và giá cả mới cập nhật !', '', null, '2015-12-13 19:52:35', '2016-03-23 01:05:08');
INSERT INTO `settings` VALUES ('18', 'ENABLE_VIBRATE', '1', 'Thực hiện bật chế độ rung khi bấm nút', null, '2015-12-13 19:52:25', '2015-12-13 19:52:27');
INSERT INTO `settings` VALUES ('19', 'VIBRATE_TIME', '100', 'Khoảng thời gian rung tính bằng mili giây', null, '2015-12-13 19:57:27', '2015-12-13 19:57:30');
INSERT INTO `settings` VALUES ('20', 'ORDER_STATUS', '{ \"0\": \"Hủy\", \"1\": \"Thành công\", \"2\": \"Chờ xử lý\", \"3\": \"Giả mạo\",\"4\":\"Đang xử lý\"}', 'Kiểu chuỗi json dùng để định dạng label trạng thái của đơn hàng', null, '2016-01-17 20:15:44', '2016-03-14 01:38:43');
INSERT INTO `settings` VALUES ('21', 'FEEDBACK_SUCCESS', '<p>Cảm ơn, ch&uacute;ng t&ocirc;i đ&atilde; nhận được &yacute; kiến đ&oacute;ng g&oacute;p của bạn th&agrave;nh c&ocirc;ng! Ch&uacute;c bạn 1 ng&agrave;y vui vẻ.</p>', 'Thông báo khi người dùng góp ý thành công', null, '2016-02-28 21:54:46', '2016-02-28 16:03:44');
INSERT INTO `settings` VALUES ('22', 'FEEDBACK_ERROR', '<p>Rất tiếc, &yacute; kiến phản hồi của bạn chưa được gửi đi! Xin vui l&ograve;ng gửi lại.</p>', 'Thông báo khi người dùng góp ý không thành công', null, '2016-02-28 21:57:56', '2016-02-28 16:03:34');
INSERT INTO `settings` VALUES ('23', 'CLIENT_VERSION_MESSAGE', '<p>Đ&atilde; c&oacute; phi&ecirc;n bản ứng dụng mới với nhiều t&iacute;nh năng mới hấp dẫn v&agrave; tiện d&ugrave;ng hơn. Bạn h&atilde;y cập nhật ngay nh&eacute;!</p>', 'Thông báo khi app có phiên bản mới, gợi ý cho người dùng download về', null, '2016-03-23 01:12:05', '2016-03-01 15:52:25');
INSERT INTO `settings` VALUES ('24', 'SHARE_SUBJECT', 'onGas - kết nối niềm tin', 'Tiêu đề thông báo chia sẻ', null, '2016-03-23 01:13:37', '2016-03-23 01:13:43');
INSERT INTO `settings` VALUES ('25', 'SHARE_MESSAGE', 'Ứng dụng miễn phí về sản phẩm thiết yếu cho gia đình, mời bạn tải theo đường dẫn: http://ongas.vn', 'Nội dung thông báo chia sẻ', null, '2016-03-23 01:15:06', '2016-03-23 01:15:15');
INSERT INTO `settings` VALUES ('26', 'SHARE_LINK', 'http://ongas.vn', 'Link liên kết với thông báo chia sẻ', null, '2016-03-23 01:16:18', '2016-03-23 01:16:50');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', 'ADMIN', 'admin', '5bc49020853cc5e6de1213fe5079c63cfc8e104a', 'Tài khoản quản trị hệ thống cao nhất', '2', null, null, '2016-03-06 07:05:21', '2016-03-06 07:24:01');
INSERT INTO `users` VALUES ('2', '2', 'MANAGER', 'hoan_kiem', '5bc49020853cc5e6de1213fe5079c63cfc8e104a', 'Quản trị viên quản lý Quận Hoàn Kiếm, với sản phẩm chỉ thuộc nhóm sản phẩm Thực phẩm sạch', '2', null, null, '2016-03-06 18:51:36', '2016-03-06 19:02:44');
INSERT INTO `users` VALUES ('3', '2', 'MANAGER', 'ba_dinh', '5bc49020853cc5e6de1213fe5079c63cfc8e104a', '', '2', null, null, '2016-03-08 03:04:03', '2016-03-08 03:04:03');
INSERT INTO `users` VALUES ('4', '2', 'MANAGER', 'ngo_quyen', '5bc49020853cc5e6de1213fe5079c63cfc8e104a', '', '2', null, null, '2016-03-13 09:36:05', '2016-03-13 09:36:05');
INSERT INTO `users` VALUES ('5', '2', 'MANAGER', 'tx_caobang', '5bc49020853cc5e6de1213fe5079c63cfc8e104a', '', '2', null, null, '2016-03-13 10:24:20', '2016-03-13 10:37:37');
INSERT INTO `users` VALUES ('6', '2', 'MANAGER', 'tx_cao_bang', '5bc49020853cc5e6de1213fe5079c63cfc8e104a', '', '2', null, null, '2016-03-13 10:26:45', '2016-03-13 10:37:14');
INSERT INTO `users` VALUES ('7', '2', 'MANAGER', 'ngoquyen', '5bc49020853cc5e6de1213fe5079c63cfc8e104a', '', '2', null, null, '2016-03-13 11:07:39', '2016-03-13 11:07:39');
INSERT INTO `users` VALUES ('8', '2', 'MANAGER', 'da_nang1', '5bc49020853cc5e6de1213fe5079c63cfc8e104a', '', '2', null, null, '2016-03-13 22:21:33', '2016-03-13 22:21:33');
INSERT INTO `users` VALUES ('9', '2', 'MANAGER', 'da_nang2', '5bc49020853cc5e6de1213fe5079c63cfc8e104a', '', '2', null, null, '2016-03-13 22:23:22', '2016-03-13 22:25:27');
INSERT INTO `users` VALUES ('10', '2', 'MANAGER', 'da_nang3', '5bc49020853cc5e6de1213fe5079c63cfc8e104a', '', '2', null, null, '2016-03-13 22:24:18', '2016-03-13 22:24:58');
INSERT INTO `users` VALUES ('11', '2', 'MANAGER', 'long_bien', '5bc49020853cc5e6de1213fe5079c63cfc8e104a', '', '2', null, null, '2016-03-15 08:32:48', '2016-03-15 08:32:48');

-- ----------------------------
-- Table structure for users_bundles
-- ----------------------------
DROP TABLE IF EXISTS `users_bundles`;
CREATE TABLE `users_bundles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `bundle_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_bundles
-- ----------------------------

-- ----------------------------
-- Table structure for users_regions
-- ----------------------------
DROP TABLE IF EXISTS `users_regions`;
CREATE TABLE `users_regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users_regions
-- ----------------------------
