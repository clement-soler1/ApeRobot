
<h1 style="margin: 20%;">W.I.P. Dashboard - Home</h1>


<?php
    require File::build_path(array('view','dashboard','graphs','koolreport', 'core', 'autoload.php'));
    require File::build_path(array('view','dashboard','graphs','GraphAccueil.php'));
  //  require_once "./graphs/koolreport/core/autoload.php";
  //  require_once "./graphs/GraphAccueil.php";

    $report = new GraphAccueil();
    $report->run()->render();
?>