<?php

class IngredientController extends BaseController {
    
    public static function index() {
        $params = $_GET;
        $options = array();
        
        if (isset($params['search'])) {
            $options['search'] = $params['search'];
        }
        
        $ingredients = Ingredient::all($options);
        View::make('ingredient/ingredient_index.html', array ('ingredients' => $ingredients));
    }
    
    public static function show($id) {
        $ingredient = Ingredient::find($id);
        View::make('ingredient/present_ingredient.html', array('ingredient' => $ingredient));
    }
    
    public static function create() {
        View::make('ingredient/new_ingredient.html');
    }
    
    public static function store() {
        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'saldo' => $params['saldo'],
            'description' => $params['description']
        );

        $ingredient = new Ingredient($attributes);
        $errors = $ingredient->errors();

        if (count($errors) == 0) {
            $ingredient->save();

            Redirect::to('/ingredients/' . $ingredient->id, array('message' => 'Ainesosa on lisätty arkistoon!'));
        } else {
            View::make('ingredient/new_ingredient.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    public static function edit($id) {
        $ingredient = Ingredient::find($id);
        View::make('ingredient/edit_ingredient.html', array('attributes' => $ingredient));
    }
    
    public static function update($id) {
        $params = $_POST;
        
        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'saldo' => $params['saldo'],
            'description' => $params['description']
        );
        
        $ingredient = new Ingredient($attributes);
        $errors = $ingredient->errors();
        
        if(count($errors) == 0) {
            $ingredient->update();
            Redirect::to('/ingredients/' . $ingredient->id, array('message' => 'Ainesosaa muokattu onnistuneesti'));
        } else {
            
            View::make('ingredient/edit_ingredient.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    public static function destroy($id) {
        $ingredient = new Ingredient(array('id' => $id));
        $ingredient->destroy();
        
        Redirect::to('/ingredients', array('message' => 'Ainesosa poistettu'));
    }
}

