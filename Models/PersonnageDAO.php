<?php

namespace Models;

/**
 * Gère les interactions avec la table brawler en base de données
 */
class PersonnageDAO extends BasePDODAO
{
    /**
     * Récupère tous les brawlers avec leur couleur de rareté
     * @return array Données brutes de la table
     */
    public function getAll(): array
    {
        // On utilise des alias (b pour brawler, r pour rarity)
        // LEFT JOIN permet de garder le brawler même si sa rareté n'existe pas dans la table rarity
        $sql = "SELECT b.*, r.color_code 
                FROM brawler b 
                LEFT JOIN rarity r ON b.rarity = r.name 
                ORDER BY b.id DESC";
                
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll();
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
    public function add(\Models\Personnage $perso): bool
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
    public function update(\Models\Personnage $perso): bool
    {
        $sql = "UPDATE brawler SET name = :name, classe = :classe, rarity = :rarity, url_img = :url_img WHERE id = :id";
        
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