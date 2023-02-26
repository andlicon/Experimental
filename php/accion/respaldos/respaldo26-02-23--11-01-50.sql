SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `Experimental`
--




CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cantidad_representados` AS select `p`.`cedula` AS `cedula`,count(0) AS `cantidad` from (`persona` `p` join `estudiante` `e` on(`p`.`cedula` = `e`.`cedula_representante`)) group by `p`.`cedula`;



CREATE TABLE IF NOT EXISTS `clase` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  `salon` varchar(20) NOT NULL,
  `cedula_profe` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descripcion` (`descripcion`),
  UNIQUE KEY `salon` (`salon`),
  KEY `fk_clase_persona` (`cedula_profe`),
  CONSTRAINT `fk_clase_persona` FOREIGN KEY (`cedula_profe`) REFERENCES `persona` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `contacto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cedula` varchar(11) NOT NULL,
  `id_tipo` int(10) unsigned NOT NULL,
  `contacto` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contacto` (`contacto`),
  KEY `fk_contacto_tipo` (`id_tipo`),
  KEY `fk_contacto_persona` (`cedula`),
  CONSTRAINT `fk_contacto_persona` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`),
  CONSTRAINT `fk_contacto_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_contacto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `cuenta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(20) NOT NULL,
  `banco` varchar(40) NOT NULL,
  `rif` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `deuda` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cedula_representante` varchar(11) NOT NULL,
  `id_estudiante` int(10) unsigned NOT NULL,
  `id_motivo` int(10) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(120) DEFAULT '',
  `monto_inicial` double unsigned NOT NULL,
  `monto_estado` double unsigned NOT NULL DEFAULT 0,
  `deuda` double GENERATED ALWAYS AS (`monto_inicial` - `monto_estado`) VIRTUAL,
  PRIMARY KEY (`id`),
  KEY `fk_deuda_persona` (`cedula_representante`),
  KEY `fk_deuda_motivo` (`id_motivo`),
  KEY `fk_estudiante` (`id_estudiante`),
  CONSTRAINT `fk_deuda_motivo` FOREIGN KEY (`id_motivo`) REFERENCES `motivo_deuda` (`id`),
  CONSTRAINT `fk_deuda_persona` FOREIGN KEY (`cedula_representante`) REFERENCES `persona` (`cedula`),
  CONSTRAINT `fk_estudiante` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiante` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `estudiante` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(11) NOT NULL,
  `apellido` varchar(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `cedula_representante` varchar(11) NOT NULL,
  `id_clase` int(10) unsigned DEFAULT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'0',
  `lugar_nacimiento` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_estudiante_representante` (`cedula_representante`),
  KEY `fk_estudiante_clase` (`id_clase`),
  CONSTRAINT `fk_estudiante_clase` FOREIGN KEY (`id_clase`) REFERENCES `clase` (`id`),
  CONSTRAINT `fk_estudiante_representante` FOREIGN KEY (`cedula_representante`) REFERENCES `persona` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `motivo_deuda` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `pago` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_deuda` int(10) unsigned NOT NULL,
  `cedula` varchar(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto` double unsigned NOT NULL,
  `id_cuenta` int(10) unsigned NOT NULL,
  `id_tipo_pago` int(10) unsigned NOT NULL,
  `ref` varchar(11) DEFAULT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  KEY `fk_deuda` (`id_deuda`),
  KEY `fk_cuenta` (`id_cuenta`),
  KEY `fk_tipo_pago` (`id_tipo_pago`),
  KEY `fk_persona` (`cedula`),
  CONSTRAINT `fk_cuenta` FOREIGN KEY (`id_cuenta`) REFERENCES `cuenta` (`id`),
  CONSTRAINT `fk_deuda` FOREIGN KEY (`id_deuda`) REFERENCES `deuda` (`id`),
  CONSTRAINT `fk_persona` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`),
  CONSTRAINT `fk_tipo_pago` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipo_pago` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `persona` (
  `cedula` varchar(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `id_tipo_persona` int(10) unsigned NOT NULL DEFAULT 1,
  `direccion_hogar` varchar(50) NOT NULL,
  `direccion_trabajo` varchar(50) NOT NULL,
  PRIMARY KEY (`cedula`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `fk_tipo_persona` (`id_tipo_persona`),
  CONSTRAINT `fk_tipo_persona` FOREIGN KEY (`id_tipo_persona`) REFERENCES `tipo_persona` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `tipo_contacto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `tipo_pago` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `tipo_persona` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  `permisos` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;



CREATE TABLE IF NOT EXISTS `usuario` (
  `cedula` varchar(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `valido` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`cedula`),
  UNIQUE KEY `cedula` (`cedula`),
  UNIQUE KEY `nickname` (`nickname`),
  CONSTRAINT `fk_personas` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cantidad_contactos` AS select `p`.`cedula` AS `cedula`,count(0) AS `cantidad` from ((`persona` `p` join `contacto` `c` on(`c`.`cedula` = `p`.`cedula`)) join `tipo_contacto` `t` on(`t`.`id` = `c`.`id_tipo`)) group by `p`.`cedula`;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_contacto` AS select `c`.`id` AS `id`,`c`.`cedula` AS `cedula`,`c`.`id_tipo` AS `id_tipo`,`t`.`descripcion` AS `descripcion`,`c`.`contacto` AS `contacto` from (`contacto` `c` join `tipo_contacto` `t` on(`t`.`id` = `c`.`id_tipo`));



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_deuda` AS select `d`.`id` AS `id`,`d`.`cedula_representante` AS `cedula_representante`,`d`.`id_motivo` AS `id_motivo`,`m`.`descripcion` AS `motivo_descripcion`,`d`.`descripcion` AS `deuda_descripcion`,`d`.`fecha` AS `fecha`,`d`.`monto_inicial` AS `monto_inicial`,`d`.`monto_estado` AS `monto_estado`,`d`.`deuda` AS `deuda` from (`deuda` `d` join `motivo_deuda` `m` on(`d`.`id_motivo` = `m`.`id`)) having `deuda` > 0;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_deuda_general` AS select `d`.`cedula_representante` AS `cedula_representante`,`d`.`id_estudiante` AS `id_estudiante`,`d`.`id_motivo` AS `id_motivo`,max(to_days(current_timestamp()) - to_days(`d`.`fecha`)) AS `fecha`,`d`.`descripcion` AS `descripcion`,sum(`d`.`monto_inicial`) AS `monto_inicial`,sum(`d`.`monto_estado`) AS `monto_estado`,sum(`d`.`deuda`) AS `deuda` from `deuda` `d` where `d`.`deuda` > 0 group by `d`.`cedula_representante`,`d`.`id_estudiante` order by `d`.`id_estudiante`;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_deudores` AS select `d`.`cedula_representante` AS `cedula_representante`,sum(`d`.`monto_inicial`) AS `monto_inicial`,sum(`d`.`monto_estado`) AS `monto_estado`,sum(`d`.`deuda`) AS `deuda` from `deuda` `d` where `d`.`deuda` > 0 group by `d`.`cedula_representante` having `deuda` > 0;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_estudiantes` AS select `e`.`id` AS `id`,`e`.`nombre` AS `nombre`,`e`.`apellido` AS `apellido`,`e`.`fecha_nacimiento` AS `fecha_nacimiento`,`e`.`id_clase` AS `id_clase`,`c`.`descripcion` AS `descripcion`,`p`.`cedula` AS `cedula` from ((`estudiante` `e` join `persona` `p` on(`e`.`cedula_representante` = `p`.`cedula`)) join `clase` `c` on(`e`.`id_clase` = `c`.`id`));



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_movimientos` AS select concat('P',`p`.`id`) AS `id`,`p`.`cedula` AS `cedula`,`p`.`fecha` AS `fecha`,(select concat('Pago de deuda: D',`d1`.`id`,'. Perteneciente al estudiante: ',`e1`.`nombre`,' ',`e1`.`apellido`) from ((`pago` `p1` join `deuda` `d1` on(`p1`.`id_deuda` = `d1`.`id`)) join `estudiante` `e1` on(`e1`.`id` = `d1`.`id_estudiante`)) where `p`.`id` = `p1`.`id`) AS `descripcion`,`p`.`monto` AS `monto` from `pago` `p` where `p`.`valido` = 1 union select concat('D',`d`.`id`) AS `id`,`d`.`cedula_representante` AS `cedula_representante`,`d`.`fecha` AS `fecha`,`d`.`descripcion` AS `descripcion`,`d`.`monto_inicial` * -1 AS `d.monto_inicial*-1` from `deuda` `d` order by `fecha` desc;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_persona_contacto` AS select `p`.`cedula` AS `cedula`,`p`.`nombre` AS `nombre`,`p`.`apellido` AS `apellido`,`tc`.`descripcion` AS `descripcion`,`c`.`contacto` AS `contacto` from ((`persona` `p` join `contacto` `c` on(`p`.`cedula` = `c`.`cedula`)) join `tipo_contacto` `tc` on(`c`.`id_tipo` = `tc`.`id`)) order by `p`.`cedula`;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_persona_contactos` AS select `p`.`cedula` AS `cedula`,`t`.`descripcion` AS `descripcion`,`c`.`contacto` AS `contacto` from ((`persona` `p` join `contacto` `c` on(`c`.`cedula` = `p`.`cedula`)) join `tipo_contacto` `t` on(`t`.`id` = `c`.`id_tipo`));



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_persona_correo` AS select `p`.`cedula` AS `cedula`,`t`.`descripcion` AS `descripcion`,`c`.`contacto` AS `contacto` from ((`persona` `p` join `contacto` `c` on(`c`.`cedula` = `p`.`cedula`)) join `tipo_contacto` `t` on(`t`.`id` = `c`.`id_tipo`)) where `t`.`descripcion` = 'correo';



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_personas` AS select `p`.`cedula` AS `cedula`,`p`.`nombre` AS `nombre`,`p`.`apellido` AS `apellido`,`c`.`id_tipo` AS `id_tipo`,`t`.`descripcion` AS `descripcion`,`c`.`contacto` AS `contacto` from ((`persona` `p` join `contacto` `c` on(`p`.`cedula` = `c`.`cedula`)) join `tipo_contacto` `t` on(`t`.`id` = `c`.`id_tipo`)) group by `p`.`cedula`,`c`.`id_tipo`;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profesores` AS select `p`.`cedula` AS `cedula`,`p`.`nombre` AS `nombre`,`p`.`apellido` AS `apellido` from (`persona` `p` join `clase` `cl` on(`cl`.`cedula_profe` = `p`.`cedula`)) group by `p`.`cedula`;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_profesores_contacto` AS select `p`.`cedula` AS `cedula`,`p`.`nombre` AS `nombre`,`p`.`apellido` AS `apellido`,`c`.`id_tipo` AS `id_tipo`,`t`.`descripcion` AS `descrip_contacto`,`c`.`contacto` AS `contacto`,`cl`.`id` AS `id_clase`,`cl`.`descripcion` AS `descrip_clase`,`cl`.`salon` AS `salon` from (((`persona` `p` join `contacto` `c` on(`p`.`cedula` = `c`.`cedula`)) join `tipo_contacto` `t` on(`t`.`id` = `c`.`id_tipo`)) join `clase` `cl` on(`cl`.`cedula_profe` = `p`.`cedula`)) group by `p`.`cedula`,`c`.`id_tipo`;



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_representante_valido` AS select `p`.`cedula` AS `cedula`,`p`.`nombre` AS `nombre`,`p`.`apellido` AS `apellido`,`p`.`id_tipo_persona` AS `id_tipo_persona` from ((`persona` `p` join `tipo_persona` `t` on(`p`.`id_tipo_persona` = `t`.`id`)) join `usuario` `u` on(`u`.`cedula` = `p`.`cedula`)) where `t`.`descripcion` like '%representante%' and `u`.`valido` = 1;


INSERT INTO cantidad_representados VALUES
("V-1","1"),
("V-11111111","1"),
("V-11121231","1"),
("V-11254230","1"),
("V-11254234","1"),
("V-11254239","1"),
("V-12354788","1"),
("V-22222222","1"),
("V-26520327","2"),
("V-33333333","1"),
("V-741147","1"),
("V-77474747","1");



INSERT INTO clase VALUES
("1","Primer nivel","pb-1",""),
("2","Segundo nivel","pb-2",""),
("3","Tercer nivel","pb-3",""),
("4","Primer grado","1-1",""),
("5","Segundo grado","1-2",""),
("6","Tercer grado","1-3",""),
("7","cuarto grado","1-4",""),
("8","Quinto grado","1-5",""),
("9","Sexto grado","1-6","");



INSERT INTO contacto VALUES
("1","V-26520327","1","andresjzabalac@hotmail.com"),
("2","V-26520327","2","0426-6883542"),
("3","V-741147","1","andres@.com"),
("4","V-741147","2","0415-5587798"),
("5","V-1","1","asda@.com"),
("6","V-1","2","1515-1515151"),
("7","V-11111111","1","andres"),
("8","V-11111111","2","1"),
("11","V-22222222","1","a"),
("12","V-22222222","2","1222-22"),
("15","V-11121231","1","aaaa"),
("16","V-11121231","2","1111-1111111"),
("17","V-33333333","1","pollo@hotmail.com"),
("18","V-33333333","2","1231-2312312"),
("19","V-12354788","1","pepe@pepe.com"),
("20","V-12354788","2","1238-5788487"),
("21","V-77474747","1","a@a.com"),
("22","V-77474747","2","1258-7878787"),
("24","V-11254234","1","aqa.com"),
("25","V-11254234","2","1123-1453446"),
("27","V-11254239","1","aqa"),
("28","V-11254239","2","1123-1453449"),
("31","V-11254230","1","aqasd@@"),
("32","V-11254230","2","1123-1451111");



INSERT INTO cuenta VALUES
("1","0485-51277","Mercantil","J-15154848");



INSERT INTO deuda VALUES
("2","v-26520327","1","2","2022-12-02","descripción","100","100","0"),
("3","v-26520327","1","1","2023-02-13","descripcion","1000","0","1000");



INSERT INTO estudiante VALUES
("1","andres","zabala","0003-03-03","v-26520327","1","0","NO ESPECIFICADO"),
("3","An","dres","0001-01-01","V-741147","1","0","NO ESPECIFICADO"),
("4","a","a","0001-01-01","V-1","1","0","NO ESPECIFICADO"),
("5","a","a","0001-11-01","V-11111111","","0",""),
("6","a","a","0003-02-01","V-22222222","","0",""),
("7","a","a","0003-02-01","V-11121231","","0",""),
("8","pollito","pollito","0001-01-01","V-33333333","","0",""),
("9","pepito","pepito","0006-02-01","V-12354788","","0","pepito lugar nacimiento"),
("10","a","a","0001-01-01","V-77474747","","0","a"),
("11","a","a","0003-02-01","V-11254234","","0","a"),
("12","a","a","0003-02-01","V-11254239","","0","a"),
("13","a","a","0003-02-01","V-11254230","","0","a"),
("14","PRUEBA1","prueba1","2023-02-24","V-26520327","","1","no sé");



INSERT INTO motivo_deuda VALUES
("1","mensualidad"),
("2","vandalismo");



INSERT INTO pago VALUES
("1","2","V-26520327","2023-02-13","100","1","1","15","1"),
("2","2","V-26520327","2023-02-25","100","1","2","201411","1");



INSERT INTO persona VALUES
("v-01","admin","admin","4","cda","abc"),
("V-1","asds","asd","1","",""),
("V-11111111","aaaaaaaaaaaaaaa","aaaaaaaaaaaaaaa","1","",""),
("V-11121231","a","a","1","",""),
("V-11254230","a","a","1","a","a"),
("V-11254234","a","a","1","a","a"),
("V-11254239","a","a","1","a","a"),
("V-12354788","pepe","pepe","1","hogar pepe","trabajo pepe"),
("V-22222222","a","a","1","",""),
("V-26520327","Andrés","Zabala","1","",""),
("V-33333333","pollo","pollo","1","direccion hogar","direccion trabajo"),
("V-741147","Andrés","Zabalaita","1","",""),
("V-77474747","a","a","1","a","a");



INSERT INTO tipo_contacto VALUES
("1","correo"),
("2","telefono");



INSERT INTO tipo_pago VALUES
("1","transferencia"),
("2","pago movil");



INSERT INTO tipo_persona VALUES
("1","representante","1"),
("2","profesor","2"),
("3","profesor y representante","3"),
("4","administrador","4");



INSERT INTO usuario VALUES
("V-01","admin","admin","1"),
("V-1","aaaaaaa","asasa","0"),
("V-11111111","aaaaaaaaaaaaaaa","aaaaaaaaaaaaaaa","0"),
("V-11121231","ababva","aasasas","0"),
("V-11254230","asaaa1","aaaaaaaas","0"),
("V-11254234","asaaaas","aaaaaaaas","0"),
("V-11254239","asaaaa","aaaaaaaas","0"),
("V-12354788","pepito","pepito","0"),
("V-22222222","bbbbbbbbbbbbbbb","bbbbbbbbbbbbbbb","0"),
("V-26520327","andres","123","1"),
("V-33333333","pollito123","polliito123","0"),
("V-741147","andres11","asas","0"),
("V-77474747","aaaaas","aaaaaaaaaas","0");



INSERT INTO v_cantidad_contactos VALUES
("V-1","2"),
("V-11111111","2"),
("V-11121231","2"),
("V-11254230","2"),
("V-11254234","2"),
("V-11254239","2"),
("V-12354788","2"),
("V-22222222","2"),
("V-26520327","2"),
("V-33333333","2"),
("V-741147","2"),
("V-77474747","2");



INSERT INTO v_contacto VALUES
("1","V-26520327","1","correo","andresjzabalac@hotmail.com"),
("3","V-741147","1","correo","andres@.com"),
("5","V-1","1","correo","asda@.com"),
("7","V-11111111","1","correo","andres"),
("11","V-22222222","1","correo","a"),
("15","V-11121231","1","correo","aaaa"),
("17","V-33333333","1","correo","pollo@hotmail.com"),
("19","V-12354788","1","correo","pepe@pepe.com"),
("21","V-77474747","1","correo","a@a.com"),
("24","V-11254234","1","correo","aqa.com"),
("27","V-11254239","1","correo","aqa"),
("31","V-11254230","1","correo","aqasd@@"),
("2","V-26520327","2","telefono","0426-6883542"),
("4","V-741147","2","telefono","0415-5587798"),
("6","V-1","2","telefono","1515-1515151"),
("8","V-11111111","2","telefono","1"),
("12","V-22222222","2","telefono","1222-22"),
("16","V-11121231","2","telefono","1111-1111111"),
("18","V-33333333","2","telefono","1231-2312312"),
("20","V-12354788","2","telefono","1238-5788487"),
("22","V-77474747","2","telefono","1258-7878787"),
("25","V-11254234","2","telefono","1123-1453446"),
("28","V-11254239","2","telefono","1123-1453449"),
("32","V-11254230","2","telefono","1123-1451111");



INSERT INTO v_deuda VALUES
("3","v-26520327","1","mensualidad","descripcion","2023-02-13","1000","0","1000");



INSERT INTO v_deuda_general VALUES
("v-26520327","1","1","13","descripcion","1000","0","1000");



INSERT INTO v_deudores VALUES
("v-26520327","1000","0","1000");



INSERT INTO v_estudiantes VALUES
("1","andres","zabala","0003-03-03","1","Primer nivel","V-26520327"),
("3","An","dres","0001-01-01","1","Primer nivel","V-741147"),
("4","a","a","0001-01-01","1","Primer nivel","V-1");



INSERT INTO v_movimientos VALUES
("P2","V-26520327","2023-02-25","Pago de deuda: D2. Perteneciente al estudiante: andres zabala","100"),
("D3","v-26520327","2023-02-13","descripcion","-1000"),
("P1","V-26520327","2023-02-13","Pago de deuda: D2. Perteneciente al estudiante: andres zabala","100"),
("D2","v-26520327","2022-12-02","descripción","-100");



INSERT INTO v_persona_contacto VALUES
("V-1","asds","asd","telefono","1515-1515151"),
("V-1","asds","asd","correo","asda@.com"),
("V-11111111","aaaaaaaaaaaaaaa","aaaaaaaaaaaaaaa","correo","andres"),
("V-11111111","aaaaaaaaaaaaaaa","aaaaaaaaaaaaaaa","telefono","1"),
("V-11121231","a","a","telefono","1111-1111111"),
("V-11121231","a","a","correo","aaaa"),
("V-11254230","a","a","correo","aqasd@@"),
("V-11254230","a","a","telefono","1123-1451111"),
("V-11254234","a","a","telefono","1123-1453446"),
("V-11254234","a","a","correo","aqa.com"),
("V-11254239","a","a","correo","aqa"),
("V-11254239","a","a","telefono","1123-1453449"),
("V-12354788","pepe","pepe","correo","pepe@pepe.com"),
("V-12354788","pepe","pepe","telefono","1238-5788487"),
("V-22222222","a","a","correo","a"),
("V-22222222","a","a","telefono","1222-22"),
("V-26520327","Andrés","Zabala","correo","andresjzabalac@hotmail.com"),
("V-26520327","Andrés","Zabala","telefono","0426-6883542"),
("V-33333333","pollo","pollo","telefono","1231-2312312"),
("V-33333333","pollo","pollo","correo","pollo@hotmail.com"),
("V-741147","Andrés","Zabalaita","correo","andres@.com"),
("V-741147","Andrés","Zabalaita","telefono","0415-5587798"),
("V-77474747","a","a","correo","a@a.com"),
("V-77474747","a","a","telefono","1258-7878787");



INSERT INTO v_persona_contactos VALUES
("V-26520327","correo","andresjzabalac@hotmail.com"),
("V-741147","correo","andres@.com"),
("V-1","correo","asda@.com"),
("V-11111111","correo","andres"),
("V-22222222","correo","a"),
("V-11121231","correo","aaaa"),
("V-33333333","correo","pollo@hotmail.com"),
("V-12354788","correo","pepe@pepe.com"),
("V-77474747","correo","a@a.com"),
("V-11254234","correo","aqa.com"),
("V-11254239","correo","aqa"),
("V-11254230","correo","aqasd@@"),
("V-26520327","telefono","0426-6883542"),
("V-741147","telefono","0415-5587798"),
("V-1","telefono","1515-1515151"),
("V-11111111","telefono","1"),
("V-22222222","telefono","1222-22"),
("V-11121231","telefono","1111-1111111"),
("V-33333333","telefono","1231-2312312"),
("V-12354788","telefono","1238-5788487"),
("V-77474747","telefono","1258-7878787"),
("V-11254234","telefono","1123-1453446"),
("V-11254239","telefono","1123-1453449"),
("V-11254230","telefono","1123-1451111");



INSERT INTO v_persona_correo VALUES
("V-26520327","correo","andresjzabalac@hotmail.com"),
("V-741147","correo","andres@.com"),
("V-1","correo","asda@.com"),
("V-11111111","correo","andres"),
("V-22222222","correo","a"),
("V-11121231","correo","aaaa"),
("V-33333333","correo","pollo@hotmail.com"),
("V-12354788","correo","pepe@pepe.com"),
("V-77474747","correo","a@a.com"),
("V-11254234","correo","aqa.com"),
("V-11254239","correo","aqa"),
("V-11254230","correo","aqasd@@");



INSERT INTO v_personas VALUES
("V-1","asds","asd","1","correo","asda@.com"),
("V-1","asds","asd","2","telefono","1515-1515151"),
("V-11111111","aaaaaaaaaaaaaaa","aaaaaaaaaaaaaaa","1","correo","andres"),
("V-11111111","aaaaaaaaaaaaaaa","aaaaaaaaaaaaaaa","2","telefono","1"),
("V-11121231","a","a","1","correo","aaaa"),
("V-11121231","a","a","2","telefono","1111-1111111"),
("V-11254230","a","a","1","correo","aqasd@@"),
("V-11254230","a","a","2","telefono","1123-1451111"),
("V-11254234","a","a","1","correo","aqa.com"),
("V-11254234","a","a","2","telefono","1123-1453446"),
("V-11254239","a","a","1","correo","aqa"),
("V-11254239","a","a","2","telefono","1123-1453449"),
("V-12354788","pepe","pepe","1","correo","pepe@pepe.com"),
("V-12354788","pepe","pepe","2","telefono","1238-5788487"),
("V-22222222","a","a","1","correo","a"),
("V-22222222","a","a","2","telefono","1222-22"),
("V-26520327","Andrés","Zabala","1","correo","andresjzabalac@hotmail.com"),
("V-26520327","Andrés","Zabala","2","telefono","0426-6883542"),
("V-33333333","pollo","pollo","1","correo","pollo@hotmail.com"),
("V-33333333","pollo","pollo","2","telefono","1231-2312312"),
("V-741147","Andrés","Zabalaita","1","correo","andres@.com"),
("V-741147","Andrés","Zabalaita","2","telefono","0415-5587798"),
("V-77474747","a","a","1","correo","a@a.com"),
("V-77474747","a","a","2","telefono","1258-7878787");









INSERT INTO v_representante_valido VALUES
("V-26520327","Andrés","Zabala","1");




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;