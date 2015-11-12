<?php

class DrinkController extends BaseController{
    public static function index(){
        $drinks = Drink::all();
        View::make('drink/index.html', array('drinks' => $drinks));
    }
    
    public static function show($id){
        $one_drink = Drink::find($id);
        View::make('drink/presentdrink.html', array('drink' => $one_drink));
    }
}

