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
  
  $routes->get('/kirjautuminen', function() {
    HelloWorldController::login();
  }); 
