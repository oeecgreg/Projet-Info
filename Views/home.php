<!-- Page d'affichage de la liste des Brawlers -->
<?php $this->layout('template', ['title' => 'Liste des Brawlers']) ?>

<div class="container">
    <h1 class="h1">Liste des Brawlers</h1>

    <!-- Affichage des messages flash -->
    <?php if(isset($flash_message) && $flash_message): ?>
        <div class="alert alert-<?= $flash_type ?>">
            <?= $flash_message ?> </div>
    <?php endif; ?>

    <!-- Barre de recherche -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Rechercher un Brawler (nom, rareté ou classe)...">
    </div>
    <table class="brawler-table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Rareté</th>
            <th>Classe</th>

            <?php if(isset($_SESSION['user'])): ?>
                <th>Collection</th>
                <th>Options</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($brawlers as $brawler): ?>
            <tr>
                <td>
                    <img src="<?= $this->e($brawler['url_img']) ?>" alt="<?= $this->e($brawler['name']) ?>" class="table-img">
                </td>
                <td><strong><?= $this->e($brawler['name']) ?></strong></td>
                <td>
                    <span class="rarity-badge" style="background-color: <?= $this->e($brawler['color_code']) ?>;">
                        <?= $this->e($brawler['rarity']) ?>
                    </span>
                </td>
                <td><?= $this->e($brawler['classe']) ?></td>
                
                <?php if(isset($_SESSION['user'])): ?>
                    <td style="text-align: center;">
                        <?php if(in_array($brawler['id'], $myCollection)): ?>
                            <a href="index.php?action=collection&id=<?= $brawler['id'] ?>&mode=remove" 
                               class="btn-collection remove" title="Retirer">✅</a>
                        <?php else: ?>
                            <a href="index.php?action=collection&id=<?= $brawler['id'] ?>&mode=add" 
                               class="btn-collection add" title="Ajouter">➕</a>
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="index.php?action=edit-perso&id=<?= $brawler['id'] ?>" class="btn-edit">✏️</a>
                        <a href="index.php?action=del-perso&id=<?= $brawler['id'] ?>" class="btn-delete" 
                           onclick="return confirm('Êtes-vous sûr ?')">🗑️</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>