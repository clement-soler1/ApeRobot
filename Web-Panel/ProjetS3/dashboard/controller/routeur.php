<?php
require_once File::build_path(array("controller","ControllerUser.php"));

if (isset($_REQUEST['action'])) {
// On recupère l'action passée dans l'URL
    $action = $_REQUEST['action'];
} else {
    //$action = "readAll";
    $action = "login";
}

if (isset($_REQUEST['controller'])) {
// On recupère l'action passée dans l'URL
    $controller = $_REQUEST['controller'];
} else {
    $controller = 'user';
}

$controller_class = "Controller".ucfirst($controller);

$tabAction = get_class_methods($controller_class);

/*if (!in_array($action, $tabAction)) {
    $action = "showError";
}*/

if(class_exists($controller_class)) {
    $controller_class::$action();
} else {
    //ControllerVoiture::showError();
}
 
?>