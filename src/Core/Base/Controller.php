<?php

namespace Core\Base;

class Controller
{
    protected function render(string $view, string $layout , array $data = []): void
    {
        extract($data);

        $viewFile = __DIR__ . '/../../Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            die("View not found: {$viewFile}");
        }
        ob_start();
        require $viewFile;
        $content = ob_get_clean();
        $layoutFile = __DIR__ . '/../../Views/layouts/' . $layout . '.php';

        if (file_exists($layoutFile)) {
            require $layoutFile;
        } else {
            echo $content;
        }
    }
}

