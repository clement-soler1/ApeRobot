<?php
 $con = mysqli_connect('webinfo.iutmontp.univ-montp2.fr','sornayj','<wxcvbn,;:!123','sornayj');
 $con->set_charset("utf8");
?>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      	var data = google.visualization.arrayToDataTable([

       		['Type d\'alerte', 'Nombre d\'alertes'],
       		<?php 
       			$data = 0;
       			if(isset($_REQUEST['time'])){
       				$change = $_REQUEST['time'];
       			}
       			else{
       				$change = '2 MONTH';
       			}
      			$query = "SELECT COUNT(`idAlert`) AS nombredereleve, titre, idAlert FROM Ap_Alert alr WHERE titre <> CONVERT(titre USING ASCII) AND `idVehicule` = 1 AND `date` BETWEEN date_sub(now(),INTERVAL ".$change.") AND now() GROUP BY titre";

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


<?php
	$tabAlerts = ModelAlerte::selectAlertAccueil($_SESSION['idv'], $change);

?>
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
  if ($data == 0){
  	echo '<div style="margin: auto; text-align:center">';
  	echo '<img style="height : 400px" src="./view/icons/checkmark.png" alt="Aucun incident">';
  	echo '<p> Aucune alerte détectée. Restez prudent !</p></div>';
  }
  else{

 	echo '<div class="container-fluid">';
    echo '<div id="piechart" style="margin: auto;width: 80%; height: 500px;"></div>';
    require_once File::build_path(array("view","dashboard","alerts.php"));
  }
?>
</div>