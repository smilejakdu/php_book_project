/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`calender` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `calender`;

/*Table structure for table `t_holiday` */

DROP TABLE IF EXISTS `t_holiday`;

CREATE TABLE `t_holiday` (
  `h_date` varchar(10) DEFAULT NULL COMMENT '공휴일 날짜',
  `h_name` varchar(30) DEFAULT NULL COMMENT '공휴일 이름',
  `h_year` varchar(10) DEFAULT NULL COMMENT '공휴일 적용 연도'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `t_holiday` */

insert  into `t_holiday`(`h_date`,`h_name`,`h_year`) values 
('0905','test1','2019'),
('0906','test2','2019'),
('1006','test3','2020'),
('1107','test4','2019');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
