-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: empireestate
-- ------------------------------------------------------
-- Server version	5.7.9

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
-- Table structure for table `imoveis`
--

DROP TABLE IF EXISTS `imoveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imoveis` (
  `cod_imovel` int(11) NOT NULL AUTO_INCREMENT,
  `cod_usuario` int(11) DEFAULT NULL,
  `cod_tipoImovel` int(11) DEFAULT NULL,
  `titulo_imovel` varchar(80) DEFAULT NULL,
  `tipoNegocio_imovel` varchar(30) DEFAULT NULL,
  `valor_imovel` float(10,2) DEFAULT NULL,
  `cidade_imovel` varchar(40) DEFAULT NULL,
  `uf_imovel` char(2) DEFAULT NULL,
  `logradouro_imovel` varchar(10) DEFAULT NULL,
  `endereco_imovel` varchar(50) DEFAULT NULL,
  `numero_imovel` int(11) DEFAULT NULL,
  `complemento_imovel` varchar(50) DEFAULT NULL,
  `bairro_imovel` varchar(50) DEFAULT NULL,
  `areaTotal_imovel` int(6) DEFAULT NULL,
  `areaUtil_imovel` int(6) DEFAULT NULL,
  `dormitorios_imovel` int(11) DEFAULT NULL,
  `banheiros_imovel` int(11) DEFAULT NULL,
  `garagem_imovel` int(11) DEFAULT NULL,
  `descricao` text,
  `situacao_imovel` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`cod_imovel`),
  KEY `cod_usuario` (`cod_usuario`),
  KEY `cod_tipoImovel` (`cod_tipoImovel`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imoveis`
--

LOCK TABLES `imoveis` WRITE;
/*!40000 ALTER TABLE `imoveis` DISABLE KEYS */;
INSERT INTO `imoveis` VALUES (21,1,2,'  Imóvel Decente','Imóvel na planta',1000000.00,'Gru','ES','Rua','13b',290,'13b','zaira',100,100,10,10,10,'Muito Elegante. Demais. Genial',1),(22,1,7,'           Imóvel com Planta','Venda',3000000.00,'Gru','ES','Rua','Sítio do Zé',29,'13b','Zaira',100,100,2,2,2,'Belo sítio!',1),(23,1,7,'   Teste Planta','Locação',1500000.00,'Guarulhos','ES','Rua','Conde',30,'29','Zaira',100,100,3,3,3,'Muito Benito!',1);
/*!40000 ALTER TABLE `imoveis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabela_imagens`
--

DROP TABLE IF EXISTS `tabela_imagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tabela_imagens` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_imovel` int(11) DEFAULT NULL,
  `img_nome` varchar(100) DEFAULT NULL,
  `img_caminho` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`img_id`),
  KEY `cod_imovel` (`cod_imovel`)
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabela_imagens`
--

LOCK TABLES `tabela_imagens` WRITE;
/*!40000 ALTER TABLE `tabela_imagens` DISABLE KEYS */;
INSERT INTO `tabela_imagens` VALUES (197,22,'vazio','vazio'),(196,22,'vazio','vazio'),(195,21,'g1.jpg','Fotos/'),(194,21,'g2.jpg','Fotos/'),(193,21,'g3.jpg','Fotos/'),(198,22,'vazio','vazio'),(199,22,'vazio','vazio'),(200,23,'vazio','vazio'),(201,23,'vazio','vazio'),(202,23,'vazio','vazio'),(203,23,'vazio','vazio'),(204,21,'vazio','vazio');
/*!40000 ALTER TABLE `tabela_imagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoimovel`
--

DROP TABLE IF EXISTS `tipoimovel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoimovel` (
  `cod_tipoImovel` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tipoImovel` varchar(50) DEFAULT NULL,
  `categoria_tipoImovel` varchar(15) DEFAULT NULL,
  `situacao_tipoImovel` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`cod_tipoImovel`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoimovel`
--

LOCK TABLES `tipoimovel` WRITE;
/*!40000 ALTER TABLE `tipoimovel` DISABLE KEYS */;
INSERT INTO `tipoimovel` VALUES (1,'Casa','Residencial',1),(2,'Galpão','Comercial',1),(3,'Fazenda','Rural',1),(6,'apartamento','Residencial',1),(7,'sítio','Residencial',1),(8,'chácara','Residencial',1);
/*!40000 ALTER TABLE `tipoimovel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(60) DEFAULT NULL,
  `email_usuario` varchar(60) DEFAULT NULL,
  `senha_usuario` varchar(16) DEFAULT NULL,
  `tipo_usuario` int(11) DEFAULT NULL,
  `situacao_usuario` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`cod_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Tacio Monteiro Costa','taciomcosta@gmail.com','123456',3,1),(2,'admin','admin','admin',1,1),(3,'Operador','op@email.com','123456',2,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-22 17:28:44
