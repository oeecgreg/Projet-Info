<?php

namespace Config;

use Exception;

class Config {
    private static $settings = [];

    public static function load($filename) {
        if (file_exists($filename)) {
            // Le deuxième paramètre 'true' permet de récupérer les sections (comme [DB])
            self::$settings = parse_ini_file($filename, true);
        } else {
            throw new Exception("Le fichier de configuration '$filename' est introuvable.");
        }
    }

    public static function get(?string $key = null, string $section = 'DB') {
        // Si on ne demande pas de clé spécifique, on renvoie toute la section
        if ($key === null) {
            return self::$settings[$section] ?? null;
        }
        // Sinon on renvoie la valeur précise
        return self::$settings[$section][$key] ?? null;
    }
}