<?php

namespace Models;

/**
 * Gère les interactions avec la table Personnages en base de données
 */
class PersonnageDAO extends BasePDODAO
{
    /**
     * Récupère tous les brawlers
     * @return array Données brutes de la table Brawler
     */
    public function getAll(): array
    {
        // j'ai remplacé Personnage par Brawler
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

    /**
     * Ajoute un nouveau brawler en base de données
     * @param Personnage $perso L'objet personnage à ajouter
     * @return bool True si l'ajout a réussi
     */
    public function add(\Models\Personnage $perso): bool
    {
        // On prépare la requête (pas d'ID car auto-incrément, pas d'element/origin car supprimés)
        $sql = "INSERT INTO Brawler (name, classe, rarity, url_img) VALUES (:name, :classe, :rarity, :url_img)";
        
        // On prépare les valeurs
        $values = [
            'name'    => $perso->getName(),
            'classe'  => $perso->getClasse(),
            'rarity'  => $perso->getRarity(),
            'url_img' => $perso->getUrlImg()
        ];

        // On exécute via la méthode héritée de BasePDODAO
        try {
            $this->execRequest($sql, $values);
            return true;
        } catch (\Exception $e) {
            // logs d'erreur peuvent être ajoutés ici
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
        $sql = "DELETE FROM Brawler WHERE id = ?";
        
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
        $sql = "UPDATE Brawler SET name = :name, classe = :classe, rarity = :rarity, url_img = :url_img WHERE id = :id";
        
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