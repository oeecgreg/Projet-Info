<?php
namespace Models;

class ClasseDAO extends BasePDODAO
{
    public function getAll(): array
    {
        $sql = "SELECT * FROM Classe ORDER BY name ASC";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll();
    }

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