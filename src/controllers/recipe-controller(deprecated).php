<?php
require_once __DIR__ . '/../models/RecipeModel.php';
function browseRecipes(): void
{

    $model = new RecipeModel();
    $recipes = $model->getAll();
    require __DIR__ . '/../views/index.php';
}

function showRecipe(int $id): void {

    if(NULL === $id ){
        header("Location: /");
        exit("Wrong input parameter");
    }

$model = new RecipeModel();
$recipe= $model->getById($id);

if (!isset($recipe['title']) || !isset($recipe['description'])) {
    header("Location: /");
    exit("Recipe not found");
}

// Generate the web page
require_once __DIR__ . '/../views/show.php';
}

function addRecipe() : void {
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $recipe = [
            'title' => $_POST['title'],
            'description' => $_POST['description']
        ];
        if (empty($errors)) {
            $model = new RecipeModel();
            $model->save($recipe);
            header('Location: /');
        }
    }
    require __DIR__ . '/../views/form.php';
}