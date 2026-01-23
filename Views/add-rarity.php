<?php $this->layout('template', ['title' => 'Ajouter une Rareté']) ?>

<h1 style="text-align: center; margin-bottom: 30px;">Gestion des Raretés</h1>

<div class="admin-layout-split">

    <div class="table-container box-shadow">
        <h2>Raretés existantes</h2>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Couleur</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rarities)): ?>
                    <?php foreach ($rarities as $rarity): ?>
                        <tr>
                            <td class="fw-bold">
                                <?= $this->e($rarity['name']) ?>
                            </td>
                            
                            <td>
                                <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                                    <span style="
                                        display: inline-block; 
                                        width: 25px; 
                                        height: 25px; 
                                        border-radius: 50%; 
                                        background-color: <?= $this->e($rarity['color_code']) ?>;
                                        border: 2px solid #444;
                                        box-shadow: 0 0 5px rgba(0,0,0,0.5);
                                    "></span>
                                    <span style="font-family: monospace; color: var(--text-muted);">
                                        <?= $this->e($rarity['color_code']) ?>
                                    </span>
                                </div>
                            </td>
                            
                            <td>
                                <a href="index.php?action=del-rarity&id=<?= $rarity['id'] ?>" 
                                   class="btn-delete-mini"
                                   onclick="return confirm('⚠️ Attention !\n\nSupprimer cette rareté peut affecter l\'affichage des Brawlers qui l\'utilisent.\n\nÊtes-vous sûr ?')">
                                    🗑️ Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="padding: 20px; text-align: center; color: var(--text-muted);">
                            Aucune rareté définie pour le moment.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="form-container box-shadow" style="height: fit-content;">
        <h2>Ajouter une Rareté</h2>
        
        <form action="index.php?action=add-rarity" method="POST">
            
            <div class="form-group">
                <label for="name">Nom de la Rareté :</label>
                <input type="text" id="name" name="name" required placeholder="Ex: Mythique">
            </div>

            <div class="form-group">
                <label for="color_code">Code Couleur (Hexadécimal) :</label>
                
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input type="color" id="colorPicker" value="#ffffff" 
                           style="width: 50px; height: 50px; padding: 0; border: none; background: none; cursor: pointer;"
                           onchange="updateTextInput(this.value)">
                    
                    <input type="text" id="color_code" name="color_code" required 
                           placeholder="#FFFFFF" value="#FFFFFF"
                           onchange="updateColorPicker(this.value)">
                </div>
                <small style="display: block; margin-top: 5px;">Cliquez sur le carré de couleur pour choisir.</small>
            </div>

            <button type="submit" class="btn-submit">Enregistrer la Rareté</button>
        </form>
    </div>

</div>

<script>
    function updateTextInput(val) {
        document.getElementById('color_code').value = val.toUpperCase();
    }
    function updateColorPicker(val) {
        document.getElementById('colorPicker').value = val;
    }
</script>