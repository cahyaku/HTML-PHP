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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hobby`
--

LOCK TABLES `hobby` WRITE;
/*!40000 ALTER TABLE `hobby` DISABLE KEYS */;
INSERT INTO `hobby` VALUES (1,1,'tidur'),(2,2,'masak'),(3,1,'membaca'),(5,1,'berlayar'),(7,3,'jalan-jalan'),(8,4,'pelihara ikan'),(11,2,'bermain'),(23,1,'lalala'),(25,1,'jalan-jalan'),(26,3,'memancing ikan'),(28,2,'memancing'),(31,1,'bersepeda'),(32,1,'makan'),(34,1,'memasak'),(37,1,'nonton'),(39,1,'berkebun'),(40,1,'memacing'),(41,1,'memelihara ikan'),(42,1,'menari');
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'jobless',1),(3,'doctor',14),(4,'staf',5),(5,'teacher',3),(6,'singer',2),(7,'farmer',1),(8,'programmer',1),(16,'model',1),(17,'chef',1),(21,'Dancer',NULL),(24,'petani',NULL),(26,'nelayan',NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_job`
--

LOCK TABLES `person_job` WRITE;
/*!40000 ALTER TABLE `person_job` DISABLE KEYS */;
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
  `birth_date` int NOT NULL,
  `sex` varchar(20) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(60) NOT NULL,
  `address` varchar(320) NOT NULL,
  `role` varchar(20) NOT NULL,
  `internal_notes` varchar(320) DEFAULT NULL,
  `logged_in` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `job_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persons`
--

LOCK TABLES `persons` WRITE;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
INSERT INTO `persons` VALUES (1,'1111111111111113','cahya','AkuCahya123',1123027200,'F','cahya@gmail.com','$2y$10$0Bv7Kzzgx00eOqpyXY/Ibuxo3sNG1al.IzOxiU55azcKWoB.P43Im','Br.Basangbe, Perean kangin, Baturiti, Tabanan, Bali','A','Hi Cahya',1710733630,1,4),(2,'1111111111111112','kitty','pricila',1044835200,'F','kitty@gmail.com','$2y$10$bh9W.B6Fsj1ac7XZ4gjZqOJyQ3QAC6FEneVKLIjQGwOn.TvX21mDy','baturiti','A','Hi, kitty comel',1708675350,1,17),(3,'1111111111111111','cia','belalalala',950140800,'F','cia@gmail.com','$2y$10$xbW5GZc2GtMuQJMaeg1gtuXnlKYUBg8.ZbMkClxJmo4lm0VLd2xrm','Br.Basangbe, Ds.Perean kangin, Kec.Baturiti, Kab.Tabanan, Prov.Bali','M','',1710734149,1,3),(4,'1111111111111191','alin','AkuCahya123',1104451200,'M','alin@gmail.com','$2y$10$0Bv7Kzzgx00eOqpyXY/Ibuxo3sNG1al.IzOxiU55azcKWoB.P43Im','perean','A','',NULL,1,3),(5,'1111111111111116','ciahlalaa','AkuCahya123',-1578009600,'F','ciah@gmail.com','$2y$10$L0eZn5x8mWTlHhnr4ZkQR.taYZDW7384Z0I9jDJOzPE0pjE7gXx5a','baturiti','A','Hi, ciah',1702537859,1,3),(6,'1111111111111117','ciahi','Cahya123',1229040000,'F','ciahi@gamil.com','$2y$10$IfA213YaQ7C25Tn6W2sK4ujLp5I2y33aEUHV2MyJlZEt4fMZ7HIq.','perean','A',NULL,NULL,1,4),(7,'1111111111111118','budi','syalala',1546387200,'M','budi@gmail.com','$2y$10$IfA213YaQ7C25Tn6W2sK4ujLp5I2y33aEUHV2MyJlZEt4fMZ7HIq.','perean','A','hi aku budi',NULL,1,17),(8,'1111111111111119','mei','Cahya123',-1578009600,'F','mei@gmail.com','$2y$10$IfA213YaQ7C25Tn6W2sK4ujLp5I2y33aEUHV2MyJlZEt4fMZ7HIq.','baturiti','M',NULL,NULL,0,4),(9,'1111111111111122','bela','lalalala',1229040000,'F','bela@gmail.com','$2y$10$o1dfNujTxrVRk83cYhI3LexOUxOJbyWUv7nuDf6BaqY5DFJzE.xLy','perean','A','',NULL,0,4),(10,'1111111111111199','lussy','Cahya123',1229070124,'F','lussy@gamil.com','$2y$10$IfA213YaQ7C25Tn6W2sK4ujLp5I2y33aEUHV2MyJlZEt4fMZ7HIq.','baturiti','M',NULL,NULL,0,4),(11,'1234567812995678','devan','lalala',1123027200,'F','devan@gmail.com','$2y$10$AjfmkPeVvERuWhLsA7sdhuhRwlNCUZDBq2u0762sxwyopRTCmp5uS','baturiti','M','',NULL,0,4),(12,'1289234719348293','debi','cute',1123027200,'F','debi@gmail.com','$2y$10$g1CaNUGWxKY2ENi0q95UT.XTYrWz0p.aXhix0CtCgVAbJZePyyZpS','perean','M','',NULL,1,3),(13,'1234567812345444','tabi','tabi',1123027200,'F','tabi@gmail.com','$2y$10$8GJR.i8kGLzlWIjA7CBOHuONi7Ur8qIs0sAgN2RJwIeagIexhyWUG','perean','A','',NULL,1,3),(14,'5004567812945678','rubi','bobi',1123027200,'F','rubi@gmail.com','$2y$10$pUfUVIWddE7mAbzsFSMb6.GMhKvOECaMiCyK1QhhZhaBUhZT7hnWa','perean','A','',NULL,1,3),(15,'1234562212345678','cherry','nanana',1123027200,'F','cherry@gmail.com','$2y$10$D36PoShCAKVkFOdvCvYPN.xo9ny5AW2wP76VPgXl6znViBziAwN2u','perean','M','',NULL,1,3),(27,'123456781234567a','kelly','lalalala',1123027200,'F','kelly@gmail.com','$2y$10$BGuPSdkLbjmsdul2idlT1.i8CLz39m.8P4na1d9lCsizdK4ZcHjd2','perean','A','',NULL,1,3),(28,'1234567811111111','cahya','Ayong',1123027200,'F','ayong@gmail.com','$2y$10$iQ2xFvdM8SvPGCz/MLy/l.rEfUbD/gJJS3kNjinF.JlS1JjvGp6QO','perean','A','',NULL,1,3),(29,'5100012505250001','shifa','cipa cipoyyy',1107561600,'F','shifa@gmail.com','$2y$10$yXASPdtiUq9zfD32G5/GguuYA4W3WK3FpwWcMSWUhi1w0pVo6Z.DW','pacung','A','',NULL,1,3),(30,'5100011011240001','nilam ','marta',1100044800,'F','nilam@gmail.com','$2y$10$SYCSgppKrdgM3E325o1nd.WfATEGFwDr3rXLY/jFqhGIoyPW6cQ2u','perean','A','',NULL,0,3),(31,'5100012505260001','nia','cutelalala',1123027200,'F','nia@gmail.id','$2y$10$as7mG2D/fSdU7FonoBkiwOV3x6/PntwfdmoLMt/Hg4RAKgDn65Phq','baturiti','A','',NULL,0,1),(32,'123456789012gaga','gaga','gugu',1123027200,'M','gaga@gmail.com','$2y$10$tvlFGzGx5zmdKuvMv6wLguw/lkdpTCr4TcRX9pwVaz92xZdtBcANq','dari mana aja boleh','A','',NULL,0,1),(33,'1234567890123123','nana','comel',1123027200,'F','nana@gmail.com','$2y$10$6OQm2jxBPYKCdxpbdI73YeRFSAvQ9rPlRN2WKc6hC/t6IW1nBruT6','perean','A','',NULL,1,16),(34,'1234567890123999','fadil','dila',1123027200,'M','dila@gmail.com','$2y$10$caXwPyIDRKOUS5MPa.arjOod.5BsHTG.QWVL6AI7/e2GWdyyQ2QfC','dari rumah','A','',NULL,1,3),(35,'1234567890123888','mimi','lala',1123027200,'F','lala@gmail.com','$2y$10$118V1K9ZaYWvlnUbUX5tXusp7ZQoC3ce7eOvClo19fP4kzTZZbzcW','dari langit','A','',NULL,0,4),(36,'1234567890123456','boba','bebe',1123027200,'M','boba@gmail.com','$2y$10$cmjQAw0Ab4laHUbEpxdY7eI9eDoG.YNZisdltRhPNAb84wGxd5AB6','dari rumah','A','',NULL,0,8),(37,'1234567890123226','shena','samando',1123027200,'F','sheina@gmail.com','$2y$10$YBR/bJ.RfC903cXKNbMKZe1FT3lRmrtVhjI8uvaGza1Vb38zSFfam','baturiti','A','',NULL,0,1),(38,'1234567890333456','ayu','media',1123027200,'F','ayu@gmail.com','$2y$10$XA2Tc50HDOtRDgKcoGQP8eIjpXM4euoIHwSeQLf/JOUsZT3uEIDwq','baturiti','M','hi aasas',NULL,1,6),(41,'1299967890123456','cahya','kumala',1123027200,'F','me@me.com','$2y$10$vIev9ysr1LNixYvGk5RhiuOjcUYt.GcDwVYOvFM9qfIHp.Kt7l1aS','rumah','A','',NULL,1,5),(42,'1234567890121243','syalala','lala',1123027200,'F','syalala@gmail.com','$2y$10$XGgSZVEV9XLIK.Q0rfjJH.kQ5CONEJ06pkFubyRVH0pVCINfx/atC','perean','A','',NULL,0,8),(56,'1234518290123456','asdsdn','sdajda',1123027200,'F','asdn@sdksad.com','$2y$10$zTkI9a7FSth/01fY.d1f3uaWtQ2id9Pdxt0J03EX4DyZiayLqt/0S','skdjas','A','',NULL,1,6);
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

-- Dump completed on 2024-03-20 13:52:54
