<?php
require_once File::build_path(array('model','ModelVehicule.php'));
require_once File::build_path(array('controller','ControllerDashboard.php'));

class ControllerVehicule
{
    public static function createVehicule() {
        $section_title = 'Véhicule';
        $view = "crtVeh.php";
        $SESSION['curAct'] = "vehicule";

        require File::build_path(array('view','mainView.php'));
    }

    public static function vehiculeCreated() {

        $veh = new ModelVehicule(ModelVehicule::generateID(),$_POST["marque"],$_POST["modele"],$_POST["color"],$_POST['immat'],$_POST['surnom'],$_POST['idc']);

        $veh->save();

        $_SESSION['idv'] = $veh->getIdVehicule();
        ControllerDashboard::vehicule();
    }

    public static function update() {
        $section_title = 'Véhicule';
        $view = "uptVeh.php";
        $SESSION['curAct'] = "vehicule";

        require File::build_path(array('view','mainView.php'));
    }

    public static function vehiculeUpdate() {

        $veh = ModelVehicule::getVehicleById($_POST['idv']);

        $veh->update($_POST["marque"],$_POST["modele"],$_POST["color"],$_POST['immat'],$_POST['surnom']);
        ControllerDashboard::vehicule();

    }

    public static function share() {
        $section_title = 'Véhicule';
        $view = "shareVeh.php";
        $SESSION['curAct'] = "vehicule";

        require File::build_path(array('view','mainView.php'));
    }

    public static function vehiculeShare() {

        $veh = ModelVehicule::getVehicleById($_POST['idv']);

        $veh->partage($_POST['idu']);
        ControllerDashboard::vehicule();

    }

    public static function delete() {
        ModelVehicule::delete($_REQUEST['idv']);
        unset($_SESSION['idv']);
        ControllerDashboard::vehicule();
    }
}

?>