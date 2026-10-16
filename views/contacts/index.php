<h1><?= $pageTitle ?></h1>

<?php if (empty($contacts)): ?>
    <p>Aucun contact pour le moment.</p>
<?php else: ?>
<ul class="contacts">
    <?php foreach ($contacts as $c): ?>
        <?php $id = (int) $c['id']; ?>
        <li>
            <a href="/contacts/<?= $id ?>">
                <?= e($c['prenom'] . ' ' . $c['nom']) ?>
            </a>

            <a href="/contacts/<?= $id ?>/edit">Éditer</a>

            <form method="post" action="/contact/delete" style="display:inline" onsubmit="return confirm('Supprimer ce contact ?');">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit">Supprimer</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>