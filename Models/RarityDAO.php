<?php
namespace Models;

/**
 * DAO pour la gestion des raretés
 */
class RarityDAO extends BasePDODAO {

    /** 
     * Récupère toutes les raretés depuis la base de données
     * @return array Liste des raretés
     */
    public function getAll(): array {
        $sql = "SELECT * FROM Rarity ORDER BY id ASC";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll();
    }

    /** 
     * Ajoute une nouvelle rareté à la base de données
     * @param Rarity $rarity La rareté à ajouter
     * @return bool
     */
    public function add(Rarity $rarity): bool
    {
        // 1. VÉRIFICATION DOUBLON
        $sqlCheck = "SELECT COUNT(*) FROM rarity WHERE name = ?";
        $stmt = $this->execRequest($sqlCheck, [$rarity->getName()]);
        
        if ($stmt->fetchColumn() > 0) {
            return false;
        }

        // 2. INSERTION NORMALE
        $sql = "INSERT INTO rarity (name, color_code) VALUES (?, ?)";
        try {
            $this->execRequest($sql, [$rarity->getName(), $rarity->getColorCode()]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Supprime une rareté de la base de données
     * @param int $id L'ID de la rareté à supprimer
     * @return bool Succès de l'opération
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM rarity WHERE id = ?";
        try {
            $this->execRequest($sql, [$id]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Récupère une rareté par son ID
     * @param int $id L'ID de la rareté
     * @return array|null Les données de la rareté ou null si non trouvée
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM rarity WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }
}