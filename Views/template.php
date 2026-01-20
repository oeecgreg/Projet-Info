<?php
// 1. On récupère automatiquement toutes les images du dossier
$images = glob('public/img/*.png'); 
// 2. On les mélange pour avoir un ordre différent à chaque fois (optionnel)
shuffle($images);
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="public/css/main.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $this->e($title) ?></title>
    </head>
    <body>
        
        <div class="background-animation">
            <div class="img-grid">
                <?php 
                // créée une grille d'images répétées pour le défilement infino
                for($i = 0; $i < 20; $i++): 
                    foreach($images as $img): ?>
                        <img src="<?= $img ?>" alt="décor">
                    <?php endforeach; 
                endfor; 
                ?>
            </div>
        </div>
        <div class="background-overlay"></div>
        <header>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <?php if(isset($_SESSION['user'])): ?>
                        <li><a href="index.php?action=add-perso">Ajouter un Brawler</a></li>
                        <li><a href="index.php?action=add-classe">Ajouter une Classe</a></li>
                        <li><a href="index.php?action=logs">Journal (Logs)</a></li>
                    <?php endif; ?>
                    
                    <?php if(!isset($_SESSION['user'])): ?>
                        <li><a href="index.php?action=login">Connexion</a></li>
                    <?php else: ?>
                        <li><a href="index.php?action=logout">Déconnexion (<?= $_SESSION['user']['username'] ?>)</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
        <main id="contenu">
            <?=$this->section('content')?>
        </main>
        <footer>
        </footer>
    </body>
</html>