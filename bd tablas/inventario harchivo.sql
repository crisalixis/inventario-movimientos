CREATE TABLE usuario (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    cargo VARCHAR(50) NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    email varchar(100),
    movil varchar(25)
);
DELETE FROM usuario WHERE usuario = 'admin';


