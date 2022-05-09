-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 14 mars 2022 à 13:41
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;




CREATE TABLE `enseignant` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `login` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `etudiant` (
  `cin` int(8) UNSIGNED not NULL ,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `cpassword` varchar(40) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `adresse` text NOT NULL,
  `Classe` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `groupes` (
  `id` int(3) ,
  `nomgrp` varchar(7)  NOT NULL,
  `numetud` int(2) NOT NULL,
  `spec` text(20) NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `absences` (
  `nometud` varchar(20) NOT NULL ,
  `idabs` int(10) NOT NULL ,
  `date` date NOT NULL ,
  `seance` int(10) NOT NULL ,
  `justif` int(2) NOT NULL ,
  `nbrabs` int(100) NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`cin`);
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `absences`
  ADD PRIMARY KEY (`idabs`);



/* ALTER TABLE `groupes`
  ADD PRIMARY KEY (`nomgrp`); */






ALTER TABLE `enseignant`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

ALTER TABLE `etudiant`
  MODIFY `cin` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
ALTER TABLE `groupes`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2 ;
ALTER TABLE `absences`
  MODIFY `idabs` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/* ALTER TABLE `groupes`
  MODIFY `nomgrp` varchar(7)  NOT NULL ;
COMMIT; */


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
