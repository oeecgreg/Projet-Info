<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="public/css/main.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $this->e($title) ?></title>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?action=add-perso">Ajouter un Brawler</a></li>
                    <li><a href="index.php?action=add-classe">Ajouter une Classe</a></li>
                    <li><a href="index.php?action=logs">Journal (Logs)</a></li>
                    <li><a href="index.php?action=login">Connexion</a></li>
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