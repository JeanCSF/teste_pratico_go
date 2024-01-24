-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.36 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para go_vistoria
DROP DATABASE IF EXISTS `go_vistoria`;
CREATE DATABASE IF NOT EXISTS `go_vistoria` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `go_vistoria`;

-- Copiando estrutura para tabela go_vistoria.fichas
DROP TABLE IF EXISTS `fichas`;
CREATE TABLE IF NOT EXISTS `fichas` (
  `idFicha` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `condutor` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rg` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnh` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selfie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placa` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chassi` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `renavam` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uf` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `km` float NOT NULL,
  `nivelCombustivel` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotoPlaca` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotoDianteira` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotoTraseira` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotoHodometro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotoBancoDianteiro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataCriacao` datetime NOT NULL,
  PRIMARY KEY (`idFicha`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
