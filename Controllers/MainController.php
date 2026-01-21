<?php

namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;

/**
 * Contrôleur principal de l'application
 */
class MainController {
    private $templates;

    // On récupère le moteur de template passé par le Routeur (depuis index.php)
    public function __construct(Engine $engine)
    {
        $this->templates = $engine;
    }

    /**
     * Affiche la page d'accueil avec la liste des brawlers
     * @return void
     */
    public function index()
    {
        //Gestion des messages flash
        $msg = $_SESSION['flash_message'] ?? null;
        $type = $_SESSION['flash_type'] ?? 'info';
        unset($_SESSION['flash_message'], $_SESSION['flash_type']);

        $dao = new PersonnageDAO();
        $brawlers = $dao->getAll();

        // Récupération de la collection de l'utilisateur connecté
        // -----------------------------------------------
        $myCollection = [];
        if (isset($_SESSION['user'])) {
            $collDAO = new \Models\CollectionDAO();
            $myCollection = $collDAO->getBrawlerIdsByUser($_SESSION['user']['id']);
        }
        // -----------------------------------------------

        echo $this->templates->render('home', [
            'brawlers' => $brawlers,
            'flash_message' => $msg,
            'flash_type' => $type,
            'myCollection' => $myCollection // On envoie la liste à la vue
        ]);
    }

    /** Traite le formulaire de login
     * @param string $username Nom d'utilisateur
     * @param string $password Mot de passe de l'utilisateur
     * @return void
     */
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

    /**
     * Affiche le formulaire d'ajout de brawler
     * @return void
     */
    public function displayAddPerso()
    {
        // On récupère les classes depuis la BDD
        $classeDAO = new \Models\ClasseDAO();
        $rarityDAO = new \Models\RarityDAO();

        $listClasses = $classeDAO->getAll();
        $listRarities = $rarityDAO->getAll();

        // On passe la liste à la vue
        echo $this->templates->render('add-perso', [
            'listClasses' => $listClasses,
            'listRarities'=> $listRarities
        ]);
    }

    /**
     * Render l'ajout de classe
     * @return void
     */
    public function displayAddClasse()
    {
        echo $this->templates->render('add-classe', []);
    }

    /**
     * Render l'ajout de rareté
     * @return void
     */
    public function displayAddRarity() {
        echo $this->templates->render('add-rarity');
    }

    /**
     * Affiche les logs
     * @return void
     */
    public function displayLogs()
    {
        $logDAO = new \Models\LogDAO();
        $logs = $logDAO->getAllLogs(); // On récupère tous les logs en base
        echo $this->templates->render('logs', ['logs' => $logs]); // On les envoie à la vue
    }

    /**
     * Affiche le formulaire de login
     * @return void
     */
    public function displayLogin()
    {
        echo $this->templates->render('login', []);
    }

    /**
     * Affiche le formulaire d'édition d'un brawler
     * @param int $id L'ID du brawler à éditer
     * @return void
     */
    public function displayEditPerso($id)
    {
        $dao = new PersonnageDAO();
        $brawler = $dao->getByID($id);

        // AJOUT : On récupère aussi les classes pour le menu déroulant
        $classeDAO = new \Models\ClasseDAO();
        $rarityDAO = new \Models\RarityDAO();

        
        $listClasses = $classeDAO->getAll();
        $listRarities = $rarityDAO->getAll();

        if ($brawler) {
            // MODIFICATION : On passe 'listClasses' à la vue
            echo $this->templates->render('edit-perso', [
                'brawler' => $brawler,
                'listClasses' => $listClasses,
                'listRarities'=> $listRarities
            ]);
        } else {
            header('Location: index.php');
            exit;
        }
    }

    /**
     * Affiche la collection de l'utilisateur connecté
     * @return void
     */
    public function displayMyCollection()
    {
        // On récupère l'ID de l'utilisateur connecté (le Routeur a déjà vérifié la connexion)
        $userId = $_SESSION['user']['id'];

        $collDAO = new \Models\CollectionDAO();
        $myBrawlers = $collDAO->getBrawlersByUser($userId);

        echo $this->templates->render('my-collection', [
            'brawlers' => $myBrawlers
        ]);
    }
}