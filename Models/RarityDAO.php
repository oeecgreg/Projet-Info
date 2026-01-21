<?php
namespace Models;

class RarityDAO extends BasePDODAO {
    public function getAll(): array {
        $sql = "SELECT * FROM Rarity ORDER BY id ASC";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll();
    }

    public function add(Rarity $rarity): void {
        $sql = "INSERT INTO Rarity (name, color_code) VALUES (?, ?)";
        $this->execRequest($sql, [$rarity->getName(), $rarity->getColorCode()]);
    }
}