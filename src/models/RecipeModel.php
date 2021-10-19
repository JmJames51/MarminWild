<?php

class RecipeModel { 

    private $connection;

    public function __construct()
    {
        $this->connection = new \PDO(DSN, USER, PASS);

    }
    public function getAll(): array
    {
        

        $statement = $this->connection->query('SELECT id, title FROM recipe');
        $recipes = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $recipes;
    }

// Fetching a recipe from database -  assuming the database is okay
    public function getById(int $id): array
    {
    
        

        $query = 'SELECT title, description FROM recipe WHERE id=:id';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $recipe = $statement->fetch(PDO::FETCH_ASSOC);

        return $recipe;
    }

    public function save(array $recipe): void
    {
        

        // lance une requête SQL pour engistrer la recette
        $query = 'INSERT INTO recipe(title, description) VALUES (:title, :description)';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':title', $recipe['title'], PDO::PARAM_STR);
        $statement->bindValue(':description', $recipe['description'], PDO::PARAM_STR);
        $statement->execute();


    }
}

?>