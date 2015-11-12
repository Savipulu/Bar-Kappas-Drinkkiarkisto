<?php

class DrinkController extends BaseController{
    public static function index(){
        $drinks = Drink::all();
        View::make('drink/index.html', array('drinks' => $drinks));
    }
}

