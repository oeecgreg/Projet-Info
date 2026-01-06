<?php $this->layout('template', ['title' => 'Ajouter une Classe']) ?>

<div class="form-container">
    <h1>Ajouter une nouvelle Classe</h1>
    
    <form action="index.php?action=add-perso-classe" method="POST">
        
        <div class="form-group">
            <label for="name">Nom de la Classe :</label>
            <input type="text" id="name" name="name" required placeholder="Ex: Tireur d'élite">
        </div>

        <div class="form-group">
            <label for="url_img">Icône de la classe :</label>
            <input type="text" id="url_img" name="url_img" required placeholder="Ex: sniper_icon.png">
            <small style="color: #666;">Nom du fichier image dans public/img/</small>
        </div>

        <button type="submit" class="btn-submit">Enregistrer la Classe</button>
    </form>
</div>