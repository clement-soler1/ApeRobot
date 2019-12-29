<?php

	if (!empty($_POST)){
		$sql = "SELECT dat.donnee, rel.date, rel.time
				FROM Ap_Data dat
				JOIN Ap_Releve rel ON rel.`idReleve` = dat.`idReleve`
				JOIN Ap_Capteur cpt ON cpt.`typeCapteur` = rel.`typeCapteur`
				JOIN Ap_Vehicule vhc ON vhc.`idVehicule` = rel.`idVehicule`
				JOIN Ap_PossesVehicule pss ON vhc.`idVehicule` = pss.`idVehicule`
				JOIN Ap_User usr ON usr.`idUser` = pss.`idUser`
				WHERE usr.`idUser` = :tag_usr
				AND cpt.`typeCapteur` = :tag_data";
		$values = array(
            "tag_usr" => $_SESSION['userID'], 
            "tag_data" => $_POST['data'],);
		if (empty($_POST['start']) AND !empty($_POST['end'])){
			$sql .= " AND rel.`date` < :tag_fin";
			$values["tag_fin"] = $_POST['end'];            
		}
		else if (!empty($_POST['start']) AND empty($_POST['end'])){
			$sql .= " AND rel.`date` BETWEEN :tag_deb AND now()";
			$values["tag_deb"] = $_POST['start'];
		}
		else if (!empty($_POST['start']) AND !empty($_POST['end'])){
			$sql .= " AND rel.`date` BETWEEN :tag_deb AND :tag_fin";
			$values["tag_deb"] = $_POST['start'];
			$values["tag_fin"] = $_POST['end'];
		}

		$req_prep = Model::$pdo->prepare($sql);
		$req_prep->execute($values);       
        echo <<<TEXT
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
		var data = google.visualization.arrayToDataTable([

		['Date de l`alerte', 'Données relevées'],
TEXT;

		if($verif = $req_prep->rowCount()){
	    	while($row = $req_prep->fetch(PDO::FETCH_ASSOC)){
	           	echo "['". $row['date'].' '. $row['time'] ."', ".$row['donnee']."],";
	        }
		    echo <<<TEXT
			]);
			var options = {
			title: 'Données récoltées',
			backgroundColor: {fill:'transparent'},
			curveType: 'function',
			legend: { position: 'bottom', alignment: 'center'},
			fontSize: '20',
			};
			var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
	        chart.draw(data, options);
	        };
	        </script>
TEXT;
		}
		echo $verif;
		if($verif > 0){
			echo '<div class="container-fluid">';
			echo '<div id="curve_chart" style="margin: auto;width: 80%; height: 500px;"></div>';
		}
	}
?>