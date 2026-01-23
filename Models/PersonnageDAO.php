<?php

namespace Models;

/**
 * Gère les interactions avec la table brawler en base de données
 */
class PersonnageDAO extends BasePDODAO
{
    /**
     * Récupère tous les brawlers avec leur couleur de rareté
     * @return array Données brutes de la table brawler avec couleur
     */
    public function getAll(): array
    {
        $sql = "SELECT b.*, 
                       r.color_code, 
                       c.url_img AS class_img 
                FROM brawler b
                LEFT JOIN rarity r ON b.rarity = r.name
                LEFT JOIN classe c ON b.classe = c.name
                ORDER BY b.name";
                
        $stmt = $this->execRequest($sql);
        $brawlers = $stmt->fetchAll();

        // On définit la racine du projet (le dossier parent de 'Models')
        $rootPath = dirname(__DIR__); 

        foreach ($brawlers as &$brawler) {
            
            // On construit le chemin système complet (ex: C:\wamp64\www\...\public\img\tank.png)
            // On s'assure qu'il n'y a pas de slash en trop au début de l'URL stockée en base
            $relativePath = ltrim($brawler['class_img'] ?? '', '/');
            $fullPath = $rootPath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);

            // On vérifie si le fichier existe sur le DISQUE (normalement dans public/img/)
            if (empty($relativePath) || !file_exists($fullPath)) {
                // Si introuvable, on met l'image par défaut
                $brawler['class_img'] = 'public/img/default.png';
            }
        }

        return $brawlers;
    }

    /**
     * Récupère un brawler par son ID avec sa couleur
     * @param int $id
     * @return array|null
     */
    public function getByID(int $id): ?array
    {
        $sql = "SELECT b.*, r.color_code 
                FROM brawler b 
                LEFT JOIN rarity r ON b.rarity = r.name 
                WHERE b.id = ?";
                
        $stmt = $this->execRequest($sql, [$id]);
        $result = $stmt->fetch();
        
        return $result ?: null;
    }

    /**
     * Ajoute un nouveau brawler en base de données
     * @param Personnage $perso L'objet personnage à ajouter
     * @return bool True si l'ajout a réussi
     */
    public function add(Personnage $perso): bool
    {
        $sql = "INSERT INTO brawler (name, classe, rarity, url_img) VALUES (:name, :classe, :rarity, :url_img)";
        
        $values = [
            'name'    => $perso->getName(),
            'classe'  => $perso->getClasse(),
            'rarity'  => $perso->getRarity(),
            'url_img' => $perso->getUrlImg()
        ];

        try {
            $this->execRequest($sql, $values);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Supprime un brawler par son ID
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM brawler WHERE id = ?";
        
        try {
            $this->execRequest($sql, [$id]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Met à jour un brawler existant
     * @param Personnage $perso
     * @return bool
     */
    public function update(Personnage $perso): bool
    {
        $sql = "UPDATE brawler SET name = :name, classe = :classe, rarity = :rarity, url_img = :url_img WHERE id = :id";
        
        // Vérification de l'existence de l'image
        $targetFile = "public/img/" . $perso->getName() . ".png";

        // Si l'image existe, on utilise cette URL
        if (file_exists($targetFile)) {
            $perso->setUrlImg($targetFile);
        } else {
            // Sinon, on met l'image par défaut
            $perso->setUrlImg("public/img/unknown.png");
        }

        $values = [
            'id'      => $perso->getId(),
            'name'    => $perso->getName(),
            'classe'  => $perso->getClasse(),
            'rarity'  => $perso->getRarity(),
            'url_img' => $perso->getUrlImg()
        ];

        try {
            $this->execRequest($sql, $values);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}