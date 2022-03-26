-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: student_activity_app
-- ------------------------------------------------------
-- Server version	5.7.34-log

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
-- Table structure for table `tbl_activity_question_answered`
--

DROP TABLE IF EXISTS `tbl_activity_question_answered`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_activity_question_answered` (
  `RecID` int(11) NOT NULL AUTO_INCREMENT,
  `ActivityID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  `QuestionName` varchar(500) NOT NULL,
  `Answer` varchar(1500) DEFAULT NULL,
  `AnsweredBy` int(11) DEFAULT NULL,
  `IsCheck` int(11) DEFAULT '0',
  `IsWrong` int(11) DEFAULT '0',
  PRIMARY KEY (`RecID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_activity_question_answered`
--

LOCK TABLES `tbl_activity_question_answered` WRITE;
/*!40000 ALTER TABLE `tbl_activity_question_answered` DISABLE KEYS */;
INSERT INTO `tbl_activity_question_answered` VALUES (1,1,1,'QUESTION ONE','Answer two',9,1,0),(2,1,2,'Tell me about you self?','dadads',9,1,0),(3,1,3,'What is my age?','23',9,1,0),(4,1,4,'What is my favorite dog?','Aw aw two',9,0,1);
/*!40000 ALTER TABLE `tbl_activity_question_answered` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_answer_type`
--

DROP TABLE IF EXISTS `tbl_answer_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_answer_type` (
  `RecID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(145) NOT NULL,
  `IsActive` int(11) NOT NULL,
  PRIMARY KEY (`RecID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_answer_type`
--

LOCK TABLES `tbl_answer_type` WRITE;
/*!40000 ALTER TABLE `tbl_answer_type` DISABLE KEYS */;
INSERT INTO `tbl_answer_type` VALUES (1,'Multiple choices',0),(2,'DropDown',1),(3,'Paragraph',1);
/*!40000 ALTER TABLE `tbl_answer_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_department` (
  `DeptID` int(11) NOT NULL AUTO_INCREMENT,
  `DeptName` varchar(145) NOT NULL,
  `IsActive` int(11) NOT NULL,
  `Created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`DeptID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_department`
--

LOCK TABLES `tbl_department` WRITE;
/*!40000 ALTER TABLE `tbl_department` DISABLE KEYS */;
INSERT INTO `tbl_department` VALUES (1,'IT DEPARTMENT',1,'2021-10-21 14:41:20'),(2,'ACCOUNTING',1,'2021-10-21 14:41:38'),(3,'CCSICT',1,'2021-10-21 14:41:51');
/*!40000 ALTER TABLE `tbl_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_student_activities`
--

DROP TABLE IF EXISTS `tbl_student_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_student_activities` (
  `RecID` int(11) NOT NULL AUTO_INCREMENT,
  `ActivityName` varchar(245) NOT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Create_by` int(11) NOT NULL,
  PRIMARY KEY (`RecID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_student_activities`
--

LOCK TABLES `tbl_student_activities` WRITE;
/*!40000 ALTER TABLE `tbl_student_activities` DISABLE KEYS */;
INSERT INTO `tbl_student_activities` VALUES (1,'Test activity','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since ','2021-10-26','2021-10-30','2021-10-23 07:23:21',10),(2,'','','0000-00-00','0000-00-00','2021-10-23 18:33:55',10);
/*!40000 ALTER TABLE `tbl_student_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_student_activity_questions`
--

DROP TABLE IF EXISTS `tbl_student_activity_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_student_activity_questions` (
  `RecID` int(11) NOT NULL AUTO_INCREMENT,
  `ActivityID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Questions` varchar(3500) NOT NULL,
  `Status` varchar(45) DEFAULT 'Pending',
  `Created_at` timestamp NULL DEFAULT NULL,
  `DateAnswered` datetime DEFAULT NULL,
  PRIMARY KEY (`RecID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_student_activity_questions`
--

LOCK TABLES `tbl_student_activity_questions` WRITE;
/*!40000 ALTER TABLE `tbl_student_activity_questions` DISABLE KEYS */;
INSERT INTO `tbl_student_activity_questions` VALUES (1,1,9,'[{\"question\":\"QUESTION ONE\",\"answerType\":\"2\",\"choices\":[],\"option\":[\"Answer one\",\"Answer two\",\"Answer tree\"]},{\"question\":\"Tell me about you self?\",\"answerType\":\"3\",\"choices\":[],\"option\":[],\"paragraph\":\"\"},{\"question\":\"What is my age?\",\"answerType\":\"2\",\"choices\":[],\"option\":[\"21\",\"23\",\"34\"]},{\"question\":\"What is my favorite dog?\",\"answerType\":\"2\",\"choices\":[],\"option\":[\"Aw aw one\",\"Aw aw two\"]}]','Validated','2021-10-23 07:23:21','2021-10-24 00:21:16'),(2,1,11,'[{\"question\":\"QUESTION ONE\",\"answerType\":\"2\",\"choices\":[],\"option\":[\"Answer one\",\"Answer two\",\"Answer tree\"]},{\"question\":\"Tell me about you self?\",\"answerType\":\"3\",\"choices\":[],\"option\":[],\"paragraph\":\"\"},{\"question\":\"What is my age?\",\"answerType\":\"2\",\"choices\":[],\"option\":[\"21\",\"23\",\"34\"]},{\"question\":\"What is my favorite dog?\",\"answerType\":\"2\",\"choices\":[],\"option\":[\"Aw aw one\",\"Aw aw two\"]}]','Pending','2021-10-23 07:23:21',NULL),(3,2,0,'[]','Pending','2021-10-23 18:33:55',NULL);
/*!40000 ALTER TABLE `tbl_student_activity_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_access`
--

DROP TABLE IF EXISTS `user_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_access` (
  `RecID` int(11) NOT NULL AUTO_INCREMENT,
  `firtname` varchar(345) DEFAULT NULL,
  `lastname` varchar(345) DEFAULT NULL,
  `middlename` varchar(345) DEFAULT NULL,
  `email` varchar(245) DEFAULT NULL,
  `username` varchar(245) DEFAULT NULL,
  `password` varchar(345) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `user_type` varchar(245) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lang` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `Status` int(11) DEFAULT '0',
  `Department` int(11) DEFAULT NULL,
  `StudentID` varchar(45) DEFAULT NULL,
  `profile` varchar(245) DEFAULT NULL,
  PRIMARY KEY (`RecID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_access`
--

LOCK TABLES `user_access` WRITE;
/*!40000 ALTER TABLE `user_access` DISABLE KEYS */;
INSERT INTO `user_access` VALUES (1,'John javier','Romero','Romero','johnjavieridmilao12@gmail.com','12345','f0a226b7092c7bc6b1fff499d62630a0d6ac9ea0','639750148734','admin',16.9578,121.731,'2021-08-09 15:24:01',1,1,NULL,'1637566176_062b3acd02adfe56c9c1.jpg'),(9,'Student1','Student1','Student1','johnjavieridmilao12@gmail.com','323232','f0a226b7092c7bc6b1fff499d62630a0d6ac9ea0','09750148734','student',0,0,'2021-10-20 15:55:19',1,1,'4343424',NULL),(10,'Teacher1','Teacher1','Teacher1','johnjavieridmilao12@gmail.com','66666','f0a226b7092c7bc6b1fff499d62630a0d6ac9ea0','09750148734','teacher',16.9578,121.731,'2021-10-20 15:56:06',1,1,NULL,'1637565520_538b2c7bf4705f3bbe15.jpg'),(11,'REGGIE','PALISOC','PALISOC','test@gmail.com','REGGIE','f0a226b7092c7bc6b1fff499d62630a0d6ac9ea0','6332323232','student',16.9578,121.731,'2021-10-21 06:50:52',1,1,'6667676','1637565963_f8a62e85538a9887603c.jpg'),(12,'test','test','test','johnjavieridmilao12@gmail.com','test','4028a0e356acc947fcd2bfbf00cef11e128d484a','09750148734','Owner',0,0,'2021-11-07 17:47:01',0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user_access` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-10 21:22:36
