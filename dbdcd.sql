-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: dbpc3020181
-- ------------------------------------------------------
-- Server version	5.6.10-log

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
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` VALUES (1,'Barbearia',1),(2,'Centro Estético',1);
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fconosco`
--

DROP TABLE IF EXISTS `tbl_fconosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fconosco` (
  `nome` varchar(255) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `email` varchar(350) DEFAULT NULL,
  `home` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `informacao` varchar(255) DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `profissao` varchar(100) DEFAULT NULL,
  `critica` varchar(500) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fconosco`
--

LOCK TABLES `tbl_fconosco` WRITE;
/*!40000 ALTER TABLE `tbl_fconosco` DISABLE KEYS */;
INSERT INTO `tbl_fconosco` VALUES ('teste','(11) 4619-2892','(11) 46192-8922','sdsa@sadsdsa','http://www.www.www','http://www.www.www','asdasdass','M','asdasdasfa','sdfasdfasdfsda',3),('Lucas Eduardo','(11) 4619-2892','(11) 46192-8922','sdsa@sadsdsa','http://www.www.www','http://www.www.www','asdasdass','M','wsrfsdgdssda','sdfgsdgdsagdasgsd',4),('Lucas Eduardo','(11) 4619-2892','(11) 46192-8922','sdsa@sadsdsa','http://www.www.www','http://www.www.www','adfasfasfas','M','sdfgsdgsdgasdg','sdfgsdgsdag',5);
/*!40000 ALTER TABLE `tbl_fconosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_niveis`
--

DROP TABLE IF EXISTS `tbl_niveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_niveis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_niveis`
--

LOCK TABLES `tbl_niveis` WRITE;
/*!40000 ALTER TABLE `tbl_niveis` DISABLE KEYS */;
INSERT INTO `tbl_niveis` VALUES (1,'administrador',NULL),(3,'básico',NULL),(4,'cataloguista',NULL);
/*!40000 ALTER TABLE `tbl_niveis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produtos`
--

DROP TABLE IF EXISTS `tbl_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `preco` decimal(10,0) DEFAULT NULL,
  `destaque` tinyint(1) DEFAULT NULL,
  `idSessao` int(11) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `idSubcategoria` int(11) DEFAULT NULL,
  `clique` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idSessao` (`idSessao`),
  CONSTRAINT `tbl_produtos_ibfk_1` FOREIGN KEY (`idSessao`) REFERENCES `tbl_sessao` (`id`),
  CONSTRAINT `tbl_produtos_ibfk_2` FOREIGN KEY (`idSessao`) REFERENCES `tbl_sessao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produtos`
--

LOCK TABLES `tbl_produtos` WRITE;
/*!40000 ALTER TABLE `tbl_produtos` DISABLE KEYS */;
INSERT INTO `tbl_produtos` VALUES (1,'teste','asdasdas',23,1,9,'arquivos/d5ee1cf970192eba903f1e6f7151c79d33828812_2127686030842324_4865404494109736960_n.jpg',1,NULL,5),(2,'teste1','teste2',23,0,9,NULL,NULL,NULL,1),(3,'teste','teste2',23,0,9,NULL,0,NULL,0),(5,'t','3',2,NULL,9,'arquivos/96a589e1650aebaa66f76e5c188a9ece33828812_2127686030842324_4865404494109736960_n.jpg',NULL,NULL,1),(6,'1','3',2,NULL,9,'arquivos/d38885b17993fcdb2746d8dee642ff8e33825142_1956909220994986_2617223267680780288_n.jpg',1,3,1),(7,'reste','teste',123,NULL,9,'arquivos/06ca8d3d456c907e5f3b944d1c4bb417DdlwvPyVMAExuC-.jpg',1,2,0);
/*!40000 ALTER TABLE `tbl_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promocao`
--

DROP TABLE IF EXISTS `tbl_promocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_promocao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) DEFAULT NULL,
  `idSessao` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `preco` decimal(10,0) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idProduto` (`idProduto`),
  KEY `idSessao` (`idSessao`),
  CONSTRAINT `tbl_promocao_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `tbl_produtos` (`id`),
  CONSTRAINT `tbl_promocao_ibfk_2` FOREIGN KEY (`idSessao`) REFERENCES `tbl_sessao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promocao`
--

LOCK TABLES `tbl_promocao` WRITE;
/*!40000 ALTER TABLE `tbl_promocao` DISABLE KEYS */;
INSERT INTO `tbl_promocao` VALUES (3,1,7,1,123,'arquivos/21556f01ed1da7209a95f456b60f8929border-collie-head (1).png'),(5,1,8,1,123,'arquivos/e8736387879ca08e912942252ef0cf5eboat-island-ocean-218999.jpg');
/*!40000 ALTER TABLE `tbl_promocao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sessao`
--

DROP TABLE IF EXISTS `tbl_sessao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sessao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sessao`
--

LOCK TABLES `tbl_sessao` WRITE;
/*!40000 ALTER TABLE `tbl_sessao` DISABLE KEYS */;
INSERT INTO `tbl_sessao` VALUES (1,'serviços'),(2,'atracao'),(3,'história'),(4,'estabelecimento'),(5,'fundadores'),(6,'lojas'),(7,'principal'),(8,'secundario'),(9,'produtos');
/*!40000 ALTER TABLE `tbl_sessao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobre_barbearia`
--

DROP TABLE IF EXISTS `tbl_sobre_barbearia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sobre_barbearia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` mediumtext,
  `imagem` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `idSessao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idSessao` (`idSessao`),
  CONSTRAINT `tbl_sobre_barbearia_ibfk_1` FOREIGN KEY (`idSessao`) REFERENCES `tbl_sessao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobre_barbearia`
--

LOCK TABLES `tbl_sobre_barbearia` WRITE;
/*!40000 ALTER TABLE `tbl_sobre_barbearia` DISABLE KEYS */;
INSERT INTO `tbl_sobre_barbearia` VALUES (3,'teste','tesste','arquivos/893ebb8d1f2dcb37088a6f4ae25c2920boat-island-ocean-218999.jpg',1,1),(4,'asdsadas','dsadsa','arquivos/79c7d2744d3deb596a8f612130befed5border-collie-head.png',1,2),(16,'teste','teste','arquivos/7bd9ade6da5c0a3fecc9930e4875b9f6pexels-photo-897271.jpeg',1,1),(18,'lanche do marcel 666','teste teste','arquivos/b40ae2c6fd6fdae92fd2c18a6d53aa61mvc.jpg',1,2);
/*!40000 ALTER TABLE `tbl_sobre_barbearia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobre_lojas`
--

DROP TABLE IF EXISTS `tbl_sobre_lojas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sobre_lojas` (
  `rua` varchar(255) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `idSessao` int(11) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `idSessao` (`idSessao`),
  CONSTRAINT `tbl_sobre_lojas_ibfk_1` FOREIGN KEY (`idSessao`) REFERENCES `tbl_sessao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobre_lojas`
--

LOCK TABLES `tbl_sobre_lojas` WRITE;
/*!40000 ALTER TABLE `tbl_sobre_lojas` DISABLE KEYS */;
INSERT INTO `tbl_sobre_lojas` VALUES ('testeqa',214332,'teste','teste','teste','34324','324324',1,6,'arquivos/c4c255d2ba5b0930b7b9c47d48a0600fborder-collie-head (1).png',4);
/*!40000 ALTER TABLE `tbl_sobre_lojas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobre_penelope`
--

DROP TABLE IF EXISTS `tbl_sobre_penelope`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sobre_penelope` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` mediumtext,
  `imagem` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `idSessao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idSessao` (`idSessao`),
  CONSTRAINT `tbl_sobre_penelope_ibfk_1` FOREIGN KEY (`idSessao`) REFERENCES `tbl_sessao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobre_penelope`
--

LOCK TABLES `tbl_sobre_penelope` WRITE;
/*!40000 ALTER TABLE `tbl_sobre_penelope` DISABLE KEYS */;
INSERT INTO `tbl_sobre_penelope` VALUES (5,'teste','testea','arquivos/a99daf8f184fa3eeab11644259d72f3022aujp.jpg',1,1),(6,'teste2','teste2','arquivos/ca9c0cd25995f8b61ad19e21d4a4782e22aujp.jpg',1,2),(7,'asdasdas','sadsadas','arquivos/a0cabedfb12ab84cb354b43318cb3a4833828812_2127686030842324_4865404494109736960_n.jpg',1,1),(8,'sadsadsa','dsdasdas','arquivos/40021c1da75738370f4e1e2771e7536733828812_2127686030842324_4865404494109736960_n.jpg',1,1),(9,'asdsadsad','sadsadasdas','arquivos/904a1e2d344b58610d82ae8fe03b20d333828812_2127686030842324_4865404494109736960_n.jpg',1,1),(10,'asdsadsadas','asdsadsadas','arquivos/5e9f2372b62b65acb5b337f1c150934a33828812_2127686030842324_4865404494109736960_n.jpg',1,2);
/*!40000 ALTER TABLE `tbl_sobre_penelope` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobre_projeto`
--

DROP TABLE IF EXISTS `tbl_sobre_projeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sobre_projeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) DEFAULT NULL,
  `subtitulo` varchar(255) DEFAULT NULL,
  `descricao` mediumtext,
  `imagem` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `idSessao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idSessao` (`idSessao`),
  CONSTRAINT `tbl_sobre_projeto_ibfk_1` FOREIGN KEY (`idSessao`) REFERENCES `tbl_sessao` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobre_projeto`
--

LOCK TABLES `tbl_sobre_projeto` WRITE;
/*!40000 ALTER TABLE `tbl_sobre_projeto` DISABLE KEYS */;
INSERT INTO `tbl_sobre_projeto` VALUES (2,'1','1','1','arquivos/b3f5b63daaeadcca151bba37d8ff4ee3boat-island-ocean-218999.jpg',1,4),(3,'1','2','3','arquivos/829f058e194b714019de7d6f8113c05822aujp.jpg',1,3),(4,'teste','teste',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend tortor a varius congue. Suspendisse faucibus eleifend nisl, nec fringilla lectus dignissim vel. Sed vitae ullamcorper ante. Sed ligula neque, malesuada quis velit sodales, molestie mattis lacus. Integer eu facilisis velit, non eleifend quam. Aliquam id nisl sapien. Sed et sollicitudin elit, et ultricies justo. Ut ligula sem, mollis vel mi a, fringilla auctor metus. Quisque ipsum turpis, tristique sit amet augue eget, pellentesque porta purus. ','arquivos/b5e459897f26be402fc0b297f4fbe38epexels-photo-897271.jpeg',1,5);
/*!40000 ALTER TABLE `tbl_sobre_projeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subcategoria`
--

DROP TABLE IF EXISTS `tbl_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_subcategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idCategoria` (`idCategoria`),
  CONSTRAINT `tbl_subcategoria_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `tbl_categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subcategoria`
--

LOCK TABLES `tbl_subcategoria` WRITE;
/*!40000 ALTER TABLE `tbl_subcategoria` DISABLE KEYS */;
INSERT INTO `tbl_subcategoria` VALUES (1,'Shampoo',1,1),(2,'Barba',1,1),(3,'Tatuagens',1,1),(4,'Shampoo',2,1);
/*!40000 ALTER TABLE `tbl_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_teste`
--

DROP TABLE IF EXISTS `tbl_teste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_teste` (
  `nome` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_teste`
--

LOCK TABLES `tbl_teste` WRITE;
/*!40000 ALTER TABLE `tbl_teste` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_teste` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `idNivel` int(10) unsigned NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idNivel` (`idNivel`),
  CONSTRAINT `tbl_usuario_ibfk_1` FOREIGN KEY (`idNivel`) REFERENCES `tbl_niveis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (2,'Administrador','admin@admin.com','admin','21232f297a57a5a743894a0e4a801fc3',1,'arquivos/95e71c7514d485cf44b77631d9fe489fborder-collie-head (1).png',1),(3,'Lucas Eduardo','lucased78@hotmail.com','lucased78','c6343758545a8dba60d7364d47493b3f',1,'arquivos/9668928957cd241162fe77cd3c32e5acescudo-do-palmeiras-vinil-emborrachado-termocolante--D_NQ_NP_520811-MLB20641849384_032016-F.jpg',0),(4,'marcel','marcel@hotmal.com','marcelnt','202cb962ac59075b964b07152d234b70',1,'arquivos/368fe7e1eab49acebdb43148f7657432mvc.jpg',1),(5,'base','base@teste.com','base','be6c5347746fae91bd02a52a114ee14f',3,'arquivos/4655f80023fa352751fea06e98fa0c5522aujp.jpg',1);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-12 15:08:52
