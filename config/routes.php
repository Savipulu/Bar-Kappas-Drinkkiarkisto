<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/suunnitelmat/etusivu', function() {
    HelloWorldController::testi();
});

$routes->get('/suunnitelmat/drinkit', function() {
    HelloWorldController::drinkit();
});

$routes->get('/suunnitelmat/lisaadrinkki', function() {
    HelloWorldController::lisaadrinkki();
});

$routes->get('/suunnitelmat/drinkkiesittely', function() {
    HelloWorldController::drinkkiesittely();
});

$routes->get('/suunnitelmat/login', function() {
    HelloWorldController::login();
});

$routes->get('/suunnitelmat/muokkaus', function() {
    
});

$routes->get('/kirjautuminen', function() {
    HelloWorldController::login();
});

$routes->get('/drinks', function() {
    DrinkController::index();
});

$routes->get('/drinks/newdrink', 'check_logged_in', function() {
    DrinkController::create();
});

$routes->post('/drinks/:id/destroy', function($id) {
    DrinkController::destroy($id);
});

$routes->get('/drinks/:id/edit', 'check_logged_in', function($id) {
    DrinkController::edit($id);
});

$routes->post('/drinks/:id/edit', function($id) {
    DrinkController::update($id);
});

$routes->get('/drinks/:id', function($id) {
    if (is_numeric($id)) {
        DrinkController::show($id);
    } else {
        Redirect::to('/');
    }
});

$routes->post('/drink', function() {
    DrinkController::store();
});

$routes->get('/ingredients/newingredient', function() {
    IngredientController::create();
});

$routes->post('/ingredients/:id/destroy', function($id) {
    IngredientController::destroy($id);
});

$routes->get('/ingredients/:id/edit', 'check_logged_in', function($id) {
    IngredientController::edit($id);
});

$routes->post('/ingredients/:id/edit', function($id) {
    IngredientController::update($id);
});

$routes->get('/ingredients/:id', function($id) {
    if (is_numeric($id)) {
        IngredientController::show($id);
    } else {
        Redirect::to('/ingredients');
    }
});

$routes->get('/ingredients', function() {
    IngredientController::index();
});

$routes->post('/ingredient', function() {
    IngredientController::store();
});

$routes->post('/login', function() {
    DrinkerController::handle_login(); 
});

$routes->post('/logout', function() {
    DrinkerController::logout();
});

$routes->post('/registerdrinker', function() {
    DrinkerController::store();
});

$routes->get('/register', function() {
    DrinkerController::create();
});

$routes->get('/search', function() {
    $params = $_GET;
    $search_select = $params['search-select'];
    
    if ($search_select == 'ingredients') {
        IngredientController::index();
    } else {
        DrinkController::index();
    }
});
