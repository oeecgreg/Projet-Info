# 🌵 Projet Brawl Stars Collection

Application Web développée en PHP (Architecture MVC) permettant de gérer une collection de personnages (Brawlers) de l'univers Brawl Stars.

## 🚀 Fonctionnalités

* **Gestion des Brawlers** : Ajout, modification, suppression (CRUD).
* **Gestion des Classes & Raretés** : Ajout dynamique de nouvelles classes et raretés avec codes couleurs.
* **Système d'Authentification** : Inscription et Connexion sécurisée.
* **Rôles** :
    * **Admin** : Accès complet (CRUD Brawlers, Logs, Configuration).
    * **Utilisateur** : Gestion de sa propre collection (Ajout/Retrait de sa liste).
* **Logs** : Historique des actions administrateur.

## 🛠️ Prérequis

* Serveur Web (WAMP, XAMPP, MAMP ou Docker).
* PHP 8.0 ou supérieur.
* MySQL / MariaDB.
* Activer l'extension `pdo_mysql` dans PHP.

## 📦 Installation

1.  **Cloner le projet** dans le dossier de votre serveur web (ex: `C:\wamp64\www\projet-brawl`).
2.  **Configurer la base de données** :
    * Ouvrez le fichier `Config/dev.ini`.
    * Modifiez les identifiants si nécessaire (par défaut : root / sans mot de passe).

```ini
[DB]
dsn = 'mysql:host=localhost;dbname=projet_info;charset=utf8'
user = 'root'
pass = ''
```
3. **Créer la base de données** avec le code suivant :
```ini
-- 1. Table des Utilisateurs
CREATE TABLE `users` (
  `id` VARCHAR(50) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `hash_pwd` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Table des Raretés (Couleurs)
CREATE TABLE `rarity` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL,
  `color_code` VARCHAR(20) DEFAULT '#FFFFFF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Table des Classes (Types)
CREATE TABLE `classe` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Table des Brawlers
CREATE TABLE `brawler` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL,
  `rarity` VARCHAR(50) NOT NULL,
  `classe` VARCHAR(50) NOT NULL,
  `url_img` VARCHAR(255) DEFAULT 'public/img/unknown.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Table de Collection (Liaison User <-> Brawler)
CREATE TABLE `collection` (
  `user_id` VARCHAR(50) NOT NULL,
  `brawler_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `brawler_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`brawler_id`) REFERENCES `brawler`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Table des Logs
CREATE TABLE `logs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `type` VARCHAR(20) NOT NULL,
  `action` TEXT NOT NULL,
  `user` VARCHAR(50) NOT NULL,
  `date_action` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- DONNÉES DE DÉPART (Optionnel) --

-- Ajouter les classes de base
INSERT INTO `classe` (`name`) VALUES ('Dégâts'), ('Tank'), ('Tireur d''élite'), ('Soutien'), ('Contrôleur'), ('Assassin'), ('Artillerie');

-- Ajouter les raretés de base
INSERT INTO `rarity` (`name`, `color_code`) VALUES 
('Commun', '#b9e8ff'), 
('Rare', '#68fd58'), 
('Super rare', '#5ab3ff'), 
('Épique', '#d850ff'), 
('Mythique', '#fe5e72'), 
('Légendaire', '#fff11e');
```

## 🔑 Compte Administrateur
Pour accéder aux fonctions d'administration, inscrivez-vous avec le pseudo suivant :

* **Pseudo**: `admin`.
* **Mot de passe**: `Celui que vous choissisez pour l'inscription`.

Le code vérifie spécifiquement le pseudo `admin` pour débloquer les menus de gestion (les logs, ajouter les classes, etc).

## 📁 Structure du Projet
```ini
/Config          -> Configuration DB
/Controllers     -> Logique (Router, MainController...)
/Models          -> Accès données (DAO)
/Views           -> Templates HTML (Plates)
/public          -> Assets (CSS, JS, Images)
/Vendor          -> Librairies externes
index.php        -> Point d'entrée
```