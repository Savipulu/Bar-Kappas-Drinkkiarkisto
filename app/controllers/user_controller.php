<?php

class UserController extends BaseController {
    
    public static function login() {
        
    }
    
    public static function handle_login() {
        $params = $_POST;
        
        $user = User::authenticate($params['username'], $params['password']);
        
        if (!$user){
            View::make('drink/index.html');
        }
    }
}

