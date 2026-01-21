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
        $sql = "SELECT * FROM users WHERE username = ?";
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

    /**
     * Récupère un utilisateur par son pseudo
     * @return array|bool (Le tableau de l'user SI trouvé, sinon FALSE)
     */
    public function getByUsername(string $username)
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->execRequest($sql, [$username]);
        
        // fetch() renvoie FALSE si rien n'est trouvé, c'est ce qu'on veut.
        return $stmt->fetch();
    }

    /**
     * Crée un nouvel utilisateur
     */
    public function add(string $username, string $hash_psw): bool
    {
        if ($this->getByUsername($username)) { return false; }

        // Pas besoin de uniqid() si c'est un INT AUTO INCREMENT
        $hash = password_hash($hash_psw, PASSWORD_DEFAULT);

        // On retire 'id' de la requête du coup
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        
        try {
            $this->execRequest($sql, [$username, $hash]); // On retire l'ID des paramètres
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}