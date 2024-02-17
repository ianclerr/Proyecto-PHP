
CREATE TABLE Clientes (
    ClienteID INT AUTO_INCREMENT PRIMARY KEY,
    Usuario VARCHAR(50),
    Nombre VARCHAR(255) NOT NULL,
    Direccion VARCHAR(255),
    Telefono VARCHAR(15),
);

CREATE TABLE Secretarias (
    SecretariaID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    Email VARCHAR(255)
);


CREATE TABLE Tecnicos (
    TecnicoID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    Especialidad VARCHAR(255)
);


CREATE TABLE Solicitudes (
    SolicitudID INT AUTO_INCREMENT PRIMARY KEY,
    TipoSolicitud ENUM('Nuevo', 'Reclamo') NOT NULL,
    ClienteID INT,
    SecretariaID INT,
    FechaSolicitud DATE,
    Estado VARCHAR(20) NOT NULL,
    FOREIGN KEY (ClienteID) REFERENCES Clientes(ClienteID),
    FOREIGN KEY (SecretariaID) REFERENCES Secretarias(SecretariaID)
);

CREATE TABLE Instalaciones (
    InstalacionID INT AUTO_INCREMENT PRIMARY KEY,
    TipoInstalacion ENUM('Confirmar') NOT NULL,
    TecnicoID INT,
    FechaInstalacion DATE,
    Estado VARCHAR(20) NOT NULL,
    FOREIGN KEY (TecnicoID) REFERENCES Tecnicos(TecnicoID)
);


CREATE TABLE Mantenimientos (
    MantenimientoID INT AUTO_INCREMENT PRIMARY KEY,
    TipoMantenimiento ENUM('Confirmar, Rechazar') NOT NULL,
    TecnicoID INT,
    FechaMantenimiento DATE,
    Estado VARCHAR(20) NOT NULL,
    FOREIGN KEY (TecnicoID) REFERENCES Tecnicos(TecnicoID)
);
