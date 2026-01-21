<?php $this->layout('template', ['title' => 'Ma Collection']) ?>

<h1>Ma Collection de Brawlers</h1>

<?php if (empty($brawlers)): ?>
    <div class="alert alert-info">
        Vous n'avez pas encore de Brawler dans votre collection. 
        <a href="index.php">Allez en ajouter !</a>
    </div>
<?php else: ?>
    <table class="brawler-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Rareté</th>
                <th>Classe</th>
                <th>Action</th>
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
                    <td style="text-align: center;">
                        <a href="index.php?action=collection&id=<?= $brawler['id'] ?>&mode=remove&redirect=my-collection" 
                        class="btn-delete" 
                        title="Retirer de ma collection"
                        onclick="return confirm('Retirer <?= $this->e($brawler['name']) ?> de votre collection ?')">
                        ⛔ Retirer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>