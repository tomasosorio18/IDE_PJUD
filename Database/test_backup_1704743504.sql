

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(150) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `contrasena` varchar(150) NOT NULL,
  `apiKey` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO usuario VALUES("1","tomas@gmail.com","Tomas Alexis","Osorio","tomas1","af5e489313145060ac84546b9bbed0250e9f9fcdc92a8f");

