-- Script SQL pour créer la structure et insérer des données de test


CREATE TABLE themes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL
);
INSERT INTO themes (id, nom) VALUES
(1, 'noel'), (2, 'paques'), (3, 'evenement'), (4, 'classique');

CREATE TABLE regimes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL
);
INSERT INTO regimes (id, nom) VALUES
(1, 'vegetarien'), (2, 'vegan'), (3, 'classique');

CREATE TABLE typesplats (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL
);
INSERT INTO typesplats (id, nom) VALUES
(1, 'entree'), (2, 'plat'), (3, 'dessert');

CREATE TABLE allergenes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL
);
INSERT INTO allergenes (id, nom) VALUES
(1, 'gluten'), (2, 'lactose'), (3, 'poisson');

CREATE TABLE roles (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL
);
INSERT INTO roles (id, nom) VALUES
(1, 'utilisateur'), (2, 'employe'), (3, 'admin');

CREATE TABLE statuts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(50) NOT NULL
);
INSERT INTO statuts (id, nom) VALUES
(1, 'en_attente'), (2, 'accepte'), (3, 'en_preparation'), (4, 'en_cours_livraison'), (5, 'livre'), (6, 'en_attente_retour_materiel'), (7, 'terminee');

CREATE TABLE menus (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titre VARCHAR(255) NOT NULL,
  description TEXT,  
  nb_personnes_min INT NOT NULL,
  prix_base DECIMAL(8,2) NOT NULL,
  conditions TEXT,
  stock_dispo INT NOT NULL,
  theme_id INT,
  regime_id INT,
  FOREIGN KEY (theme_id) REFERENCES themes(id),
  FOREIGN KEY (regime_id) REFERENCES regimes(id)
);

CREATE TABLE images (
  id INT PRIMARY KEY AUTO_INCREMENT,
  menu_id INT,
  url VARCHAR(255) NOT NULL,
  FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE
);

CREATE TABLE plats (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  description TEXT,
  typesplat_id INT,
  FOREIGN KEY (typesplat_id) REFERENCES typesplats(id)
);

CREATE TABLE plats_allergenes (
  plat_id INT,
  allergene_id INT,
  PRIMARY KEY (plat_id, allergene_id),
  FOREIGN KEY (plat_id) REFERENCES plats(id) ON DELETE CASCADE,
  FOREIGN KEY (allergene_id) REFERENCES allergenes(id) ON DELETE CASCADE
);

CREATE TABLE menus_plats (
  menu_id INT,
  plat_id INT,
  PRIMARY KEY (menu_id, plat_id),
  FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE,
  FOREIGN KEY (plat_id) REFERENCES plats(id) ON DELETE CASCADE
);

CREATE TABLE utilisateurs (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  gsm VARCHAR(20),
  adresse_postale TEXT,
  mot_de_passe VARCHAR(255) NOT NULL, -- hashed
  actif BOOLEAN DEFAULT true,
  role_id INT DEFAULT 1,
  FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE commandes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nb_personnes INT NOT NULL,
  adresse_livraison TEXT NOT NULL,
  date_livraison DATE NOT NULL,
  heure_livraison TIME NOT NULL,
  prix_total DECIMAL(8,2) NOT NULL,
  notes TEXT,
  utilisateur_id INT,
  menu_id INT,
  statut_id INT DEFAULT 1,
  FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id),
  FOREIGN KEY (menu_id) REFERENCES menus(id),
  FOREIGN KEY (statut_id) REFERENCES statuts(id)
);

CREATE TABLE avis (
  id INT PRIMARY KEY AUTO_INCREMENT,
  note TINYINT CHECK (note BETWEEN 1 AND 5),
  commentaire TEXT,
  valide BOOLEAN DEFAULT false,
  commande_id INT UNIQUE,
  FOREIGN KEY (commande_id) REFERENCES commandes(id)
);


-- DONNÉES DE TEST


INSERT INTO plats (id, nom, description, typesplat_id) VALUES
(1, 'Salade festive', 'Salade verte, tomates, concombres, vinaigrette maison', 1),
(2, 'Quiche lorraine', 'Quiche traditionnelle', 1),
(3, 'Magret de canard', 'Magret grillé, sauce porto', 2),
(4, 'Gratin dauphinois', 'Pommes de terre, crème, fromage', 2),
(5, 'Tarte aux fruits', 'Fruits de saison, pâte sablée', 3);

INSERT INTO plats_allergenes (plat_id, allergene_id) VALUES
(1, 1), (1, 2),
(2, 1), (2, 2),
(3, 3),
(4, 2),
(5, 1);

INSERT INTO menus (id, titre, description, nb_personnes_min, prix_base, conditions, stock_dispo, theme_id, regime_id) VALUES
(1, 'Menu Noël Familial', 'Menu festif pour les fêtes de fin d’année', 6, 35.50, 'Commande 48h minimum avant', 8, 1, 1),
(2, 'Menu Pâques Printanier', 'Saveurs du printemps pour Pâques', 4, 28.00, 'Livraison Bordeaux intra-muros uniquement', 12, 2, 2),
(3, 'Menu Événement Pro', 'Pour vos séminaires et cocktails', 10, 42.00, 'Réservation 7 jours avant', 5, 3, 1),
(4, 'Menu Vegan Saisonnier', '100% végétal et gourmand', 4, 32.00, 'Stock limité', 3, 1, 3);

INSERT INTO menus_plats (menu_id, plat_id) VALUES
(1, 1), (1, 3), (1, 5),
(2, 1), (2, 4), (2, 5),
(3, 2), (3, 3), (3, 5),
(4, 1), (4, 4), (4, 5);

INSERT INTO utilisateurs (id, nom, prenom, email, mot_de_passe, role_id) VALUES
(3, 'Alice', 'Utilisateur', 'alice@google.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
(2, 'Julie', 'Employé', 'julie@vite-gourmand.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
(1, 'José', 'Admin', 'jose@vite-gourmand.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3);

INSERT INTO commandes (id, nb_personnes, adresse_livraison, date_livraison, heure_livraison, prix_total, utilisateur_id, menu_id, statut_id) VALUES
(1, 6, '123 Rue de Paris, Bordeaux', '2024-12-24', '19:00:00', 213.00, 3, 1, 1),
(2, 4, '456 Avenue de la République, Bordeaux', '2024-04-20', '12:30:00', 112.00, 3, 2, 1),
(3, 10, '789 Boulevard Saint-Michel, Bordeaux', '2024-11-15', '18:00:00', 420.00, 3, 3, 1),
(4, 4, '321 Place de la Bourse, Bordeaux', '2024-05-01', '13:00:00', 128.00, 3, 4, 1);

INSERT INTO avis (id, note, commentaire, valide, commande_id) VALUES
(1, 5, 'Excellent repas, tout le monde a adoré !', true, 1),
(2, 4, 'Très bon menu, livraison à l’heure.', true, 2),
(3, 3, 'Menu correct mais un peu cher pour la qualité.', false, 3),
(4, 5, 'Parfait pour notre déjeuner vegan !', true, 4);