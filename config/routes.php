<?php

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
HelloWorldController::muokkaus();
});

$routes->get('/kirjautuminen', function() {
HelloWorldController::login();
});
