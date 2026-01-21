<?php
namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;
use Models\Personnage;
use Models\PersonnageDAO;

/**
 * Route pour l'ajout d'un brawler
 */
class RouteAddPerso extends Route
{
    protected bool $isProtected = true;

    private MainController $controller;

    /**
     * Constructeur
     * @param MainController $controller Le contrôleur principal
     */
    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }


    /**
     * Gère la requête GET pour afficher le formulaire d'ajout de brawler
     * @param mixed $params
     * @return void
     */
    public function get($params = [])
    {
        return $this->controller->displayAddPerso();
    }

    /**
     * Traite le formulaire
     * @param mixed $params
     * @return void
     */
    public function post($params = [])
    {
        // Récup des données du formulaire et vérification que le formulaire est complet
        $name = $params['name'] ?? null;
        $classe = $params['classe'] ?? null;
        $rarity = $params['rarity'] ?? null;

        // Vérification basique que les champs sont remplis
        if ($name && $classe && $rarity) {

            $perso = new Personnage();
            $perso->setName($name);
            $perso->setRarity($rarity);
            $perso->setClasse($classe);
            // --- Gestion du cas ou l'image existe pas (image générer par le nom du brawler dans le formulaire) ---
            $targetImage = "public/img/" . $name . ".png";
            
            if (file_exists($targetImage)) {
                $perso->setUrlImg($targetImage);
            } else {
                // Si l'image n'existe pas, on met l'image unknown par défaut
                $perso->setUrlImg("public/img/unknown.png");
            }
            // ---------------------------------------
            

            $dao = new \Models\PersonnageDAO();
            if ($dao->add($perso)) {
                // parti logs
                $logDAO = new \Models\LogDAO();
                $username = $_SESSION['user']['username'] ?? 'Inconnu';
                $logDAO->addLog('ADD', "A ajouté le Brawler : " . $name, $username);

                // msg de succès
                $_SESSION['flash_message'] = "Le Brawler <strong>" . $name . "</strong> a été ajouté avec succès !";
                $_SESSION['flash_type'] = "success"; // vert

                header('Location: index.php');
                exit;
            } else {
                // message d'erreur
                $_SESSION['flash_message'] = "Erreur : Impossible d'ajouter le Brawler.";
                $_SESSION['flash_type'] = "error"; // rouge
            }
        } else {
            echo "Veuillez remplir tous les champs.";
        }
    }
}