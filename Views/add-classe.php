<?php $this->layout('template', ['title' => 'Ajouter une Classe']) ?>

<h1 style="text-align: center; margin-bottom: 30px;">Gestion des Classes</h1>

<div class="admin-layout-split">

    <div class="form-container box-shadow">
        <h2>Classes existantes</h2>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($classes)): ?>
                    <?php foreach ($classes as $classe): ?>
                        <tr>
                            <td class="fw-bold">
                                <?= $this->e($classe['name']) ?>
                            </td>
                            <td>
                                <?php 
                                    $imgSrc = !empty($classe['url_img']) ? $classe['url_img'] : 'public/img/default.png';
                                ?>
                                <img src="<?= $this->e($imgSrc) ?>" alt="Icone" class="class-icon-mini">
                            </td>
                            <td>
                                <a href="index.php?action=del-classe&id=<?= $classe['id'] ?>" 
                                   class="btn-delete-mini"
                                   onclick="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer cette classe ?')">
                                    🗑️ Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="padding: 20px; text-align: center; color: #666;">
                            Aucune classe n'a été créée pour le moment.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="form-container box-shadow" style="height: fit-content;">
        <h2>Ajouter une nouvelle Classe</h2>
        
        <form action="index.php?action=add-classe" method="POST">
            <div class="form-group">
                <label for="name">Nom de la Classe :</label>
                <input type="text" id="name" name="name" required placeholder="Ex: Tireur d'élite">
            </div>

            <div class="form-group">
                <label for="url_img">Icône de la classe :</label>
                <input type="text" id="url_img" name="url_img" required placeholder="Ex: sniper_icon.png">
                <small style="color: #666; display: block; margin-top: 5px;">Nom du fichier image dans public/img/</small>
            </div>

            <button type="submit" class="btn-submit">Enregistrer la Classe</button>
        </form>
    </div>

</div>