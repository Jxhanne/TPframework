<?php

namespace Controllers;

use App\Container;
use App\Request;
use App\Response;
use App\View;
use Repositories\ContactsRepository;

class ContactsController
{
    private View $view;
    private ContactsRepository $contacts;

    public function __construct(Container $container)
    {
        $this->view     = $container->get('view');
        $this->contacts = $container->get('contacts');
    }

    public function all(): array
    {
        if (!file_exists($this->path)) {
            return [];
        }

        $data = json_decode(file_get_contents($this->path), true);

        return $data['contacts'] ?? [];
    }

    public function find(int $id): ?array
    {
        foreach ($this->all() as $contact) {
            if ($contact['id'] === $id) {
                return $contact;
            }
        }

        return null;
    }

    public function index(Request $request): Response
    {
        $html = $this->view->renderWithLayout('contacts/index', [
            'pageTitle' => 'Mes contacts',
            'contacts'  => $this->contacts->all(),
        ]);
        return Response::html($html);
    }

    public function show(Request $request, array $params): Response
    {
        $contact = $this->contacts->find((int) $params['id']);

        if ($contact === null) {
            $html = $this->view->renderWithLayout('errors/404', [
                'pageTitle' => 'Contact introuvable',
            ]);
            return Response::html($html, 404);
        }

        $html = $this->view->renderWithLayout('contacts/contact', [
            'pageTitle' => $contact['prenom'] . ' ' . $contact['nom'],
            'contact'   => $contact,
        ]);
        return Response::html($html);
    }

    public function add(Request $request): Response
    {
        $html = $this->view->renderWithLayout('contacts/add');
        return Response::html($html);
    }

    public function delete(Request $request): Response
    {
        $html = $this->view->renderWithLayout('contacts');
        return Response::html($html);
    }

    public function edit(Request $request, array $params): Response
    {
        $contact = $this->contacts->find((int) $params['id']);

        if ($contact === null) {
            $html = $this->view->renderWithLayout('errors/404', [
                'pageTitle' => 'Contact introuvable',
            ]);
            return Response::html($html, 404);
        }

        $html = $this->view->renderWithLayout('contacts/edit', [
            'pageTitle' => 'Modifier ' . $contact['prenom'] . ' ' . $contact['nom'],
            'contact'   => $contact,
        ]);
        return Response::html($html);
    }

    public function update(Request $request): Response
    {
        $id      = (int) $request->input('id');
        $contact = $this->contacts->find($id);

        if ($contact === null) {
            $html = $this->view->renderWithLayout('errors/404', [
                'pageTitle' => 'Contact introuvable',
            ]);
            return Response::html($html, 404);
        }

        $age = trim((string) $request->input('age'));

        $fields = [
            'prenom'                 => trim((string) $request->input('prenom')),
            'nom'                    => trim((string) $request->input('nom')),
            'age'                    => $age === '' ? null : (int) $age,
            'carte_bleue'            => trim((string) $request->input('carte_bleue')),
            'carte_pokemon_preferee' => trim((string) $request->input('carte_pokemon_preferee')),
        ];

        $erreur = null;
        if ($fields['prenom'] === '' || $fields['nom'] === '') {
            $erreur = 'Le prénom et le nom sont obligatoires.';
        } elseif ($age !== '' && !ctype_digit($age)) {
            $erreur = "L'âge doit être un nombre entier positif.";
        }

        if ($erreur !== null) {
            $html = $this->view->renderWithLayout('contacts/edit', [
                'pageTitle' => 'Modifier ' . $contact['prenom'] . ' ' . $contact['nom'],
                'contact'   => array_merge($contact, $fields),
                'erreur'    => $erreur,
            ]);
            return Response::html($html, 422);
        }

        $this->contacts->update($id, $fields);

        return Response::redirect('/contacts/' . $id);
    }
}