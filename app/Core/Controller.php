<?php

namespace App\Core;

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        require __DIR__ . '/../Views/' . $view . '.php';
    }

    protected function redirect($path)
    {
        $config = require __DIR__ . '/../../config/app.php';
        header('Location: ' . $config['base_url'] . $path);
        exit();
    }
}