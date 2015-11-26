<?php

class DrinkerController extends BaseController {
    
    public static function handle_login() {
        $params = $_POST;
        
        $drinker = Drinker::authenticate($params['name'], $params['password']);
        
        if (!$drinker){
            View::make('/', array('error' => 'Väärä käyttäjätunnus tai salasana', 'username' => $params['name']));
        } else {
            $_SESSION['user'] = $drinker->id;
            
            Redirect::to('/', array('message' => 'Tervetuloa drinkkiarkistoon, ' . $drinker->name));
        }
    }
    
    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos'));
    }
}

