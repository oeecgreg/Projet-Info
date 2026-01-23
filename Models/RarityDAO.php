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
     * @return void
     */
    public function add(Rarity $rarity): void {
        $sql = "INSERT INTO Rarity (name, color_code) VALUES (?, ?)";
        $this->execRequest($sql, [$rarity->getName(), $rarity->getColorCode()]);
    }

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
}