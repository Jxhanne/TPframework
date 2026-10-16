<?php
// config/routes.php
// Ce fichier déclare toutes les routes de l'application.
// C'est l'équivalent de config/routes.yaml chez Symfony,
// ou des attributs #[Route('/about')] sur les contrôleurs.
// Ici on utilise du PHP pur, pas de YAML, pas d'annotations.
//
// La variable $router est créée dans public/index.php
// avant que ce fichier soit inclus via require.
// C'est pour ça qu'on peut l'utiliser directement ici
// sans la déclarer, elle vient du scope parent.

use App\Response;
use App\Request;

use Controllers\ArticleController;


/** @var App\Router $router */


// A décommenter pour utiliser les controllers. Commenter les routes correspondant au dessus.
$router->get('/contacts',      [ArticleController::class, 'index']);
$router->get('/contacts/{id}', [ArticleController::class, 'show']);
$router->post('/contact',      [ArticleController::class, 'add']);
$router->post('/contact',      [ArticleController::class, 'delete']);
$router->post('/contact',      [ArticleController::class, 'edit']);