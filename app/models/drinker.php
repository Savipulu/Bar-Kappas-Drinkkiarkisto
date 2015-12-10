<?php

class Drinker extends BaseModel {
    
    public $id,
            $name,
            $password;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
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
    
    public function save() {
        $query = DB::connection()->prepare(
                'INSERT INTO Drinker ('
                . 'name,'
                . ' password'
                . ') VALUES ('
                . ' :name,'
                . ' :password'
                . ') RETURNING id');

        $query->execute(array('name' => $this->name,
            'password' => $this->password));

        $row = $query->fetch();
        
        $this->id = $row['id'];
    }
    
    public function validate_name() {
        $errors = array();
        if ($this->validatable_attribute_is_null($this->name)) {
            $errors[] = 'Nimi ei saa olla tyhjä';
        }
        if (!$this->validate_string_length($this->name, 3)) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä';
        }

        return $errors;
    }
}

