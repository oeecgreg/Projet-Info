<?php
namespace Models;

/**
 * DAO pour la gestion des classes
 */
class ClasseDAO extends BasePDODAO
{
    /** 
     * Récupère toutes les classes depuis la base de données
     * @return array Liste des classes
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM Classe ORDER BY name ASC";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll();
    }

    /** 
     * Ajoute une nouvelle classe à la base de données
     * @param Classe $classe La classe à ajouter
     * @return bool Succès de l'opération
     */
    public function add(Classe $classe): bool
    {
        // 1. VÉRIFICATION DOUBLON
        $sqlCheck = "SELECT COUNT(*) FROM classe WHERE name = ?";
        $stmt = $this->execRequest($sqlCheck, [$classe->getName()]);
        // Si le résultat est supérieur à 0, le nom existe déjà
        if ($stmt->fetchColumn() > 0) {
            return false; 
        }

        // 2. INSERTION NORMALE
        $sql = "INSERT INTO classe (name, url_img) VALUES (?, ?)";
        try {
            $this->execRequest($sql, [$classe->getName(), $classe->getUrlImg()]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Supprime une classe de la base de données
     * @param int $id L'ID de la classe à supprimer
     * @return bool Succès de l'opération
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM classe WHERE id = ?";
        try {
            $this->execRequest($sql, [$id]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Récupère une classe par son ID
     * @param int $id L'ID de la classe
     * @return array|null Les données de la classe ou null si non trouvée
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM classe WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }
}