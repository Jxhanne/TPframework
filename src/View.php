<?php


namespace App;

class View
{
    private string $viewsPath;

    public function __construct(string $viewsPath)
    {
        $this->viewsPath = rtrim($viewsPath, '/');
    }

    public function render(string $view, array $data = []): string
    {
        $filePath = $this->viewsPath . '/' . $view . '.php';

        if (!file_exists($filePath)) {
            throw new \RuntimeException("Vue introuvable : $view ($filePath)");
        }

        extract($data);

        ob_start();

        require $filePath;

        return ob_get_clean();
    }

    public function renderWithLayout(
        string $view,
        array $data = [],
        string $layout = 'layouts/main'
    ): string {

        $content = $this->render($view, $data);

        return $this->render($layout, array_merge($data, ['content' => $content]));
    }
}
