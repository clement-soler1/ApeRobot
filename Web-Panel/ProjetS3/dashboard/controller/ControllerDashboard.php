<?php
class ControllerDashboard {

    public static function home($usr) {
        $user = $usr;
        $section_title = 'Acceuil';
        $view = 'home.php';
        require File::build_path(array('view','mainView.php'));
    }
}
?>