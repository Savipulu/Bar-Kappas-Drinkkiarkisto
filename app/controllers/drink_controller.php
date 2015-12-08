<?php

class DrinkController extends BaseController {

    public static function index() {
        $params = $_GET;
        $options = array();
        
        if (isset($params['search'])) {
            $options['search'] = $params['search'];
        }
        
        $drinks = Drink::all($options);
        View::make('drink/drink_index.html', array('drinks' => $drinks));
    }

    public static function show($id) {
        $one_drink = Drink::find($id);
        $recipe = DrinkIngredients::find($id);
        View::make('drink/present_drink.html', array('drink' => $one_drink, 'recipe' => $recipe));
    }

    public static function create() {
        $ingredients = Ingredient::all(null);
        View::make('drink/new_drink.html', array('ingredients' => $ingredients));
    }

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'alcohol_content' => $params['alcohol_content'],
            'volume' => $params['volume'],
            'glass' => $params['glass'],
            'drink_type' => $params['drink_type'],
            'description' => $params['description'],
            'preparation_time' => $params['preparation_time']
        );

        $drink = new Drink($attributes);
        $errors = $drink->errors();

        if (count($errors) == 0) {
            $drink->save();

            Redirect::to('/drinks/' . $drink->id, array('message' => 'Drinkki on lisätty arkistoon!'));
        } else {
            View::make('drink/new_drink.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        $drink = Drink::find($id);
        View::make('drink/edit_drink.html', array('attributes' => $drink));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'alcohol_content' => $params['alcohol_content'],
            'volume' => $params['volume'],
            'glass' => $params['glass'],
            'drink_type' => $params['drink_type'],
            'description' => $params['description'],
            'preparation_time' => $params['preparation_time']
        );

        $drink = new Drink($attributes);
        $errors = $drink->errors();

        if (count($errors) == 0) {
            $drink->update();
            Redirect::to('/drinks/' . $drink->id, array('message' => 'Drinkkiä muokattu onnistuneesti'));
        } else {

            View::make('drink/edit_drink.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function destroy($id) {
        $drink = new Drink(array('id' => $id));
        $drink->destroy();

        Redirect::to('/drinks', array('message' => 'Drinkki poistettu'));
    }

}
