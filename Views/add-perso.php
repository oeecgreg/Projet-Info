<?php $this->layout('template', ['title' => 'Ajouter un Brawler']) ?>

<div class="form-container">
    <h1>Ajouter un nouveau Brawler</h1>
    
    <form action="index.php?action=add-perso" method="POST">
        
        <div class="form-group">
            <label for="name">Nom du Brawler :</label>
            <input type="text" id="name" name="name" required placeholder="Ex: Shelly">
            <small style="color: #666;">L'image sera générée automatiquement (ex: public/img/Shelly.png)</small>
        </div>

        <div class="form-group">
            <label for="rarity">Rareté :</label>
            <select id="rarity" name="rarity" required>
                <option value="Premier brawler">Premier brawler</option>
                <option value="Rare">Rare</option>
                <option value="Super Rare">Super Rare</option>
                <option value="Epique">Epique</option>
                <option value="Mythique">Mythique</option>
                <option value="Légendaire">Légendaire</option>
                <option value="Ultra Légendaire">Ultra Légendaire</option>
            </select>
        </div>

        <div class="form-group">
            <label for="classe">Classe :</label>
            <select id="classe" name="classe" required>
                <option value="Tank">Tank</option>
                <option value="Assassinat">Assassinat</option>
                <option value="Soutien">Soutien</option>
                <option value="Contrôle">Contrôle</option>
                <option value="Dégats bruts">Dégats bruts</option>
                <option value="Tir d'élite">Tir d'élite</option>
                <option value="Artillerie">Artillerie</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Créer le Brawler</button>
    </form>
</div>