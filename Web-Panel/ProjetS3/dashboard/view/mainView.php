<?php
    require_once File::build_path(array("model","ModelVehicule.php"));
?>

<head>
  <title>Apérobot - Dashboard</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./view/css/entypo.css">
  <link rel="stylesheet" type="text/css" href="./view/css/mainView.css">
  <script type="text/javascript" src="./view/js/mainView.js"></script>
  <script type="text/javascript" src="./view/js/action.js"></script>
</head>

<body>
  <span class="bckg"></span>
  <header>
    <h1>Dashboard</h1>
    <nav>
      <ul>
        <li>
          <a href="index.php?controller=dashboard&action=home" data-title="Projects">Acceuil</a>
        </li>
        <li>
          <a href="index.php?controller=dashboard&action=alert" class="entypo-home">Alertes</a>
        </li>
        <li>
          <a href="#" data-title="Diary">Données</a>
        </li>
        <li>
          <a href="#" data-title="Timeline">Véhicules</a>
        </li>
        <li>
          <a href="#" data-title="Settings">Paramètres</a>
        </li>
      </ul>
    </nav>
  </header>
  <?php
  echo '<main>';
    echo '<div class="title">';
      echo '<h2>'. $section_title .'</h2>';
      echo '<div class="flexRow">';
      echo '<select onchange=\'setCurVeh(this.value,'. $SESSION['curAct'] .')\' class="selVeh">';
            $tav = ModelVehicule::getVehicleByPossesors($_SESSION["userID"]);
            foreach ($tav as $v) {
                if ($v->getIdVehicule() == $_SESSION['idv']) {
                    echo '<option selected value="'. $v->getIdVehicule() .'">'. $v->getSurnom() .'</option>';
                } else {
                    echo '<option value="'. $v->getIdVehicule() .'">'. $v->getSurnom() .'</option>';
                }
            }
      
        
      echo '</select>';
      
      $usr = ModelUser::getUserByEmail($_SESSION['userEmail']);
      echo '<a href="" class="btnNav"><i class="material-icons">person</i>Hello '. $usr->getPrenom() .'</a>';
    echo '</div>';
    echo '</div>';
    
    require File::build_path(array('view','dashboard',$view));
    
  echo '</main>';
  ?>
</body>