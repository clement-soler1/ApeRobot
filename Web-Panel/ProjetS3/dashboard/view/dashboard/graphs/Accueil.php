<?php
 $con = mysqli_connect(Conf::getHostname(), Conf::getLogin(), Conf::getPassword(), Conf::getDatabase());
 $con->set_charset("utf8");
?>
 <link rel="stylesheet" type="text/css" href="./view/css/alerte.css">
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      	var data = google.visualization.arrayToDataTable([

       		['Type d\'alerte', 'Nombre d\'alertes'],
            <?php
            $data = 0;
            if(isset($_REQUEST['time'])){
                //Whitelisting de change pour éviter les injections. Impossible d'effectuer une req prep avec INTERVAL.
                $change = ModelAlerte::white_list($_REQUEST['time'], ["2 DAY","1 DAY","1 WEEK","1 MONTH","1 YEAR"], "Unité invalide");
            }
            else{
                $change = '2 DAY';
            }

            $query = "SELECT COUNT(nombredereleve) as nombredereleve, titre
                         FROM  (SELECT COUNT(*) AS nombredereleve, alr.nomAlerte AS titre
                                FROM Ap_ReleveAlerte ra
                                JOIN Ap_Alerte alr ON ra.typeAlerte = alr.typeAlerte 
                                WHERE ra.`idVehicule` = ". $_SESSION['idv'] ." AND `date` BETWEEN date_sub(now(),INTERVAL ".$change.") AND now()
                                GROUP BY titre, date, time) tab
                        GROUP BY titre";

            $exec = mysqli_query($con, $query);

            if(mysqli_num_rows($exec)){
                while($row = mysqli_fetch_array($exec)){
                    echo "['". $row['titre'] ."', ".$row['nombredereleve']."],";
                }
                $data = 1;
            }
            ?>
	 	]);

      	var options = {
            title: 'Alertes répertoriées',
          	backgroundColor: {fill:'transparent'},
          	pieSliceText: 'value',
          	is3D: true,
          	legend: { position: 'bottom', alignment: 'center'},
			fontSize: '20',

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data,options);
      };
    </script>


<div style="margin: 20px">
    <form action="index.php?controller=dashboard&action=home" method="post" name="form">
        <label for="time">Voir les alertes</label>
        <select name="time" onchange=document.form.submit(); id="change">
            <option value="1 DAY">Du jour</option>
            <option value="2 DAY">Depuis hier</option>
            <option value="1 WEEK">De la semaine</option>
            <option value="1 MONTH">Du mois</option>
            <option value="1 YEAR">De l'année</option>
        </select>
    </form>
</div>

<script type="text/javascript">
	document.getElementById('change').value = '<?= $change ?>';
</script>
  
  <?php

  if ($data == 0 || !(isset($_SESSION['idv']))){
    require_once File::build_path(array("view","dashboard","graphs", "ras.php"));
  }
  else{
      $tabAlerts = ModelAlerte::selectAlertAccueil($_SESSION['idv'], $change);
 	  echo '<div class="container-fluid">';
    echo '<div id="piechart" style="margin: auto;width: 80%; height: 500px;"></div>';
    foreach ($tabAlerts as $alert) {
        $alert->afficher();
    }
  }
?>
</div>
<br>