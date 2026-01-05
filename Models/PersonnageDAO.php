<?php

namespace Models;

class PersonnageDAO extends BasePDODAO
{
    /**
     * Récupère tous les brawlers
     * @return array Données brutes de la table Brawler
     */
    public function getAll(): array
    {
        // On remplace PERSONNAGE par Brawler
        $sql = "SELECT id, url_img, name, classe, rarity FROM Brawler";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll();
    }

    /**
     * Récupère un brawler par son ID
     * @param int $id
     * @return array|null
     */
    public function getByID(int $id): ?array
    {
        // On remplace PERSONNAGE par Brawler
        $sql = "SELECT id, url_img, name, classe, rarity FROM Brawler WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $result = $stmt->fetch();
        
        return $result ?: null;
    }
}