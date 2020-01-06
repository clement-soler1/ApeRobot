<?php
    require File::build_path(array('model','ModelAlerte.php'));

class ControllerDashboard {
    
    public static function home() {
        $section_title = 'Accueil';
        $view = 'home.php';
        $SESSION['curAct'] = "home";
        require File::build_path(array('view','mainView.php'));
    }
    
    public static function alert() {
        $section_title = 'Alertes';
        $view = 'alerts.php';
        $SESSION['curAct'] = "alert";
        $sql = "SELECT COUNT(*) FROM `Ap_Alert` WHERE idVehicule=".$_SESSION['idv']; 
        $result = Model::$pdo->prepare($sql); 
        $result->execute(); 
        $total_rows = $result->fetchColumn(); 
        require File::build_path(array('view','mainView.php'));
    }
    
    public static function setCurVeh() {
        
        $_SESSION['idv'] = $_REQUEST['idv'];
        $newAction = $_REQUEST['red'];
        ControllerDashboard::$newAction();
        
    }

    public static function vehicule() {
        $section_title = 'Véhicule';
        $view = 'vehicule.php';
        $SESSION['curAct'] = "vehicule";
        require File::build_path(array('view','mainView.php'));
    }

    public static function data() {
        $section_title = 'Données';
        $view = 'data.php';
        $SESSION['curAct'] = "data";
        
        require File::build_path(array('view','mainView.php'));
    }

    public static function account() {
        $section_title = 'Mon compte';
        $view = "account.php";
        $SESSION['curAct'] = "account";
        require File::build_path(array('view','mainView.php'));
    }
}
?>