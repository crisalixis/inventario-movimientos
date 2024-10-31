CREATE TABLE cargos (
    idCargo INT AUTO_INCREMENT PRIMARY KEY,
    nombreCargo VARCHAR(50) NOT NULL
);

INSERT INTO cargos (nombreCargo) VALUES 
('Administrador'),
('Invitado'),
('Encargado'),
('Pañolero'),
('Directivo'),
('Docente'),
('Estudiante');
