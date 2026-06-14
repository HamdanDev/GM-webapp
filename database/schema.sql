-- Green Market database schema
-- Generated from phpMyAdmin export: greenmarket (1).sql
-- Import this file first.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS greenmarket DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE greenmarket;

SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `avis` (
  `ID_Avis` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` text DEFAULT NULL,
  `ID_utili` int(11) NOT NULL,
  `ID_Prod` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ;

CREATE TABLE `boutique` (
  `ID_boutique` int(11) NOT NULL,
  `nom_boutique` varchar(150) NOT NULL,
  `description_boutique` text DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `ID_utili` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `categorie` (
  `ID_Categ` int(11) NOT NULL,
  `nom_Categ` varchar(100) NOT NULL,
  `description_Categ` text DEFAULT NULL,
  `Categ_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `commande` (
  `ID_Com` int(11) NOT NULL,
  `date_com` datetime DEFAULT current_timestamp(),
  `status_com` varchar(50) NOT NULL DEFAULT 'en attente',
  `prix_total` decimal(10,2) NOT NULL,
  `ID_utili` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `favoris` (
  `ID_utili` int(11) NOT NULL,
  `ID_Prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `ligne_commande` (
  `ID_Com` int(11) NOT NULL,
  `ID_Prod` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL,
  `Prix_Unitaire` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `ligne_panier` (
  `ID_Panier` int(11) NOT NULL,
  `ID_Prod` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `notification` (
  `ID_Noti` int(11) NOT NULL,
  `message` text NOT NULL,
  `est_lu` tinyint(1) DEFAULT 0,
  `ID_utili` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `paiement` (
  `ID_Pay` int(11) NOT NULL,
  `mode_pay` varchar(50) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `date_pay` datetime DEFAULT current_timestamp(),
  `ID_Com` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `panier` (
  `ID_Panier` int(11) NOT NULL,
  `ID_utili` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `produit` (
  `ID_Prod` int(11) NOT NULL,
  `nom_Prod` varchar(150) NOT NULL,
  `Prix` decimal(10,2) NOT NULL,
  `Stock` int(11) NOT NULL DEFAULT 0,
  `Prod_img` varchar(255) DEFAULT NULL,
  `ID_boutique` int(11) NOT NULL,
  `ID_Categ` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `est_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `produit_caracteristique` (
  `ID_Caract` int(11) NOT NULL,
  `ID_Prod` int(11) NOT NULL,
  `texte` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `produit_image` (
  `ID_Image` int(11) NOT NULL,
  `ID_Prod` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `produit_option` (
  `ID_Option` int(11) NOT NULL,
  `ID_Prod` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `produit_option_valeur` (
  `ID_Valeur` int(11) NOT NULL,
  `ID_Option` int(11) NOT NULL,
  `valeur` varchar(100) NOT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `reclamation` (
  `ID_Reclam` int(11) NOT NULL,
  `description` text NOT NULL,
  `status_reclam` varchar(50) DEFAULT 'ouverte',
  `ID_Com` int(11) NOT NULL,
  `ID_utili` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `reponse` (
  `ID_Rep` int(11) NOT NULL,
  `message` text NOT NULL,
  `ID_utili` int(11) NOT NULL,
  `ID_Avis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `traceabilite` (
  `ID_Trace` int(11) NOT NULL,
  `ID_Prod` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `lieu` varchar(150) DEFAULT NULL,
  `date_trace` varchar(50) DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `utilisateur` (
  `ID_utili` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'client',
  `telephone` varchar(30) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `est_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `avis`
  ADD PRIMARY KEY (`ID_Avis`),
  ADD KEY `ID_utili` (`ID_utili`),
  ADD KEY `ID_Prod` (`ID_Prod`);

ALTER TABLE `boutique`
  ADD PRIMARY KEY (`ID_boutique`),
  ADD KEY `ID_utili` (`ID_utili`);

ALTER TABLE `categorie`
  ADD PRIMARY KEY (`ID_Categ`);

ALTER TABLE `commande`
  ADD PRIMARY KEY (`ID_Com`),
  ADD KEY `ID_utili` (`ID_utili`);

ALTER TABLE `favoris`
  ADD PRIMARY KEY (`ID_utili`,`ID_Prod`),
  ADD KEY `ID_Prod` (`ID_Prod`);

ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`ID_Com`,`ID_Prod`),
  ADD KEY `ID_Prod` (`ID_Prod`);

ALTER TABLE `ligne_panier`
  ADD PRIMARY KEY (`ID_Panier`,`ID_Prod`),
  ADD KEY `ID_Prod` (`ID_Prod`);

ALTER TABLE `notification`
  ADD PRIMARY KEY (`ID_Noti`),
  ADD KEY `ID_utili` (`ID_utili`);

ALTER TABLE `paiement`
  ADD PRIMARY KEY (`ID_Pay`),
  ADD KEY `ID_Com` (`ID_Com`);

ALTER TABLE `panier`
  ADD PRIMARY KEY (`ID_Panier`),
  ADD KEY `ID_utili` (`ID_utili`);

ALTER TABLE `produit`
  ADD PRIMARY KEY (`ID_Prod`),
  ADD KEY `ID_boutique` (`ID_boutique`),
  ADD KEY `ID_Categ` (`ID_Categ`);

ALTER TABLE `produit_caracteristique`
  ADD PRIMARY KEY (`ID_Caract`),
  ADD KEY `ID_Prod` (`ID_Prod`);

ALTER TABLE `produit_image`
  ADD PRIMARY KEY (`ID_Image`),
  ADD KEY `ID_Prod` (`ID_Prod`);

ALTER TABLE `produit_option`
  ADD PRIMARY KEY (`ID_Option`),
  ADD KEY `ID_Prod` (`ID_Prod`);

ALTER TABLE `produit_option_valeur`
  ADD PRIMARY KEY (`ID_Valeur`),
  ADD KEY `ID_Option` (`ID_Option`);

ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`ID_Reclam`),
  ADD KEY `ID_Com` (`ID_Com`),
  ADD KEY `ID_utili` (`ID_utili`);

ALTER TABLE `reponse`
  ADD PRIMARY KEY (`ID_Rep`),
  ADD KEY `ID_utili` (`ID_utili`),
  ADD KEY `ID_Avis` (`ID_Avis`);

ALTER TABLE `traceabilite`
  ADD PRIMARY KEY (`ID_Trace`),
  ADD KEY `ID_Prod` (`ID_Prod`);

ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID_utili`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `avis`
  MODIFY `ID_Avis` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `boutique`
  MODIFY `ID_boutique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `categorie`
  MODIFY `ID_Categ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `commande`
  MODIFY `ID_Com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `notification`
  MODIFY `ID_Noti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `paiement`
  MODIFY `ID_Pay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `panier`
  MODIFY `ID_Panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `produit`
  MODIFY `ID_Prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `produit_caracteristique`
  MODIFY `ID_Caract` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `produit_image`
  MODIFY `ID_Image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `produit_option`
  MODIFY `ID_Option` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `produit_option_valeur`
  MODIFY `ID_Valeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

ALTER TABLE `reclamation`
  MODIFY `ID_Reclam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `reponse`
  MODIFY `ID_Rep` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `traceabilite`
  MODIFY `ID_Trace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `utilisateur`
  MODIFY `ID_utili` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`ID_utili`) REFERENCES `utilisateur` (`ID_utili`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`);

ALTER TABLE `boutique`
  ADD CONSTRAINT `boutique_ibfk_1` FOREIGN KEY (`ID_utili`) REFERENCES `utilisateur` (`ID_utili`);

ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`ID_utili`) REFERENCES `utilisateur` (`ID_utili`);

ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_1` FOREIGN KEY (`ID_utili`) REFERENCES `utilisateur` (`ID_utili`),
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`);

ALTER TABLE `ligne_commande`
  ADD CONSTRAINT `ligne_commande_ibfk_1` FOREIGN KEY (`ID_Com`) REFERENCES `commande` (`ID_Com`),
  ADD CONSTRAINT `ligne_commande_ibfk_2` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`);

ALTER TABLE `ligne_panier`
  ADD CONSTRAINT `ligne_panier_ibfk_1` FOREIGN KEY (`ID_Panier`) REFERENCES `panier` (`ID_Panier`),
  ADD CONSTRAINT `ligne_panier_ibfk_2` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`);

ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`ID_utili`) REFERENCES `utilisateur` (`ID_utili`);

ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`ID_Com`) REFERENCES `commande` (`ID_Com`);

ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`ID_utili`) REFERENCES `utilisateur` (`ID_utili`);

ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`ID_boutique`) REFERENCES `boutique` (`ID_boutique`),
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`ID_Categ`) REFERENCES `categorie` (`ID_Categ`);

ALTER TABLE `produit_caracteristique`
  ADD CONSTRAINT `produit_caracteristique_ibfk_1` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`) ON DELETE CASCADE;

ALTER TABLE `produit_image`
  ADD CONSTRAINT `produit_image_ibfk_1` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`) ON DELETE CASCADE;

ALTER TABLE `produit_option`
  ADD CONSTRAINT `produit_option_ibfk_1` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`) ON DELETE CASCADE;

ALTER TABLE `produit_option_valeur`
  ADD CONSTRAINT `produit_option_valeur_ibfk_1` FOREIGN KEY (`ID_Option`) REFERENCES `produit_option` (`ID_Option`) ON DELETE CASCADE;

ALTER TABLE `reclamation`
  ADD CONSTRAINT `reclamation_ibfk_1` FOREIGN KEY (`ID_Com`) REFERENCES `commande` (`ID_Com`),
  ADD CONSTRAINT `reclamation_ibfk_2` FOREIGN KEY (`ID_utili`) REFERENCES `utilisateur` (`ID_utili`);

ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`ID_utili`) REFERENCES `utilisateur` (`ID_utili`),
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`ID_Avis`) REFERENCES `avis` (`ID_Avis`);

ALTER TABLE `traceabilite`
  ADD CONSTRAINT `traceabilite_ibfk_1` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS = 1;

