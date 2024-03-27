-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: Persons_Management_App
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.23.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `hobby`
--

DROP TABLE IF EXISTS `hobby`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hobby` (
  `id` int NOT NULL AUTO_INCREMENT,
  `person_id` int DEFAULT NULL,
  `name` varchar(320) DEFAULT NULL,
  UNIQUE KEY `hobby_pk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hobby`
--

LOCK TABLES `hobby` WRITE;
/*!40000 ALTER TABLE `hobby` DISABLE KEYS */;
INSERT INTO `hobby` VALUES (2,2,'masak'),(3,1,'membaca'),(5,1,'berlayar'),(7,3,'jalan-jalan'),(8,4,'pelihara ikan'),(11,2,'bermain'),(23,1,'lalala'),(25,1,'jalan-jalan'),(26,3,'memancing ikan'),(28,2,'memancing'),(31,1,'bercyanda'),(32,1,'menangis'),(34,1,'memasak'),(37,1,'nonton'),(39,1,'berkebun'),(40,1,'memacing'),(41,1,'memelihara ikan'),(42,1,'menari'),(46,4,'menari'),(49,2,'tertawa'),(58,2,'melukis');
/*!40000 ALTER TABLE `hobby` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_name` varchar(320) NOT NULL,
  `count` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'jobless',8),(3,'doctor',8),(4,'staf',3),(5,'teacher',1),(6,'singer',2),(7,'farmer',2),(8,'programmer',2),(16,'model',1),(17,'chef',1),(21,'Dancer',1),(24,'petani',2),(26,'nelayan',1),(34,'Pelawak',NULL);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person_job`
--

DROP TABLE IF EXISTS `person_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `person_job` (
  `id` int NOT NULL AUTO_INCREMENT,
  `person_id` int NOT NULL,
  `job_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_job`
--

LOCK TABLES `person_job` WRITE;
/*!40000 ALTER TABLE `person_job` DISABLE KEYS */;
INSERT INTO `person_job` VALUES (1,1,4),(2,2,3),(3,3,1),(4,4,26),(5,5,3),(6,6,4),(7,7,17),(8,8,1),(9,9,1),(10,10,4),(11,11,21),(12,12,3),(13,13,1),(14,14,3),(15,15,3),(16,27,8),(17,28,3),(18,29,3),(19,30,3),(22,33,16),(23,34,5),(25,36,24),(34,68,6),(38,72,1),(39,73,1),(40,74,1),(41,75,24),(44,78,7),(52,89,6),(55,92,7),(56,93,1),(57,94,8);
/*!40000 ALTER TABLE `person_job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persons`
--

DROP TABLE IF EXISTS `persons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `birth_date` date NOT NULL,
  `sex` varchar(20) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(60) NOT NULL,
  `address` varchar(320) NOT NULL,
  `role` varchar(20) NOT NULL,
  `internal_notes` varchar(320) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `job_id` int DEFAULT NULL,
  `logged_in` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persons`
--

LOCK TABLES `persons` WRITE;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
INSERT INTO `persons` VALUES (1,'1111111111111113','cahya','AkuCahya123','2005-08-03','F','cahya@gmail.com','$2y$10$o3w3SN9UkYwKGMQstUnyPOd4Wra3YQdF2efy9jrqkq5WbiYetG01K','Br.Basangbe, Perean kangin, Baturiti, Tabanan, Bali','A','Hi cahya kml',1,4,'2024-03-26 21:46:09'),(2,'1111111111111193','kitty','pricila','2022-01-02','F','kitty@gmail.com','$2y$10$bh9W.B6Fsj1ac7XZ4gjZqOJyQ3QAC6FEneVKLIjQGwOn.TvX21mDy','baturiti','A','Hi, kitty comel',1,3,'2024-03-24 21:40:59'),(3,'1111111111111991','cia','belalalala','2004-03-03','F','cia@gmail.com','$2y$10$xbW5GZc2GtMuQJMaeg1gtuXnlKYUBg8.ZbMkClxJmo4lm0VLd2xrm','Br.Basangbe, Ds.Perean kangin, Kec.Baturiti, Kab.Tabanan, Prov.Bali','M','hihi laskalas',1,1,'2024-03-26 20:08:05'),(4,'1111111111111191','alin','AkuCahya123','2022-08-03','M','alin@gmail.com','$2y$10$0Bv7Kzzgx00eOqpyXY/Ibuxo3sNG1al.IzOxiU55azcKWoB.P43Im','perean','A','',1,26,NULL),(5,'1111111111111116','ciahlalaa','AkuCahya123','1950-04-01','F','ciah@gmail.com','$2y$10$L0eZn5x8mWTlHhnr4ZkQR.taYZDW7384Z0I9jDJOzPE0pjE7gXx5a','baturiti','A','Hi, ciah',1,3,NULL),(6,'1111111111111117','ciahi','Cahya123','2004-03-11','F','ciahi@gamil.com','$2y$10$IfA213YaQ7C25Tn6W2sK4ujLp5I2y33aEUHV2MyJlZEt4fMZ7HIq.','perean','A',NULL,1,4,NULL),(7,'1111111111111118','budi','syalala','2023-02-03','M','budi@gmail.com','$2y$10$IfA213YaQ7C25Tn6W2sK4ujLp5I2y33aEUHV2MyJlZEt4fMZ7HIq.','perean','A','hi aku budi',1,17,NULL),(8,'1111111111111119','mei','Cahya123','2004-03-03','F','mei@gmail.com','$2y$10$IfA213YaQ7C25Tn6W2sK4ujLp5I2y33aEUHV2MyJlZEt4fMZ7HIq.','baturiti','M','',0,1,NULL),(9,'1111111111111122','bela','lalalala','2004-03-03','F','bela@gmail.com','$2y$10$o1dfNujTxrVRk83cYhI3LexOUxOJbyWUv7nuDf6BaqY5DFJzE.xLy','perean','A','',0,1,NULL),(10,'1111111111111199','lussy','Cahya123','2004-03-03','F','lussy@gamil.com','$2y$10$IfA213YaQ7C25Tn6W2sK4ujLp5I2y33aEUHV2MyJlZEt4fMZ7HIq.','baturiti','M',NULL,1,4,NULL),(11,'1234567812995678','devan','lalala','2004-03-22','F','devan@gmail.com','$2y$10$AjfmkPeVvERuWhLsA7sdhuhRwlNCUZDBq2u0762sxwyopRTCmp5uS','baturiti','M','',1,21,NULL),(12,'1289234719348293','debi','cute','2023-08-03','F','debi@gmail.com','$2y$10$g1CaNUGWxKY2ENi0q95UT.XTYrWz0p.aXhix0CtCgVAbJZePyyZpS','perean','M','',1,3,NULL),(13,'1234567812345444','tabi','tabi','2023-02-01','F','tabi@gmail.com','$2y$10$8GJR.i8kGLzlWIjA7CBOHuONi7Ur8qIs0sAgN2RJwIeagIexhyWUG','perean','A','aku tabu tabi',0,1,NULL),(14,'5004567812945678','rubi','bobi','2015-03-03','F','rubi@gmail.com','$2y$10$pUfUVIWddE7mAbzsFSMb6.GMhKvOECaMiCyK1QhhZhaBUhZT7hnWa','perean','A','',1,3,NULL),(15,'1234562212345678','cherry','nanana','2014-03-03','F','cherry@gmail.com','$2y$10$D36PoShCAKVkFOdvCvYPN.xo9ny5AW2wP76VPgXl6znViBziAwN2u','perean','M','',1,3,NULL),(27,'123456781234567a','kelly','lalalala','2016-03-03','F','kelly@gmail.com','$2y$10$TZup/Aj5BftiAuimZ2UqNuZcQMQhKiTXCUn5Ai6buiMPMweKVlhLG','perean','A','hi kelly cute',1,8,NULL),(28,'1234567811111111','cahya','Ayong','2016-03-03','F','ayong@gmail.com','$2y$10$iQ2xFvdM8SvPGCz/MLy/l.rEfUbD/gJJS3kNjinF.JlS1JjvGp6QO','perean','A','',1,3,NULL),(29,'5100012505250001','shifa','cipa cipoyyy','2004-03-03','F','shifa@gmail.com','$2y$10$yXASPdtiUq9zfD32G5/GguuYA4W3WK3FpwWcMSWUhi1w0pVo6Z.DW','pacung','A','',1,3,NULL),(30,'5100011011240001','nilam ','marta','2004-03-03','F','nilam@gmail.com','$2y$10$SYCSgppKrdgM3E325o1nd.WfATEGFwDr3rXLY/jFqhGIoyPW6cQ2u','perean','A','',1,3,NULL),(33,'1234567890123123','nana','comel','2004-03-03','F','nana@gmail.com','$2y$10$6OQm2jxBPYKCdxpbdI73YeRFSAvQ9rPlRN2WKc6hC/t6IW1nBruT6','perean','A','',1,16,NULL),(34,'1234567890123999','fadil','dila','2004-03-03','M','dila@gmail.com','$2y$10$caXwPyIDRKOUS5MPa.arjOod.5BsHTG.QWVL6AI7/e2GWdyyQ2QfC','dari rumah','A','',1,5,NULL),(36,'1234567890123456','boba','bebe','2004-03-03','M','boba@gmail.com','$2y$10$cmjQAw0Ab4laHUbEpxdY7eI9eDoG.YNZisdltRhPNAb84wGxd5AB6','dari rumah','A','',1,24,NULL),(68,'1234567891234325','ayu','media','2004-03-03','F','ayu@gmail.com','$2y$10$OeClTn8Z14yBf9CEekAzROxI7pUyeac82WpxIG/efLY11LtjaHLAy','sdakasd','A','',1,6,NULL),(72,'1234567891234523','ayu','media','2004-03-03','F','ayu@gmail.aya','$2y$10$c58rK3a02herXto16eEkkOV.GaZ9G7bohXihnVr/vUCUMb84XhaLm','asdkksd','A','',0,1,NULL),(73,'1111111111111192','caca','caca','2004-03-03','F','caca@gmi.dsdk','$2y$10$FE/6U0vwnIQy.FAY6bA8HulS4KuSKfdCV5yIHOKjZF1tp76OYqQI2','sdaf','A','',0,1,NULL),(74,'1111111111111346','sdkadka','dasdkakd','2004-03-03','F','adksajkd@jjda.ckna','$2y$10$niGP2gqRy.8sMbgixP3IsuoXXKXwaSGaE1KKB.PbwN.NZlJAFeW2W','sdfasf','A','',0,1,NULL),(75,'1234567891234273','dadlasld','dksadksl','2004-03-03','F','sdkskda@hajdajsd','$2y$10$dNYiTHP8FemWKqOOR93Lz./AgQfhN3wa5kE8KKUPKqBD9zipr8fae','sdasd','A','sasas',1,24,NULL),(78,'1234567891237237','gaga','gugu','2004-03-03','F','gaga@gmail.com','$2y$10$aZEPB7cevxkk7u9IWvTOuuuzRdP9ypm/ONIq0Ct.Ex5zU1JqfeHPe','denpasar','A','',1,7,NULL),(89,'1234567882334567','aya','cahya','2005-08-03','F','cahyaAya@gmail.com','$2y$10$Q0eVvZYEbSsX/d9p0KWlNuMX.ZKYwk5IRIXdzkaysfdYpkcXjfXH6','perean','A','',1,6,NULL),(92,'1289234719348291','kumala','skdkasjdsa','2005-08-03','F','cahya@gmail.comsdasdasdasd','$2y$10$lJB2vd1S6LHKzqrJ4WpnSONWmK./g7vngZTeIzyIYdZN7AVMuNldW','perean','A','',0,7,NULL),(93,'111111111111111c','sadad','asdsad','2005-08-03','F','cahya@gmail.comsdkaskd','$2y$10$j11uvOX71cbrN6zBudBjC.AitwJs1vjgja.I8kr/8hDEeQQ/Netfi','perean','A','dasd',0,1,NULL),(94,'1111111111111110','aksdakd','alsdksakd','2005-08-03','F','cia@gmail.cute','$2y$10$ujZcNtqQHRp2c.y0JkbPLuU0z4Z3pyMx0H7zF070pl4YOTaWwN/1O','perean','A','',0,8,NULL);
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-27 13:53:54
