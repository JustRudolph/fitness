
DROP DATABASE IF EXISTS `leden-overzicht`;

    CREATE DATABASE `leden-overzicht`;

    USE `leden-overzicht`;

CREATE TABLE LedenOverzicht (
    Id                   TINYINT         UNSIGNED       NOT NULL    PRIMARY KEY AUTO_INCREMENT
    ,Naam                VARCHAR(255) NOT NULL
    ,Leeftijd            TINYINT        UNSIGNED       NOT NULL
    ,Email             VARCHAR(255) NOT NULL
    ,Programma         VARCHAR(255) NOT NULL
) ENGINE=InnoDB;


INSERT INTO LedenOverzicht
(
  Id
,Naam
,Leeftijd
,Email
,Programma
)
VALUES
('1', 'Jane Doe', '16', 'matiebal@email.com', 'Placeholder')
