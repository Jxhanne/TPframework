<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Mon Framework') ?></title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 800px;
            margin: 2rem auto;
        }

        footer {
            margin-top: 2rem;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 1rem;
        }
    </style>
</head>

<body>
    <main>
        <?= $content ?>
    </main>
</body>

</html>