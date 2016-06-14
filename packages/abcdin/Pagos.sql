 -- --------------------------------------------------------
-- Host:                         192.168.235.129
-- Versión del servidor:         5.5.47 - MySQL Community Server (GPL) by Remi
-- SO del servidor:              Linux
-- HeidiSQL Versión:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para asterisk
CREATE DATABASE IF NOT EXISTS `asterisk` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `asterisk`;


-- Volcando estructura para tabla asterisk.sistema_temporal_pagos
DROP TABLE IF EXISTS `sistema_temporal_pagos`;
CREATE TABLE IF NOT EXISTS `sistema_temporal_pagos` (
  `cuenta` varchar(500) DEFAULT NULL,
  `fecha1` varchar(50) DEFAULT NULL,
  `monto` varchar(50) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `fecha2` varchar(50) DEFAULT NULL,
  KEY `cuenta` (`cuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para disparador asterisk.sistema_pagos_after_insert
DROP TRIGGER IF EXISTS `sistema_pagos_after_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `sistema_pagos_after_insert` AFTER INSERT ON `sistema_pagos` FOR EACH ROW BEGIN

insert into sistema_gestiones  (fecha,campaign,monto_compromiso,glosa,user,rut_cliente,deuda_total) values (new.fecha, new.campaign, new.monto,concat('CLIENTE PAGO EL ',new.fecha),'VDAD', new.rut, new.monto )
;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
