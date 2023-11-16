-- --------------------------------------------------------
-- 主机:                           192.168.133.128
-- 服务器版本:                        11.1.2-MariaDB-1:11.1.2+maria~ubu2204 - mariadb.org binary distribution
-- 服务器操作系统:                      debian-linux-gnu
-- HeidiSQL 版本:                  11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- 导出 db_test 的数据库结构
DROP DATABASE IF EXISTS `db_test`;
CREATE DATABASE IF NOT EXISTS `db_test` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_test`;

-- 导出  表 db_test.tb_message 结构
DROP TABLE IF EXISTS `tb_message`;
CREATE TABLE IF NOT EXISTS `tb_message` (
  `cl_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cl_title` varchar(100) NOT NULL,
  `cl_content` text NOT NULL,
  `cl_author` varchar(40) NOT NULL,
  `cl_file` varchar(40) DEFAULT NULL,
  `cl_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`cl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  db_test.tb_message 的数据：~4 rows (大约)
DELETE FROM `tb_message`;
/*!40000 ALTER TABLE `tb_message` DISABLE KEYS */;
INSERT INTO `tb_message` (`cl_id`, `cl_title`, `cl_content`, `cl_author`, `cl_file`, `cl_date`) VALUES
	(1, 'test——留言', '留言0.0', 'chameleon', 'uploads/图片1.png', '2023-11-16 01:06:15'),
	(2, 'test2', '', 'chameleon', '', '2023-11-16 01:06:24'),
	(3, 'test123留言', '留言板123', 'chameleon', 'uploads/图片3.png', '2023-11-16 01:06:52'),
	(4, '来留言吧', '留言留言\r\n', 'root', 'uploads/图片2.png', '2023-11-16 01:07:42');
/*!40000 ALTER TABLE `tb_message` ENABLE KEYS */;

-- 导出  表 db_test.tb_user 结构
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE IF NOT EXISTS `tb_user` (
  `cl_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cl_user` varchar(50) NOT NULL,
  `cl_pass` varchar(50) NOT NULL,
  `cl_confirm` varchar(50) NOT NULL,
  `cl_protect` int(11) NOT NULL,
  `cl_avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  db_test.tb_user 的数据：~2 rows (大约)
DELETE FROM `tb_user`;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`cl_id`, `cl_user`, `cl_pass`, `cl_confirm`, `cl_protect`, `cl_avatar`) VALUES
	(1, 'chameleon', '123', '123', 123, 'uploads/图片5.png'),
	(2, 'root', 'root', 'root', 123, 'uploads/11.png');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
