<?php

class DrinkerController extends BaseController {
    
    public static function handle_login() {
        $params = $_POST;
        
        $drinker = Drinker::authenticate($params['name'], $params['password']);
        
        if (!$drinker){
            View::make('/', array('error' => 'Väärä käyttäjätunnus tai salasana', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $drinker->id;
            
            Redirect::to('/', array('message' => 'Tervetuloa drinkkiarkistoon, ' . $drinker->name));
        }
    }
}

