<!-- Page pour modifier un Brawler -->
<?php $this->layout('template', ['title' => 'Modifier un Brawler']) ?>

<div class="form-container">
    <h1>Modifier <?= $this->e($brawler['name']) ?></h1>
    
    <!-- Formulaire de modification de brawler -->
    <form action="index.php?action=edit-perso&id=<?= $brawler['id'] ?>" method="POST">
        <input type="hidden" name="id" value="<?= $brawler['id'] ?>">    

        <div class="form-group">
            <label for="name">Nom du Brawler :</label>
            <input type="text" id="name" name="name" required value="<?= $this->e($brawler['name']) ?>">
        </div>

        <!-- AJOUT : Menu déroulant pour les raretés -->
        <div class="form-group">
            <label for="rarity">Rareté :</label>
            <select id="rarity" name="rarity" required>
                <?php foreach($listRarities as $rarity): ?>
                    <option value="<?= $this->e($rarity['name']) ?>" 
                        <?= $brawler['rarity'] == $rarity['name'] ? 'selected' : '' ?>>
                        <?= $this->e($rarity['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- AJOUT : Menu déroulant pour les classes -->
        <div class="form-group">
            <label for="classe">Classe :</label>
            <select id="classe" name="classe" required>
                <?php foreach($listClasses as $classe): ?>
                    <option value="<?= $this->e($classe['name']) ?>" <?= ($brawler['classe'] == $classe['name']) ? 'selected' : '' ?>>
                        <?= $this->e($classe['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn-submit">Enregistrer les modifications</button>
    </form>
</div>