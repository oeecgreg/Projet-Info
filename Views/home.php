<?php $this->layout('template', ['title' => 'Test des données']) ?>

<h1>Résultats du test DAO</h1>

<section>
    <h2>Liste de tous les personnages :</h2>
    <?php var_dump($listPersonnage); ?>
</section>

<hr>

<section>
    <h2>Un personnage existant :</h2>
    <?php var_dump($first); ?>
</section>

<hr>

<section>
    <h2>Un personnage inexistant (doit être NULL) :</h2>
    <?php var_dump($other); ?>
</section>