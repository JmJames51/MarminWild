<?php 

require_once __DIR__ . '/../models/RecipeModel.php';


class RecipeController
{
    private $model;

    public function __construct()
    {
        $this->model = new RecipeModel();
    }

    public function browse(): void
    {
        $recipes = $this->model->getAll();

        require __DIR__ . '/../views/index.php';
 
   }

   public function show(int $id): void {

        if(NULL === $id ){
            header("Location: /");
            exit("Wrong input parameter");
        }

        $recipe= $this->model->getById($id);

        if (!isset($recipe['title']) || !isset($recipe['description'])) {
            header("Location: /");
            exit("Recipe not found");
        }

        // Generate the web page
        require_once __DIR__ . '/../views/show.php';
    }
    public function add() : void {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $recipe = [
                'title' => $_POST['title'],
                'description' => $_POST['description']
            ];
            if (empty($errors)) {
                $this->model->save($recipe);
                header('Location: /');
            }
        }
        require __DIR__ . '/../views/form.php';
    }
}