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

        $drionk = new Drink(array(
            'name' => $row['name'],
            'alcohol_content' => $row['alcohol_content'],
            'volume' => $row['volume'],
            'glass' => $row['glass'],
            'drink_type' => $row['drink_type'],
            'description' => $row['description'],
            'preparation_time' => $row['preparation_time']
        ));
        
        $drink->save();
        
        Redirect::to('/drink/' . $drink->id, array('message' => 'Peli on lisätty kirjastoosi!'));
    }
}
