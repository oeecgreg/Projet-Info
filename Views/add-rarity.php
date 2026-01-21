<?php $this->layout('template', ['title' => 'Ajouter une Rareté']) ?>

<div class="form-container">
    <h1>Ajouter une nouvelle Rareté</h1>

    <form action="index.php?action=add-rarity" method="POST">
        <div class="form-group">
            <label for="name">Nom de la rareté :</label>
            <input type="text" id="name" name="name" placeholder="Ex: Légendaire, Chromatique..." required>
        </div>

        <div class="form-group">
            <label for="color_code">Couleur associée :</label>
            <input type="color" id="color_code" name="color_code" value="#fef136" required>
            <small style="color: #ccc;">Cette couleur sera utilisée pour le badge du Brawler.</small>
        </div>

        <button type="submit" class="btn-submit">Créer la rareté</button>
    </form>
</div>