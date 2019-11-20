<?php

class ControllerUser {
    
    public static function login() {
        $controller='user';
        $view='login';
        $pagetitle='ApeRobot - Connexion';
        require File::build_path(array("view","login.php"));  //"redirige" vers la vue
    }
    
}
?>