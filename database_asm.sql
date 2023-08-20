-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: asm_php_1
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_items` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_price` decimal(13,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int unsigned NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_items_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_product`
--

DROP TABLE IF EXISTS `cat_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_product` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_product`
--

LOCK TABLES `cat_product` WRITE;
/*!40000 ALTER TABLE `cat_product` DISABLE KEYS */;
INSERT INTO `cat_product` VALUES (1,'Men'),(2,'Women'),(17,'Women 2'),(29,'Man 2'),(30,'Men 16123'),(31,'Men 2'),(36,'Man');
/*!40000 ALTER TABLE `cat_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `address` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` char(10) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(13,0) NOT NULL,
  `note` text COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`order_id`),
  KEY `fk_orders_users` (`user_id`),
  KEY `fk_orders_products` (`product_id`),
  CONSTRAINT `fk_orders_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (34,'2023-08-04 15:59:48',6,'Nguyen Van Tin','ajkdhsl','0905085920',1,26,1,419264,'asdasd'),(35,'2023-08-04 16:35:29',6,'Nguyen Van Tin','0982341','09107404',1,26,1,419264,''),(36,'2023-08-04 16:36:30',6,'Nguyen Van Tin','072334','09140',1,24,1,1094761982,'0823'),(37,'2023-08-04 16:39:34',6,'Nguyen Van Tin','702589',')92580',1,26,1,419264,'082384al'),(38,'2023-08-04 16:41:07',6,'Nguyen Van Tin','802034','9458610',1,26,1,419264,'18932a'),(39,'2023-08-04 17:53:50',6,'Nguyen Van Tin','982630745','89174098',1,26,1,419264,'-725-341'),(41,'2023-08-05 00:09:37',6,'Son','90 - Nguyên Xuân Nguyên','0905085920',1,26,6,2515584,''),(42,'2023-08-05 00:17:08',6,'Nguyen Van Tin','90 - Nguyen Xuan Nguyen','0905085920',1,24,1,1094761982,'Khong'),(43,'2023-08-05 08:15:58',6,'Nguyen Van Tin','bguyt46al','18946091',1,33,1,58369502,'uigahosldugsdoqw'),(44,'2023-08-05 09:49:48',6,'Nguyen Van Tin','kasdygasd',')905085920',1,26,1,419264,'aksgdasdhgasd'),(45,'2023-08-05 09:55:21',5,'Nguyen Van Tin','dhaskdg','0905085920',1,26,1,419264,'djahsldas'),(46,'2023-08-05 09:59:52',5,'Nguyen Van Tin','8963401','18267028',1,26,1,419264,'12412412412412'),(47,'2023-08-05 10:03:34',6,'Nguyen Van Tin','fsfgkjhafs','0905085920',1,26,4,1677056,'khdfsdhfsgdk');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processed_order`
--

DROP TABLE IF EXISTS `processed_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `processed_order` (
  `processed_id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `status` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` char(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(13,0) NOT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `order_id` int NOT NULL,
  PRIMARY KEY (`processed_id`),
  KEY `fk_orders_users` (`user_id`),
  KEY `fk_orders_products` (`product_id`),
  CONSTRAINT `fk_pr_order_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pr_order_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processed_order`
--

LOCK TABLES `processed_order` WRITE;
/*!40000 ALTER TABLE `processed_order` DISABLE KEYS */;
INSERT INTO `processed_order` VALUES (1,'2023-08-05 08:15:58',5,'Nguyen Van Tin','bguyt46al','18946091',1,33,1,58369502,'uigahosldugsdoqw',43),(2,'2023-08-05 08:15:58',5,'Nguyen Van Tin','bguyt46al','18946091',1,33,1,58369502,'uigahosldugsdoqw',43),(3,'2023-08-05 08:15:58',5,'Nguyen Van Tin','bguyt46al','18946091',1,33,1,58369502,'uigahosldugsdoqw',43),(4,'2023-08-05 00:17:08',5,'Nguyen Van Tin','90 - Nguyen Xuan Nguyen','0905085920',1,24,1,1094761982,'Khong',42),(5,'2023-08-04 15:59:48',0,'Nguyen Van Tin','ajkdhsl','0905085920',1,26,1,419264,'asdasd',34),(6,'2023-08-04 16:35:29',5,'Nguyen Van Tin','0982341','09107404',1,26,1,419264,'',35),(7,'2023-08-04 16:36:30',0,'Nguyen Van Tin','072334','09140',1,24,1,1094761982,'0823',36),(8,'2023-08-04 16:41:07',5,'Nguyen Van Tin','802034','9458610',1,26,1,419264,'18932a',38),(9,'2023-08-05 00:09:37',5,'Son','90 - Nguyên Xuân Nguyên','0905085920',1,26,6,2515584,'',41),(10,'2023-08-04 17:53:50',0,'Nguyen Van Tin','982630745','89174098',1,26,1,419264,'-725-341',39),(11,'2023-08-05 09:49:48',5,'Nguyen Van Tin','kasdygasd',')905085920',1,26,1,419264,'aksgdasdhgasd',44),(12,'2023-08-04 16:39:34',0,'Nguyen Van Tin','702589',')92580',1,26,1,419264,'082384al',37),(13,'2023-08-05 10:03:34',5,'Nguyen Van Tin','fsfgkjhafs','0905085920',1,26,4,1677056,'khdfsdhfsgdk',47);
/*!40000 ALTER TABLE `processed_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `cat_id` int DEFAULT NULL,
  `product_code` varchar(10) CHARACTER SET armscii8 NOT NULL,
  `product_name` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `price` decimal(12,0) NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `short_description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `brand` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `color` varchar(20) CHARACTER SET armscii8 NOT NULL DEFAULT 'red',
  `size` varchar(2) CHARACTER SET armscii8 NOT NULL DEFAULT 'L',
  PRIMARY KEY (`product_id`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `cat_id` FOREIGN KEY (`cat_id`) REFERENCES `cat_product` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (24,2,'SP003','Áo Nữ Cao Cao',1094761982,'kjfahdsfabjhfba','./uploads/362638560_108737208970853_4178407654573532345_n-Copy(1).jpg','03918aflhjb','Cool mate','red','L'),(26,1,'4124','Tin',419264,'13974010746121','./uploads/ads.jpg','Nguyeasd','124','red','L'),(33,1,'SP002','tin',58369502,'535262','./uploads/ads-Copy.jpg','5035138914','qưe','red','L'),(34,1,'SP002','tin',58369502,'535262','./uploads/ads-Copy(1).jpg','5035138914','qưe','red','L'),(35,1,'SP002','Áo Nam Trắng',12000,'Không có gì hết ','./uploads/drm.jpg','Không có gì hết ','Coolmate','red','L'),(36,29,'SP003','Áo Nam Đen',18740,'8604132784601','./uploads/8938509426040-Copy.jpg','0346981','Tín','red','L'),(37,2,'SP003','Áo nam xấu ',123896198,'jasdl','./uploads/8938509426040-Copy(1).jpg','hagsfdlka','Coolmate','red','L'),(38,1,'SP002','Quần Nam Sẹc Xi',139840,'fpsiadoufhnaosduf','./uploads/8938509426019-Copy.jpg','fsiduhg','Cun mết','red','L'),(39,2,'SP002','Ao',132141,'qwr','./uploads/8938509426040-Copy(2).jpg','fasffas','Coll meat','red','L');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `birthday` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sex` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `role` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address` text COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'tin123','5da7f1b4321b14b05a1d6484c60daa81','nvtin1104@gmail.com','2000-01-01','Men','Nguyen Van Tin',1,1,'2023-07-21 20:51:51',NULL),(2,'tin1234','2715e3d13ec89f3d0f7744139f50ef4a','tin@gmail.com','2023-07-27','Men','taokobitla123',1,1,'2023-07-24 19:13:19',NULL),(6,'admin','0192023a7bbd73250516f069df18b500','bguyt46@gmail.com','2004-01-01','Men','Nguyen Van Tin',2,1,'2023-07-30 20:34:32',NULL),(7,'tin123f','5da7f1b4321b14b05a1d6484c60daa81','Taokobitla123@gmail.com','2023-07-28','Men','Nguyen Van Tin',1,1,'2023-07-30 21:43:22',NULL),(9,'Tin123d','5da7f1b4321b14b05a1d6484c60daa81','la@gmail.com','2004-01-01','Men','sdasda',1,1,'2023-08-01 08:10:40',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'asm_php_1'
--

--
-- Dumping routines for database 'asm_php_1'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-08 10:32:00
