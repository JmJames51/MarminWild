<?php

require_once __DIR__.'/controllers/RecipeController.php';

$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$recipeController = new RecipeController();

if ('/' === $urlPath) {
    $recipeController->browse();
} elseif ('/show' === $urlPath && isset($_GET['id'])) {
    $recipeController->show($_GET['id']);
    
} elseif ('/add' === $urlPath) {
    $recipeController->add();
} else {
    header('HTTP/1.1 404 Not Found');
}