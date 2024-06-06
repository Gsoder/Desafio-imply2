CREATE DATABASE IF NOT EXISTS ClimaDB
    DEFAULT CHARACTER SET = 'utf8mb4';

USE ClimaDB;

CREATE TABLE IF NOT EXISTS Clima(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Temperatura FLOAT NOT NULL,
    Umidade INT NOT NULL,
    Vento FLOAT NOT NULL,
    Sensacao FLOAT NOT NULL,
    Descricao VARCHAR(320),
    Min FLOAT NOT NULL,
    Max FLOAT NOT NULL,
    Icon VARCHAR(10) NOT NULL
);

CREATE TABLE IF NOT EXISTS Historico(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    DataHora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,    
    ClimaID INT NOT NULL,
    Cidade VARCHAR(255) NOT NULL,
    FOREIGN KEY (ClimaID) REFERENCES Clima(ID)
);

INSERT INTO Clima(Temperatura, Umidade, Vento, Sensacao, Descricao) VALUES (18.1, 68, 20, -2, "Test");
INSERT INTO Historico(DataHora, ClimaID, Cidade) VALUES ("2024-06-05 08:30:44", 1, "Santa Cruz do sul");

SELECT c.Temperatura, c.Umidade, c.Vento, c.Sensacao, c.Descricao
FROM Historico h
INNER JOIN Clima c ON h.ClimaID = c.ID
WHERE h.Cidade = "Santa Cruz do sul" AND h.DataHora >= DATE_SUB(NOW(), INTERVAL 1 HOUR);

DROP DATABASE ClimaDB;

INSERT INTO Historico(ClimaID, Cidade) VALUES (1, "Santa Cruz do sul")

SELECT ID FROM Clima WHERE ID = LAST_INSERT_ID()

UPDATE `Historico` SET `DataHora` = "2024-06-05 08:30:44";
UPDATE Clima SET `Umidade` = 10000;

DELETE FROM `Historico`;

DELETE FROM  Clima;

