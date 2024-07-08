CREATE DATABASE le_planes;

USE le_planes;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    telefone VARCHAR(15) NOT NULL UNIQUE,
    horario_atendimento TIME NOT NULL
);

CREATE TABLE procedimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    procedimento VARCHAR(255) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    data_solicitacao DATE NOT NULL DEFAULT (CURRENT_DATE),
    data_marcada DATE NOT NULL,
    horario_marcado time not null,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);
