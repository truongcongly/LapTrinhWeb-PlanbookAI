<?php

declare(strict_types=1);

use App\Core\Router;

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$authRoutes = require __DIR__ . '/../routes/auth.php';
$adminRoutes = require __DIR__ . '/../routes/admin.php';
$webRoutes = require __DIR__ . '/../routes/web.php';

$router->addRoutes($authRoutes);
$router->addRoutes($adminRoutes);
$router->addRoutes($webRoutes);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);