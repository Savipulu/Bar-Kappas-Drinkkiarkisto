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
    
    public static function create() {
        View::make('register.html');
    }
    
    public static function store() {
        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'password' => $params['password']
        );

        $drinker = new Drinker($attributes);
        $errors = $drinker->errors();

        if (count($errors) == 0) {
            $drinker->save();

            self::handle_login();
        } else {
            View::make('/register', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
}

