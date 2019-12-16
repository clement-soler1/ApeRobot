<?php
    require File::build_path(array('model','ModelAlerte.php'));

class ControllerDashboard {
    
    public static function home() {
        $section_title = 'Acceuil';
        $view = 'home.php';
        $SESSION['curAct'] = "home";
        require File::build_path(array('view','mainView.php'));
    }
    
    public static function alert() {
        $section_title = 'Alertes';
        $view = 'alerts.php';
        $SESSION['curAct'] = "alert";
        
        $idv = $_SESSION['idv'];
        $tabAlerts = ModelAlerte::selectAlertByVehicle($idv);
        require File::build_path(array('view','mainView.php'));
    }
    
    public static function setCurVeh() {
        
        $_SESSION['idv'] = $_REQUEST['idv'];
        $newAction = $_REQUEST['red'];
        
        ControllerDashboard::alert();
        
    }
}
?>