<!-- Page pour afficher la collection de Brawlers de l'utilisateur -->
<?php $this->layout('template', ['title' => 'Ma Collection']) ?>

<div class="container"> <h1>Ma Collection</h1>

    <!-- Barre de recherche -->
    <div class="search-container">
        <input type="text" id="searchInput" onkeyup="filterCollection()" placeholder="Rechercher un brawler dans ma collection...">
    </div>

    <?php if (empty($brawlers)): ?>
        <div class="alert alert-info">
            Vous n'avez aucun Brawler dans votre collection pour le moment.
            <a href="index.php">Allez en ajouter !</a>
        </div>
    <?php else: ?>

        <table class="brawler-table">
            <thead>
                <tr>
                    <th>Brawler</th>
                    <th>Nom</th>
                    <th>Classe</th>
                    <th>Rareté</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($brawlers as $brawler): ?>
                <tr>
                    <td>
                        <img src="<?= $this->e($brawler['url_img']) ?>" 
                             alt="<?= $this->e($brawler['name']) ?>" 
                             class="table-img">
                    </td>
                    <td><strong><?= $this->e($brawler['name']) ?></strong></td>
                    <td>
                        <div>
                            <?php 
                                // Logique de l'image de classe (Sécurisée)
                                $classImg = $brawler['class_img'] ?? '';
                                if (empty($classImg) || !file_exists($classImg)) {
                                    $classImg = 'public/img/default.png';
                                }
                            ?>
                            <img src="<?= $this->e($classImg) ?>" alt="Classe" class="class_img">
                            <span><?= $this->e($brawler['classe']) ?></span>
                        </div>
                    </td>

                    <td>
                        <span class="rarity-badge <?= strtolower(str_replace(' ', '-', $brawler['rarity'])) ?>"
                            >
                            <?= $this->e($brawler['rarity']) ?>
                        </span>
                    </td>

                    <td>
                        <a href="index.php?action=remove-collection&id=<?= $brawler['id'] ?>" 
                           style="color: #ff6b6b; font-size: 1.5em;"
                           onclick="return confirm('Retirer ce Brawler de votre collection ?')"
                           title="Retirer de la collection" 
                           class="btn-collection-remove">
                           ❌
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>
</div>

<script>
function filterCollection() {
    // Récupérer ce que l'utilisateur tape
    var input = document.getElementById("searchInput");
    var filter = input.value.toUpperCase();
    
    // Récupérer le tableau et les lignes
    var table = document.getElementById("collectionTable");
    var tr = table.getElementsByTagName("tr");
    var hasResult = false;

    // Boucle sur toutes les lignes (on commence à 1 pour sauter l'en-tête)
    for (var i = 1; i < tr.length; i++) {
        // On cherche le SPAN qui contient le nom (classe .brawler-name)
        var span = tr[i].querySelector(".brawler-name");
        
        if (span) {
            var txtValue = span.textContent || span.innerText;
            
            // Si le texte contient la recherche
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = ""; // On affiche
                hasResult = true;
            } else {
                tr[i].style.display = "none"; // On cache
            }
        }       
    }

    // Gestion du message "Aucun résultat"
    var noResultMsg = document.getElementById("noResult");
    if (!hasResult && filter !== "") {
        noResultMsg.style.display = "block";
        table.style.display = "none"; // Optionnel : cache l'en-tête du tableau
    } else {
        noResultMsg.style.display = "none";
        table.style.display = ""; // Réaffiche le tableau
    }
}
</script>
