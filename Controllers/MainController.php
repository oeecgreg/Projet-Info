<?php

namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;

class MainController {
    private $templates;

    // On récupère le moteur de template passé par le Routeur (depuis index.php)
    public function __construct(Engine $engine)
    {
        $this->templates = $engine;
    }

    public function index() : void {
        $personnageDAO = new PersonnageDAO();
        $listPersonnage = $personnageDAO->getAll();

        echo $this->templates->render('home', [
            'listPersonnage' => $listPersonnage
        ]);
    }

    // --- Méthodes de navigation ---

    public function displayAddPerso()
    {
        echo $this->templates->render('add-perso', []);
    }

    // C'est cette méthode qui était manquante pour ta page !
    public function displayAddClasse()
    {
        // Assure-toi que le fichier Views/add-classe.php existe bien
        echo $this->templates->render('add-classe', []);
    }

    public function displayLogs()
    {
        echo $this->templates->render('logs', []);
    }

    public function displayLogin()
    {
        echo $this->templates->render('login', []);
    }
}