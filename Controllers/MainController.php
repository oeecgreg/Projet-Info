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

    public function login($username, $password)
    {
        $userDAO = new \Models\UserDAO();
        $user = $userDAO->findByUsername($username);

        // On vérifie si l'utilisateur existe ET si le mot de passe est correct
        if ($user && password_verify($password, $user->getPassword())) {
            // AUTHENTIFICATION RÉUSSIE
            $_SESSION['user'] = [
                'id' => $user->getId(),
                'username' => $user->getUsername()
            ];
            header('Location: index.php');
            exit;
        } else {
            // ÉCHEC : On réaffiche le formulaire avec une erreur
            echo $this->templates->render('login', ['error' => 'Identifiants incorrects.']);
        }
    }

    // --- Méthodes de navigation ---

    public function displayAddPerso()
    {
        // On récupère les classes depuis la base de données
        $classeDAO = new \Models\ClasseDAO();
        $listClasses = $classeDAO->getAll();

        // On passe la liste à la vue
        echo $this->templates->render('add-perso', [
            'listClasses' => $listClasses
        ]);
    }
    // C'est cette méthode qui était manquante pour ta page !
    public function displayAddClasse()
    {
        // Assure-toi que le fichier Views/add-classe.php existe bien
        echo $this->templates->render('add-classe', []);
    }

    public function displayLogs()
    {
        $logDAO = new \Models\LogDAO();
        $logs = $logDAO->getAllLogs(); // On récupère tous les logs en base
        echo $this->templates->render('logs', ['logs' => $logs]); // On les envoie à la vue
    }

    public function displayLogin()
    {
        echo $this->templates->render('login', []);
    }

    public function displayEditPerso($id)
    {
        $dao = new PersonnageDAO();
        $brawler = $dao->getByID($id);

        // AJOUT : On récupère aussi les classes pour le menu déroulant
        $classeDAO = new \Models\ClasseDAO();
        $listClasses = $classeDAO->getAll();

        if ($brawler) {
            // MODIFICATION : On passe 'listClasses' à la vue
            echo $this->templates->render('edit-perso', [
                'brawler' => $brawler,
                'listClasses' => $listClasses
            ]);
        } else {
            header('Location: index.php');
            exit;
        }
    }
}