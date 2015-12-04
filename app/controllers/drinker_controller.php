<?php

class DrinkerController extends BaseController {
    
    public static function handle_login() {
        $params = $_POST;
        
        $drinker = Drinker::authenticate($params['name'], $params['password']);
        
        if (!$drinker){
            $errors = array('Väärä käyttäjätunnus tai salasana');
            View::make('index.html', array('errors' => $errors, 'username' => $params['name']));
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

