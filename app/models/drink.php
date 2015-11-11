<?php

class Drink extends BaseModel {

    public $id,
            $name,
            $in_stock,
            $alcohol_content,
            $volume,
            $glass,
            $drink_type,
            $description,
            $preparation_time;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Drink');
        $query->execute();
        
        $rows = $query->fetchAll();
        $drinks = array();
        
        foreach ($rows as $row) {
            $drinks[] = new Drink(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'in_stock' => $row['in_stock'],
                'alcohol_content' => $row['alcohol_content'],
                'volume' => $row['volume'],
                'glass' => $row['glass'],
                'drink_type' => $row['drink_type'],
                'description' => $row['description'],
                'preparation_time' => $row['preparation_time']
            ));
        }
        
        return $drinks;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Drink WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $drink = new Drink(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'in_stock' => $row['in_stock'],
                'alcohol_content' => $row['alcohol_content'],
                'volume' => $row['volume'],
                'glass' => $row['glass'],
                'drink_type' => $row['drink_type'],
                'description' => $row['description'],
                'preparation_time' => $row['preparation_time']
            ));
            return $drink;
        }
        return null;
    }
}
