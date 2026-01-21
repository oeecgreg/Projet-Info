<?php
namespace Models;

use Models\User;

/**
 * DAO pour la gestion des utilisateurs
 */
class UserDAO extends BasePDODAO
{
    /**
     * Cherche un utilisateur par son pseudo
     * @param string $username
     * @return User|null
     */
    public function findByUsername(string $username): ?User
    {
        $sql = "SELECT * FROM Users WHERE username = ?";
        $stmt = $this->execRequest($sql, [$username]);
        $row = $stmt->fetch();

        if ($row) {
            $user = new User();
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setPassword($row['password']);
            return $user;
        }

        return null;
    }
}