<?php

class Drink extends BaseModel {

    public $id,
            $name,
            $alcohol_content,
            $volume,
            $glass,
            $drink_type,
            $description,
            $preparation_time;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_alcoholcontent', 'validate_volume', 'validate_preparationtime');
    }

    public static function all($options) {
        $query_string = 'SELECT * FROM Drink';
        if (isset($options['search'])) {
            $query_string .= ' WHERE name LIKE :like';
            $options['like'] = '%' . $options['search'] . '%';
            unset($options['search']);
        }
        
        $query = DB::connection()->prepare($query_string);
        $query->execute($options);

        $rows = $query->fetchAll();
        $drinks = array();

        foreach ($rows as $row) {
            $drinks[] = new Drink(array(
                'id' => $row['id'],
                'name' => $row['name'],
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

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Drink WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $drink = new Drink(array(
                'id' => $row['id'],
                'name' => $row['name'],
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

    public function save() {
        $query = DB::connection()->prepare(
                'INSERT INTO Drink ('
                . 'name,'
                . ' alcohol_content,'
                . ' volume,'
                . ' glass,'
                . ' drink_type,'
                . ' description,'
                . ' preparation_time'
                . ') VALUES ('
                . ' :name,'
                . ' :alcohol_content,'
                . ' :volume,'
                . ' :glass,'
                . ' :drink_type,'
                . ' :description,'
                . ' :preparation_time'
                . ') RETURNING id');

        $query->execute(array('name' => $this->name,
            'alcohol_content' => $this->alcohol_content,
            'volume' => $this->volume,
            'glass' => $this->glass,
            'drink_type' => $this->drink_type,
            'description' => $this->description,
            'preparation_time' => $this->preparation_time));

        $row = $query->fetch();
        
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare(
                'UPDATE Drink '
                . ' SET '
                . ' name = :name,'
                . ' alcohol_content = :alcohol_content,'
                . ' volume = :volume,'
                . ' glass = :glass,'
                . ' drink_type = :drink_type,'
                . ' description = :description,'
                . ' preparation_time = :preparation_time'
                . ' WHERE id = :id');


        $query->execute(array(
            'id' => $this->id,
            'name' => $this->name,
            'alcohol_content' => $this->alcohol_content,
            'volume' => $this->volume,
            'glass' => $this->glass,
            'drink_type' => $this->drink_type,
            'description' => $this->description,
            'preparation_time' => $this->preparation_time));

        $row = $query->fetch();
    }

    public function destroy() {
        $reference_query = DB::connection()->prepare('DELETE FROM Recipes WHERE drink = :id');
        $query = DB::connection()->prepare('DELETE FROM Drink WHERE id = :id');
        
        $reference_query->execute(array('id' => $this->id));
        $query->execute(array('id' => $this->id));
    }
    
    public function check_availability() {
        $query = DB::connection()->prepare('SELECT r.amount, i.saldo FROM Recipes r '
                . 'JOIN Ingredient i ON r.ingredient = i.id '
                . 'WHERE r.drink = :id');
        $query->execute(array('id' => $this->id));
        
        $rows = $query->fetchAll();
        
        foreach($rows as $row) {
            if ($row['amount'] > $row['saldo']) {
                return false;
            }
        }
        return true;
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

    public function validate_alcoholcontent() {
        $errors = array();
        
        if ($this->validatable_attribute_is_null($this->alcohol_content)) {
            $errors[] = 'Alkoholipitoisuus ei saa olla tyhjä';
        }
        
        if ($this->validatable_attribute_is_negative($this->alcohol_content)) {
            $errors[] = 'Alkoholipitoisuus ei voi olla negatiivinen';
        }
        
        if ($this->alcohol_content > 100) {
            $errors[] = 'Alkoholipitoisuus ei voi olla yli sata prosenttia';
        }
        
        if (!is_numeric($this->alcohol_content)) {
            $errors[] = 'Alkoholipitoisuuden tulee olla luku';
        }
        

        return $errors;
    }

    public function validate_volume() {
        $errors = array();
        
        if ($this->validatable_attribute_is_negative($this->volume)) {
            $errors[] = 'Tilavuus ei voi olla negatiivinen';
        }
        
        if (!is_numeric($this->volume)) {
            $errors[] = 'Tilavuuden tulee olla luku';
        }

        return $errors;
    }

    public function validate_preparationtime() {
        $errors = array();
        
        if ($this->validatable_attribute_is_negative($this->preparation_time)) {
            $errors[] = 'Valmistusaika ei voi olla negatiivinen';
        }
        
        if (!is_numeric($this->preparation_time)) {
            $errors[] = 'Valmistusajan tulee olla luku';
        }

        return $errors;
    }

}
