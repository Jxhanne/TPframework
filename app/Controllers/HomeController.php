<?php

namespace Controllers;

use App\Request;
use App\Response;
use App\View;
use App\Container;

class HomeController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../views');
    }

    public function index(Request $request): Response
    {
        $html = $this->view->renderWithLayout('home/index', [
            'pageTitle' => 'Accueil',
        ]);
        return Response::html($html);
    }
}
