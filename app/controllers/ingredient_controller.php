<?php

class IngredientController extends BaseController {
    
    public static function index() {
        $ingredients = Ingredient::all();
        View::make('ingredient/index.html', array ('ingredients' => $ingredients));
    }
    
    public static function show($id) {
        $ingredient = Ingredient::find($id);
        View::make('ingredient/present_ingredient.html', array('ingredient' => $ingredient));
    }
}

