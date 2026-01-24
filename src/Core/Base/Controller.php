<?php

namespace Core\Base;

use eftec\bladeone\BladeOne;

class Controller
{

    protected function render(string $view, array $data = []): void
    {
        // 1. Define paths (relative to this file in Core/Base/)
        $views = __DIR__ . '/../../App/Views';
        $cache = __DIR__ . '/../../storage/cache';

        try {

            $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);


            echo $blade->run($view, $data);

        } catch (\Exception $e) {
            // Handle template errors gracefully
            die("Template Error: " . $e->getMessage());
        }
    }
}