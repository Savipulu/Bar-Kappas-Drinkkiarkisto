<?php

class DrinkController extends BaseController {

    public static function index() {
        $drinks = Drink::all();
        View::make('drink/index.html', array('drinks' => $drinks));
    }

    public static function show($id) {
        $one_drink = Drink::find($id);
        View::make('drink/presentdrink.html', array('drink' => $one_drink));
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
            View::make('drink/newdrink.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function create() {
        View::make('drink/newdrink.html');
    }

}
