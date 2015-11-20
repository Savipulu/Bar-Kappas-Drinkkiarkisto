<?php

class Drinker extends BaseModel {
    
    public $id,
            $name,
            $password;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Drinker WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $drinker = new Drink(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $drinker;
        }
        return null;
    } 
    
    public function authenticate($name, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Drinker WHERE name = :name AND password = :password LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $password));
        $row = $query->fetch();
        
        if ($row){
            $drinker = new Drinker(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $drinker;
            
        } else {
            return null;
        }
    }
}

