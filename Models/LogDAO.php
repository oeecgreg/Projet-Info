<?php
namespace Models;

/**
 * DAO pour la gestion des logs
 */
class LogDAO extends BasePDODAO
{
    /**
     * Enregistre un nouvel événement dans le journal
     * @param string $type Type d'action (e.g., 'INFO', 'ERROR')
     * @param string $message Description de l'action
     * @param string $user Auteur de l'action
     * @return void
     */
    public function addLog(string $type, string $message, string $user): void
    {
        $sql = "INSERT INTO Log (action_type, description, author) VALUES (?, ?, ?)";
        $this->execRequest($sql, [$type, $message, $user]);
    }

    /**
     * Récupère tous les logs du plus récent au plus ancien
     * @return array Liste des logs
     */
    public function getAllLogs(): array
    {
        $sql = "SELECT * FROM Log ORDER BY date_action DESC";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll();
    }
}