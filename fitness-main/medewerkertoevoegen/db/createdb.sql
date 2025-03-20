
DROP DATABASE IF EXISTS `medewerker-overzicht`;

    CREATE DATABASE `medewerker-overzicht`;

    USE `medewerker-overzicht`;

CREATE TABLE Medewerkers (
    Id                   TINYINT         UNSIGNED       NOT NULL    PRIMARY KEY AUTO_INCREMENT
    ,Naam                VARCHAR(255) NOT NULL
    ,Leeftijd            TINYINT        UNSIGNED       NOT NULL
    ,Email               VARCHAR(255) NOT NULL
) ENGINE=InnoDB;


INSERT INTO Medewerkers
(
  Id
,Naam
,Leeftijd
,Email
)
VALUES
('1', 'John Doe', '18', 'john.doe@me.com')