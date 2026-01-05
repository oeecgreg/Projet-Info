<?php

namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO; // Importation nécessaire

class MainController {
    private $templates;

    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');  
    }

    public function index() : void {
        // Test demandé à l'étape 2.3 du PDF
        $personnageDAO = new PersonnageDAO();
        
        $listPersonnage = $personnageDAO->getAll();
        $first = $personnageDAO->getByID(1); // Remplacez 1 par un ID existant
        $other = $personnageDAO->getByID(999);

        echo $this->templates->render('home', [
            'listPersonnage' => $listPersonnage,
            'first'          => $first,
            'other'          => $other
        ]);
    }
}