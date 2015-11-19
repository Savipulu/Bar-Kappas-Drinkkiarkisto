<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      $rommikola = new Drink(array(
          'name' => 'ro',
          'alcohol_content' => 105,
          'volume' => -2,
          'preparation_time' => -3));
      $errors = $rommikola->errors();
      
      Kint::dump($errors);
    }
    
    public static function testi() {
        View::make('suunnitelmat/EtusivuSuunnitelma.html');
    }
    
    public static function drinkit() {
        View::make('suunnitelmat/DrinkitSuunnitelma.html');
    }
    
    public static function lisaadrinkki() {
        View::make('suunnitelmat/LisaaDrinkkiSuunnitelma.html');
    }
    
    public static function drinkkiesittely() {
        View::make('suunnitelmat/DrinkkiEsittely.html');
    }


    public static function login() {
        View::make('suunnitelmat/LoginSuunnitelma.html');
    }
    
    public static function muokkaus() {
        View::make('suunnitelmat/MuokkausSuunnitelma.html');
    }
  }
