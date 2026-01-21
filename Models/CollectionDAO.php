<?php
namespace Models;

class CollectionDAO extends BasePDODAO
{
    /**
     * Ajoute un brawler à la collection de l'utilisateur
     * @param int $userId ID de l'utilisateur
     * @param int $brawlerId ID du brawler à ajouter
     * @return bool Succès de l'opération
     */
    public function add(int $userId, int $brawlerId): bool
    {
        $sql = "INSERT INTO Collection (user_id, brawler_id) VALUES (?, ?)";
        try {
            $this->execRequest($sql, [$userId, $brawlerId]);
            return true;
        } catch (\Exception $e) {
            return false; // Déjà présent ou erreur
        }
    }

    /**
     * Retire un brawler de la collection
     * @param int $userId ID de l'utilisateur
     * @param int $brawlerId ID du brawler à retirer
     * @return bool Succès de l'opération
     */
    public function remove(int $userId, int $brawlerId): bool
    {
        $sql = "DELETE FROM Collection WHERE user_id = ? AND brawler_id = ?";
        $this->execRequest($sql, [$userId, $brawlerId]);
        return true;
    }

    /**
     * Récupère la liste des IDs des brawlers possédés par l'utilisateur
     * @param int $userId ID de l'utilisateur
     * @return array Liste simple d'IDs (ex: [1, 5, 12])
     */
    public function getBrawlerIdsByUser(int $userId): array
    {
        $sql = "SELECT brawler_id FROM Collection WHERE user_id = ?";
        $stmt = $this->execRequest($sql, [$userId]);
        $rows = $stmt->fetchAll();
        
        // On transforme le résultat en un tableau simple d'IDs
        return array_column($rows, 'brawler_id');
    }

    /**
     * Récupère la liste complète des objets Brawlers possédés par un utilisateur
     * (Avec jointure pour avoir la couleur de rareté)
     * @param int $userId ID de l'utilisateur
     * @return array Liste des brawlers complets
     */
    public function getBrawlersByUser(int $userId): array
    {
        // On joint Brawler + Collection + Rarity
        $sql = "SELECT b.*, r.color_code 
                FROM brawler b
                JOIN Collection c ON b.id = c.brawler_id
                LEFT JOIN rarity r ON b.rarity = r.name
                WHERE c.user_id = ?";
                
        $stmt = $this->execRequest($sql, [$userId]);
        return $stmt->fetchAll();
    }
}