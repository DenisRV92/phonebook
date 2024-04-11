<?php
session_start();

use App\Controllers\ContactController;
use App\Factories\DependencyFactory;
use Route\Router;

require_once __DIR__ . '/vendor/autoload.php';


$router = new Router(DependencyFactory::createContactRepository(), DependencyFactory::createContact());

$router->get('/option_two/', [ContactController::class, 'index']);
$router->post('/option_two/contacts', [ContactController::class, 'store']);
$router->delete("/option_two/contacts/" . ($_GET['id'] ?? "{id}"), [ContactController::class, 'destroy']);
$router->dispatch();
?>