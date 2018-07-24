/*
 Navicat Premium Data Transfer

 Source Server         : 123.207.0.179
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : 123.207.0.179:3306
 Source Schema         : laravel

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 25/07/2018 00:07:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for Jasmine_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_admin_menu`;
CREATE TABLE `Jasmine_admin_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of Jasmine_admin_menu
-- ----------------------------
INSERT INTO `Jasmine_admin_menu` VALUES (1, 0, 1, '仪表盘', 'fa-bar-chart', '/', NULL, '2018-07-24 22:44:16');
INSERT INTO `Jasmine_admin_menu` VALUES (2, 0, 2, '管理员', 'fa-tasks', NULL, NULL, '2018-07-24 23:14:44');
INSERT INTO `Jasmine_admin_menu` VALUES (3, 2, 3, '用户管理', 'fa-users', 'auth/users', NULL, '2018-07-24 22:44:42');
INSERT INTO `Jasmine_admin_menu` VALUES (4, 2, 4, '角色管理', 'fa-user', 'auth/roles', NULL, '2018-07-24 22:44:49');
INSERT INTO `Jasmine_admin_menu` VALUES (5, 2, 5, '权限管理', 'fa-ban', 'auth/permissions', NULL, '2018-07-24 22:44:55');
INSERT INTO `Jasmine_admin_menu` VALUES (6, 2, 6, '节点管理', 'fa-bars', 'auth/menu', NULL, '2018-07-24 22:45:04');
INSERT INTO `Jasmine_admin_menu` VALUES (7, 2, 8, '操作日志', 'fa-history', 'auth/logs', NULL, '2018-07-24 23:06:26');
INSERT INTO `Jasmine_admin_menu` VALUES (8, 10, 10, '会员管理', 'fa-user-md', 'member/users', '2018-07-24 22:47:12', '2018-07-24 23:16:04');
INSERT INTO `Jasmine_admin_menu` VALUES (9, 2, 7, '文件管理', 'fa-file', 'media', '2018-07-24 23:04:32', '2018-07-24 23:06:26');
INSERT INTO `Jasmine_admin_menu` VALUES (10, 0, 9, '用户模块', 'fa-user', NULL, '2018-07-24 23:15:31', '2018-07-24 23:16:21');

-- ----------------------------
-- Table structure for Jasmine_admin_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_admin_operation_log`;
CREATE TABLE `Jasmine_admin_operation_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_operation_log_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 271 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for Jasmine_admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_admin_permissions`;
CREATE TABLE `Jasmine_admin_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_permissions_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of Jasmine_admin_permissions
-- ----------------------------
INSERT INTO `Jasmine_admin_permissions` VALUES (1, 'All permission', '*', '', '*', NULL, NULL);
INSERT INTO `Jasmine_admin_permissions` VALUES (2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL);
INSERT INTO `Jasmine_admin_permissions` VALUES (3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL);
INSERT INTO `Jasmine_admin_permissions` VALUES (4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL);
INSERT INTO `Jasmine_admin_permissions` VALUES (5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);
INSERT INTO `Jasmine_admin_permissions` VALUES (6, 'Media manager', 'ext.media-manager', NULL, '/media*', '2018-07-24 23:04:32', '2018-07-24 23:04:32');

-- ----------------------------
-- Table structure for Jasmine_admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_admin_role_menu`;
CREATE TABLE `Jasmine_admin_role_menu`  (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  INDEX `admin_role_menu_role_id_menu_id_index`(`role_id`, `menu_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of Jasmine_admin_role_menu
-- ----------------------------
INSERT INTO `Jasmine_admin_role_menu` VALUES (1, 2, NULL, NULL);
INSERT INTO `Jasmine_admin_role_menu` VALUES (1, 9, NULL, NULL);

-- ----------------------------
-- Table structure for Jasmine_admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_admin_role_permissions`;
CREATE TABLE `Jasmine_admin_role_permissions`  (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  INDEX `admin_role_permissions_role_id_permission_id_index`(`role_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of Jasmine_admin_role_permissions
-- ----------------------------
INSERT INTO `Jasmine_admin_role_permissions` VALUES (1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for Jasmine_admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_admin_role_users`;
CREATE TABLE `Jasmine_admin_role_users`  (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  INDEX `admin_role_users_role_id_user_id_index`(`role_id`, `user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of Jasmine_admin_role_users
-- ----------------------------
INSERT INTO `Jasmine_admin_role_users` VALUES (1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for Jasmine_admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_admin_roles`;
CREATE TABLE `Jasmine_admin_roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_roles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of Jasmine_admin_roles
-- ----------------------------
INSERT INTO `Jasmine_admin_roles` VALUES (1, 'Administrator', 'administrator', '2018-07-24 22:42:36', '2018-07-24 22:42:36');

-- ----------------------------
-- Table structure for Jasmine_admin_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_admin_user_permissions`;
CREATE TABLE `Jasmine_admin_user_permissions`  (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  INDEX `admin_user_permissions_user_id_permission_id_index`(`user_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for Jasmine_admin_users
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_admin_users`;
CREATE TABLE `Jasmine_admin_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of Jasmine_admin_users
-- ----------------------------
INSERT INTO `Jasmine_admin_users` VALUES (1, 'Lee', '$2y$10$nC1930GpZWOBSNVnlIhOsejEBCEC3aZUgeN14.lgXbTFehiT8W6Lm', 'Administrator', 'images/0d063c94fb5d37fbc316d16f9fa92d4a.jpeg', NULL, '2018-07-24 22:42:36', '2018-07-24 23:20:47');

-- ----------------------------
-- Table structure for Jasmine_articles
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_articles`;
CREATE TABLE `Jasmine_articles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for Jasmine_migrations
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_migrations`;
CREATE TABLE `Jasmine_migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of Jasmine_migrations
-- ----------------------------
INSERT INTO `Jasmine_migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `Jasmine_migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `Jasmine_migrations` VALUES (3, '2016_01_04_173148_create_admin_tables', 1);
INSERT INTO `Jasmine_migrations` VALUES (4, '2016_06_01_000001_create_oauth_auth_codes_table', 1);
INSERT INTO `Jasmine_migrations` VALUES (5, '2016_06_01_000002_create_oauth_access_tokens_table', 1);
INSERT INTO `Jasmine_migrations` VALUES (6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1);
INSERT INTO `Jasmine_migrations` VALUES (7, '2016_06_01_000004_create_oauth_clients_table', 1);
INSERT INTO `Jasmine_migrations` VALUES (8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);
INSERT INTO `Jasmine_migrations` VALUES (9, '2018_07_24_213950_create_articles_table', 1);

-- ----------------------------
-- Table structure for Jasmine_oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_oauth_access_tokens`;
CREATE TABLE `Jasmine_oauth_access_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  `expires_at` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_access_tokens_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for Jasmine_oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_oauth_auth_codes`;
CREATE TABLE `Jasmine_oauth_auth_codes`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for Jasmine_oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_oauth_clients`;
CREATE TABLE `Jasmine_oauth_clients`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_clients_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for Jasmine_oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_oauth_personal_access_clients`;
CREATE TABLE `Jasmine_oauth_personal_access_clients`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_personal_access_clients_client_id_index`(`client_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for Jasmine_oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_oauth_refresh_tokens`;
CREATE TABLE `Jasmine_oauth_refresh_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_refresh_tokens_access_token_id_index`(`access_token_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for Jasmine_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_password_resets`;
CREATE TABLE `Jasmine_password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for Jasmine_users
-- ----------------------------
DROP TABLE IF EXISTS `Jasmine_users`;
CREATE TABLE `Jasmine_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮箱',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系电话',
  `type` int(11) NOT NULL DEFAULT 0 COMMENT '用户类型',
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '昵称',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '头像',
  `is_active` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否激活',
  `money` decimal(8, 2) NOT NULL DEFAULT 0.00 COMMENT '余额',
  `login_time` timestamp(0) DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最后登录IP',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否启用',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(0) DEFAULT NULL,
  `updated_at` timestamp(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
