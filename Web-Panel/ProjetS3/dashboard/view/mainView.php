<head>
  <title>Apérobot - Dashboard</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./view/css/entypo.css">
  <link rel="stylesheet" type="text/css" href="./view/css/mainView.css">
  <script type="text/javascript" src="./view/js/mainView.js"></script>
</head>

<body>
  <span class="bckg"></span>
  <header>
    <h1>Dashboard</h1>
    <nav>
      <ul>
        <li>
          <a href="#;" data-title="Projects">Acceuil</a>
        </li>
        <li>
          <a href="#" class="entypo-home">Alertes</a>
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
      echo '<a href="" class="btnNav2"><i class="material-icons">brightness_6</i></a>';
      echo '<a href="" class="btnNav2"><i class="material-icons">build</i></a>';
      echo '<a href="" class="btnNav"><i class="material-icons">person</i>Hello '. $user->getPrenom() .'</a>';
    echo '</div>';
    echo '</div>';
    

    
  echo '</main>';
  ?>
</body>