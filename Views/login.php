<!-- Page de connexion admin -->
<?php $this->layout('template', ['title' => 'Connexion']) ?>

<div class="form-container">
    <h1>Connexion</h1>

    <?php if(isset($error)): ?>
        <p style="color: #fe3636; text-align: center; font-weight: bold;"><?= $this->e($error) ?></p>
    <?php endif; ?>

    <form action="index.php?action=login" method="POST">
        <div class="form-group">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn-submit">Se connecter</button>
    </form>
</div>