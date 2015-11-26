<?php

class IngredientController extends BaseController {
    
    public static function index() {
        $ingredients = Ingredient::all();
        View::make('ingredient/index.html', array ('ingredients' => $ingredients));
    }
}

