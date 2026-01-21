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