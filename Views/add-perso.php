<!-- Page pour ajouter un nouveau Brawler -->
<?php $this->layout('template', ['title' => 'Ajouter un Brawler']) ?>

<div class="form-container">
    <h1>Ajouter un nouveau Brawler</h1>
    
    <!-- Formulaire d'ajout de brawler -->
    <form action="index.php?action=add-perso" method="POST">
        
        <!-- Champ pour le nom du brawler -->
        <div class="form-group">
            <label for="name">Nom du Brawler :</label>
            <input type="text" id="name" name="name" required placeholder="Ex: Shelly">
            <small style="color: #666;">L'image sera générée automatiquement (ex: public/img/Shelly.png)</small>
        </div>

        <!-- AJOUT : Menu déroulant pour les raretés -->
        <div class="form-group">
            <label for="rarity">Rareté :</label>
            <select id="rarity" name="rarity" required>
                <?php foreach($listRarities as $rarity): ?>
                    <option value="<?= $this->e($rarity['name']) ?>">
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
                    <option value="<?= $this->e($classe['name']) ?>">
                        <?= $this->e($classe['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn-submit">Créer le Brawler</button>
    </form>
</div>