<?php

$routes->get('/', function() {
    DrinkController::index();
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

$routes->get('/drinks/newdrink', function() {
    DrinkController::create();
});

$routes->get('/drinks/:id/edit', function($id) {
    DrinkController::edit($id);
});

$routes->post('/drinks/:id/edit', function($id) {
    DrinkController::update($id);
});

$routes->post('/drinks/:id/destroy', function($id) {
    DrinkController::destroy($id);
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
