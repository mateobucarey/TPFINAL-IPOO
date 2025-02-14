CREATE DATABASE bdviajes; 

CREATE TABLE empresa(
    idempresa bigint AUTO_INCREMENT,
    enombre varchar(150),
    edireccion varchar(150),
    PRIMARY KEY (idempresa)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE responsable (
    rnumeroempleado bigint AUTO_INCREMENT,
    rnumerolicencia bigint,
	rnombre varchar(150), 
    rapellido  varchar(150),
    rnrodocumento int(11),
    PRIMARY KEY (rnumeroempleado),
    FOREIGN KEY (rnrodocumento) REFERENCES persona(nrodocumento) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
	
CREATE TABLE viaje (
    idviaje bigint AUTO_INCREMENT, /*codigo de viaje*/
	vdestino varchar(150),
    vcantmaxpasajeros int,
	idempresa bigint,
    rnumeroempleado bigint,
    vimporte float,
    PRIMARY KEY (idviaje),
    FOREIGN KEY (idempresa) REFERENCES empresa (idempresa),
	FOREIGN KEY (rnumeroempleado) REFERENCES responsable (rnumeroempleado)
    ON UPDATE CASCADE
    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;
	
CREATE TABLE pasajero (
    pdocumento varchar(15) PRIMARY KEY,
    pnombre varchar(150), 
    papellido varchar(150), 
	ptelefono int, 
	idviaje bigint,
	FOREIGN KEY (idviaje) REFERENCES viaje (idviaje),	
    FOREIGN KEY (pdocumento) REFERENCES persona(nrodocumento) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB DEFAULT CHARSET=utf8; 
 
 CREATE TABLE persona (
    nombre varchar(150),
    apellido varchar(150),
    nrodocumento varchar(15),
    PRIMARY KEY (nrodocumento)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
