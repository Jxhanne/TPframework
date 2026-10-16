<h1><?= e($pageTitle) ?></h1>

<?php if (!empty($erreur)): ?>
    <p role="alert"><?= e($erreur) ?></p>
<?php endif; ?>

<form method="post" action="/contact/edit">
    <input type="hidden" name="id" value="<?= (int) $contact['id'] ?>">

    <label>Prénom
        <input type="text" name="prenom" value="<?= e($contact['prenom'] ?? '') ?>" required>
    </label>

    <label>Nom
        <input type="text" name="nom" value="<?= e($contact['nom'] ?? '') ?>" required>
    </label>

    <label>Âge
        <input type="number" name="age" min="0" max="150" value="<?= e((string) ($contact['age'] ?? '')) ?>">
    </label>

    <label>Carte bleue
        <input type="text" name="carte_bleue" inputmode="numeric" autocomplete="off"
               value="<?= e($contact['carte_bleue'] ?? '') ?>">
    </label>

    <label>Carte Pokémon préférée
        <input type="text" name="carte_pokemon_preferee"
               value="<?= e($contact['carte_pokemon_preferee'] ?? '') ?>">
    </label>

    <button type="submit">Enregistrer</button>
</form>

<p><a href="/contacts">Retour à la liste</a></p>