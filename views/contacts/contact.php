<h1><?= htmlspecialchars($contact['prenom'] . ' ' . $contact['nom']) ?></h1>

<ul>
    <li><strong>Id :</strong> <?= (int) $contact['id'] ?></li>
    <li><strong>Nom :</strong> <?= htmlspecialchars($contact['nom']) ?></li>
    <li><strong>Prénom :</strong> <?= htmlspecialchars($contact['prenom']) ?></li>
    <li><strong>Âge :</strong> <?= (int) $contact['age'] ?> ans</li>
    <li><strong>Carte bleue :</strong> <?= htmlspecialchars($contact['carte_bleue']) ?></li>
    <li><strong>Carte Pokémon préférée :</strong> <?= htmlspecialchars($contact['carte_pokemon_preferee']) ?></li>
</ul>

<a href="/contacts">Retour à la liste</a>