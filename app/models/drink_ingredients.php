<?php

class DrinkIngredients extends BaseModel {
    
    public $ingredient_id,
            $name,
            $amount;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT i.id, i.name, r.amount FROM Drink d '
                . 'JOIN Recipes r ON d.id = r.drink '
                . 'JOIN Ingredient i ON r.ingredient = i.id '
                . 'WHERE d.id = :id');
        $query->execute(array('id' => $id));
        
        $rows = $query->fetchAll();
        $recipe = array();

        foreach ($rows as $row) {
            $recipe[] = new DrinkIngredients(array(
                'ingredient_id' => $row['id'],
                'name' => $row['name'],
                'amount' => $row['amount']
            ));
        }
        return $recipe;
    }
}

