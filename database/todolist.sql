/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100421 (10.4.21-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : todolist

 Target Server Type    : MySQL
 Target Server Version : 100421 (10.4.21-MariaDB)
 File Encoding         : 65001

 Date: 06/02/2025 09:54:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activity_log
-- ----------------------------
DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `activity` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3536 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of activity_log
-- ----------------------------
INSERT INTO `activity_log` VALUES (3472, 37, 'Mengakses halaman dashboard', '2025-02-06 09:13:19');
INSERT INTO `activity_log` VALUES (3473, 37, 'Mengakses halaman dashboard', '2025-02-06 09:13:36');
INSERT INTO `activity_log` VALUES (3474, 37, 'Mengakses halaman profile', '2025-02-06 09:13:41');
INSERT INTO `activity_log` VALUES (3475, 37, 'Mengakses halaman dashboard', '2025-02-06 09:14:04');
INSERT INTO `activity_log` VALUES (3476, 37, 'Mengakses halaman to do list', '2025-02-06 09:14:42');
INSERT INTO `activity_log` VALUES (3477, 37, 'Menambah data to do list', '2025-02-06 09:15:10');
INSERT INTO `activity_log` VALUES (3478, 37, 'Mengakses halaman to do list', '2025-02-06 09:15:17');
INSERT INTO `activity_log` VALUES (3479, 37, 'Mengakses halaman to do list', '2025-02-06 09:16:01');
INSERT INTO `activity_log` VALUES (3480, 37, 'Menambah data to do list', '2025-02-06 09:16:11');
INSERT INTO `activity_log` VALUES (3481, 37, 'Mengakses halaman to do list', '2025-02-06 09:16:12');
INSERT INTO `activity_log` VALUES (3482, 37, 'Mengakses halaman to do list', '2025-02-06 09:16:43');
INSERT INTO `activity_log` VALUES (3483, 37, 'Mengakses halaman to do list', '2025-02-06 09:16:48');
INSERT INTO `activity_log` VALUES (3484, 37, 'Menambah data to do list', '2025-02-06 09:16:59');
INSERT INTO `activity_log` VALUES (3485, 37, 'Mengakses halaman to do list', '2025-02-06 09:17:00');
INSERT INTO `activity_log` VALUES (3486, 37, 'Mengakses halaman to do list', '2025-02-06 09:17:36');
INSERT INTO `activity_log` VALUES (3487, 37, 'Menambah data to do list', '2025-02-06 09:18:12');
INSERT INTO `activity_log` VALUES (3488, 37, 'Mengakses halaman to do list', '2025-02-06 09:18:13');
INSERT INTO `activity_log` VALUES (3489, 37, 'Menandai task selesai', '2025-02-06 09:18:23');
INSERT INTO `activity_log` VALUES (3490, 37, 'Mengakses halaman to do list', '2025-02-06 09:18:24');
INSERT INTO `activity_log` VALUES (3491, 1, 'Mengakses halaman dashboard', '2025-02-06 09:21:49');
INSERT INTO `activity_log` VALUES (3492, 1, 'Mengakses halaman dashboard', '2025-02-06 09:22:18');
INSERT INTO `activity_log` VALUES (3493, 1, 'Mengakses halaman dashboard', '2025-02-06 09:23:16');
INSERT INTO `activity_log` VALUES (3494, 1, 'Mengakses halaman to do list', '2025-02-06 09:23:22');
INSERT INTO `activity_log` VALUES (3495, 1, 'Mengakses halaman to do list', '2025-02-06 09:23:46');
INSERT INTO `activity_log` VALUES (3496, 1, 'Mengakses halaman dashboard', '2025-02-06 09:31:35');
INSERT INTO `activity_log` VALUES (3497, 1, 'Mengakses halaman user', '2025-02-06 09:31:57');
INSERT INTO `activity_log` VALUES (3498, 1, 'Mengakses halaman setting', '2025-02-06 09:32:00');
INSERT INTO `activity_log` VALUES (3499, 1, 'Mengakses halaman to do list', '2025-02-06 09:32:01');
INSERT INTO `activity_log` VALUES (3500, 1, 'Mengakses halaman setting', '2025-02-06 09:32:02');
INSERT INTO `activity_log` VALUES (3501, 1, 'Mengakses halaman setting', '2025-02-06 09:32:03');
INSERT INTO `activity_log` VALUES (3502, 1, 'Mengakses halaman to do list', '2025-02-06 09:32:05');
INSERT INTO `activity_log` VALUES (3503, 1, 'Mengakses halaman setting', '2025-02-06 09:32:13');
INSERT INTO `activity_log` VALUES (3504, 1, 'Mengakses halaman setting', '2025-02-06 09:32:28');
INSERT INTO `activity_log` VALUES (3505, 1, 'Mengakses halaman setting', '2025-02-06 09:33:39');
INSERT INTO `activity_log` VALUES (3506, 1, 'Mengubah data setting', '2025-02-06 09:33:47');
INSERT INTO `activity_log` VALUES (3507, 1, 'Mengakses halaman setting', '2025-02-06 09:33:54');
INSERT INTO `activity_log` VALUES (3508, 1, 'Mengubah data setting', '2025-02-06 09:34:00');
INSERT INTO `activity_log` VALUES (3509, 1, 'Mengakses halaman setting', '2025-02-06 09:34:01');
INSERT INTO `activity_log` VALUES (3510, 1, 'Mengakses halaman profile', '2025-02-06 09:34:36');
INSERT INTO `activity_log` VALUES (3511, 1, 'Mengubah data profile', '2025-02-06 09:34:45');
INSERT INTO `activity_log` VALUES (3512, 1, 'Mengakses halaman profile', '2025-02-06 09:34:45');
INSERT INTO `activity_log` VALUES (3513, 1, 'Mengubah data profile', '2025-02-06 09:35:06');
INSERT INTO `activity_log` VALUES (3514, 1, 'Mengakses halaman profile', '2025-02-06 09:35:07');
INSERT INTO `activity_log` VALUES (3515, 1, 'Mengubah data profile', '2025-02-06 09:35:14');
INSERT INTO `activity_log` VALUES (3516, 1, 'Mengakses halaman profile', '2025-02-06 09:35:15');
INSERT INTO `activity_log` VALUES (3517, 1, 'Mengakses halaman dashboard', '2025-02-06 09:35:28');
INSERT INTO `activity_log` VALUES (3518, 1, 'Mengakses halaman to do list', '2025-02-06 09:35:44');
INSERT INTO `activity_log` VALUES (3519, 1, 'Mengakses halaman to do list', '2025-02-06 09:37:09');
INSERT INTO `activity_log` VALUES (3520, 1, 'Menambah data to do list', '2025-02-06 09:37:17');
INSERT INTO `activity_log` VALUES (3521, 1, 'Mengakses halaman to do list', '2025-02-06 09:37:18');
INSERT INTO `activity_log` VALUES (3522, 1, 'Menandai task selesai', '2025-02-06 09:37:21');
INSERT INTO `activity_log` VALUES (3523, 1, 'Mengakses halaman to do list', '2025-02-06 09:37:22');
INSERT INTO `activity_log` VALUES (3524, 1, 'Membatalkan status task', '2025-02-06 09:37:25');
INSERT INTO `activity_log` VALUES (3525, 1, 'Mengakses halaman to do list', '2025-02-06 09:37:26');
INSERT INTO `activity_log` VALUES (3526, 1, 'Mengakses halaman to do list', '2025-02-06 09:40:00');
INSERT INTO `activity_log` VALUES (3527, 1, 'Mengakses halaman to do list', '2025-02-06 09:40:11');
INSERT INTO `activity_log` VALUES (3528, 1, 'Mengakses halaman to do list', '2025-02-06 09:40:29');
INSERT INTO `activity_log` VALUES (3529, 1, 'Mengakses halaman to do list', '2025-02-06 09:40:37');
INSERT INTO `activity_log` VALUES (3530, 1, 'Mengakses halaman to do list', '2025-02-06 09:41:41');
INSERT INTO `activity_log` VALUES (3531, 1, 'Mengakses halaman to do list', '2025-02-06 09:42:00');
INSERT INTO `activity_log` VALUES (3532, 1, 'Menandai task selesai', '2025-02-06 09:42:06');
INSERT INTO `activity_log` VALUES (3533, 1, 'Mengakses halaman to do list', '2025-02-06 09:42:07');
INSERT INTO `activity_log` VALUES (3534, 1, 'Membatalkan status task', '2025-02-06 09:42:30');
INSERT INTO `activity_log` VALUES (3535, 1, 'Mengakses halaman to do list', '2025-02-06 09:42:31');

-- ----------------------------
-- Table structure for backup_task
-- ----------------------------
DROP TABLE IF EXISTS `backup_task`;
CREATE TABLE `backup_task`  (
  `id_task` int NOT NULL AUTO_INCREMENT,
  `task` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `priority` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `due_date` datetime NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `isdelete` int NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_task`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of backup_task
-- ----------------------------

-- ----------------------------
-- Table structure for backup_user
-- ----------------------------
DROP TABLE IF EXISTS `backup_user`;
CREATE TABLE `backup_user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` int NULL DEFAULT NULL,
  `isdelete` int NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of backup_user
-- ----------------------------
INSERT INTO `backup_user` VALUES (1, 'adminn', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, 0, NULL, NULL, 1, '2025-02-06 09:35:06', NULL, NULL);

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `nama_setting` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'todolist', 'todo.png', 1, '2025-02-06 09:34:01');

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks`  (
  `id_task` int NOT NULL AUTO_INCREMENT,
  `task` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `priority` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `due_date` datetime NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `isdelete` int NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_task`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tasks
-- ----------------------------
INSERT INTO `tasks` VALUES (1, 'tugas pak if', '1', '2025-02-06 09:16:00', 1, 0, 37, '2025-02-06 09:16:11', 37, '2025-02-06 09:18:23', NULL, NULL);
INSERT INTO `tasks` VALUES (3, 'tugas pak if 2', '1', '2025-02-06 09:18:00', 0, 0, 1, '2025-02-06 09:18:12', 1, '2025-02-06 09:37:25', NULL, NULL);
INSERT INTO `tasks` VALUES (4, 'tes', '1', '2025-02-06 09:37:00', 0, 0, 1, '2025-02-06 09:37:17', 1, '2025-02-06 09:42:31', NULL, NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` int NULL DEFAULT NULL,
  `isdelete` int NOT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, 0, NULL, NULL, 1, '2025-02-06 09:35:14', NULL, NULL);
INSERT INTO `user` VALUES (37, 'elly', 'elly gou', 'c4ca4238a0b923820dcc509a6f75849b', 2, 0, 2, '2025-02-06 09:12:17', NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
