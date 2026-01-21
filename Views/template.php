<!-- Modèle de template principal avec animation de fond et navigation -->
<?php
$images = glob('public/img/*.png'); 
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

        <!-- Overlay pour assombrir le fond -->
        <div class="background-overlay"></div>
        <header>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    
                    <?php if(isset($_SESSION['user'])): ?>
                        <?php if($_SESSION['user']['username'] === 'admin'): ?>
                            <li><a href="index.php?action=add-perso">Ajouter un Brawler</a></li>
                            <li><a href="index.php?action=add-classe">Ajouter une Classe</a></li>
                            <li><a href="index.php?action=add-rarity">Ajouter une Rareté</a></li>
                            <li><a href="index.php?action=logs">Logs</a></li>
                        <?php endif; ?>
                        <li><a href="index.php?action=my-collection">Ma Collection</a></li>
                        <li><a href="index.php?action=logout">Déconnexion (<?= $_SESSION['user']['username'] ?>)</a></li>
                        
                    <?php else: ?>
                        <li><a href="index.php?action=login">Connexion</a></li>
                        <li><a href="index.php?action=register">Inscription</a></li> <?php endif; ?>
                </ul>
            </nav>
        </header>

        <!-- Contenu principal de la page -->
        <main id="contenu">
            <?=$this->section('content')?>
        </main>
        <footer>
            <p>&copy; <?= date('Y') ?> <a id="rickroll" href="Views/essentials/rr.html" target="_blank">Luca le goat</a>. Tous droits réservés (sinon je vous envoie mes avocats).</p>
            <p>Images de Brawl Stars &copy;Supercell. Utilisées à des fins éducatives uniquement.</p>
            
        </footer>

        <!-- Script pour la recherche et le tri dans la table des Brawlers -->
        <script>

        // Recherche en temps réel par nom, rareté ou classe
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('.brawler-table tbody tr');

            rows.forEach(row => {
                // On récupère le texte du nom, de la rareté et de la classe
                let text = row.textContent.toLowerCase();
                
                if (text.includes(filter)) {
                    row.style.display = ""; // Affiche la ligne
                } else {
                    row.style.display = "none"; // Cache la ligne
                }
            });
        });

        // Tri des colonnes au clic sur l'en-tête
        document.querySelectorAll('.brawler-table th').forEach((header, index) => {
            // On ne trie pas la colonne "Image" (index 0) ni "Options" (index 4)
            if (index === 0 || index === 4) return;

            header.addEventListener('click', () => {
                const table = header.closest('table');
                const tbody = table.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr'));
                const isAscending = header.classList.contains('th-sort-asc');

                // Tri des lignes
                rows.sort((a, b) => {
                    const aText = a.children[index].textContent.trim();
                    const bText = b.children[index].textContent.trim();
                    
                    return isAscending 
                        ? bText.localeCompare(aText) 
                        : aText.localeCompare(bText);
                });

                // Mise à jour visuelle
                tbody.append(...rows);
                
                // On gère les classes pour savoir si on est en ASC ou DESC
                document.querySelectorAll('.brawler-table th').forEach(th => th.classList.remove('th-sort-asc', 'th-sort-desc'));
                header.classList.toggle('th-sort-asc', !isAscending);
                header.classList.toggle('th-sort-desc', isAscending);
            });
        });
        </script>
    </body>
</html>