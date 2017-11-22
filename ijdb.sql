-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 192.168.10.10    Database: ijdb
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `permissions` int(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Carlos Moia','carlos@gmail.com',NULL,NULL),(2,'Joana Marques','joana@izyl.com',NULL,NULL),(3,NULL,NULL,NULL,NULL),(4,NULL,NULL,NULL,NULL),(5,NULL,NULL,NULL,NULL),(6,NULL,NULL,NULL,NULL),(7,'m','m','m',NULL),(8,'b','b','b',NULL),(9,'b','b','k',NULL),(10,'b','b','d',NULL),(11,'l','m','m',NULL),(12,'l','m','m',NULL),(13,'o','o','0',NULL),(14,'b','b','m',NULL),(15,'s','s','s',NULL),(16,'as','sd@s.com','d',NULL),(17,'Clarissa','clarissa.feio@hushmail.com','Tolkien23',NULL),(18,'f','dsdfsdf@gmail.com','$2y$10$7ziW8oKDN/NltaG7Pg8IuuTvkiSnvJRGkKkLknNIV0mSykdYRFy.C',NULL),(19,'a','aaa@gmail.com','$2y$10$lo.qI3Lvs2pGMj9Q3f0NGuC3.BTgu874EQfIu4IqITCYN/MWza4QK',NULL),(20,'b','bbb@gmail.com','$2y$10$0CmZo1j58dbmqXO5t2ad.uo2XiF4hgQWXACVvNCj3GQPVohwWfCFO',63),(21,'d','ddd@gmail.com','$2y$10$KHUbShRYKv.JAks.9j7rBe4fIqs3Cp9Kv58GFGxCWzYCyWNovX2nS',63),(22,'ss','s@gmail.com','$2y$10$gtMGTGJQQnjQYO6qEVAZ8.TW3Q3M/VpXJzwRF1gIHGTcSM18lpwCW',NULL),(23,'df','df@gmail.com','$2y$10$nI5XnADCXKBuD2/H547uROF5MUITUsCA9kIP9clOfRoKjAzgEFfje',0),(24,'ccc','ccc@gmail.com','$2y$10$WqJ3prBA/tnMtvO0oViDA.e5uFh2cZepNCkWCtN4k0WtBpuaPMSj.',NULL);
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Political'),(4,'Classic'),(5,'programming jokes'),(6,'one-liners');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `joke`
--

DROP TABLE IF EXISTS `joke`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `joke` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joketext` text,
  `jokedate` date NOT NULL,
  `authorid` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `authorid` (`authorid`),
  CONSTRAINT `fk_joke_author` FOREIGN KEY (`authorid`) REFERENCES `author` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `joke`
--

LOCK TABLES `joke` WRITE;
/*!40000 ALTER TABLE `joke` DISABLE KEYS */;
INSERT INTO `joke` VALUES (3,'A programmer\'s wife tells him to go to the store and get a gallon of milk, an if they have eggs, get a dozen. He returns with 13 gallons of milk.','2017-11-08',1),(152,'How many programmers does it take to screw in a lightbulb? None, it’s\r\na hardware problem.','2017-11-22',21),(153,'Why did the programmer quit his job? He didn’t get arrays.','2017-11-22',21),(154,'Why was the empty array stuck outside? It didn’t have any keys.','2017-11-22',21),(155,'Bugs come in through open Windows.','2017-11-22',21),(156,'How do functions break up? They stop calling each other','2017-11-22',21),(157,'You don’t need any training to be a litter picker, you pick it up on the\r\njob.','2017-11-22',21),(158,'Venison’s dear, isn’t it?','2017-11-22',21),(159,'It’s tricky being a magician.','2017-11-22',21),(160,'If con is the opposite of pro, then isn’t Congress the opposite of progress?','2017-11-22',21),(161,'The Pentagon announced that its fight against ISIS will be called Operation Inherent Resolve. They came up with that name using Operation Random Thesaurus.','2017-11-22',21),(162,'Can’t believe the National Spelling Bee ended in a tye.','2017-11-22',21),(163,'I saw this man and woman wrapped in a barcode. I said: \"Are you two an item?\"','2017-11-22',21),(164,'A group of chess enthusiasts checked into a hotel and were standing in the lobby discussing their tournament victories. After an hour, the manager came out and asked them to disperse. \"But why?\" they asked. \"Because,\" he said, \"I can\'t stand chess nuts boasting in an open foyer.\"','2017-11-22',21),(165,'Went to the paper shop - it had blown away.','2017-11-22',21),(166,'I cleaned the attic with the wife the other day. Now I can\'t get the cobwebs out of her hair.','2017-11-22',21),(167,'I sent my girlfriend a huge pile of snow. I rang her up and said: \"Did you get my drift?\"','2017-11-22',21);
/*!40000 ALTER TABLE `joke` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `joke_category`
--

DROP TABLE IF EXISTS `joke_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `joke_category` (
  `jokeid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  PRIMARY KEY (`categoryid`,`jokeid`),
  KEY `composite` (`jokeid`,`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `joke_category`
--

LOCK TABLES `joke_category` WRITE;
/*!40000 ALTER TABLE `joke_category` DISABLE KEYS */;
INSERT INTO `joke_category` VALUES (26,1),(102,1),(110,1),(111,1),(112,1),(113,1),(114,1),(115,1),(116,1),(117,1),(118,1),(119,1),(120,1),(121,1),(122,1),(123,1),(124,1),(125,1),(126,1),(127,1),(129,1),(132,1),(145,1),(146,1),(148,1),(160,1),(161,1),(162,1),(26,4),(102,4),(110,4),(111,4),(113,4),(135,4),(136,4),(137,4),(138,4),(139,4),(140,4),(141,4),(142,4),(143,4),(144,4),(147,4),(148,4),(163,4),(164,4),(165,4),(166,4),(167,4),(102,5),(113,5),(148,5),(152,5),(153,5),(154,5),(155,5),(156,5),(102,6),(113,6),(148,6),(155,6),(157,6),(158,6),(159,6);
/*!40000 ALTER TABLE `joke_category` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-22 14:12:58
