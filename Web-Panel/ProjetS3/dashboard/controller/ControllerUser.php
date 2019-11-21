<?php

    require_once File::build_path(array("model","ModelUser.php"));
    require_once File::build_path(array("lib","Security.php"));
    require_once File::build_path(array("controller","ControllerDashboard.php"));

class ControllerUser {
    
    public static function login() {
        $controller='user';
        $view='login';
        $pagetitle='ApeRobot - Connexion';
        require File::build_path(array("view","login.php"));  //"redirige" vers la vue
    }
    
    public static function createUser() {
        $usr = new ModelUser($_POST["email"],$_POST["nom"],$_POST["prenom"],$_POST["dob"],Security::chiffrer($_POST["pwd"]),$_POST["tel"]);
        $usr ->save();
        ControllerDashboard::home($usr);
    }
    
    public static function connectUser() {
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        
        $isRealUser = ModelUser::verifyExist($email, Security::chiffrer($pwd));
        
        if ($isRealUser) {
            $user = ModelUser::getUserByEmail($email);
            ControllerDashboard::home($user);
        } else {
            //TO DO : Show error
        }
        
    }
    
}
?>