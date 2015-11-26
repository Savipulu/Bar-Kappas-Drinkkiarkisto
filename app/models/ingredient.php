<?php

class Ingredient extends BaseModel {
    
    public $id,
            $name,
            $saldo,
            $description;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        //this->validators
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Ingredient');
        $query->execute();
        
        $rows = $query->fetchAll();
        $ingredients = array();
        
        foreach ($rows as $row) {
            $ingredients[] = new Ingredient(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'saldo' => $row['saldo'],
                'description' => $row['description']
            ));
        }
        
        return $ingredients;
    }
}

