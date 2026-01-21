<!-- Page d'inscription -->
<?php $this->layout('template', ['title' => 'Inscription']) ?>

<?php if(isset($_SESSION['flash_message'])): ?>
    <div class="alert alert-<?= $_SESSION['flash_type'] ?>">
        <?= $_SESSION['flash_message'] ?>
    </div>
    <?php unset($_SESSION['flash_message'], $_SESSION['flash_type']); ?>
<?php endif; ?>

<div class="form-container">
    <h1>Créer un compte</h1>
    
    <form action="index.php?action=register" method="POST">
        <div class="form-group">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn-submit">S'inscrire</button>
    </form>
    
    <p style="text-align: center; margin-top: 20px;">
        Déjà un compte ? <a href="index.php?action=login">Se connecter</a>
    </p>
</div>