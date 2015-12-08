<?php

class Ingredient extends BaseModel {
    
    public $id,
            $name,
            $saldo,
            $description;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_saldo');
    }
    
    public static function all($options) {
        $query_string = 'SELECT * FROM Ingredient';
        if (isset($options['search'])) {
            $query_string .= ' WHERE name LIKE :like';
            $options['like'] = '%' . $options['search'] . '%';
            unset($options['search']);
        }
        
        $query = DB::connection()->prepare($query_string);
        $query->execute($options);
        
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
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Ingredient WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $ingredient = new Ingredient(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'saldo' => $row['saldo'],
                'description' => $row['description']
            ));
            return $ingredient;
        }
        return null;
    }
    
    public function save() {
        $query = DB::connection()->prepare(
                'INSERT INTO Ingredient ('
                . 'name,'
                . ' saldo,'
                . ' description'
                . ') VALUES ('
                . ' :name,'
                . ' :saldo,'
                . ' :description'
                . ') RETURNING id');

        $query->execute(array('name' => $this->name,
            'saldo' => $this->saldo,
            'description' => $this->description));

        $row = $query->fetch();

        $this->id = $row['id'];
    }
    
    public function update() {
        $query = DB::connection()->prepare(
                'UPDATE Ingredient '
                . ' SET '
                . ' name = :name,'
                . ' saldo = :saldo,'
                . ' description = :description'
                . ' WHERE id = :id');


        $query->execute(array(
            'id' => $this->id,
            'name' => $this->name,
            'saldo' => $this->saldo,
            'description' => $this->description));

        $row = $query->fetch();
    }
    
    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Ingredient WHERE id = :id');
        $query->execute(array('id' => $this->id));
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
    
    public function validate_saldo() {
        $errors = array();
        
        if ($this->validatable_attribute_is_negative($this->saldo)) {
            $errors[] = 'Saldo ei voi olla negatiivinen';
        } 
        
        return $errors;
    }
}

