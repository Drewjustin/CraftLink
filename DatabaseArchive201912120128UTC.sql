CREATE DATABASE  IF NOT EXISTS `CraftLink` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `CraftLink`;
-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: CraftLink
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `product_dscpt` varchar(1024) DEFAULT NULL,
  `product_inStock` tinyint(1) NOT NULL DEFAULT '1',
  `product_price` int(10) unsigned DEFAULT NULL,
  `product_createTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `product_unitInWhichSold` varchar(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_id_UNIQUE` (`product_id`),
  KEY `supplier_id_fk_idx` (`supplier_id`),
  CONSTRAINT `supplier_id_fk` FOREIGN KEY (`supplier_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (0,0,'Bud Roots','This is a classic brew, low in calories, high in flavor! No rootbeer can match the hops in Bud Root without giving you a serious sugar high',1,2299,'2019-12-03 01:38:50','36 case'),(1,0,'Root Beer Deluxe','Classic Deluxe Flavor',1,1145,'2019-11-25 00:02:09','bulk'),(2,0,'Peach Brews','Peachy root beer',0,999,'2019-11-30 18:48:27','bulk'),(3,5,'Vanilla Root Beer','Root Beer with virgin vanilla extract',1,699,'2019-11-28 03:10:41','6 case'),(4,5,'Rooty Roots','Root Beer',1,1199,'2019-12-02 20:36:45','bulk'),(5,6,'Long Roots','This crafted masterpiece has the perfect balance of sweet yet savory flavor. Limited stock use promo code WEBSYS for 50% off ',1,1000,'2019-12-03 00:52:50','Gallons'),(260,6,'Root Beer','root beer',0,1099,'2019-12-03 06:32:48','12 case'),(262,6,'Rooty Tooty','The Good Stuff',1,1000,'2019-12-03 17:05:08','Bulk'),(263,5,'Apple Root Beer','Root Beer with Adam\'s Apples',0,1149,'2019-12-03 18:28:24','12 case'),(265,39,'SISMAN','Great',1,7400000,'2019-12-03 20:22:39','Bulk'),(266,44,'Big Root Beer','Big Root Beer!!!',1,1000,'2019-12-12 01:23:23','12 case'),(267,44,'Peach Root Beer','Peachy',1,1000,'2019-12-12 01:25:13','6 case');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `transaction_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `product_quantity` int(8) DEFAULT '1',
  PRIMARY KEY (`transaction_id`),
  UNIQUE KEY `transaction_id_UNIQUE` (`transaction_id`),
  KEY `fk_custome_id_idx` (`customer_id`),
  KEY `fk_product_id_idx` (`product_id`),
  KEY `fk_supplier_id_idx` (`supplier_id`),
  CONSTRAINT `fk_custome_id` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(16) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `passwordhash` varchar(64) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `phonenumber` varchar(45) DEFAULT NULL,
  `issupplier` tinyint(1) unsigned zerofill NOT NULL,
  `businessname` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('fakeUsr','websys.CftLnk@rpi.edu','loremipsum','2019-11-24 23:50:35',0,'58517516',1,'Fake Brewers'),('Steve','a@a.a','password123','2019-12-02 18:27:32',1,'546-847-5436',0,'Steve\'s'),('admin1','admin@admin.com','admin123','2019-12-02 19:16:33',3,'111-222-1234',0,'CraftLink'),('test','test@test.com','test','2019-12-02 21:39:39',4,'000-000-0000',0,'Test Business'),('supplier2','xux8@rpi.edu','loremipsum','2019-12-03 03:37:47',5,'518-000-0000',1,'Adam\'s Apples'),('supplier1','alexwenzhenhe@gmail.com','supplier123','2019-12-03 05:30:18',6,'609-819-1937',1,'Alex\'s Root Beers'),('asdf','alexwenzhenhe@gmail.com','asdf','2019-12-03 18:50:54',38,'111-111-1111',1,NULL),('shirley','a@aol.com','password','2019-12-03 20:21:55',39,'111-111-1111',1,NULL),('testhash','hash@hashme.com','61e2c44f3d461d90c4cee15b3e325d4163a0f144df55711272536a391943b681','2019-12-11 04:58:13',40,'123-456-7891',0,NULL),('brewer','brewer@brewer.com','299ac625029687f80c186459d6dfec620fe2df74e948fac460fcc32c5daa2a4a','2019-12-11 06:00:31',41,'123-456-1234',0,NULL),('barroot','bar@isconsumer.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','2019-12-11 06:19:30',42,'123-456-1234',0,NULL),('testSUP','password123456789@security.com','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225','2019-12-11 08:03:13',43,'123-456-7890',1,NULL),('supplier123','alexwenzhenhe@gmail.com','fe64f70054eb770bd151d84bf4425b356f6ba30d52c8958b65afefcdb4e02425','2019-12-12 01:13:55',44,'609-819-1937',1,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-11 20:29:07
