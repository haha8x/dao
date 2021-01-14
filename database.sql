/*
 Navicat Premium Data Transfer

 Source Server         : local mysql
 Source Server Type    : MySQL
 Source Server Version : 80021
 Source Host           : localhost:3306
 Source Schema         : dao

 Target Server Type    : MySQL
 Target Server Version : 80021
 File Encoding         : 65001

 Date: 26/11/2020 00:03:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activations
-- ----------------------------
DROP TABLE IF EXISTS `activations`;
CREATE TABLE `activations` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `code` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `completed` tinyint NOT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activations_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of activations
-- ----------------------------
BEGIN;
INSERT INTO `activations` VALUES (1, 2, 'hrPRvKytacoU5neZ8ovBPZyOoNjokYJR', 1, '2020-01-14 15:56:45', '2020-01-14 08:56:45', '2020-01-14 08:56:45');
INSERT INTO `activations` VALUES (2, 3, 'BmRJateyCTuJ2F0onGrxmJcXthVqI3wa', 1, '2020-01-15 14:55:29', '2020-01-15 07:55:29', '2020-01-15 07:55:29');
INSERT INTO `activations` VALUES (4, 5, '8LTgH06Go1StGE88TqfQYYCH9dsc16pM', 1, '2020-01-15 14:56:32', '2020-01-15 07:56:32', '2020-01-15 07:56:32');
INSERT INTO `activations` VALUES (6, 1, 'CqKQnHpTDAVIC25eAF7fWCy1nQaDT7y1', 1, '2020-01-15 15:02:05', '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `activations` VALUES (9, 20, 'Tn6orkXArA0QUKXGXGWBCQKBxj6iTqkn', 1, '2020-06-02 10:46:09', '2020-06-02 03:46:09', '2020-06-02 03:46:09');
INSERT INTO `activations` VALUES (11, 61, 'qjcJdN85cIjJHBrjgfFsDmbOkvbNa52T', 1, '2020-06-02 10:46:18', '2020-06-02 03:46:18', '2020-06-02 03:46:18');
INSERT INTO `activations` VALUES (12, 4, 'vMgy18z8JocWwV6t11hmcd3M7KtBBZBF', 1, '2020-06-02 10:46:57', '2020-06-02 03:46:57', '2020-06-02 03:46:57');
INSERT INTO `activations` VALUES (13, 6, '39E0crC5SvDzOwCGzHYFTHfv54f2yjq4', 1, '2020-06-02 10:46:59', '2020-06-02 03:46:59', '2020-06-02 03:46:59');
INSERT INTO `activations` VALUES (15, 36, 'BLsNW0FsxjfW6yfhEZtX4ZyIvARDEs9t', 1, '2020-06-02 10:52:26', '2020-06-02 03:52:26', '2020-06-02 03:52:26');
INSERT INTO `activations` VALUES (16, 33, 'pbniv4zVUSRyMkhkFlpiHfXNxwkg4XmW', 1, '2020-06-02 10:56:33', '2020-06-02 03:56:33', '2020-06-02 03:56:33');
INSERT INTO `activations` VALUES (17, 59, 'TiFSC5GQETUA7LLl3Xb8OoCvcXE1sXxf', 1, '2020-06-02 11:02:06', '2020-06-02 04:02:06', '2020-06-02 04:02:06');
INSERT INTO `activations` VALUES (18, 18, 'AVp6RQGfkDIOpui366s9ZnvfZHV8pXwC', 1, '2020-06-02 15:16:14', '2020-06-02 08:16:14', '2020-06-02 08:16:14');
INSERT INTO `activations` VALUES (19, 71, 'xlcDWFUmh9WMFJhqGn2RCoyFRMvBW2jA', 1, '2020-06-02 15:42:57', '2020-06-02 08:42:57', '2020-06-02 08:42:57');
INSERT INTO `activations` VALUES (20, 70, 'I9fc5J2FjM4AeaGcDgQ8V2XC2wSUprSH', 1, '2020-06-02 15:48:16', '2020-06-02 08:48:16', '2020-06-02 08:48:16');
INSERT INTO `activations` VALUES (21, 67, 'o5cMQPpCktkeHD7abTb3ernmHCQc0C1H', 1, '2020-06-02 16:04:52', '2020-06-02 09:04:52', '2020-06-02 09:04:52');
INSERT INTO `activations` VALUES (22, 72, 'Fn3VTYgwo2D4QOesSJzQdFDouOLsrCVL', 1, '2020-06-02 16:15:39', '2020-06-02 09:15:39', '2020-06-02 09:15:39');
INSERT INTO `activations` VALUES (23, 83, 'gSIvsFaxCuVWxhtaqq5j1bilV7WANDsj', 1, '2020-06-03 15:29:22', '2020-06-03 08:29:22', '2020-06-03 08:29:22');
INSERT INTO `activations` VALUES (24, 42, '19oS9qzWapajsdm9CzItVUGSw1izPoMr', 1, '2020-06-03 16:41:28', '2020-06-03 09:41:28', '2020-06-03 09:41:28');
INSERT INTO `activations` VALUES (25, 16, 'kPiRwDVBcej8hE9qQUntE5d1zshJW9d2', 1, '2020-06-03 16:41:39', '2020-06-03 09:41:39', '2020-06-03 09:41:39');
COMMIT;

-- ----------------------------
-- Table structure for catalog_branches
-- ----------------------------
DROP TABLE IF EXISTS `catalog_branches`;
CREATE TABLE `catalog_branches` (
  `id` int NOT NULL,
  `zone_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `catalog_branches_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of catalog_branches
-- ----------------------------
BEGIN;
INSERT INTO `catalog_branches` VALUES (1, '2', 'VN0010302', 'PHUONG MAI');
INSERT INTO `catalog_branches` VALUES (2, '3', 'VN0010111', 'CAT LINH');
INSERT INTO `catalog_branches` VALUES (3, '1', 'VN0010176', 'TON DUC THANG');
INSERT INTO `catalog_branches` VALUES (4, '9', 'VN0010163', 'NGUYEN THIEN THUAT');
INSERT INTO `catalog_branches` VALUES (5, '9', 'VN0010172', 'BUI HUU NGHIA');
INSERT INTO `catalog_branches` VALUES (6, '1', 'VN0010328', 'TRAN HUNG DAO');
INSERT INTO `catalog_branches` VALUES (7, '2', 'VN0010241', 'KINH DO');
INSERT INTO `catalog_branches` VALUES (8, '1', 'VN0010133', 'SO GIAO DICH');
INSERT INTO `catalog_branches` VALUES (9, '2', 'VN0010379', 'RB SECURED LOAN R2');
INSERT INTO `catalog_branches` VALUES (10, '4', 'VN0010360', 'LANG SON');
INSERT INTO `catalog_branches` VALUES (11, '3', 'HUB_V3', 'TRUNG TAM KHACH HANG UU TIEN R3');
INSERT INTO `catalog_branches` VALUES (12, '2', 'VN0010189', 'LE TRONG TAN');
INSERT INTO `catalog_branches` VALUES (13, '2', 'VN0010117', 'THANH XUAN');
INSERT INTO `catalog_branches` VALUES (14, '1', 'VN0010113', 'THU DO');
INSERT INTO `catalog_branches` VALUES (15, '3', 'VN0010119', 'THANG LONG');
INSERT INTO `catalog_branches` VALUES (16, '2', 'VN0010310', 'HA THANH');
INSERT INTO `catalog_branches` VALUES (17, '3', 'VN0010267', 'NAM TU LIEM');
INSERT INTO `catalog_branches` VALUES (18, '2', 'VN0010115', 'TRAN DUY HUNG');
INSERT INTO `catalog_branches` VALUES (19, '1', 'HUB_V1', 'TRUNG TAM KHACH HANG UU TIEN R1');
INSERT INTO `catalog_branches` VALUES (20, '4', 'VN0010131', 'VINH PHUC');
INSERT INTO `catalog_branches` VALUES (21, '3', 'VN0010143', 'PHAM VAN DONG');
INSERT INTO `catalog_branches` VALUES (22, '3', 'VN0010204', 'DOI CAN');
INSERT INTO `catalog_branches` VALUES (23, '3', 'VN0010192', 'HOANG QUOC VIET');
INSERT INTO `catalog_branches` VALUES (24, '2', 'VN0010252', 'LINH DAM');
INSERT INTO `catalog_branches` VALUES (25, '2', 'VN0010169', 'NAM HA NOI');
INSERT INTO `catalog_branches` VALUES (26, '3', 'VN0010214', 'THANH CONG');
INSERT INTO `catalog_branches` VALUES (27, '3', 'VN0010236', 'LIEU GIAI');
INSERT INTO `catalog_branches` VALUES (28, '3', 'VN0010297', 'LANG THUONG');
INSERT INTO `catalog_branches` VALUES (29, '3', 'VN0010114', 'GIANG VO');
INSERT INTO `catalog_branches` VALUES (30, '3', 'VN0010152', 'THUY KHUE');
INSERT INTO `catalog_branches` VALUES (31, '1', 'VN0010110', 'HOAN KIEM');
INSERT INTO `catalog_branches` VALUES (32, '3', 'VN0010251', 'HAO NAM');
INSERT INTO `catalog_branches` VALUES (33, '1', 'VN0010298', 'DONG HA NOI');
INSERT INTO `catalog_branches` VALUES (34, '1', 'VN0010116', 'CHUONG DUONG');
INSERT INTO `catalog_branches` VALUES (35, '1', 'VN0010231', 'DONG ANH');
INSERT INTO `catalog_branches` VALUES (36, '1', 'VN0010244', 'NGUYEN HUU THUAN');
INSERT INTO `catalog_branches` VALUES (37, '2', 'VN0010167', 'DONG TAM');
INSERT INTO `catalog_branches` VALUES (38, '2', 'VN0010245', 'DINH CONG');
INSERT INTO `catalog_branches` VALUES (39, '2', 'VN0010277', 'VU TRONG PHUC');
INSERT INTO `catalog_branches` VALUES (40, '3', 'VN0010193', 'TRUNG KINH');
INSERT INTO `catalog_branches` VALUES (41, '2', 'VN0010112', 'HAI BA TRUNG');
INSERT INTO `catalog_branches` VALUES (42, '2', 'HUB_V2', 'TRUNG TAM KHACH HANG UU TIEN R2');
INSERT INTO `catalog_branches` VALUES (43, '2', 'VN0010173', 'KIM LIEN');
INSERT INTO `catalog_branches` VALUES (44, '2', 'VN0010235', 'HA TAY');
INSERT INTO `catalog_branches` VALUES (45, '3', 'VN0010303', 'TRAN THAI TONG');
INSERT INTO `catalog_branches` VALUES (46, '4', 'VN0010132', 'BAC GIANG');
INSERT INTO `catalog_branches` VALUES (47, '4', 'VN0010179', 'NGO GIA TU');
INSERT INTO `catalog_branches` VALUES (48, '4', 'VN0010278', 'LE LOI');
INSERT INTO `catalog_branches` VALUES (49, '4', 'VN001028', 'GANG THEP');
COMMIT;

-- ----------------------------
-- Table structure for catalog_positions
-- ----------------------------
DROP TABLE IF EXISTS `catalog_positions`;
CREATE TABLE `catalog_positions` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `catalog_positions_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of catalog_positions
-- ----------------------------
BEGIN;
INSERT INTO `catalog_positions` VALUES (1, 'GDCN', 'GDCN');
INSERT INTO `catalog_positions` VALUES (2, 'TPHONG', 'TPHONG');
INSERT INTO `catalog_positions` VALUES (3, 'GDTT', 'GDTT');
INSERT INTO `catalog_positions` VALUES (4, 'PB', 'PB');
INSERT INTO `catalog_positions` VALUES (5, 'PSE LOAN', 'PSE LOAN');
INSERT INTO `catalog_positions` VALUES (6, 'RM', 'RM');
INSERT INTO `catalog_positions` VALUES (7, 'PSE UPL', 'PSE UPL');
INSERT INTO `catalog_positions` VALUES (9, 'TPHONG_TTTC', 'TPHONG_TTTC');
INSERT INTO `catalog_positions` VALUES (10, 'GDCN_HUB_AF', 'GDCN_HUB_AF');
INSERT INTO `catalog_positions` VALUES (11, 'TPHONG_HUB_AF', 'TPHONG_HUB_AF');
COMMIT;

-- ----------------------------
-- Table structure for catalog_zones
-- ----------------------------
DROP TABLE IF EXISTS `catalog_zones`;
CREATE TABLE `catalog_zones` (
  `id` int NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `catalog_zones_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of catalog_zones
-- ----------------------------
BEGIN;
INSERT INTO `catalog_zones` VALUES (1, 'R01', 'Vùng 01');
INSERT INTO `catalog_zones` VALUES (2, 'R02', 'Vùng 02');
INSERT INTO `catalog_zones` VALUES (3, 'R03', 'Vùng 03');
INSERT INTO `catalog_zones` VALUES (4, 'R04', 'Vùng 04');
INSERT INTO `catalog_zones` VALUES (5, 'R05', 'Vùng 05');
INSERT INTO `catalog_zones` VALUES (6, 'R06', 'Vùng 06');
INSERT INTO `catalog_zones` VALUES (7, 'R07', 'Vùng 07');
INSERT INTO `catalog_zones` VALUES (8, 'R08', 'Vùng 08');
INSERT INTO `catalog_zones` VALUES (9, 'R09', 'Vùng 09');
INSERT INTO `catalog_zones` VALUES (10, 'R10', 'Vùng 10');
INSERT INTO `catalog_zones` VALUES (11, 'R11', 'Vùng 11');
COMMIT;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int NOT NULL,
  `cif` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `acctno` varchar(120) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `app_id_c` varchar(120) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `product_name` varchar(120) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zone_id` int DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `dao` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `open_date` datetime DEFAULT NULL,
  `name` varchar(120) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_created_by_index` (`created_by`),
  KEY `customers_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of customers
-- ----------------------------
BEGIN;
INSERT INTO `customers` VALUES (1, '5044246', 'LD1824700488', 'LN1808270890823', '10. UPL', 1, 1, '19868', '2018-04-18 00:00:00', 'LE DUC SINH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (2, '5044266', '204305188', '04. AUTO LINK', '1. Current Account', 1, 1, '19868', '2020-01-29 00:00:00', 'NGUYEN THI THANH HA', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (3, '5044272', '1617126', '', '06. Overdraft', 1, 1, '19868', '2018-05-09 00:00:00', 'DUONG THI MY LINH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (4, '5044273', '201517583', '04. AUTO LINK', '1. Current Account', 1, 1, '19868', '2019-12-25 00:00:00', 'HOANG THI THU HIEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (5, '5044308', '325-P-2509420', '21150854', '01. Credit Card', 1, 1, '19868', '2020-02-03 00:00:00', 'DANG THI THANH NHA', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (6, '5044329', 'PDPD1826000600', '', '06. Overdraft', 1, 1, '19868', '2020-08-07 00:00:00', 'DU HONG QUAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (7, '5044334', 'LD1829901361', 'LN1810171001964', '10. UPL', 1, 1, '19868', '2020-10-09 00:00:00', 'LE THANH BINH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (8, '5044422', 'LD1824700556', 'LN1808290898079', '10. UPL', 1, 1, '19868', '2020-03-15 00:00:00', 'LE THI HUONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (9, '5044451', 'LD2001300549', 'LN200113296772', '10. UPL', 1, 1, '19868', '2020-03-29 00:00:00', 'LE VAN DONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (10, '5044423', '291-P242380', '19829398', '02. Debit Card', 1, 1, '19868', '2020-04-22 00:00:00', 'LE VAN SANG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (11, '5044523', 'LD1925500321', 'LN1909061658437', '01. Auto Loan', 1, 1, '19868', '2020-09-07 00:00:00', 'LE VAN SANG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (12, '5044590', '324-P-6449340', '21003372', '01. Credit Card', 1, 1, '19868', '2020-03-11 00:00:00', 'LE NGOC CAM', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (13, '5044620', '324-P3684830', '21251588', '01. Credit Card', 1, 1, '19868', '2020-05-27 00:00:00', 'DINH THI HIEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (14, '5044664', 'LD1824700659', 'LN1808280894080', '10. UPL', 1, 1, '19868', '2020-02-22 00:00:00', 'HA VAN CHUONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (15, '5044699', 'LD1927600507', 'LN1910031735697', '10. UPL', 1, 1, '19868', '2020-10-02 00:00:00', 'HUYNH VAN TAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (16, '5044701', 'LD1824900103', 'LN1809040904121', '10. UPL', 1, 1, '19868', '2020-04-11 00:00:00', 'LUU THI HONG CHAU', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (17, '5044811', 'LD1924900519', 'LN1908221624174', '05. Household Business', 1, 1, '25115', '2020-12-09 00:00:00', 'DUONG DUC MANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (18, '5044868', '324-P-3101640', '19955409', '01. Credit Card', 1, 1, '25115', '2020-12-26 00:00:00', 'BUI VAN HOA', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (19, '5044873', '979668899', '', '06. Overdraft', 1, 1, '25115', '2020-10-11 00:00:00', 'NGUYEN VAN TRUONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (20, '5044877', 'LD1824700767', 'LN1808300900829', '10. UPL', 1, 1, '25115', '2020-08-15 00:00:00', 'NGUYEN HONG QUAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (21, '5044883', 'LD1824700739', 'LN1808180874187', '10. UPL', 1, 1, '25115', '2020-12-06 00:00:00', 'TRUONG HUNG VUONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (22, '5044935', 'LD2001600782', 'LN2001162114154', '10. UPL', 1, 1, '25115', '2020-11-11 00:00:00', 'NGUYEN THI GAM', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (23, '5044937', 'LD1824800931', 'LN1808300899098', '01. Auto Loan', 1, 1, '23627', '2020-05-12 00:00:00', 'HUYNH THANH TUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (24, '5045063', '167015859', '', '06. Overdraft', 1, 1, '23627', '2020-12-12 00:00:00', 'LE PHUONG ANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (25, '5045063', '169146117', '', '06. Overdraft', 1, 1, '23627', '2020-11-16 00:00:00', 'LE PHUONG ANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (26, '5045063', '182888109', '', '06. Overdraft', 1, 1, '23627', '2020-03-17 00:00:00', 'LE PHUONG ANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (27, '504511', 'LD1601501347', '5075580', '02. Consumption Loan', 1, 1, '23627', '2020-03-01 00:00:00', 'NGUYEN THI HIEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (28, '504511', 'LD1917515443', 'LN1906181469054', '10. UPL', 1, 1, '23627', '2020-09-01 00:00:00', 'NGUYEN VAN HAI', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (29, '5045110', 'LD1824900570', 'LN1808310902984', '01. Auto Loan', 1, 1, '23627', '2020-08-02 00:00:00', 'NGUYEN VAN THAO', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (30, '5045143', 'LD1926200718', 'LN1909191695823', '10. UPL', 1, 1, '23627', '2020-07-08 00:00:00', 'NGUYEN VAN THAO', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (31, '5045234', '005-P8672532', '19458659', '01. Credit Card', 1, 1, '23627', '2020-10-10 00:00:00', 'PHAM VAN THUAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (32, '5045234', '161764205', '', '06. Overdraft', 1, 1, '23627', '2020-12-24 00:00:00', 'PHAM VAN THUAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (33, '5045253', 'LD1922600373', 'LN1908141600436', '10. UPL', 1, 1, '23627', '2020-12-11 00:00:00', 'DAO VAN DUONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (34, '5045275', 'LD1824700984', 'LN1808270892303', '10. UPL', 1, 1, '23627', '2020-06-27 00:00:00', 'BUI TRI DUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (35, '5045324', '161766062', '', '06. Overdraft', 1, 1, '23627', '2020-06-11 00:00:00', 'PHAM VAN THANG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (36, '5045355', 'LD1824700973', 'LN1808310902345', '10. UPL', 1, 1, '23627', '2020-12-03 00:00:00', 'NGUYEN THI VAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (37, '5045442', 'LD1825400680', '', '10. UPL', 1, 1, '23627', '2020-09-06 00:00:00', 'PHUONG MY TRANG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (38, '5045457', 'LD1824900829', '', '10. UPL', 1, 1, '23561', '2020-09-07 00:00:00', 'GIANG DIEM THUY', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (39, '5045462', 'LD1825000611', '', '10. UPL', 1, 1, '23561', '2020-09-14 00:00:00', 'NGUYEN VU MINH HIEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (40, '5045484', 'LD1824700989', 'LN1808300900327', '10. UPL', 1, 1, '23561', '2020-09-05 00:00:00', 'PHAM THI THUY TIEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (41, '5045499', '200138608', '04. AUTO LINK', '1. Current Account', 1, 1, '23561', '2020-09-10 00:00:00', 'NGUYEN ANH QUAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (42, '5045541', '196072117', '05. PAYROLL', '1. Current Account', 1, 1, '23561', '2020-09-06 00:00:00', 'NGO DAI HAI', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (43, '5045573', 'LD1830600164', 'LN1810311035146', '10. UPL', 1, 1, '23561', '2020-03-02 00:00:00', 'NGUYEN CONG MINH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (44, '5045600', '325-P-3521520', '19811091', '01. Credit Card', 1, 1, '23561', '2020-09-05 00:00:00', 'HUYNH THU THAO', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (45, '5045600', 'LD1934600898', 'LN1912121973837', '10. UPL', 1, 1, '23561', '2020-12-26 00:00:00', 'HUYNH THU THAO', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (46, '5045611', 'LD1824701072', 'LN1808240888097', '10. UPL', 1, 1, '23561', '2020-12-09 00:00:00', 'DANG DUY DUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (47, '5045614', 'LD1824701077', 'LN1809040904236', '10. UPL', 1, 1, '23561', '2020-06-10 00:00:00', 'NGUYEN BAO HOANG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (48, '5045689', '325-P-1437220', '19440513', '01. Credit Card', 1, 1, '23561', '2020-06-09 00:00:00', 'MAI THI HUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (49, '5045778', 'LD1916414342', 'LN1906061441413', '10. UPL', 1, 1, '23561', '2020-09-06 00:00:00', 'LUU TU ANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (50, '504589', '193234208', '04. AUTO LINK', '1. Current Account', 1, 1, '23561', '2020-04-01 00:00:00', 'DONG XUAN KHANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (51, '504589', '270-P-3129190', '19736067', '01. Credit Card', 1, 1, '23561', '2020-04-09 00:00:00', 'DONG XUAN KHANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (52, '504642', 'LD2000900561', 'LN1912272040291', '05. Household Business', 1, 1, '23561', '2020-04-09 00:00:00', 'NGUYEN THI TRA MY', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (53, '5046516', 'LD1920700746', 'LN1907221541951', '10. UPL', 1, 1, '23561', '2020-01-16 00:00:00', 'HO NGUYEN THANH DIEU', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (54, '5045518', '005-P-2772510', '19637351', '01. Credit Card', 1, 1, '23561', '2020-05-09 00:00:00', 'LE THI THUY AN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (55, '5045580', 'LD1932601227', 'LN1911221897946', '10. UPL', 1, 1, '22515', '2020-02-24 00:00:00', 'LE NGOC LUAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (56, '5046589', 'LD1917811930', 'LN1906261487573', '10. UPL', 1, 1, '22515', '2020-02-24 00:00:00', 'NGUYEN BAO PHONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (57, '5046615', 'LD1931000197', '', '10. UPL', 1, 1, '22515', '2020-12-12 00:00:00', 'HUYNH MY TIEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (58, '5046620', '205-P-0349152', '13904703', '02. Debit Card', 1, 1, '22515', '2020-02-18 00:00:00', 'NGUYEN TRUNG SON', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (59, '5046669', 'LD1824900448', 'LN1808220883377', '01. Auto Loan', 1, 1, '22515', '2020-08-14 00:00:00', 'NGUYEN HONG CHUYEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (60, '5046691', 'LD1825000768', 'LN1809040904938', '01. Auto Loan', 1, 1, '22515', '2020-09-04 00:00:00', 'LE NGUYEN HIEU TRUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (61, '5046697', 'LD1825700714', 'LN1808290897271', '01. Auto Loan', 1, 1, '22515', '2020-09-05 00:00:00', 'NGO VAN SEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (62, '5046699', 'LD1824800121', 'LN1808310901704', '10. UPL', 1, 1, '22515', '2020-09-04 00:00:00', 'LE THANH LIEM', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (63, '5046713', 'LD1824800132', 'LN1809040904241', '10. UPL', 1, 1, '22515', '2020-09-11 00:00:00', 'DO DOAN THAI AN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (64, '5046763', 'LD1925305331', '', '05. Household Business', 1, 1, '22515', '2020-09-06 00:00:00', 'NGO THI XUYEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (65, '5046782', 'LD1924901273', 'LN1908291643550', '10. UPL', 1, 1, '22515', '2020-09-07 00:00:00', 'NGUYEN THANH HIEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (66, '5046825', '204756597', '04. AUTO LINK', '1. Current Account', 1, 1, '22515', '2020-04-09 00:00:00', 'DOAN THANH HUYEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (67, '5046831', 'LD1824800302', 'LN1808290897560', '10. UPL', 1, 1, '22515', '2020-10-23 00:00:00', 'TRINH THI HONG LOAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (68, '5046862', '325-P-3149320', '19880055', '01. Credit Card', 1, 1, '22515', '2020-11-02 00:00:00', 'LUU KIM HOANG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (69, '5046875', '167-P899635', '13840472', '02. Debit Card', 1, 1, '22515', '2020-12-16 00:00:00', 'PHAM VAN KHANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (70, '5046999', '123-P5955374', '15052949', '01. Credit Card', 1, 1, '22515', '2020-01-10 00:00:00', 'TRAN THANH UYEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (71, '5047015', '195926808', '04. AUTO LINK', '1. Current Account', 1, 1, '22515', '2020-10-22 00:00:00', 'TRAN HAI NAM', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (72, '5047029', '324-P-8023987', '13944605', '01. Credit Card', 1, 1, '22515', '2020-01-21 00:00:00', 'LE THI THUY HOA', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (73, '5047029', 'LD1824800360', 'LN1808230885461', '10. UPL', 1, 1, '22515', '2020-09-05 00:00:00', 'LE THI THUY HOA', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (74, '5047054', 'LD1928201362', 'LN1910081748708', '10. UPL', 1, 1, '22515', '2020-10-09 00:00:00', 'NGUYEN VAN LAM', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (75, '5047190', 'LD1824800341', 'LN1808240887758', '10. UPL', 1, 1, '22515', '2020-09-05 00:00:00', 'NGUYEN VAN PHUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (76, '5047259', 'LD1824800419', 'LN1808310901461', '10. UPL', 1, 1, '22515', '2020-09-05 00:00:00', 'NGUYEN THI TUYET NGA', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (77, '504727', '201630158', '04. AUTO LINK', '1. Current Account', 1, 1, '22515', '2020-12-26 00:00:00', 'LE THI THU HUONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (78, '5047370', 'LD1824800453', 'LM1808300900731', '10. UPL', 1, 1, '22515', '2020-09-05 00:00:00', 'TRAN HUY HUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (79, '5047422', 'LS1826300166', 'LN1808310902622', '02. Consumption Loan', 1, 1, '10572', '2020-09-20 00:00:00', 'DANG THI THUY', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (80, '5047458', 'LD1918000413', 'LN1906261487148', '05. Household Business', 1, 1, '10572', '2020-06-29 00:00:00', 'NGUYEN VIET HUONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (81, '5047494', 'LD1824800530', 'LN1809040904381', '10. UPL', 1, 1, '10572', '2020-09-05 00:00:00', 'NGUYEN NGOC THANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (82, '5047494', 'LD1922100853', 'LN1908021571797', '10. UPL', 1, 1, '10572', '2020-08-09 00:00:00', 'NGUYEN NGOC THANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (83, '504753', '153385084', '', '06. Overdraft', 1, 1, '10572', '2020-05-31 00:00:00', 'TA VIET HUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (84, '5047558', 'LD1921100751', 'LN1808290896537', '05. Household Business', 1, 1, '10572', '2020-07-30 00:00:00', 'TRAN VAN DAT', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (85, '5407569', 'LD1825301289', 'LN1808300899762', '01. Auto Loan', 1, 1, '10572', NULL, 'VU DUC TAM', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (86, '5047572', 'LD1916200317', 'LN1906111451629', '10. UPL', 1, 1, '10572', NULL, 'LE VAN VINH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (87, '504765', '192680832', '01. VP SUPER', '1. Current Account', 1, 1, '10572', NULL, 'NGO THI HUYNH DIEP', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (88, '5047675', 'LD1825100476', 'LN1808310902403', '05. Household Business', 1, 1, '10572', NULL, 'DOAN VAN DUY', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (89, '5047677', 'LD1824800554', 'LN1809040904154', '10. UPL', 1, 1, '10572', NULL, 'DANG THANH THAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (90, '5047681', 'LD1929100133', 'LN1910181783638', '10. UPL', 1, 1, '10572', NULL, 'TONG QUOC NHAT', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (91, '5047794', 'LD1935200080', 'LN1912181995725', '10. UPL', 1, 1, '10572', NULL, 'HOANG QUOC TUAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (92, '5047844', 'LD1824800790', 'LN1809040904024', '10. UPL', 1, 1, '10572', NULL, 'LE QUANG TINH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (93, '5047904', 'LD1825400478', 'LN1809060910135', '10. UPL', 1, 1, '10572', NULL, 'NGO QUOC TAI', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (94, '5047927', 'LD1825400335', 'LN1809060909176', '10. UPL', 1, 1, '10572', NULL, 'NGUYEN MANH HUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (95, '5047947', 'LD1825601018', 'LN1808090910146', '10. UPL', 1, 1, '12222', NULL, 'NGUYEN THI NHAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (96, '5047963', '280-P-8426315', '16962339', '02. Debit Card', 1, 1, '12222', NULL, 'DANG THI THU HIEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (97, '5048022', 'LD1824800838', 'LN1808300899862', '10. UPL', 1, 1, '12222', NULL, 'NGUYEN THI HOANG MINH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (98, '5048033', 'LD1908600141', 'LN1903181289266', '10. UPL', 1, 1, '12222', NULL, 'DO TUAN TU', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (99, '5048078', '161867233', '', '06. Overdraft', 1, 1, '12222', NULL, 'NGO THI MAI', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (100, '5048116', '198798533', '04. AUTO LINK', '1. Current Account', 1, 1, '12222', NULL, 'CAO VAN BAM', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (101, '5048208', 'LD1824800923', 'LN1809040904948', '10. UPL', 1, 1, '12222', NULL, 'LE THI KIEU MI', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (102, '5048223', '353-P-1426760', '20940919', '02. Debit Card', 1, 1, '12222', NULL, 'HUYNH VAN DUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (103, '5048236', 'LD1824800898', 'LN1809040903969', '10. UPL', 1, 1, '12222', NULL, 'NGUYEN HOANG ANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (104, '5048277', 'LD1824800975', 'LN1809050905838', '10. UPL', 1, 1, '12222', NULL, 'VU TRUONG HINH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (105, '5048320', '280-P-9537700', '19822269', '02. Debit Card', 1, 1, '12222', NULL, 'LE VAN LAM', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (106, '5048403', '200794998', '04. AUTO LINK', '1. Current Account', 1, 1, '12222', NULL, 'TRAN THI TUYET DUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (107, '5048436', 'LD1824801105', 'LN1809040903695', '10. UPL', 1, 1, '12222', NULL, 'DANG VAN LAM', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (108, '5048889', 'LD1825401114', '', '10. UPL', 1, 1, '12222', NULL, 'LE HAI YEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (109, '5048900', 'LD1825400910', '', '10. UPL', 1, 1, '12222', NULL, 'VO THI THU LOAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (110, '5048986', 'LD1905801094', 'LN1902151240249', '02. Consumption Loan', 1, 1, '12222', NULL, 'NGUYEN THI PHUONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (111, '5048990', 'LD1826100749', 'LN1808230883649', '01. Auto Loan', 1, 1, '12222', NULL, 'HUYNH THI MY PHUONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (112, '5049050', 'LD1824900143', 'LN1808280895910', '10. UPL', 1, 1, '12222', NULL, 'DANG THI TRA MY', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (113, '5049063', 'LD1824900126', 'LN1808310901958', '10. UPL', 1, 1, '12222', NULL, 'PHAM QUANG THAI', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (114, '5049064', 'LD2001100117', 'LN2001112094523', '10. UPL', 1, 1, '17394', NULL, 'CHE THANH HUONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (115, '5049090', 'LD1919200396', 'LN1907111519183', '10. UPL', 1, 1, '17394', NULL, 'NGUYEN HUU XUYEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (116, '5049102', 'LD1826101648', 'LN1808300899752', '02. Consumption Loan', 1, 1, '17394', NULL, 'NGUYEN XUAN TU', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (117, '5049114', '005-P-9590280', '20221094', '01. Credit Card', 1, 1, '17394', NULL, 'NGUYEN NHAT LINH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (118, '5049156', 'LD1928400388', 'LN1910081752489', '10. UPL', 1, 1, '17394', NULL, 'TRAN QUANG HUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (119, '5049189', '183937502', '', '06. Overdraft', 1, 1, '17394', NULL, 'BUI THI THU THUY', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (120, '5049197', 'LD1932600525', 'LN1911221896215', '10. UPL', 1, 1, '17394', NULL, 'DANG VAN DUY', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (121, '5049206', 'LD1825100408', '', '10. UPL', 1, 1, '17394', NULL, 'LE THI MINH NGHIA', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (122, '5049217', '206803428', '04. AUTO LINK', '1. Current Account', 1, 1, '17394', NULL, 'NGUYEN THI TAM', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (123, '5049233', '110-P-1884136', '19444194', '02. Debit Card', 1, 1, '17394', NULL, 'LE QUANG HUNG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (124, '5049263', 'LD1825501542', '', '10. UPL', 1, 1, '17394', NULL, 'NGUYEN THI ANH TUYET', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (125, '5049266', 'LD1825001257', '', '10. UPL', 1, 1, '17394', NULL, 'PHAM THI THANH HANG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (126, '5049267', 'LD1825001121', '', '10. UPL', 1, 1, '17394', NULL, 'THACH THI MINH NGUYET', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (127, '5049279', 'LD1825600872', 'LN1809050905553', '01. Auto Loan', 1, 1, '17394', NULL, 'BUI KHAC VIEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (128, '5049309', 'LD1919300115', 'LN1907121521925', '10. UPL', 1, 1, '10126', NULL, 'HUYNH THI KIM LAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (129, '5049332', 'LD2005000169', 'LN2002192175726', '10. UPL', 1, 1, '10126', NULL, 'NGUYEN QUOC KHANH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (130, '5049363', 'LD1825300651', 'LN1809040905344', '02. Consumption Loan', 1, 1, '10126', NULL, 'BUI VAN SON', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (131, '5049377', 'LD1824900275', 'LN1808310901446', '10. UPL', 1, 1, '10126', NULL, 'NGUYEN DANG THUAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (132, '5049377', 'LD2003400823', 'LN2002032130353', '10. UPL', 1, 1, '10126', NULL, 'NGUYEN DANG THUAN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (133, '5049434', '111-P8743380', '20050293', '', 1, 1, '10126', NULL, 'PHAM THI THEU', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (134, '5049452', 'LD1824900349', 'LN1808290898610', '10. UPL', 1, 1, '10126', NULL, 'NGUYEN THI TINH', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (135, '5049454', '143-P-1696143', '20899764', '02. Debit Card', 1, 1, '10126', NULL, 'NGUYEN THI THU', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (136, '5049517', 'LD1825601428', 'LN1808270891927', '03. Home Loan', 1, 1, '10126', NULL, 'PHUNG HONG TUYEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (137, '5049517', 'LD1923308485', 'LN1908161608023', '02. Consumption Loan', 1, 1, '10126', NULL, 'PHUNG HONG TUYEN', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (138, '5049538', 'LD1825001070', 'LN1808270892311', '01. Auto Loan', 1, 1, '10126', NULL, 'LE THI PHUONG', 1, 1, '2020-05-24 16:29:09', NULL);
INSERT INTO `customers` VALUES (139, '5049554', '191725336', '04. AUTO LINK', '1. Current Account', 1, 1, '10126', NULL, 'VU NHU QUYNH', 1, 1, '2020-05-24 16:29:09', NULL);
COMMIT;

-- ----------------------------
-- Table structure for dashboard_widget_settings
-- ----------------------------
DROP TABLE IF EXISTS `dashboard_widget_settings`;
CREATE TABLE `dashboard_widget_settings` (
  `id` int NOT NULL,
  `settings` longtext COLLATE utf8mb4_general_ci,
  `user_id` int NOT NULL,
  `widget_id` int NOT NULL,
  `order` tinyint NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dashboard_widget_settings_user_id_index` (`user_id`),
  KEY `dashboard_widget_settings_widget_id_index` (`widget_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of dashboard_widget_settings
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for dashboard_widgets
-- ----------------------------
DROP TABLE IF EXISTS `dashboard_widgets`;
CREATE TABLE `dashboard_widgets` (
  `id` int NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of dashboard_widgets
-- ----------------------------
BEGIN;
INSERT INTO `dashboard_widgets` VALUES (1, 'widget_total_pages', '2019-11-04 15:57:08', '2019-11-04 15:57:08');
INSERT INTO `dashboard_widgets` VALUES (2, 'widget_total_users', '2019-11-04 15:57:08', '2019-11-04 15:57:08');
INSERT INTO `dashboard_widgets` VALUES (3, 'widget_total_plugins', '2019-11-04 15:57:08', '2019-11-04 15:57:08');
INSERT INTO `dashboard_widgets` VALUES (4, 'widget_total_themes', '2019-11-04 15:57:08', '2019-11-04 15:57:08');
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `attempts` tinyint NOT NULL,
  `reserved_at` int DEFAULT NULL,
  `available_at` int NOT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for media_files
-- ----------------------------
DROP TABLE IF EXISTS `media_files`;
CREATE TABLE `media_files` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `folder_id` int NOT NULL,
  `mime_type` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `size` int NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `options` longtext COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_files_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of media_files
-- ----------------------------
BEGIN;
INSERT INTO `media_files` VALUES (1, 1, 'bic', 0, 'image/png', 82664, 'bic.png', '[]', '2020-03-17 09:11:46', '2020-03-17 09:11:46', NULL);
INSERT INTO `media_files` VALUES (2, 1, 'vpbank', 0, 'image/png', 18299, 'vpbank.png', '[]', '2020-03-17 09:11:47', '2020-03-17 09:11:47', NULL);
INSERT INTO `media_files` VALUES (3, 1, 'favicon', 0, 'image/png', 6603, 'favicon.png', '[]', '2020-03-17 09:17:01', '2020-03-17 09:17:01', NULL);
INSERT INTO `media_files` VALUES (4, 1, 'file', 4, 'image/jpeg', 267024, 'decision/decision/file.jpg', '[]', '2020-03-18 07:53:10', '2020-03-18 07:53:10', NULL);
INSERT INTO `media_files` VALUES (5, 0, 'bic-1', 0, 'image/png', 82664, 'decision/bic-1.png', '[]', '2020-03-18 08:13:05', '2020-03-18 08:13:05', NULL);
INSERT INTO `media_files` VALUES (6, 1, 'logo', 0, 'image/png', 105446, 'logo.png', '[]', '2020-03-18 14:02:09', '2020-03-18 14:02:09', NULL);
INSERT INTO `media_files` VALUES (7, 0, 'Danh-sach-co-so-KCB-nam-2020', 0, 'application/pdf', 220905, 'decision/danh-sach-co-so-kcb-nam-2020.pdf', '[]', '2020-03-24 06:52:30', '2020-03-24 06:52:30', NULL);
INSERT INTO `media_files` VALUES (8, 1, '0a', 2, 'image/jpeg', 299469, 'users/0a.jpg', '[]', '2020-05-24 16:55:44', '2020-05-24 16:55:44', NULL);
INSERT INTO `media_files` VALUES (9, 0, '246557ca346e5005a9e25257e491f9cc-2668798836198727357', 1, 'image/jpeg', 131778, 'decision/246557ca346e5005a9e25257e491f9cc-2668798836198727357.jpg', '[]', '2020-06-03 08:02:13', '2020-06-03 08:02:13', NULL);
INSERT INTO `media_files` VALUES (10, 0, '2', 1, 'image/jpeg', 270601, 'decision/2.jpg', '[]', '2020-06-08 07:59:07', '2020-06-08 07:59:07', NULL);
COMMIT;

-- ----------------------------
-- Table structure for media_folders
-- ----------------------------
DROP TABLE IF EXISTS `media_folders`;
CREATE TABLE `media_folders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_folders_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of media_folders
-- ----------------------------
BEGIN;
INSERT INTO `media_folders` VALUES (1, 1, 'decision', 'decision', 0, '2020-03-18 07:40:50', '2020-03-18 07:40:50', NULL);
INSERT INTO `media_folders` VALUES (2, 1, 'users', 'users', 0, '2020-05-21 10:22:50', '2020-05-21 10:22:50', NULL);
COMMIT;

-- ----------------------------
-- Table structure for media_settings
-- ----------------------------
DROP TABLE IF EXISTS `media_settings`;
CREATE TABLE `media_settings` (
  `id` int NOT NULL,
  `key` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_general_ci,
  `media_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of media_settings
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for meta_boxes
-- ----------------------------
DROP TABLE IF EXISTS `meta_boxes`;
CREATE TABLE `meta_boxes` (
  `id` int NOT NULL,
  `reference_id` int NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `meta_value` longtext COLLATE utf8mb4_general_ci,
  `reference_type` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_boxes_content_id_index` (`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of meta_boxes
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2013_04_09_032329_create_base_tables', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (4, '2016_06_10_230148_create_acl_tables', 1);
INSERT INTO `migrations` VALUES (5, '2016_10_05_074239_create_setting_table', 1);
INSERT INTO `migrations` VALUES (6, '2016_11_28_032840_create_dashboard_widget_tables', 1);
INSERT INTO `migrations` VALUES (7, '2017_05_09_070343_create_media_tables', 1);
INSERT INTO `migrations` VALUES (8, '2019_01_05_053554_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (9, '2019_08_13_033145_remove_unused_columns_in_users_table', 1);
INSERT INTO `migrations` VALUES (10, '2019_09_08_014859_update_meta_boxes_table', 1);
INSERT INTO `migrations` VALUES (11, '2019_09_12_073711_update_media_url', 1);
INSERT INTO `migrations` VALUES (15, '2020_01_15_161745_create_catalog_zone_table', 2);
INSERT INTO `migrations` VALUES (16, '2020_01_15_161756_create_catalog_position_table', 2);
INSERT INTO `migrations` VALUES (17, '2020_05_15_161735_create_catalog_branch_table', 2);
INSERT INTO `migrations` VALUES (19, '2020_01_15_161745_create_request_close_table', 3);
INSERT INTO `migrations` VALUES (20, '2020_01_15_161745_create_request_new_table', 4);
INSERT INTO `migrations` VALUES (21, '2020_01_15_161745_create_request_transfer_table', 4);
INSERT INTO `migrations` VALUES (22, '2020_01_15_161745_create_request_update_table', 4);
INSERT INTO `migrations` VALUES (23, '2020_01_15_161745_create_request_history_table', 5);
INSERT INTO `migrations` VALUES (26, '2020_05_21_103156_create_user_position_table', 7);
INSERT INTO `migrations` VALUES (27, '2020_05_24_142806_create_customer_table', 8);
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
INSERT INTO `password_resets` VALUES ('huongtt50@vpbank.com.vn', '$2y$10$7AJ5AHCCH7EES7ZBmLun..gD8iTMCn.IRu0GGT2.MBxf90TvviyYK', '2020-07-01 04:32:41');
COMMIT;

-- ----------------------------
-- Table structure for request_closes
-- ----------------------------
DROP TABLE IF EXISTS `request_closes`;
CREATE TABLE `request_closes` (
  `id` int NOT NULL,
  `dao` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zone_id` int DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `staff_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `level` int DEFAULT NULL,
  `dept_parent` int DEFAULT NULL,
  `staff_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cif` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `from_date` datetime DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cmnd` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of request_closes
-- ----------------------------
BEGIN;
INSERT INTO `request_closes` VALUES (1, '12355123', 1, 1, 'TRẦN THỊ HƯƠNG', '1', 60, NULL, '552', '335', '2020-01-14 00:00:00', NULL, '123@vpbank.com.vn', '021356487', 'gdcn_duyet', NULL, 1, NULL, '2020-01-16 15:43:37', NULL);
INSERT INTO `request_closes` VALUES (2, '12355123', 2, 1, 'NGUYỄN HỒNG VÂN', '1', 60, NULL, '552', '353', '2020-01-14 00:00:00', NULL, '123@vpbank.com.vn', '021356487', 'hoiso_duyet', NULL, 1, NULL, '2020-01-16 15:43:37', NULL);
INSERT INTO `request_closes` VALUES (3, '12355123', 1, 1, 'ĐOÀN MAI CHI', '1', 60, NULL, '552', '6575', '2020-01-14 00:00:00', NULL, '123@vpbank.com.vn', '021356487', 'thanh_cong', NULL, 1, NULL, '2020-01-16 15:43:37', NULL);
INSERT INTO `request_closes` VALUES (4, '12355123', 2, 1, 'NGUYỄN HỒNG VÂN', '1', 60, NULL, '552', '8686', '2020-01-14 00:00:00', NULL, '123@vpbank.com.vn', '021356487', 'thanh_cong', NULL, 1, NULL, '2020-01-16 15:43:37', NULL);
INSERT INTO `request_closes` VALUES (5, '12355123', 3, 21, 'NGUYỄN HỒNG VÂN', '1', 60, NULL, '552', '8434', '2020-01-14 00:00:00', NULL, '123@vpbank.com.vn', '021356487', 'tiep_nhan', NULL, 1, NULL, '2020-01-16 15:43:37', NULL);
INSERT INTO `request_closes` VALUES (6, '12312312', 1, 6, '123123', '1', NULL, NULL, '1231231', '12312', NULL, NULL, 'abc@vpbank.com.vn', '123123', 'tao_moi', NULL, 71, NULL, '2020-06-03 04:00:41', '2020-06-03 04:00:41');
COMMIT;

-- ----------------------------
-- Table structure for request_histories
-- ----------------------------
DROP TABLE IF EXISTS `request_histories`;
CREATE TABLE `request_histories` (
  `id` int NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `request_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of request_histories
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for request_news
-- ----------------------------
DROP TABLE IF EXISTS `request_news`;
CREATE TABLE `request_news` (
  `id` int NOT NULL,
  `zone_id` int DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `staff_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `staff_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cif` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cmnd` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `decision_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of request_news
-- ----------------------------
BEGIN;
INSERT INTO `request_news` VALUES (1, 1, 1, '1', 'ĐOÀN MAI CHI', '1', '8686', '123@vpbank.com.vn', '46USDAH', '91456768', 'decision/file.jpg', 'gdcn_duyet', '', 4, 4, '2020-01-16 15:43:37', NULL);
INSERT INTO `request_news` VALUES (2, 1, 1, '1', 'NGUYỄN HỒNG VÂN', '1', '8434', '123@vpbank.com.vn', '46USDAH', '91456769', 'decision/file.jpg', 'hoiso_duyet', '', 4, 4, '2020-01-16 15:43:37', NULL);
INSERT INTO `request_news` VALUES (3, 1, 1, '1', 'NGUYỄN HỒNG VÂN', '1', '4242', '123@vpbank.com.vn', '46USDAH', '91456770', 'decision/file.jpg', 'thanh_cong', '', 4, 4, '2020-01-16 15:43:37', NULL);
INSERT INTO `request_news` VALUES (4, 1, 1, '123', 'NGUYỄN HẢI TUẤN', '1', '123', '123213@vpbank.com.vn', '123123', '123123', NULL, 'thanh_cong', NULL, 4, 4, '2020-03-18 08:11:12', '2020-03-18 16:31:42');
INSERT INTO `request_news` VALUES (5, 1, 1, '12321', 'NGUYỄN HẢI TUẤN', '1', '123213', 'asdas@vpbank.com.vn', '123123', '12312', 'decision/bic-1.png', 'tiep_nhan', NULL, 4, 4, '2020-03-18 08:13:05', '2020-03-24 10:10:08');
INSERT INTO `request_news` VALUES (6, 1, 1, '123', 'NGUYỄN HẢI TUẤN', '1', '123', '123@vpbank.com.vn', '123', '123', 'decision/danh-sach-co-so-kcb-nam-2020.pdf', 'tu_choi', NULL, 4, 4, '2020-03-24 06:52:30', '2020-06-04 08:34:19');
INSERT INTO `request_news` VALUES (7, 1, 8, '12321', '12312', '1', '12312', '123@vpbank.com.vn', '12312', '12312', NULL, 'tiep_nhan', NULL, NULL, NULL, '2020-05-24 15:45:13', '2020-05-24 15:45:13');
INSERT INTO `request_news` VALUES (8, 1, 3, '34578', 'TRAN THI HUONG', '1', '4578', 'huongtt50@vpbank.com.vn', '123468798', '5678905678', NULL, 'tao_moi', NULL, NULL, 1, '2020-05-24 16:40:40', '2020-05-24 16:58:13');
INSERT INTO `request_news` VALUES (9, 3, 17, '12312', 'Nguy?n h?i Tu?n', '2', '12312', 'abc@vpbank.com.vn', '123', '123', 'decision/246557ca346e5005a9e25257e491f9cc-2668798836198727357.jpg', 'tao_moi', NULL, NULL, NULL, '2020-06-03 08:02:13', '2020-06-03 08:02:13');
INSERT INTO `request_news` VALUES (10, 2, 1, '28928', 'TRAN THI HUONG', '1', '123456', 'huongtt50@vpbank.com.vn', '036190000107', '0944222966', 'decision/2.jpg', 'tiep_nhan', NULL, NULL, NULL, '2020-06-08 07:59:07', '2020-06-08 08:00:36');
COMMIT;

-- ----------------------------
-- Table structure for request_transfers
-- ----------------------------
DROP TABLE IF EXISTS `request_transfers`;
CREATE TABLE `request_transfers` (
  `id` int NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zone_id` int DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `staff_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `ref_no` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'CIF/LD/STK/AL/MD',
  `dao_old` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dao_transfer` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of request_transfers
-- ----------------------------
BEGIN;
INSERT INTO `request_transfers` VALUES (1, 'pb_dao', 4, 46, 'NGUYỄN HẢI TUẤN', '123@vpbank.com.vn', 1, '4123213', '123123123', '12355123', 'Do phân bổ lại CB quản lý KH', 'gdcn_duyet', NULL, 1, 1, '2020-01-16 15:43:37', '2020-05-28 09:22:21');
INSERT INTO `request_transfers` VALUES (2, 'pb_dao', NULL, 1, 'NGUYỄN HẢI TUẤN', '123@vpbank.com.vn', 1, '4123213', '123123123', '12355123', NULL, 'hoiso_duyet', NULL, 1, 1, '2020-01-16 15:43:37', NULL);
INSERT INTO `request_transfers` VALUES (3, 'pb_dao', 1, 1, 'NGUYỄN HẢI TUẤN', '123@vpbank.com.vn', 1, '4123213', '123123123', '12355123', 'Do phân bổ lại CB quản lý KH', 'thanh_cong', NULL, 1, 1, '2020-01-16 15:43:37', '2020-03-25 05:02:34');
INSERT INTO `request_transfers` VALUES (4, 'pb_dao', NULL, 1, 'NGUYỄN HẢI TUẤN', '123@vpbank.com.vn', 1, '4123213', '123123123', '12355123', NULL, 'thanh_cong', NULL, 1, 1, '2020-01-16 15:43:37', NULL);
INSERT INTO `request_transfers` VALUES (5, 'pb_dao', 1, 1, 'NGUYỄN HẢI TUẤN', '123@vpbank.com.vn', 1, '4123213', '123123123', '12355123', NULL, 'tiep_nhan', NULL, 1, 1, '2020-01-16 15:43:37', NULL);
INSERT INTO `request_transfers` VALUES (6, 'pb_dao', NULL, 1, NULL, NULL, 1, NULL, '123213', '123', 'other', 'hoiso_duyet', NULL, NULL, NULL, '2020-03-25 04:49:59', '2020-06-04 08:31:05');
INSERT INTO `request_transfers` VALUES (7, 'al', 3, 15, NULL, NULL, 116, NULL, NULL, '123121', 'Do phân b? l?i CB qu?n lý KH', 'tao_moi', NULL, 71, NULL, '2020-06-03 04:21:18', '2020-06-03 04:21:18');
INSERT INTO `request_transfers` VALUES (8, 'pb_dao', 3, 11, NULL, NULL, 114, '12312312', NULL, '12312312', 'Do phân b? l?i CB qu?n lý KH', 'gdcn_duyet', NULL, 71, NULL, '2020-06-03 04:32:54', '2020-07-10 08:35:59');
INSERT INTO `request_transfers` VALUES (9, 'pb_dao', 1, 3, NULL, NULL, NULL, '5044868', NULL, '10127', 'Do phân bổ lại CB quản lý KH', 'tao_moi', NULL, 5, NULL, '2020-06-04 08:29:23', '2020-06-04 08:29:23');
INSERT INTO `request_transfers` VALUES (10, 'pb_dao', 1, 8, NULL, NULL, NULL, '5044868', NULL, '10127', 'Do phân bổ lại CB quản lý KH', 'tao_moi', NULL, 5, NULL, '2020-06-04 08:32:13', '2020-06-04 08:32:13');
INSERT INTO `request_transfers` VALUES (11, 'pb_dao', 1, 8, NULL, NULL, NULL, '1234566', NULL, '22434', 'Do phân bổ lại CB quản lý KH', 'tao_moi', NULL, 5, NULL, '2020-06-04 08:32:35', '2020-06-04 08:32:35');
INSERT INTO `request_transfers` VALUES (12, 'pb_dao', 1, 8, NULL, NULL, NULL, '5049538', NULL, '22434', 'Do phân bổ lại CB quản lý KH', 'tao_moi', NULL, 5, NULL, '2020-06-04 08:33:01', '2020-06-04 08:33:01');
INSERT INTO `request_transfers` VALUES (13, 'pb_dao', 4, 10, NULL, NULL, NULL, '1234566', NULL, NULL, 'Do phân bổ lại CB quản lý KH', 'tao_moi', NULL, 20, NULL, '2020-06-05 02:56:09', '2020-06-05 02:56:09');
INSERT INTO `request_transfers` VALUES (14, 'pb_dao', 1, NULL, NULL, NULL, NULL, '1234566', NULL, NULL, 'Do phân bổ lại CB quản lý KH', 'tao_moi', NULL, 5, NULL, '2020-07-02 07:26:13', '2020-07-02 07:26:13');
INSERT INTO `request_transfers` VALUES (15, 'ld', 1, NULL, NULL, NULL, NULL, '1234566', NULL, '10127', 'Do CBBH nghỉ việc/buộc thôi việc/điều chuyển sang bộ phận khác', 'tao_moi', NULL, 5, NULL, '2020-07-02 07:37:18', '2020-07-02 07:37:18');
INSERT INTO `request_transfers` VALUES (16, 'pb_dao', 3, 2, NULL, NULL, 128, '1234566', NULL, '10127', 'Do phân bổ lại CB quản lý KH', 'tao_moi', NULL, 72, NULL, '2020-07-02 07:42:01', '2020-07-02 07:42:01');
INSERT INTO `request_transfers` VALUES (17, 'ld', 3, 2, NULL, NULL, 128, '5044868', NULL, '10127', 'Do CBBH nghỉ việc/buộc thôi việc/điều chuyển sang bộ phận khác', 'tao_moi', NULL, 72, NULL, '2020-07-02 07:43:50', '2020-07-02 07:43:50');
INSERT INTO `request_transfers` VALUES (18, 'pb_dao', 3, 2, NULL, NULL, 128, '1234566', NULL, '10127', 'Do phân bổ lại CB quản lý KH', 'it_xuly', NULL, 72, NULL, '2020-07-10 08:15:49', '2020-07-10 08:36:44');
INSERT INTO `request_transfers` VALUES (19, 'dao_cif', 1, 33, NULL, NULL, 65, '124596', NULL, '1234567', 'Do phân bổ lại CB quản lý KH', 'tao_moi', NULL, 2, NULL, '2020-07-17 12:13:53', '2020-07-17 12:13:53');
INSERT INTO `request_transfers` VALUES (20, 'pb_dao', 3, 2, NULL, NULL, 134, '5049554', NULL, '1234567', 'Do phân bổ lại CB quản lý KH', 'tao_moi', NULL, 72, NULL, '2020-07-17 12:43:29', '2020-07-17 12:43:29');
COMMIT;

-- ----------------------------
-- Table structure for request_updates
-- ----------------------------
DROP TABLE IF EXISTS `request_updates`;
CREATE TABLE `request_updates` (
  `id` int NOT NULL,
  `dao_old` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dao_update` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zone_id` int DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `staff_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `staff_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cif` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cmnd` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `from_date` datetime DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of request_updates
-- ----------------------------
BEGIN;
INSERT INTO `request_updates` VALUES (1, '12355123', '12355123', 1, 1, '552', 'TRẦN THỊ HƯƠNG', '1', '335', '123@vpbank.com.vn', '021356487', '2020-01-14 00:00:00', NULL, 'it_xuly', NULL, 1, 1, '2020-01-14 17:04:55', '2020-06-03 10:36:34');
INSERT INTO `request_updates` VALUES (2, '12355123', '12355123', 2, 1, '552', 'NGUYỄN HỒNG VÂN', '1', '353', '123@vpbank.com.vn', '021356487', '2020-01-14 00:00:00', NULL, 'it_process', NULL, 1, 1, '2020-01-14 17:04:55', '2020-06-03 10:29:11');
INSERT INTO `request_updates` VALUES (3, '12355123', '12355123', 1, 1, '552', 'ĐOÀN MAI CHI', '1', '6575', '123@vpbank.com.vn', '021356487', '2020-01-14 00:00:00', NULL, 'thanh_cong', NULL, 1, 1, '2020-01-14 17:04:55', NULL);
INSERT INTO `request_updates` VALUES (4, '12355123', '12355123', 2, 1, '552', 'NGUYỄN HỒNG VÂN', '1', '8686', '123@vpbank.com.vn', '021356487', '2020-01-14 00:00:00', NULL, 'thanh_cong', NULL, 1, 1, '2020-01-14 17:04:55', '2020-03-25 04:09:58');
INSERT INTO `request_updates` VALUES (5, '12355123', '12355123', 3, 1, '552', 'NGUYỄN HỒNG VÂN', '1', '8434', '123@vpbank.com.vn', '021356487', '2020-01-14 00:00:00', NULL, 'thanh_cong', NULL, 1, 1, '2020-01-14 17:04:55', '2020-06-04 08:36:33');
INSERT INTO `request_updates` VALUES (6, '12355123', '12355123', 3, 1, '552', 'NGUY?N HO?NG V?N', '1', '4242', '123@vpbank.com.vn', '021356487', '2020-01-14 00:00:00', NULL, 'tao_moi', NULL, 1, 1, '2020-01-14 17:04:55', NULL);
INSERT INTO `request_updates` VALUES (7, '123', '12312', 1, 8, '12321', '12312', '5', '12312', 'abc@vpbank.com.vn', '123123213', NULL, NULL, NULL, '123', NULL, NULL, '2020-06-03 03:23:22', '2020-06-03 03:23:22');
INSERT INTO `request_updates` VALUES (8, '12321', '12312', 1, 6, '123', '12312', '1', '123', 'abc@vpbank.com.vn', '123123121', NULL, NULL, 'tao_moi', NULL, 71, NULL, '2020-06-03 03:44:11', '2020-06-03 03:44:11');
COMMIT;

-- ----------------------------
-- Table structure for role_users
-- ----------------------------
DROP TABLE IF EXISTS `role_users`;
CREATE TABLE `role_users` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `role_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_users_user_id_index` (`user_id`),
  KEY `role_users_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of role_users
-- ----------------------------
BEGIN;
INSERT INTO `role_users` VALUES (1, 3, 1, '2020-01-15 07:55:29', '2020-01-15 07:55:29');
INSERT INTO `role_users` VALUES (2, 4, 2, '2020-01-15 07:56:07', '2020-01-15 07:56:07');
INSERT INTO `role_users` VALUES (4, 6, 4, '2020-01-15 07:57:03', '2020-01-15 07:57:03');
INSERT INTO `role_users` VALUES (6, 2, 6, '2020-05-24 11:26:23', '2020-05-24 11:26:23');
INSERT INTO `role_users` VALUES (7, 59, 3, '2020-06-02 03:55:03', '2020-06-02 03:55:03');
INSERT INTO `role_users` VALUES (9, 71, 3, '2020-06-02 03:55:12', '2020-06-02 03:55:12');
INSERT INTO `role_users` VALUES (10, 70, 4, '2020-06-02 09:01:04', '2020-06-02 09:01:04');
INSERT INTO `role_users` VALUES (11, 67, 4, '2020-06-02 09:04:33', '2020-06-02 09:04:33');
INSERT INTO `role_users` VALUES (16, 5, 3, '2020-06-03 10:26:18', '2020-06-03 10:26:18');
INSERT INTO `role_users` VALUES (18, 20, 3, '2020-06-05 02:55:44', '2020-06-05 02:55:44');
INSERT INTO `role_users` VALUES (19, 72, 1, '2020-07-02 07:43:02', '2020-07-02 07:43:02');
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `permissions` longtext COLLATE utf8mb4_general_ci,
  `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_default` tinyint NOT NULL,
  `created_by` int NOT NULL,
  `updated_by` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`),
  KEY `roles_created_by_index` (`created_by`),
  KEY `roles_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'cbbh', 'CBBH', '{\"customer.index\":true,\"customer.create\":true,\"request-transfer.index\":true,\"request-transfer.create\":true,\"request-transfer.tiep_nhan\":true}', 'Cán bộ bán hàng', 0, 1, 2, '2019-11-15 17:26:55', '2020-07-02 08:06:33');
INSERT INTO `roles` VALUES (2, 'cbql', 'CBQL', '{\"customer.index\":true,\"request-transfer.index\":true,\"request-transfer.create\":true,\"request-new.index\":true,\"request-new.create\":true,\"request-close.index\":true,\"request-close.create\":true}', 'Cán bộ quản lý', 0, 1, 2, '2020-01-13 04:49:22', '2020-06-05 02:50:09');
INSERT INTO `roles` VALUES (3, 'gdcn', 'GDCN', '{\"customer.index\":true,\"customer.create\":true,\"hr.index\":true,\"hr.new-user\":true,\"hr.cbbh\":true,\"request-transfer.index\":true,\"request-transfer.all\":true,\"request-transfer.create\":true,\"request-transfer.edit\":true,\"request-transfer.destroy\":true,\"request-transfer.tiep_nhan\":true,\"request-transfer.tu_choi\":true,\"request-transfer.gdcn_duyet\":true}', 'Giám đốc chi nhánh', 0, 1, 2, '2020-01-13 04:49:55', '2020-07-02 08:06:21');
INSERT INTO `roles` VALUES (4, 'cbcb', 'CBCB', '{\"customer.index\":true,\"request-history.index\":true,\"request-history.create\":true,\"request-transfer.index\":true,\"request-transfer.all\":true,\"request-transfer.create\":true,\"request-update.index\":true,\"request-update.all\":true,\"request-update.create\":true,\"request-new.index\":true,\"request-close.index\":true}', 'Cán bộ chuyên biệt', 0, 1, 2, '2020-01-13 04:50:03', '2020-06-05 03:06:05');
INSERT INTO `roles` VALUES (5, 'admin', 'Admin', '{\"customer.index\":true,\"core.system\":true,\"users.index\":true,\"users.create\":true,\"users.edit\":true,\"users.destroy\":true,\"roles.index\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.destroy\":true,\"plugins.index\":true,\"plugins.edit\":true,\"plugins.remove\":true,\"settings.options\":true,\"settings.email\":true,\"settings.media\":true}', 'Administrator', 0, 1, 1, '2020-01-15 07:58:43', '2020-03-20 07:03:00');
INSERT INTO `roles` VALUES (6, 'system-admin', 'System Admin', '{\"customer.index\":true,\"customer.create\":true,\"customer.edit\":true,\"customer.destroy\":true,\"hr.index\":true,\"hr.create\":true,\"hr.edit\":true,\"hr.destroy\":true,\"request-history.index\":true,\"request-history.create\":true,\"request-history.edit\":true,\"request-history.destroy\":true,\"catalog.index\":true,\"catalog-position.index\":true,\"catalog-position.create\":true,\"catalog-position.edit\":true,\"catalog-position.destroy\":true,\"catalog-zone.index\":true,\"catalog-zone.create\":true,\"catalog-zone.edit\":true,\"catalog-zone.destroy\":true,\"catalog-branch.index\":true,\"catalog-branch.create\":true,\"catalog-branch.edit\":true,\"catalog-branch.destroy\":true,\"core.system\":true,\"users.index\":true,\"users.create\":true,\"users.edit\":true,\"users.destroy\":true,\"users.impersonate\":true,\"roles.index\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.destroy\":true,\"settings.options\":true,\"settings.email\":true,\"user-position.index\":true,\"user-position.create\":true,\"user-position.edit\":true,\"user-position.destroy\":true,\"request-transfer.index\":true,\"request-transfer.all\":true,\"request-transfer.create\":true,\"request-transfer.edit\":true,\"request-transfer.destroy\":true,\"request-transfer.receive\":true,\"request-transfer.reject\":true,\"request-transfer.it-process\":true,\"request-transfer.gdcn-approve\":true,\"request-transfer.hoiso-approve\":true,\"request-transfer.success\":true,\"request-update.index\":true,\"request-update.all\":true,\"request-update.create\":true,\"request-update.edit\":true,\"request-update.destroy\":true,\"request-update.receive\":true,\"request-update.reject\":true,\"request-update.it-process\":true,\"request-update.gdcn-approve\":true,\"request-update.hoiso-approve\":true,\"request-update.success\":true,\"request-new.index\":true,\"request-new.all\":true,\"request-new.create\":true,\"request-new.edit\":true,\"request-new.destroy\":true,\"request-new.receive\":true,\"request-new.reject\":true,\"request-new.it-process\":true,\"request-new.gdcn-approve\":true,\"request-new.hoiso-approve\":true,\"request-new.success\":true,\"request-close.index\":true,\"request-close.all\":true,\"request-close.create\":true,\"request-close.edit\":true,\"request-close.destroy\":true,\"request-close.receive\":true,\"request-close.reject\":true,\"request-close.it-process\":true,\"request-close.gdcn-approve\":true,\"request-close.hoiso-approve\":true,\"request-close.success\":true}', 'System Admin', 0, 1, 1, '2020-01-21 07:44:34', '2020-05-24 11:27:22');
COMMIT;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
BEGIN;
INSERT INTO `settings` VALUES (2, 'time_zone', 'Asia/Ho_Chi_Minh', NULL, NULL);
INSERT INTO `settings` VALUES (3, 'enable_send_error_reporting_via_email', '0', NULL, NULL);
INSERT INTO `settings` VALUES (4, 'admin_title', 'DAO', NULL, NULL);
INSERT INTO `settings` VALUES (5, 'rich_editor', 'ckeditor', NULL, NULL);
INSERT INTO `settings` VALUES (6, 'default_admin_theme', 'black', NULL, NULL);
INSERT INTO `settings` VALUES (7, 'enable_change_admin_theme', '0', NULL, NULL);
INSERT INTO `settings` VALUES (8, 'enable_multi_language_in_admin', '0', NULL, NULL);
INSERT INTO `settings` VALUES (9, 'enable_cache', '1', NULL, NULL);
INSERT INTO `settings` VALUES (10, 'cache_time', '10', NULL, NULL);
INSERT INTO `settings` VALUES (11, 'cache_admin_menu_enable', '0', NULL, NULL);
INSERT INTO `settings` VALUES (12, 'optimize_page_speed_enable', '0', NULL, NULL);
INSERT INTO `settings` VALUES (13, 'cache_time_site_map', '3600', NULL, NULL);
INSERT INTO `settings` VALUES (14, 'show_admin_bar', '0', NULL, NULL);
INSERT INTO `settings` VALUES (15, 'media_driver', 'public', NULL, NULL);
INSERT INTO `settings` VALUES (16, 'activated_plugins', '[\"hr\",\"dao\",\"catalog\",\"enhanced-setting\",\"enhanced-user\",\"captcha\",\"impersonate\",\"customer\",\"setting\",\"webconf\"]', NULL, NULL);
INSERT INTO `settings` VALUES (17, 'membership_authorization_at', '2020-11-25 16:59:32', NULL, NULL);
INSERT INTO `settings` VALUES (18, 'licensed_to', 'haha8x', NULL, NULL);
INSERT INTO `settings` VALUES (19, 'admin_favicon', 'favicon.png', NULL, NULL);
INSERT INTO `settings` VALUES (41, 'enable_captcha', '0', NULL, NULL);
INSERT INTO `settings` VALUES (42, 'captcha_site_key', 'no-captcha-site-key', NULL, NULL);
INSERT INTO `settings` VALUES (43, 'captcha_secret', 'no-captcha-secret', NULL, NULL);
INSERT INTO `settings` VALUES (44, 'admin_logo', 'vpbank.png', NULL, NULL);
INSERT INTO `settings` VALUES (45, 'header_announcement', '<p style=\"text-align: justify;\">Nếu c&oacute; vấn&nbsp;đề li&ecirc;n quan&nbsp;đến&nbsp;đăng nhập hoặc cần hỗ trợ trao t&aacute;c tr&ecirc;n hệ thống <b>QUẢN L&Yacute; DAO </b>(dao_khcn_vpbank/login),&nbsp;Đơn vị kinh doanh vui l&ograve;ng email&nbsp;đến&nbsp;địa chỉ <u><strong>hotro_dao_khcn@vpbank.com.vn</strong></u>.</p>', NULL, NULL);
INSERT INTO `settings` VALUES (46, 'footer_announcement', '<p style=\"text-align: justify;\"><strong>Khuyến c&aacute;o: &quot;B&aacute;o c&aacute;o anh/chị nhận được chứa dữ liệu l&agrave; t&agrave;i sản của Vpbank&quot;,&nbsp;đặc biệt l&agrave; c&aacute;c th&ocirc;ng tin về kh&aacute;ch h&agrave;ng. K&iacute;nh&nbsp;đề nghị anh/chị lưu&nbsp;&yacute; v&agrave; cẩn trọng khi sử dụng, lưu trữ v&agrave; chia sẻ&nbsp;để&nbsp;đảm bảo kh&ocirc;ng g&acirc;y thất tho&aacute;t t&agrave;i sản của Vpbank&quot;.</strong></p>\r\n\r\n<p><span style=\"font-size:12px;\"><i><span style=\"margin: 0px; color: red; line-height: 115%; font-family: \" tahoma=\"\">Note: &ldquo;This report contains data which is VPBank&rsquo;s asset, especially customer infor. Please kindly take careful consideration while using, storing and sharing this report so as not to leak VPBank data asset.&rdquo;</span></i></span></p>', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for sysdiagrams
-- ----------------------------
DROP TABLE IF EXISTS `sysdiagrams`;
CREATE TABLE `sysdiagrams` (
  `name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `principal_id` int NOT NULL,
  `diagram_id` int NOT NULL,
  `version` int DEFAULT NULL,
  `definition` longblob,
  PRIMARY KEY (`diagram_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of sysdiagrams
-- ----------------------------
BEGIN;
INSERT INTO `sysdiagrams` VALUES ('Diagram_0', 1, 1, 1, 0xD0CF11E0A1B11AE1000000000000000000000000000000003E000300FEFF0900060000000000000000000000010000000100000000000000001000000200000001000000FEFFFFFF0000000000000000FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFDFFFFFF15000000FEFFFFFF0400000023000000060000000700000008000000090000000A0000000B0000000C0000000D0000000E0000000F0000001000000011000000120000001300000014000000FEFFFFFFFEFFFFFF1700000018000000190000001A0000001B0000001C0000001D0000001E0000001F000000200000002100000022000000FEFFFFFF2400000025000000FEFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF52006F006F007400200045006E00740072007900000000000000000000000000000000000000000000000000000000000000000000000000000000000000000016000500FFFFFFFFFFFFFFFF0200000000000000000000000000000000000000000000000000000000000000408B5952972DD6010300000000090000000000006600000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000004000201FFFFFFFFFFFFFFFFFFFFFFFF0000000000000000000000000000000000000000000000000000000000000000000000000000000056030000000000006F000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000040002010100000004000000FFFFFFFF00000000000000000000000000000000000000000000000000000000000000000000000005000000FC1F000000000000010043006F006D0070004F0062006A0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000012000201FFFFFFFFFFFFFFFFFFFFFFFF0000000000000000000000000000000000000000000000000000000000000000000000000E0000005F000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A0000000B0000000C0000000D000000FEFFFFFF0F000000FEFFFFFFFEFFFFFF12000000130000001400000015000000160000001700000018000000190000001A0000001B0000001C0000001D0000001E0000001F000000200000002100000022000000FEFFFFFFFEFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF000430000A1E100C050000800E0000000F00FFFF0E000000007D000028800000285B000041C60000DA96000052E2FFFF19DEFFFFDE805B10F195D011B0A000AA00BDCB5C0000080030000000000200000100000038002B00000009000000D9E6B0E91C81D011AD5100A0C90F5739F43B7F847F61C74385352986E1D552F8A0327DB2D86295428D98273C25A2DA2D0C000000C0020000008C010F00003800A50900000700008001000000B202000000800000100000805363684772696400220B0000A60E0000636174616C6F675F6272616E6368657300003C00A50900000700008002000000B4020000008000001100008053636847726964008C0A00007CFCFFFF636174616C6F675F706F736974696F6E7300000000003800A50900000700008003000000AC020000008000000D00008053636847726964008C0A000040EDFFFF636174616C6F675F7A6F6E657308000000003800A50900000700008004000000AE020000008000000E0000805363684772696400D0D5FFFFD6EDFFFF726571756573745F636C6F736573000000003400A50900000700008006000000AA020000008000000C0000805363684772696400C4F0FFFFAAECFFFF726571756573745F6E65777300003C00A50900000700008007000000B4020000008000001100008053636847726964003AD5FFFF6E280000726571756573745F7472616E736665727300610000003800A50900000700008008000000B0020000008000000F000080536368477269640086F2FFFFD8270000726571756573745F757064617465730000003400A50900000700008009000000A6020000008000000A00008053636847726964006243000018150000726F6C655F7573657273000000003000A5090000070000800A0000009C02000000800000050000805363684772696400CC42000002EFFFFF726F6C657369640000003000A5090000070000800B0000009C02000000800000050000805363684772696400D8270000D6EDFFFF737461666669640000003000A5090000070000800C0000009C020000008000000500008053636847726964002A5D000002EFFFFF757365727369640000003C00A50900000700008005000000B4020000008000001100008053636847726964007A0D00006E280000726571756573745F686973746F726965730000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100FEFF030A0000FFFFFFFF00000000000000000000000000000000170000004D6963726F736F66742044445320466F726D20322E300010000000456D626564646564204F626A6563740000000000F439B271000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000214334120800000041170000670F000078563412070000001401000063006100740061006C006F0067005F006200720061006E00630068006500730000000000000000000000000000000000540C3564540C35645C0C35645C0C3564680C3564680C3564740C3564740C3564800C3564800C3564A4C13364A4C13364B0C13364B0C13364BCC13364BCC133648C0C35648C0C3564C8C13364C8C13364980C3564980C3564A40C3564A40C3564B00C3564B00C3564D4C13364D4C13364BC0C3564BC0C3564C80C3564C80C3564D40C3564D40C3564E0C13364E0C13364ECC13364ECC13364F8C13364F8C13364E00C3564E00C3564EC0C3564EC0C356404C2336404C2336410C2336410C2000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A729000039160000000000002D010000070000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC07000046050000000000000100000041170000670F000000000000040000000400000002000000020000001C010000E60A00000000000001000000F21300009408000000000000020000000200000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000006A00000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F0000001100000063006100740061006C006F0067005F006200720061006E0063006800650073000000214334120800000041170000EC0C000078563412070000001401000063006100740061006C006F0067005F0070006F0073006900740069006F006E0073000000000000000000000000000000D0E15454D0E1545438E3545438E35454A4E25454A4E2545448E3545448E3545458E3545458E3545468E3545468E35454ACE25454ACE25454B4E25454B4E25454BCE25454BCE25454C4E25454C4E25454CCE25454CCE2545478E3545478E35454ECE25454ECE25454D4E25454D4E25454FCE25454FCE2545410E3545410E3545424E3545424E35454D8E15454D8E15454E4E15454E4E15454F0E15454F0E15454FCE15454FCE1545408E2545408E2545414E2545414E2545420E2545420E2000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A729000039160000000000002D010000070000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC07000046050000000000000100000041170000EC0C000000000000030000000300000002000000020000001C010000E60A00000000000001000000F21300009408000000000000020000000200000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000006C00000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F0000001200000063006100740061006C006F0067005F0070006F0073006900740069006F006E0073000000214334120800000041170000EC0C000078563412070000001401000063006100740061006C006F0067005F007A006F006E00650073000000B89A1F0F48A4FF0E0C0000000000000009000000000000000000000000010000000100000000000030E64F6A30E64F6A30E64F6A30E64F6A30E64F6A30E64F6AD401646A0C6F646A3427506A14B3506314B3506320B3506320B350632CB350632CB3506338B3506338B3506344B3506344B3506350B3506350B350635CB350635CB3506368B3506368B3506374B3506374B3506380B3506380B350638CB350638CB3506398B3506398B35063A4B35063A4B35063B0B35063B0B35063BCB35063BCB35063C8B35063C8B35063D4B35063D4B3000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A729000039160000000000002D010000070000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC07000046050000000000000100000041170000EC0C000000000000030000000300000002000000020000001C010000E60A00000000000001000000F21300009408000000000000020000000200000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000006400000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F0000000E00000063006100740061006C006F0067005F007A006F006E006500730000002143341208000000411700001737000078563412070000001401000072006500710075006500730074005F0063006C006F0073006500730000001F0FE0551E0F07000000000000000E0000000000000000000000000100000001000000000000A49C4F6AD401646AD49C4F6A5CB9666A380B691718C9636A20E64F6A5CB9666A6834691718C9636A20E64F6A5CB9666AD401646A6801646AC8176917E4176917E4176917F0176917F0176917141869171418691720186917201869172C1869172C1869173818691738186917541869175418691760186917601869176C1869176C18691780186917801869178C1869178C1869179818691798186917AC186917AC186917C8186917C818000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A7290000DD230000000000002D0100000D0000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC070000460500000000000001000000411700001737000000000000140000000C00000002000000020000001C010000E60A00000000000001000000F21300004E06000000000000010000000100000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000006600000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F0000000F00000072006500710075006500730074005F0063006C006F007300650073000000214334120800000041170000A62F000078563412070000001401000072006500710075006500730074005F006E006500770073000000720061006D002000460069006C00650073002000280078003800360029005C004D006900630072006F0073006F00660074002000530051004C0020005300650072007600650072005C003100320030005C0054006F006F006C0073005C00420069006E006E005C004D0061006E006100670065006D0065006E007400530074007500640069006F005C0054006F006F006C0073005C005600440054005C004400610074006100440065007300690067006E006500720073002E0064006C006C005C0032000000EC6D646AEC6D646AB068646AB068000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A7290000DD230000000000002D0100000D0000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC07000046050000000000000100000041170000A62F000000000000110000000C00000002000000020000001C010000E60A00000000000001000000F21300004E06000000000000010000000100000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000006200000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F0000000D00000072006500710075006500730074005F006E0065007700730000002143341208000000411700002132000078563412070000001401000072006500710075006500730074005F007400720061006E00730066006500720073000000E42B666AA089636AA089636AC4D0636AC4D0636AC42B666AC42B666AF42B666AF42B666A9C2B666A9C2B666ABC2B666ABC2B666A3CD1636A3CD1636A502B666A502B666AEC2B666AEC2B666A202B666A202B666A2C2B666A2C2B666A382B666A382B666A442B666A442B666A602B666A602B666A6C2B666A6C2B666A782B666A782B666A842B666A842B666A902B666A902B666AA42B666AA42B666AB02B666AB02B666ACC2B666ACC2B666AD82B666AD82B666AFC2B666AFC2B666A082C666A082C666A142C666A142C000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A7290000DD230000000000002D0100000D0000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC070000460500000000000001000000411700002132000000000000120000000C00000002000000020000001C010000E60A00000000000001000000F21300004E06000000000000010000000100000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000006C00000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F0000001200000072006500710075006500730074005F007400720061006E007300660065007200730000002143341208000000411700009C34000078563412070000001401000072006500710075006500730074005F00750070006400610074006500730000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A7290000DD230000000000002D0100000D0000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC070000460500000000000001000000411700009C34000000000000130000000C00000002000000020000001C010000E60A00000000000001000000F21300004E06000000000000010000000100000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000006800000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F0000001000000072006500710075006500730074005F0075007000640061007400650073000000214334120800000041170000E211000078563412070000001401000072006F006C0065005F007500730065007200730000001E0F0000000090621E0F70551E0F0800000000000000080000000000000000000000000100000001000000000000A49C4F6AD401646AD49C4F6A5CB9666A10B1646A1CB1646AD401646A6801646A10B1646A1CB1646AD401646A6801646A049B50630C9B50630C9B5063149B5063149B50631C9B50631C9B5063249B5063249B5063349B5063349B50633C9B50633C9B5063449B5063449B50634C9B50634C9B5063549B5063549B50635C9B50635C9B5063649B5063649B50636C9B50636C9B5063749B5063749B50637C9B50637C9B5063849B5063849B000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A729000039160000000000002D010000070000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC07000046050000000000000100000041170000E211000000000000050000000500000002000000020000001C010000E60A00000000000001000000F21300004E06000000000000010000000100000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000005E00000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F0000000B00000072006F006C0065005F00750073006500720073000000214334120800000041170000491E000078563412070000001401000072006F006C0065007300000000000000000000000000000000000000000000000000000000000000050000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000050000000000000000000000000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A729000097210000000000002D0100000C0000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC07000046050000000000000100000041170000491E0000000000000A0000000A00000002000000020000001C010000E60A00000000000001000000F21300009408000000000000020000000200000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000005400000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F0000000600000072006F006C0065007300000021433412080000004117000092390000785634120700000014010000730074006100660066000000000000000000000000000000000000000000000000000000000000000000000000000000DC5E646ADC5E646AE45E646AE45E646AEC5E646AEC5E646AF45E646AF45E646A845D646A845D646A0C5F646A0C5F646A8C5D646A8C5D646A985D646A985D646AA45D646AA45D646AB05D646AB05D646ABC5D646ABC5D646AC85D646AC85D646AD45D646AD45D646AE05D646AE05D646AEC5D646AEC5D646AF85D646AF85D646A045E646A045E646A105E646A105E646A70EA4F6A70EA4F6A1C5E646A1C5E646A285E646A285E646A345E646A345E646A405E646A405E646A4C5E646A4C5E000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A7290000DD230000000000002D0100000D0000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC070000460500000000000001000000411700009239000000000000150000000C00000002000000020000001C010000E60A00000000000001000000F21300004E06000000000000010000000100000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000005400000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F000000060000007300740061006600660000002143341208000000411700003F23000078563412070000001401000075007300650072007300000020006E0075006C006C00290020007400680065006E0020006E0075006C006C00200065006C0073006500200063006D0063002E00690073005F00700065007200730069007300740065006400200065006E0064002000610073002000690073005F007000650072007300690073007400650064002C0020006400650066004300730074002E0064006500660069006E006900740069006F006E002C00200043004F004C0055004D004E00500052004F0050004500520054005900280063006F006C002E006F0062006A006500630074005F00690064002C00200063006F006C002E00000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A7290000DD230000000000002D0100000D0000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC070000460500000000000001000000411700003F230000000000000C0000000C00000002000000020000001C010000E60A00000000000001000000F21300009408000000000000020000000200000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000005400000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F000000060000007500730065007200730000002143341208000000411700005D14000078563412070000001401000072006500710075006500730074005F0068006900730074006F00720069006500730000000A000000000000000C0000000000000000000000000100000001000000000000A49C4F6AD401646AD49C4F6A5CB9666A2038691718C9636A30E64F6A5CB9666A10B1646A1CB1646AD401646A6801646A049B50630C9B50630C9B5063149B5063149B50631C9B50631C9B5063249B5063249B5063349B5063349B50633C9B50633C9B5063449B5063449B50634C9B50634C9B5063549B5063549B50635C9B50635C9B5063649B5063649B50636C9B50636C9B5063749B5063749B50637C9B50637C9B5063849B5063849B000000000000000000000100000005000000540000002C0000002C0000002C000000340000000000000000000000A72900007F180000000000002D010000080000000C000000070000001C010000F708000053070000390300000B040000D0020000DD04000018060000A203000018060000BC070000460500000000000001000000411700005D14000000000000060000000600000002000000020000001C010000E60A00000000000001000000F21300004E06000000000000010000000100000002000000020000001C010000F70800000100000000000000F21300000804000000000000000000000000000002000000020000001C010000F7080000000000000000000055320000DD23000000000000000000000D00000004000000040000001C010000F70800009B0A00008106000078563412040000006C00000001000000010000000B000000000000000100000002000000030000000400000005000000060000000700000008000000090000000A00000004000000640062006F0000001200000072006500710075006500730074005F0068006900730074006F0072006900650073000000000000000300440064007300530074007200650061006D000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000160002000300000006000000FFFFFFFF00000000000000000000000000000000000000000000000000000000000000000000000016000000321900000000000053006300680065006D00610020005500440056002000440065006600610075006C0074000000000000000000000000000000000000000000000000000000000026000200FFFFFFFFFFFFFFFFFFFFFFFF000000000000000000000000000000000000000000000000000000000000000000000000100000001600000000000000440053005200450046002D0053004300480045004D0041002D0043004F004E00540045004E0054005300000000000000000000000000000000000000000000002C0002010500000007000000FFFFFFFF00000000000000000000000000000000000000000000000000000000000000000000000011000000500400000000000053006300680065006D00610020005500440056002000440065006600610075006C007400200050006F007300740020005600360000000000000000000000000036000200FFFFFFFFFFFFFFFFFFFFFFFF0000000000000000000000000000000000000000000000000000000000000000000000002300000012000000000000000C00000052E2FFFF19DEFFFF0100260000007300630068005F006C006100620065006C0073005F00760069007300690062006C0065000000010000000B0000001E000000000000000000000000000000000000006400000000000000000000000000000000000000000000000000010000000100000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C0031003600360035000000020000000200000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C0031003600360035000000030000000300000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C0031003600360035000000040000000400000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C0031003600360035000000050000000500000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C0031003600360035000000060000000600000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C0031003600360035000000070000000700000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C0031003600360035000000080000000800000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C0031003600360035000000090000000900000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C00310036003600350000000A0000000A00000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C00310036003600350000000B0000000B00000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C00310036003600350000000C0000000C00000000000000000000000000000000000000D00200000600280000004100630074006900760065005400610062006C00650056006900650077004D006F006400650000000100000008000400000031000000200000005400610062006C00650056006900650077004D006F00640065003A00300000000100000008003A00000034002C0030002C003200380034002C0030002C0032003200390035002C0031002C0031003800370035002C0035002C0031003200340035000000200000005400610062006C00650056006900650077004D006F00640065003A00310000000100000008001E00000032002C0030002C003200380034002C0030002C0032003700390030000000200000005400610062006C00650056006900650077004D006F00640065003A00320000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00330000000100000008001E00000032002C0030002C003200380034002C0030002C0032003200390035000000200000005400610062006C00650056006900650077004D006F00640065003A00340000000100000008003E00000034002C0030002C003200380034002C0030002C0032003200390035002C00310032002C0032003700310035002C00310031002C0031003600360035000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010003000000000000000C0000000B0000004E61BC00000000000000000000000000000000000000000000000000000000000000000000000000000000000000DBE6B0E91C81D011AD5100A0C90F573900000200F0E55352972DD601020200001048450000000000000000000000000000000000680100004400610074006100200053006F0075007200630065003D0048004100480041002D003600370039005C00530051004C0032003000310034003B0049006E0069007400690061006C00200043006100740061006C006F0067003D00440041004F003B0049006E00740065006700720061007400650064002000530065006300750072006900740079003D0054007200750065003B004D0075006C007400690070006C00650041006300740069007600650052006500730075006C00740053006500740073003D00460061006C00730065003B005000610063006B00650074002000530069007A0065003D0034003000390036003B004100700070006C00690063006100740069006F006E0020004E0061006D0065003D0022004D006900630072006F0073006F00660074002000530051004C00200053006500720076006500720020004D0061006E006100670065006D0065006E0074002000530074007500640069006F002200000000800500140000004400690061006700720061006D005F0030000000000226002200000063006100740061006C006F0067005F006200720061006E006300680065007300000008000000640062006F000000000226002400000063006100740061006C006F0067005F0070006F0073006900740069006F006E007300000008000000640062006F000000000226001C00000063006100740061006C006F0067005F007A006F006E0065007300000008000000640062006F000000000226001E00000072006500710075006500730074005F0063006C006F00730065007300000008000000640062006F000000000226002400000072006500710075006500730074005F0068006900730074006F007200690065007300000008000000640062006F000000000226001A00000072006500710075006500730074005F006E00650077007300000008000000640062006F000000000226002400000072006500710075006500730074005F007400720061006E0073006600650072007300000008000000640062006F000000000226002000000072006500710075006500730074005F007500700064006100740065007300000008000000640062006F000000000226001600000072006F006C0065005F0075007300650072007300000008000000640062006F000000000226000C00000072006F006C0065007300000008000000640062006F000000000226000C00000073007400610066006600000008000000640062006F000000000224000C00000075007300650072007300000008000000640062006F00000001000000D68509B3BB6BF2459AB8371664F0327008004E0000007B00310036003300340043004400440037002D0030003800380038002D0034003200450033002D0039004600410032002D004200360044003300320035003600330042003900310044007D000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010003000000000000000C0000000B000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000062885214);
COMMIT;

-- ----------------------------
-- Table structure for user_meta
-- ----------------------------
DROP TABLE IF EXISTS `user_meta`;
CREATE TABLE `user_meta` (
  `id` int NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_meta_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of user_meta
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for user_positions
-- ----------------------------
DROP TABLE IF EXISTS `user_positions`;
CREATE TABLE `user_positions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `position_id` int DEFAULT NULL,
  `position_sub_id` int DEFAULT NULL,
  `zone_id` int DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `created_by` int NOT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_positions_user_id_index` (`user_id`),
  KEY `user_positions_created_by_index` (`created_by`),
  KEY `user_positions_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of user_positions
-- ----------------------------
BEGIN;
INSERT INTO `user_positions` VALUES (4, 1, 1, 1, 2, 1, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (5, 5, 1, 1, 1, 1, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (6, 5, 1, 1, 3, 21, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (7, 13, 1, 1, 1, 3, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (8, 14, 1, 1, 9, 4, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (9, 14, 1, 1, 9, 5, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (10, 15, 3, 3, 1, 6, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (11, 16, 1, 1, 2, 7, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (12, 17, 3, 3, 1, 8, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (13, 18, 3, 3, 1, 6, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (14, 19, 2, 9, 2, 9, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (15, 20, 1, 1, 4, 10, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (16, 21, 1, 10, 3, NULL, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (17, 22, 1, 1, 2, 12, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (18, 22, 1, 1, 2, 13, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (19, 23, 1, 1, 1, 14, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (20, 24, 1, 1, 3, 15, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (21, 25, 1, 1, 2, 16, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (22, 26, 1, 1, 3, 17, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (23, 27, 1, 1, 2, 18, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (24, 28, 2, 11, 1, NULL, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (25, 29, 1, 1, 4, 20, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (26, 30, 1, 1, 3, 21, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (27, 31, 1, 1, 3, 22, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (28, 32, 1, 1, 3, 23, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (29, 32, 2, 2, 3, 23, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (30, 33, 1, 1, 2, 24, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (31, 33, 1, 1, 2, 25, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (32, 34, 1, 1, 3, 26, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (33, 35, 1, 1, 3, 27, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (34, 35, 1, 1, 3, 28, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (35, 36, 1, 1, 3, 29, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (36, 37, 1, 1, 3, 30, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (37, 38, 1, 1, 1, 31, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (38, 38, 2, 2, 1, 31, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (39, 39, 1, 1, 3, 32, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (40, 40, 1, 1, 1, 33, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (41, 41, 3, 3, 1, 34, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (42, 42, 1, 2, 1, 35, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (43, 42, 2, 2, 1, 35, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (44, 43, 1, 1, 1, 36, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (45, 44, 1, 1, 1, 6, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (46, 45, 2, 2, 2, 7, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (47, 46, 3, 3, 2, 9, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (48, 47, 1, 1, 2, 37, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (49, 48, 2, NULL, 2, 9, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (50, 49, 1, 1, 2, 38, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (51, 50, 1, 1, 2, 39, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (52, 50, 2, 2, 2, 39, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (53, 51, 1, 1, 3, 40, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (54, 52, 1, 1, 2, 41, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (55, 53, 2, 11, 2, NULL, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (56, 54, 2, 2, 2, 29, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (57, 55, 2, 11, 2, 42, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (58, 56, 1, 1, 2, 43, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (59, 56, 2, 2, 2, 43, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (60, 57, 1, 1, 2, 44, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (61, 57, 2, 2, 2, 44, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (62, 58, 1, 1, 3, 45, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (63, 59, 2, 2, 4, 46, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (64, 60, 1, 1, 4, 47, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (65, 61, 1, 1, 4, 48, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (66, 62, 2, 2, 4, 47, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (67, 63, 1, 1, 4, NULL, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (68, 64, 4, 4, 2, 1, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (69, 65, 4, 4, 2, 1, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (70, 66, 5, 5, 2, 1, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (71, 67, 4, 4, 3, 2, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (72, 68, 6, 6, 1, 3, 1, NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05');
INSERT INTO `user_positions` VALUES (73, 69, 7, 7, 1, 3, 1, NULL, NULL, NULL);
INSERT INTO `user_positions` VALUES (74, 70, 5, 7, 1, 3, 1, NULL, NULL, NULL);
INSERT INTO `user_positions` VALUES (75, 71, 4, 4, 3, 2, 1, NULL, NULL, NULL);
INSERT INTO `user_positions` VALUES (76, 72, 6, 6, 3, 2, 1, NULL, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `permissions` longtext COLLATE utf8mb4_general_ci,
  `last_login` datetime DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar_id` int DEFAULT NULL,
  `super_user` tinyint NOT NULL,
  `manage_supers` tinyint NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dao` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `staff_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'dev@vpbank.com.vn', '$2y$10$7cWtzkjUFTfR5gcrHzwDSeH3iwYE0wxdjRIePV73y4aN4reAnvGqO', 'lky8KxKvdlsssAHF960zSrfIZbXdItQF7ZrskfbpRhiTtRsKM753FcDzBucq', '2020-01-15 08:02:05', '2020-11-25 16:59:31', NULL, '2020-11-25 23:59:31', 'System Admin', 8, 1, 1, 'chinh_thuc', NULL, NULL, NULL);
INSERT INTO `users` VALUES (2, 'huongtt50@vpbank.com.vn', '$2y$10$r/5eQpT3zlSmzHyJTXqCMuM1asf2Sqn51KE4VBt2JtQCIKCd1kEbO', 'FSQXuxaRCFVK4wsFw0Qrhv5kFpLDHLOkVFvlYLo1dHY8sNv0tWgJpV1WJ3dv', '2020-01-15 08:02:05', '2020-10-28 09:09:08', '{\"customer.index\":true,\"customer.create\":true,\"customer.edit\":true,\"customer.destroy\":true,\"hr.index\":true,\"hr.create\":true,\"hr.edit\":true,\"hr.destroy\":true,\"request-history.index\":true,\"request-history.create\":true,\"request-history.edit\":true,\"request-history.destroy\":true,\"catalog.index\":true,\"catalog-position.index\":true,\"catalog-position.create\":true,\"catalog-position.edit\":true,\"catalog-position.destroy\":true,\"catalog-zone.index\":true,\"catalog-zone.create\":true,\"catalog-zone.edit\":true,\"catalog-zone.destroy\":true,\"catalog-branch.index\":true,\"catalog-branch.create\":true,\"catalog-branch.edit\":true,\"catalog-branch.destroy\":true,\"core.system\":true,\"users.index\":true,\"users.create\":true,\"users.edit\":true,\"users.destroy\":true,\"users.impersonate\":true,\"roles.index\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.destroy\":true,\"settings.options\":true,\"settings.email\":true,\"user-position.index\":true,\"user-position.create\":true,\"user-position.edit\":true,\"user-position.destroy\":true,\"request-transfer.index\":true,\"request-transfer.all\":true,\"request-transfer.create\":true,\"request-transfer.edit\":true,\"request-transfer.destroy\":true,\"request-transfer.receive\":true,\"request-transfer.reject\":true,\"request-transfer.it-process\":true,\"request-transfer.gdcn-approve\":true,\"request-transfer.hoiso-approve\":true,\"request-transfer.success\":true,\"request-update.index\":true,\"request-update.all\":true,\"request-update.create\":true,\"request-update.edit\":true,\"request-update.destroy\":true,\"request-update.receive\":true,\"request-update.reject\":true,\"request-update.it-process\":true,\"request-update.gdcn-approve\":true,\"request-update.hoiso-approve\":true,\"request-update.success\":true,\"request-new.index\":true,\"request-new.all\":true,\"request-new.create\":true,\"request-new.edit\":true,\"request-new.destroy\":true,\"request-new.receive\":true,\"request-new.reject\":true,\"request-new.it-process\":true,\"request-new.gdcn-approve\":true,\"request-new.hoiso-approve\":true,\"request-new.success\":true,\"request-close.index\":true,\"request-close.all\":true,\"request-close.create\":true,\"request-close.edit\":true,\"request-close.destroy\":true,\"request-close.receive\":true,\"request-close.reject\":true,\"request-close.it-process\":true,\"request-close.gdcn-approve\":true,\"request-close.hoiso-approve\":true,\"request-close.success\":true,\"superuser\":true,\"manage_supers\":true}', '2020-10-28 16:09:08', 'Trần Hương', NULL, 1, 1, 'chinh_thuc', NULL, NULL, NULL);
INSERT INTO `users` VALUES (3, 'cbbh@gmail.com', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', 'WGZtUxvl4WOMOidw7KIZad5Qu4k4GeBZFJtzQXIP0FQ0iIXI4sWjKetZa9uQ', '2020-01-15 08:02:05', '2020-07-02 08:06:33', '{\"customer.index\":true,\"customer.create\":true,\"request-transfer.index\":true,\"request-transfer.create\":true,\"request-transfer.tiep_nhan\":true,\"superuser\":\"0\",\"manage_supers\":\"0\"}', '2020-01-15 15:08:29', 'Cán bộ bán bàng', NULL, 0, 0, 'chinh_thuc', NULL, NULL, NULL);
INSERT INTO `users` VALUES (4, 'cbql@gmail.com', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-06-05 02:50:09', '{\"customer.index\":true,\"request-transfer.index\":true,\"request-transfer.create\":true,\"request-new.index\":true,\"request-new.create\":true,\"request-close.index\":true,\"request-close.create\":true,\"superuser\":\"0\",\"manage_supers\":\"0\"}', NULL, 'Cán bộ quản lý', NULL, 0, 0, 'chinh_thuc', NULL, NULL, NULL);
INSERT INTO `users` VALUES (5, 'gdcn@gmail.com', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-07-02 08:06:21', '{\"customer.index\":true,\"customer.create\":true,\"hr.index\":true,\"hr.new-user\":true,\"hr.cbbh\":true,\"request-transfer.index\":true,\"request-transfer.all\":true,\"request-transfer.create\":true,\"request-transfer.edit\":true,\"request-transfer.destroy\":true,\"request-transfer.tiep_nhan\":true,\"request-transfer.tu_choi\":true,\"request-transfer.gdcn_duyet\":true,\"superuser\":\"0\",\"manage_supers\":\"0\"}', NULL, 'Giám đốc chi nhánh', NULL, 0, 0, 'chinh_thuc', NULL, NULL, NULL);
INSERT INTO `users` VALUES (6, 'cbcb@gmail.com', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-06-05 03:06:05', '{\"customer.index\":true,\"request-history.index\":true,\"request-history.create\":true,\"request-transfer.index\":true,\"request-transfer.all\":true,\"request-transfer.create\":true,\"request-update.index\":true,\"request-update.all\":true,\"request-update.create\":true,\"request-new.index\":true,\"request-close.index\":true,\"superuser\":\"0\",\"manage_supers\":\"0\"}', NULL, 'Cán bộ chuyên biệt', NULL, 0, 0, 'chinh_thuc', NULL, NULL, NULL);
INSERT INTO `users` VALUES (12, 'hoangnam@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN HOANG NAM', NULL, 0, 0, 'chinh_thuc', '', '112', NULL);
INSERT INTO `users` VALUES (13, 'longdd@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'DO DUC LONG', NULL, 0, 0, 'chinh_thuc', '', '182', NULL);
INSERT INTO `users` VALUES (14, 'phuocth@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'TRAN HUU PHUOC', NULL, 0, 0, 'chinh_thuc', '', '191', NULL);
INSERT INTO `users` VALUES (15, 'khanhly@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN THI KHANH LY', NULL, 0, 0, 'chinh_thuc', '', '507', NULL);
INSERT INTO `users` VALUES (16, 'trungvan@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'TRAN TRUNG VĂN', NULL, 0, 0, 'chinh_thuc', '', '522', NULL);
INSERT INTO `users` VALUES (17, 'chinhha@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'PHAM THI CHINH HA', NULL, 0, 0, 'chinh_thuc', '', '530', NULL);
INSERT INTO `users` VALUES (18, 'minhvu@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'VU MINH', NULL, 0, 0, 'chinh_thuc', '', '568', NULL);
INSERT INTO `users` VALUES (19, 'ngocan@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'KIEU NGOC AN', NULL, 0, 0, 'chinh_thuc', '', '577', NULL);
INSERT INTO `users` VALUES (20, 'quyetds@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-07-02 08:06:21', '{\"customer.index\":true,\"customer.create\":true,\"hr.index\":true,\"hr.new-user\":true,\"hr.cbbh\":true,\"request-transfer.index\":true,\"request-transfer.all\":true,\"request-transfer.create\":true,\"request-transfer.edit\":true,\"request-transfer.destroy\":true,\"request-transfer.tiep_nhan\":true,\"request-transfer.tu_choi\":true,\"request-transfer.gdcn_duyet\":true,\"superuser\":\"0\",\"manage_supers\":\"0\"}', NULL, 'DAU SY QUYET', NULL, 0, 0, 'chinh_thuc', '', '621', NULL);
INSERT INTO `users` VALUES (22, 'hiennt2@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN THU HIEN', NULL, 0, 0, 'chinh_thuc', '', '638', NULL);
INSERT INTO `users` VALUES (23, 'diennt@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGO THI DIEN', NULL, 0, 0, 'chinh_thuc', '', '656', NULL);
INSERT INTO `users` VALUES (24, 'phuongnt@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN THI PHUONG', NULL, 0, 0, 'chinh_thuc', '', '670', NULL);
INSERT INTO `users` VALUES (25, 'thuongnb@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN BA THUONG', NULL, 0, 0, 'chinh_thuc', '', '702', NULL);
INSERT INTO `users` VALUES (26, 'tranminh@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'TRAN MINH', NULL, 0, 0, 'chinh_thuc', '', '712', NULL);
INSERT INTO `users` VALUES (27, 'honghanh@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'TRAN THI HONG HANH', NULL, 0, 0, 'chinh_thuc', '', '737', NULL);
INSERT INTO `users` VALUES (28, 'nganle@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'LE THI NGAN', NULL, 0, 0, 'chinh_thuc', '', '753', NULL);
INSERT INTO `users` VALUES (29, 'dinhthuc@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN DINH THUC', NULL, 0, 0, 'chinh_thuc', '', '756', NULL);
INSERT INTO `users` VALUES (30, 'phuongdm@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'DU MINH PHUONG', NULL, 0, 0, 'chinh_thuc', '', '757', NULL);
INSERT INTO `users` VALUES (31, 'hungnguyem@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN MANH HUNG', NULL, 0, 0, 'chinh_thuc', '', '763', NULL);
INSERT INTO `users` VALUES (32, 'thuquynh@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGO THI THU QUYNH', NULL, 0, 0, 'chinh_thuc', '', '766', NULL);
INSERT INTO `users` VALUES (33, 'hoanganhphuong@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'HOANG ANH PHUONG', NULL, 0, 0, 'chinh_thuc', '', '775', NULL);
INSERT INTO `users` VALUES (34, 'dungdt@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'DINH TIEN DUNG', NULL, 0, 0, 'chinh_thuc', '', '784', NULL);
INSERT INTO `users` VALUES (35, 'phuongtq@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'TRAN QUOC PHONG', NULL, 0, 0, 'chinh_thuc', '', '786', NULL);
INSERT INTO `users` VALUES (36, 'hoangtv@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'TRAN VAN HOANG', NULL, 0, 0, 'chinh_thuc', '', '800', NULL);
INSERT INTO `users` VALUES (37, 'anhbq@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'BUI HOANG ANH', NULL, 0, 0, 'chinh_thuc', '', '831', NULL);
INSERT INTO `users` VALUES (38, 'huongtran@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'TRAN THI THANH HUONG', NULL, 0, 0, 'chinh_thuc', '', '839', NULL);
INSERT INTO `users` VALUES (39, 'thuyt46@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'TRAN THANH HUY', NULL, 0, 0, 'chinh_thuc', '', '844', NULL);
INSERT INTO `users` VALUES (40, 'quynhltn@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'LE THI NHU QUYNH', NULL, 0, 0, 'chinh_thuc', '', '854', NULL);
INSERT INTO `users` VALUES (41, 'hantt4@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN THI THU HA', NULL, 0, 0, 'chinh_thuc', '', '876', NULL);
INSERT INTO `users` VALUES (42, 'thangtx@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'TRINH XUAN THANG', NULL, 0, 0, 'chinh_thuc', '', '888', NULL);
INSERT INTO `users` VALUES (43, 'dieutrang@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN DIEU TRANG', NULL, 0, 0, 'chinh_thuc', '', '900', NULL);
INSERT INTO `users` VALUES (44, 'cuongdv1@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'DINH VIET CUONG', NULL, 0, 0, 'chinh_thuc', '', '913', NULL);
INSERT INTO `users` VALUES (45, 'phamduc@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'PHAM MINH DUC', NULL, 0, 0, 'chinh_thuc', '', '970', NULL);
INSERT INTO `users` VALUES (46, 'haikien@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'BUI HAI KIEN', NULL, 0, 0, 'chinh_thuc', '', '978', NULL);
INSERT INTO `users` VALUES (47, 'hahuong@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN THI HUONG', NULL, 0, 0, 'chinh_thuc', '', '1007', NULL);
INSERT INTO `users` VALUES (48, 'hoangdx@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'DONG XUAN HOANG', NULL, 0, 0, 'chinh_thuc', '', '1011', NULL);
INSERT INTO `users` VALUES (49, 'phungvuong@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'PHUNG VUONG', NULL, 0, 0, 'chinh_thuc', '', '1043', NULL);
INSERT INTO `users` VALUES (50, 'anhnk@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN THI KIEU ANH', NULL, 0, 0, 'chinh_thuc', '', '1084', NULL);
INSERT INTO `users` VALUES (51, 'danghai@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN DANG HAI', NULL, 0, 0, 'chinh_thuc', '', '1085', NULL);
INSERT INTO `users` VALUES (52, 'thedan@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN THE DAN', NULL, 0, 0, 'chinh_thuc', '', '1086', NULL);
INSERT INTO `users` VALUES (53, 'thuongnv@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN VAN THUONG', NULL, 0, 0, 'chinh_thuc', '', '1087', NULL);
INSERT INTO `users` VALUES (54, 'phuclv@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'LE VAN PHUC', NULL, 0, 0, 'chinh_thuc', '', '1088', NULL);
INSERT INTO `users` VALUES (55, 'trangpt@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'PHAM THI TRANG', NULL, 0, 0, 'chinh_thuc', '', '1090', NULL);
INSERT INTO `users` VALUES (56, 'phuonghv@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'HOANG VAN PHUONG', NULL, 0, 0, 'chinh_thuc', '', '1109', NULL);
INSERT INTO `users` VALUES (57, 'longnb@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN BA LONG', NULL, 0, 0, 'chinh_thuc', '', '1121', NULL);
INSERT INTO `users` VALUES (58, 'lcson@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'LE CONG SON', NULL, 0, 0, 'chinh_thuc', '', '1143', NULL);
INSERT INTO `users` VALUES (59, 'yenpt1@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-07-02 08:06:21', '{\"customer.index\":true,\"customer.create\":true,\"hr.index\":true,\"hr.new-user\":true,\"hr.cbbh\":true,\"request-transfer.index\":true,\"request-transfer.all\":true,\"request-transfer.create\":true,\"request-transfer.edit\":true,\"request-transfer.destroy\":true,\"request-transfer.tiep_nhan\":true,\"request-transfer.tu_choi\":true,\"request-transfer.gdcn_duyet\":true,\"superuser\":\"0\",\"manage_supers\":\"0\"}', NULL, 'PHAM THI YEN', NULL, 0, 0, 'chinh_thuc', '', '1159', NULL);
INSERT INTO `users` VALUES (60, 'bacnv02@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN VAN BAC', NULL, 0, 0, 'chinh_thuc', '', '1160', NULL);
INSERT INTO `users` VALUES (61, 'dangson@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'DANG THANH SON', NULL, 0, 0, 'chinh_thuc', '', '1161', NULL);
INSERT INTO `users` VALUES (62, 'trungnk@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGO KIEN TRUNG', NULL, 0, 0, 'chinh_thuc', '', '1171', NULL);
INSERT INTO `users` VALUES (63, 'tungdt2@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'DONG THANH TUNG', NULL, 0, 0, 'chinh_thuc', '', '1175', NULL);
INSERT INTO `users` VALUES (64, 'nhink12@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN KIEU NHI', NULL, 0, 0, 'chinh_thuc', '19868', '17626', NULL);
INSERT INTO `users` VALUES (65, 'huyenptt21@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'PHAM THI THANH HUYEN', NULL, 0, 0, 'chinh_thuc', '25115', '17627', NULL);
INSERT INTO `users` VALUES (66, 'thanhnt20@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'NGUYEN TUAN THANH', NULL, 0, 0, 'chinh_thuc', '23627', '117629', NULL);
INSERT INTO `users` VALUES (67, 'loannt15@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-06-05 03:06:05', '{\"customer.index\":true,\"request-history.index\":true,\"request-history.create\":true,\"request-transfer.index\":true,\"request-transfer.all\":true,\"request-transfer.create\":true,\"request-update.index\":true,\"request-update.all\":true,\"request-update.create\":true,\"request-new.index\":true,\"request-close.index\":true,\"superuser\":\"0\",\"manage_supers\":\"0\"}', NULL, 'NGUYEN THI LOAN', NULL, 0, 0, 'chinh_thuc', '23561', '17635', NULL);
INSERT INTO `users` VALUES (68, 'trangttt22@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'THAN THI THU TRANG', NULL, 0, 0, 'chinh_thuc', '22515', '17954', NULL);
INSERT INTO `users` VALUES (69, 'trangptk2@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-01-15 08:02:05', NULL, NULL, 'PHAN THI KIEU TRANG', NULL, 0, 0, 'cong_tac_vien', '10572', '18225', NULL);
INSERT INTO `users` VALUES (70, 'loannt17@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-06-05 03:06:05', '{\"customer.index\":true,\"request-history.index\":true,\"request-history.create\":true,\"request-transfer.index\":true,\"request-transfer.all\":true,\"request-transfer.create\":true,\"request-update.index\":true,\"request-update.all\":true,\"request-update.create\":true,\"request-new.index\":true,\"request-close.index\":true,\"superuser\":\"0\",\"manage_supers\":\"0\"}', NULL, 'NGUYEN TO LOAN', NULL, 0, 0, 'chinh_thuc', '12222', '18222', NULL);
INSERT INTO `users` VALUES (71, 'vinhhn@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-01-15 08:02:05', '2020-07-02 08:06:21', '{\"customer.index\":true,\"customer.create\":true,\"hr.index\":true,\"hr.new-user\":true,\"hr.cbbh\":true,\"request-transfer.index\":true,\"request-transfer.all\":true,\"request-transfer.create\":true,\"request-transfer.edit\":true,\"request-transfer.destroy\":true,\"request-transfer.tiep_nhan\":true,\"request-transfer.tu_choi\":true,\"request-transfer.gdcn_duyet\":true,\"superuser\":\"0\",\"manage_supers\":\"0\"}', NULL, 'HOANG NGOC VINH', NULL, 0, 0, 'cong_tac_vien', '17394', '18737', NULL);
INSERT INTO `users` VALUES (72, 'huongpt12@vpbank.com', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', 'sB7xi8G1iWl9KfytZMvxZ1Dyq0Ud3oxRjYNtAIBiZBDNGP3cQlqkOFx1jacC', '2020-01-15 08:02:05', '2020-07-02 08:06:33', '{\"customer.index\":true,\"customer.create\":true,\"request-transfer.index\":true,\"request-transfer.create\":true,\"request-transfer.tiep_nhan\":true,\"superuser\":\"0\",\"manage_supers\":\"0\"}', '2020-07-02 14:42:31', 'PHAM THI HUONG', NULL, 0, 0, 'cong_tac_vien', '10126', '18813', NULL);
INSERT INTO `users` VALUES (73, 'huongtt7@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-05-24 16:51:07', '2020-05-24 16:51:07', NULL, NULL, 'huongtt7', NULL, 0, 0, NULL, NULL, 'q3456', NULL);
INSERT INTO `users` VALUES (74, 'chidm2@vpbank.com.vn', '$2y$10$.d4CDWudhU6dC6uWqZsWEuDxEgUJV68d2qvBs4RKOpPqlXvopDWDy', NULL, '2020-05-24 16:55:23', '2020-05-24 16:55:23', NULL, NULL, 'doan mai chi', NULL, 0, 0, NULL, NULL, '28928', NULL);
INSERT INTO `users` VALUES (83, 'abc@vpbank.com.vn', '123456', NULL, '2020-06-03 08:25:27', '2020-06-03 08:25:27', NULL, NULL, 'Ha Hoang', NULL, 0, 0, NULL, NULL, '12312', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
