<?php
namespace Models;

class LogDAO extends BasePDODAO
{
    /**
     * Enregistre un nouvel événement dans le journal
     */
    public function addLog(string $type, string $message, string $user): void
    {
        $sql = "INSERT INTO Log (action_type, description, author) VALUES (?, ?, ?)";
        $this->execRequest($sql, [$type, $message, $user]);
    }

    /**
     * Récupère tous les logs du plus récent au plus ancien
     */
    public function getAllLogs(): array
    {
        $sql = "SELECT * FROM Log ORDER BY date_action DESC";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll();
    }
}