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
        $sql = "INSERT INTO Classe (name, url_img) VALUES (?, ?)";
        try {
            $this->execRequest($sql, [$classe->getName(), $classe->getUrlImg()]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}