<?php

namespace Models;

use PDO;
use PDOException;
use Config\Config;

/**
 * Classe de base pour les DAO utilisant PDO
 */
abstract class BasePDODAO
{
    /** @var PDO|null Instance de connexion à la base de données */
    private static ?PDO $db = null;

    /**
     * Instancie et retourne l'objet PDO de connexion [cite: 879, 880]
     * @return PDO
     * @throws PDOException
     */
    private function getDB(): PDO
    {
        if (self::$db === null) {
            try {
                // Récupération de toute la section [DB] du fichier .ini 
                $dbConfig = Config::get(null, 'DB');

                self::$db = new PDO(
                    $dbConfig['dsn'],
                    $dbConfig['user'],
                    $dbConfig['pass'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                throw new PDOException(
                    'Erreur de connexion à la base de données : ' . $e->getMessage()
                );
            }
        }
        return self::$db;
    }

    /**
     * Prépare et exécute une requête SQL [cite: 882, 883]
     * @param string $sql La requête SQL
     * @param array|null $params Les paramètres de la requête
     * @return \PDOStatement Le résultat de la requête 
     */
    protected function execRequest(string $sql, ?array $params = null)
    {
        // On récupère la connexion via getDB()
        $stmt = $this->getDB()->prepare($sql);

        if ($params !== null) {
            $stmt->execute($params);
        } else {
            $stmt->execute();
        }

        // On retourne l'objet PDOStatement pour pouvoir lire les résultats 
        return $stmt;
    }
}