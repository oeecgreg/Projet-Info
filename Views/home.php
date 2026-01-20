<?php $this->layout('template', ['title' => 'Liste des Brawlers']) ?>

<div class="container">
    <h1 class="h1">Liste des Brawlers</h1>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Rechercher un Brawler (nom, rareté ou classe)...">
    </div>
    <table class="brawler-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Classe</th>
                <th>Rareté</th>
                <th>Options</th> </tr>
        </thead>
        <tbody>
            <?php foreach ($listPersonnage as $brawler): ?>
                <tr>
                    <td>
                        <img src="<?= $this->e($brawler['url_img']) ?>" alt="<?= $this->e($brawler['name']) ?>" class="table-img">
                    </td>
                    <td><?= $this->e($brawler['name']) ?></td>
                    <td><?= $this->e($brawler['classe']) ?></td>
                    <td>
                        <span class="rarity-badge <?= strtolower($this->e($brawler['rarity'])) ?>">
                            <?= $this->e($brawler['rarity']) ?>
                        </span>
                    </td>
                    <td class="options">
                        <?php if(isset($_SESSION['user'])): ?>
                            <a href="index.php?action=edit-perso&id=<?= $brawler['id'] ?>" title="Modifier">✏️</a>
                            <a href="index.php?action=del-perso&id=<?= $brawler['id'] ?>" title="Supprimer">🗑️</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>