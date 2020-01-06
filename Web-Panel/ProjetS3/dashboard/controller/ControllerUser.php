<?php

    require_once File::build_path(array("model","ModelUser.php"));
    require_once File::build_path(array("lib","Security.php"));
    require_once File::build_path(array("controller","ControllerDashboard.php"));
    require_once File::build_path(array("model","ModelVehicule.php"));

class ControllerUser {
    
    public static function login() {
        $controller='user';
        $view='login';
        $pagetitle='ApeRobot - Connexion';
        $type = null;
        $msg = null;
        require File::build_path(array("view","login.php"));  //"redirige" vers la vue
    }
    
    public static function createUser() {
        $usr = new ModelUser($_POST["email"],$_POST["nom"],$_POST["prenom"],$_POST["dob"],Security::chiffrer($_POST["pwd"]),$_POST["tel"]);
        
        $usrTry = ModelUser::getUserByEmail($_POST["email"]);
        
        if (is_null($usrTry)) {
            $usr ->save();
            $_SESSION['userEmail'] = $usr->getEmail();
            $_SESSION['userID'] = $usr->getUserID();
            $car = ModelVehicule::getOneCarByPossesors($usr->getUserID());
            if (!is_null($car)) {
                $_SESSION['idv'] = $car->getIdVehicule();
            }
            ControllerDashboard::home();
            
        } else {
            ControllerUser::showLoginError("inscription","Un utilisateur possédant cet Email existe déja !");
        }
    }
    
    public static function connectUser() {
        $email = $_REQUEST["email"];
        $pwd = $_REQUEST["pwd"];
        
        $isRealUser = ModelUser::verifyExist($email, Security::chiffrer($pwd));
        
        if ($isRealUser) {
            $user = ModelUser::getUserByEmail($email);
            $_SESSION['userEmail'] = $user->getEmail();
            $_SESSION['userID'] = $user->getUserID();
            $car = ModelVehicule::getOneCarByPossesors($user->getUserID());
            if (!is_null($car)) {
                $_SESSION['idv'] = $car->getIdVehicule();
            }
            ControllerDashboard::home();
        } else {
            ControllerUser::showLoginError("connexion","Email ou Mot de passe incorrect !");
        }
        
    }
    
    public static function showLoginError($type = null,$msg = null) {
        $controller='user';
        $view='login';
        $pagetitle='ApeRobot - Connexion';
        require File::build_path(array("view","login.php"));
    }

    public static function disconnect() {

        session_unset();
        session_destroy();
        setcookie(session_name(),'',time()-1);

        ControllerDashboard::backToHome();
    }
    
}
?>