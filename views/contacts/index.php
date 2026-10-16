<h1>Mes contacts</h1>
<ul>
<?php foreach ($contacts as $c): ?>
    <li>
        <a href="/contacts/<?= (int) $c['id'] ?>">
            <?= e($c['prenom'] . ' ' . $c['nom']) ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>