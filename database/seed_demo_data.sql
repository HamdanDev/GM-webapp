-- Green Market demo content seed
-- Import this after your main greenmarket schema.
-- Image values are stored as asset-relative paths, for example:
-- assets/images/products/savonBeldi.png

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET NAMES utf8mb4;

START TRANSACTION;

-- Extra profile fields used by the client/profile screens.
ALTER TABLE `utilisateur`
  ADD COLUMN IF NOT EXISTS `telephone` varchar(30) DEFAULT NULL AFTER `role`,
  ADD COLUMN IF NOT EXISTS `adresse` varchar(255) DEFAULT NULL AFTER `telephone`;

-- Extra product-detail data currently hardcoded in product-details.js.
CREATE TABLE IF NOT EXISTS `produit_image` (
  `ID_Image` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Prod` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`ID_Image`),
  KEY `ID_Prod` (`ID_Prod`),
  CONSTRAINT `produit_image_ibfk_1` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `produit_caracteristique` (
  `ID_Caract` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Prod` int(11) NOT NULL,
  `texte` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`ID_Caract`),
  KEY `ID_Prod` (`ID_Prod`),
  CONSTRAINT `produit_caracteristique_ibfk_1` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `produit_option` (
  `ID_Option` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Prod` int(11) NOT NULL,
  `label` varchar(100) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`ID_Option`),
  KEY `ID_Prod` (`ID_Prod`),
  CONSTRAINT `produit_option_ibfk_1` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `produit_option_valeur` (
  `ID_Valeur` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Option` int(11) NOT NULL,
  `valeur` varchar(100) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`ID_Valeur`),
  KEY `ID_Option` (`ID_Option`),
  CONSTRAINT `produit_option_valeur_ibfk_1` FOREIGN KEY (`ID_Option`) REFERENCES `produit_option` (`ID_Option`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `traceabilite` (
  `ID_Trace` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Prod` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `lieu` varchar(150) DEFAULT NULL,
  `date_trace` varchar(50) DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`ID_Trace`),
  KEY `ID_Prod` (`ID_Prod`),
  CONSTRAINT `traceabilite_ibfk_1` FOREIGN KEY (`ID_Prod`) REFERENCES `produit` (`ID_Prod`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Demo users and profile data.
INSERT INTO `utilisateur` (`ID_utili`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`, `telephone`, `adresse`, `est_active`, `created_at`) VALUES
(1, 'Ahmadi', 'Ahmed', 'client@test.com', '$2y$12$w9h9a1bNDUryRAPSCLczY.ASU0OVOP7hguc0CCZXVtewI7kRs4zie', 'client', '+212 6 00 00 00 00', 'Marrakech, Maroc', 1, '2026-06-13 17:00:21'),
(2, 'Test', 'Producteur', 'producteur@test.com', '$2y$12$w9h9a1bNDUryRAPSCLczY.ASU0OVOP7hguc0CCZXVtewI7kRs4zie', 'producteur', '+212 6 11 11 11 11', 'Agadir, Maroc', 1, '2026-06-13 17:00:21'),
(3, 'Test', 'Admin', 'admin@test.com', '$2y$12$w9h9a1bNDUryRAPSCLczY.ASU0OVOP7hguc0CCZXVtewI7kRs4zie', 'admin', '+212 6 22 22 22 22', 'Marrakech, Maroc', 1, '2026-06-13 17:00:21'),
(4, 'Zahra', 'Fatima', 'fatima@test.com', '$2y$12$w9h9a1bNDUryRAPSCLczY.ASU0OVOP7hguc0CCZXVtewI7kRs4zie', 'client', NULL, NULL, 1, '2026-06-13 17:05:00'),
(5, 'Mansouri', 'Ahmed', 'ahmed.m@test.com', '$2y$12$w9h9a1bNDUryRAPSCLczY.ASU0OVOP7hguc0CCZXVtewI7kRs4zie', 'client', NULL, NULL, 1, '2026-06-13 17:10:00')
ON DUPLICATE KEY UPDATE
  `nom` = VALUES(`nom`),
  `prenom` = VALUES(`prenom`),
  `role` = VALUES(`role`),
  `telephone` = VALUES(`telephone`),
  `adresse` = VALUES(`adresse`),
  `est_active` = VALUES(`est_active`);

-- Categories from categories.php and product filters.
INSERT INTO `categorie` (`ID_Categ`, `nom_Categ`, `description_Categ`, `Categ_img`) VALUES
(1, 'Poterie', 'Plats, tagines et bols artisanaux fabriqués à la main par des potiers marocains.', 'assets/images/categories/produitsBio.jpeg'),
(2, 'Cosmétiques', 'Savons, huiles et soins naturels à base d''argan et de plantes marocaines.', 'assets/images/categories/cosmetiques.jpeg'),
(3, 'Artisanat', 'Tapis, poteries et objets décoratifs uniques faits par des artisans locaux.', 'assets/images/categories/artisan.jpeg'),
(4, 'Textile', 'Tapis, coussins et tissages berbères aux motifs authentiques.', 'assets/images/categories/modeTraditionnel.jpeg'),
(5, 'Produits Bio', 'Épices, huiles et produits alimentaires biologiques issus de l''agriculture locale.', 'assets/images/categories/produitsBio.jpeg'),
(6, 'Mode Traditionnelle', 'Djellabas, kaftans et babouches brodés à la main par des artisans marocains.', 'assets/images/categories/modeTraditionnel.jpeg'),
(7, 'Bijoux', 'Colliers, bracelets et bagues en argent et pierres semi-précieuses du Maroc.', 'assets/images/categories/artisan.jpeg'),
(8, 'Maison & Déco', 'Lanternes, plateaux et objets de décoration inspirés de l''artisanat marocain.', 'assets/images/categories/artisan.jpeg')
ON DUPLICATE KEY UPDATE
  `nom_Categ` = VALUES(`nom_Categ`),
  `description_Categ` = VALUES(`description_Categ`),
  `Categ_img` = VALUES(`Categ_img`);

-- Producer shops/cooperatives from product filters and product-detail cards.
INSERT INTO `boutique` (`ID_boutique`, `nom_boutique`, `description_boutique`, `ville`, `ID_utili`, `created_at`) VALUES
(1, 'Coopérative Marrakech', 'Produits artisanaux et bio de la région de Marrakech.', 'Marrakech', 2, '2026-06-13 17:20:00'),
(2, 'Coopérative Essaouira', 'Huiles et cosmétiques naturels.', 'Essaouira', 2, '2026-06-13 17:21:00'),
(3, 'Coopérative Tiznit', 'Textile, bijoux et poterie artisanale.', 'Tiznit', 2, '2026-06-13 17:22:00'),
(4, 'Coopérative Kelalat M''gouna', 'Produits de rose et soins naturels.', 'Kelaat M''gouna', 2, '2026-06-13 17:23:00'),
(5, 'Coopérative Fès', 'Argiles, poteries et soins traditionnels.', 'Fès', 2, '2026-06-13 17:24:00'),
(6, 'Coopérative Agadir', 'Huiles d''argan et produits cosmétiques.', 'Agadir', 2, '2026-06-13 17:25:00')
ON DUPLICATE KEY UPDATE
  `nom_boutique` = VALUES(`nom_boutique`),
  `description_boutique` = VALUES(`description_boutique`),
  `ville` = VALUES(`ville`),
  `ID_utili` = VALUES(`ID_utili`);

-- Products from products.php, product-details.js, client profile, and recommendations.
INSERT INTO `produit` (`ID_Prod`, `nom_Prod`, `Prix`, `Stock`, `Prod_img`, `ID_boutique`, `ID_Categ`, `description`, `est_active`, `created_at`) VALUES
(1, 'Savon Beldi', 45.00, 120, 'assets/images/products/savonBeldi.png', 1, 2, 'Savon Beldi traditionnel marocain, enrichi à l''huile d''olive naturelle. Il nettoie la peau en profondeur, élimine les cellules mortes et laisse la peau douce, lisse et éclatante. Idéal pour le hammam et les soins du corps.', 1, '2026-06-13 17:30:00'),
(2, 'Huile d''Argan', 120.00, 75, 'assets/images/products/huileArganBio.png', 2, 5, 'Huile d''argan pure du Maroc, riche en vitamine E et en antioxydants. Elle hydrate intensément la peau et les cheveux, aide à réparer les pointes abîmées et lutte contre le dessèchement et le vieillissement cutané.', 1, '2026-06-13 17:31:00'),
(3, 'Tapis Azilal Indigo', 2800.00, 12, 'assets/images/products/tapisAzilalIndigo.png', 3, 3, 'Tapis berbère artisanal fabriqué à la main dans la région d''Azilal. Il se distingue par ses motifs uniques et ses couleurs vibrantes avec une touche d''indigo. Parfait pour apporter une touche artistique et authentique à votre intérieur.', 1, '2026-06-13 17:32:00'),
(4, 'Huile d''Olive Vierge', 80.00, 90, 'assets/images/products/huileOliveVierge.png', 1, 5, 'Huile d''olive vierge extra 100% naturelle, obtenue par pression traditionnelle. Elle est reconnue pour ses bienfaits pour la santé, la cuisine et les soins cosmétiques grâce à ses propriétés nourrissantes et protectrices.', 1, '2026-06-13 17:33:00'),
(5, 'Tagine Terracotta', 280.00, 35, 'assets/images/products/tagineTerracotta.png', 3, 1, 'Tagine marocain traditionnel en terre cuite, idéal pour une cuisson lente et savoureuse. Il permet de préserver toutes les saveurs et l''authenticité des plats marocains.', 1, '2026-06-13 17:34:00'),
(6, 'Kaftan Bleu Indigo', 850.00, 18, 'assets/images/products/kaftanBleuIndigo.png', 3, 6, 'Kaftan marocain élégant de couleur bleu indigo, alliant tradition et modernité. Parfait pour les occasions spéciales et les fêtes.', 1, '2026-06-13 17:35:00'),
(7, 'Eau de Rose', 65.00, 60, 'assets/images/product-details/aimeImg/RoseWater.jpg', 4, 2, 'Eau de rose naturelle issue de la vallée des roses.', 1, '2026-06-13 17:36:00'),
(8, 'Ghassoul', 45.00, 80, 'assets/images/product-details/aimeImg/RoseWater.jpg', 5, 2, 'Ghassoul traditionnel pour soins du visage, du corps et des cheveux.', 1, '2026-06-13 17:37:00'),
(9, 'Huile d''Argan Cosmétique', 150.00, 55, 'assets/images/product-details/arganOil/arganOilCosmetics.jpg', 6, 2, 'Huile d''argan cosmétique pour peau et cheveux.', 1, '2026-06-13 17:38:00'),
(10, 'Kaftan Brodé', 850.00, 10, 'assets/images/products/kaftanBleuIndigo.png', 3, 6, 'Kaftan traditionnel brodé à la main.', 1, '2026-06-13 17:39:00')
ON DUPLICATE KEY UPDATE
  `nom_Prod` = VALUES(`nom_Prod`),
  `Prix` = VALUES(`Prix`),
  `Stock` = VALUES(`Stock`),
  `Prod_img` = VALUES(`Prod_img`),
  `ID_boutique` = VALUES(`ID_boutique`),
  `ID_Categ` = VALUES(`ID_Categ`),
  `description` = VALUES(`description`),
  `est_active` = VALUES(`est_active`);

-- Product galleries.
DELETE FROM `produit_image` WHERE `ID_Prod` BETWEEN 1 AND 10;
INSERT INTO `produit_image` (`ID_Prod`, `image_path`, `is_main`, `sort_order`) VALUES
(1, 'assets/images/product-details/savonBeldi/savonBeldi.png', 1, 1),
(1, 'assets/images/product-details/savonBeldi/savonBeldiAkarFasi.jpeg', 0, 2),
(1, 'assets/images/product-details/savonBeldi/savonBeldiFlowers.jpeg', 0, 3),
(1, 'assets/images/product-details/savonBeldi/savonBeldiHerbs.jpeg', 0, 4),
(1, 'assets/images/product-details/savonBeldi/savonBeldiNila.jpeg', 0, 5),
(1, 'assets/images/product-details/savonBeldi/savonBeldiSouffre.jpeg', 0, 6),
(2, 'assets/images/product-details/arganOil/huileArganBio.png', 1, 1),
(2, 'assets/images/product-details/arganOil/arganOilCosmetics.jpg', 0, 2),
(3, 'assets/images/product-details/tapisAI/tapisAzilalIndigo.png', 1, 1),
(3, 'assets/images/product-details/tapisAI/tapisAzilalAll.jpg', 0, 2),
(3, 'assets/images/product-details/tapisAI/tapisAzilalDetails.jpg', 0, 3),
(4, 'assets/images/product-details/oliveOil/huileOliveVierge.png', 1, 1),
(4, 'assets/images/product-details/oliveOil/oliveOilBottle.jpeg', 0, 2),
(5, 'assets/images/product-details/tagineTerracotta/tagineTerracotta.png', 1, 1),
(5, 'assets/images/product-details/tagineTerracotta/tagineTerracottaInside.jpg', 0, 2),
(5, 'assets/images/product-details/tagineTerracotta/tagineTerracottaDetails.jpg', 0, 3),
(5, 'assets/images/product-details/tagineTerracotta/tagineTerracottaSize.jpg', 0, 4),
(6, 'assets/images/product-details/kaftan/kaftanBleuIndigo.png', 1, 1),
(6, 'assets/images/product-details/kaftan/kaftanBleuIndigoBack.jpeg', 0, 2),
(6, 'assets/images/product-details/kaftan/kaftanBleuIndigoFront.jpeg', 0, 3),
(6, 'assets/images/product-details/kaftan/kaftanBleuIndigoStyle.jpeg', 0, 4),
(6, 'assets/images/product-details/kaftan/kaftanBleuIndigoMain.jpeg', 0, 5);

-- Product characteristics.
DELETE FROM `produit_caracteristique` WHERE `ID_Prod` BETWEEN 1 AND 10;
INSERT INTO `produit_caracteristique` (`ID_Prod`, `texte`, `sort_order`) VALUES
(1, 'Recette traditionnelle marocaine', 1),
(1, 'À base d''huile d''olive pure', 2),
(1, 'Texture pâteuse pour hammam', 3),
(1, 'Nettoyage doux et exfoliation naturelle', 4),
(2, 'Pressée à froid à partir d''amandons d''argan', 1),
(2, '100% pure et biologique', 2),
(2, 'Hydratation intense pour peau et cheveux', 3),
(2, 'Riche en vitamine E et acides gras essentiels', 4),
(3, 'Laine naturelle de haute qualité', 1),
(3, 'Motifs berbères traditionnels', 2),
(3, 'Teinture indigo artisanale', 3),
(3, 'Pièce unique faite à la main', 4),
(4, 'Pressée à froid', 1),
(4, '100% olives locales', 2),
(4, 'Saveur fruitée et équilibrée', 3),
(4, 'Riche en antioxydants et vitamines', 4),
(5, 'Terre cuite naturelle', 1),
(5, 'Fabrication artisanale à la main', 2),
(5, 'Résistant à la chaleur et durable', 3),
(5, 'Idéal pour cuisson lente et saveurs authentiques', 4),
(6, 'Tissu 100% coton léger', 1),
(6, 'Broderies artisanales indigo', 2),
(6, 'Coupe traditionnelle marocaine', 3),
(6, 'Confort et élégance pour occasions spéciales', 4);

-- Product options and values.
DELETE pov FROM `produit_option_valeur` pov
INNER JOIN `produit_option` po ON po.`ID_Option` = pov.`ID_Option`
WHERE po.`ID_Prod` BETWEEN 1 AND 10;
DELETE FROM `produit_option` WHERE `ID_Prod` BETWEEN 1 AND 10;

INSERT INTO `produit_option` (`ID_Option`, `ID_Prod`, `label`, `sort_order`) VALUES
(1, 1, 'Size', 1), (2, 1, 'Mix with', 2),
(3, 2, 'Size', 1),
(4, 3, 'Size', 1), (5, 3, 'COLOR', 2),
(6, 4, 'Size', 1),
(7, 5, 'Size', 1), (8, 5, 'COLOR', 2),
(9, 6, 'Size', 1), (10, 6, 'COLOR', 2)
ON DUPLICATE KEY UPDATE `ID_Prod` = VALUES(`ID_Prod`), `label` = VALUES(`label`), `sort_order` = VALUES(`sort_order`);

INSERT INTO `produit_option_valeur` (`ID_Option`, `valeur`, `sort_order`) VALUES
(1, 'Small', 1), (1, 'Medium', 2), (1, 'Large', 3),
(2, 'BLUE NILLA', 1), (2, 'Akar FASI', 2), (2, 'Herbs', 3), (2, 'Soufre', 4), (2, 'Fleur', 5), (2, 'Pure', 6),
(3, 'Small', 1), (3, 'Medium', 2), (3, 'Large', 3),
(4, 'Small', 1), (4, 'Medium', 2), (4, 'Large', 3),
(5, 'Rouge', 1), (5, 'Beige', 2), (5, 'Brown', 3), (5, 'Blue', 4),
(6, '1L', 1), (6, '1/2 L', 2),
(7, 'Small', 1), (7, 'Medium', 2), (7, 'Large', 3),
(8, 'Rouge', 1), (8, 'Vert', 2), (8, 'Blue', 3),
(9, 'Small', 1), (9, 'Medium', 2), (9, 'Large', 3),
(10, 'Rouge', 1), (10, 'beige', 2), (10, 'Blue', 3);

-- Traceability steps shared by the demo product-detail page.
DELETE FROM `traceabilite` WHERE `ID_Prod` BETWEEN 1 AND 10;
INSERT INTO `traceabilite` (`ID_Prod`, `titre`, `description`, `lieu`, `date_trace`, `icone`, `image_path`, `sort_order`) VALUES
(1, 'Récolte / Production', 'Les matières premières ont été récoltées par la coopérative partenaire.', 'Atlas, Maroc', '15 Mars 2024', 'bi-person', 'assets/images/product-details/tracabiliteStep/traceabiliteStep1.png', 1),
(1, 'Fabrication Artisanale', 'Création par les maîtres artisans selon les techniques traditionnelles.', 'Fès, Maroc', '20 Mars 2024', 'bi-gear', 'assets/images/product-details/tracabiliteStep/traceabiliteStep2.jpeg', 2),
(1, 'Contrôle & Emballage', 'Vérification qualité et conditionnement avec code QR traçabilité.', 'Casablanca, Maroc', '28 Mars 2024', 'bi-box-seam', 'assets/images/product-details/tracabiliteStep/traceabiliteStep3.jpeg', 3),
(1, 'Livraison', 'Expédié avec soin jusqu''à votre domicile.', 'Votre adresse', 'En attente', 'bi-truck', 'assets/images/product-details/tracabiliteStep/traceabiliteStep4.jpeg', 4),
(2, 'Récolte / Production', 'Les matières premières ont été récoltées par la coopérative partenaire.', 'Atlas, Maroc', '15 Mars 2024', 'bi-person', 'assets/images/product-details/tracabiliteStep/traceabiliteStep1.png', 1),
(2, 'Fabrication Artisanale', 'Création par les maîtres artisans selon les techniques traditionnelles.', 'Fès, Maroc', '20 Mars 2024', 'bi-gear', 'assets/images/product-details/tracabiliteStep/traceabiliteStep2.jpeg', 2),
(2, 'Contrôle & Emballage', 'Vérification qualité et conditionnement avec code QR traçabilité.', 'Casablanca, Maroc', '28 Mars 2024', 'bi-box-seam', 'assets/images/product-details/tracabiliteStep/traceabiliteStep3.jpeg', 3),
(2, 'Livraison', 'Expédié avec soin jusqu''à votre domicile.', 'Votre adresse', 'En attente', 'bi-truck', 'assets/images/product-details/tracabiliteStep/traceabiliteStep4.jpeg', 4);

-- Client favorites from client-profile.php.
INSERT INTO `favoris` (`ID_utili`, `ID_Prod`) VALUES
(1, 1),
(1, 2)
ON DUPLICATE KEY UPDATE `ID_utili` = VALUES(`ID_utili`);

-- Client orders from client-profile.php.
INSERT INTO `commande` (`ID_Com`, `date_com`, `status_com`, `prix_total`, `ID_utili`) VALUES
(1, '2026-05-12 10:00:00', 'livré', 45.00, 1),
(2, '2026-05-05 15:30:00', 'en cours', 120.00, 1),
(3, '2026-04-28 09:15:00', 'livré', 350.00, 1),
(4, '2026-04-10 11:45:00', 'annulé', 850.00, 1),
(5, '2026-06-13 12:00:00', 'en attente', 560.00, 1)
ON DUPLICATE KEY UPDATE
  `date_com` = VALUES(`date_com`),
  `status_com` = VALUES(`status_com`),
  `prix_total` = VALUES(`prix_total`),
  `ID_utili` = VALUES(`ID_utili`);

INSERT INTO `ligne_commande` (`ID_Com`, `ID_Prod`, `Quantite`, `Prix_Unitaire`) VALUES
(1, 1, 1, 45.00),
(2, 2, 1, 120.00),
(3, 3, 1, 350.00),
(4, 10, 1, 850.00),
(5, 5, 2, 280.00)
ON DUPLICATE KEY UPDATE
  `Quantite` = VALUES(`Quantite`),
  `Prix_Unitaire` = VALUES(`Prix_Unitaire`);

-- Payments and complaints for admin/payment/reclamation screens.
INSERT INTO `paiement` (`ID_Pay`, `mode_pay`, `montant`, `date_pay`, `ID_Com`) VALUES
(1, 'Carte bancaire', 45.00, '2026-05-12 10:05:00', 1),
(2, 'PayPal', 120.00, '2026-05-05 15:35:00', 2),
(3, 'Carte bancaire', 350.00, '2026-04-28 09:20:00', 3),
(4, 'Carte bancaire', 560.00, '2026-06-13 12:05:00', 5)
ON DUPLICATE KEY UPDATE
  `mode_pay` = VALUES(`mode_pay`),
  `montant` = VALUES(`montant`),
  `date_pay` = VALUES(`date_pay`),
  `ID_Com` = VALUES(`ID_Com`);

INSERT INTO `reclamation` (`ID_Reclam`, `description`, `status_reclam`, `ID_Com`, `ID_utili`) VALUES
(1, 'Produit non reçu', 'ouverte', 2, 1),
(2, 'Paiement échoué', 'en cours', 4, 1)
ON DUPLICATE KEY UPDATE
  `description` = VALUES(`description`),
  `status_reclam` = VALUES(`status_reclam`),
  `ID_Com` = VALUES(`ID_Com`),
  `ID_utili` = VALUES(`ID_utili`);

-- Reviews from client-profile.php and product-details.php.
INSERT INTO `avis` (`ID_Avis`, `note`, `commentaire`, `ID_utili`, `ID_Prod`, `created_at`) VALUES
(1, 4, 'Très bon produit, naturel et efficace!', 1, 1, '2026-05-12 18:00:00'),
(2, 5, 'Magnifique tapis, exactement comme sur la photo!', 1, 3, '2026-04-28 18:00:00'),
(3, 5, 'Produit magnifique ! La qualité est exceptionnelle et la traçabilité me rassure sur l''origine.', 4, 1, '2026-05-30 12:00:00'),
(4, 4, 'Très satisfait de mon achat. La livraison était rapide et le produit correspond parfaitement à la description.', 5, 1, '2026-05-13 12:00:00'),
(5, 2, 'Produit pas conforme à la description.', 5, 1, '2026-06-01 14:00:00')
ON DUPLICATE KEY UPDATE
  `note` = VALUES(`note`),
  `commentaire` = VALUES(`commentaire`),
  `ID_utili` = VALUES(`ID_utili`),
  `ID_Prod` = VALUES(`ID_Prod`),
  `created_at` = VALUES(`created_at`);

-- Notifications from admin notifications section.
INSERT INTO `notification` (`ID_Noti`, `message`, `est_lu`, `ID_utili`) VALUES
(1, 'Nouvelle commande créée: Commande #CMD-1524 enregistrée.', 0, 3),
(2, 'Nouveau producteur inscrit: Bio Atlas attend validation.', 0, 3),
(3, 'Produit signalé: Huile d''Argan a reçu plusieurs signalements.', 0, 3),
(4, 'Paiement reçu: Un paiement de 250.00 DH confirmé.', 1, 3),
(5, 'Nouvelle réclamation client nécessite votre intervention.', 0, 3)
ON DUPLICATE KEY UPDATE
  `message` = VALUES(`message`),
  `est_lu` = VALUES(`est_lu`),
  `ID_utili` = VALUES(`ID_utili`);

-- Basic carts for later dynamic cart work.
INSERT INTO `panier` (`ID_Panier`, `ID_utili`) VALUES
(1, 1)
ON DUPLICATE KEY UPDATE `ID_utili` = VALUES(`ID_utili`);

INSERT INTO `ligne_panier` (`ID_Panier`, `ID_Prod`, `Quantite`) VALUES
(1, 1, 1),
(1, 2, 1)
ON DUPLICATE KEY UPDATE `Quantite` = VALUES(`Quantite`);

ALTER TABLE `utilisateur` AUTO_INCREMENT = 6;
ALTER TABLE `categorie` AUTO_INCREMENT = 9;
ALTER TABLE `boutique` AUTO_INCREMENT = 7;
ALTER TABLE `produit` AUTO_INCREMENT = 11;
ALTER TABLE `commande` AUTO_INCREMENT = 6;
ALTER TABLE `paiement` AUTO_INCREMENT = 5;
ALTER TABLE `reclamation` AUTO_INCREMENT = 3;
ALTER TABLE `avis` AUTO_INCREMENT = 6;
ALTER TABLE `notification` AUTO_INCREMENT = 6;
ALTER TABLE `panier` AUTO_INCREMENT = 2;

COMMIT;
