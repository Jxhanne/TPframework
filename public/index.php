<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Repositories\ContactsRepository;

$app = new App\Application(dirname(__DIR__));

$app->container()->set('contacts', function () {
    return new ContactsRepository(dirname(__DIR__) . '/data/contacts.json');
});

$router = $app->router();
require __DIR__ . '/../config/routes.php';

$app->run();