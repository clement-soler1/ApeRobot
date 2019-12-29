<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="./view/css/donnes.css">

<button onclick="toggle();" id="labelForm">Générer un graphique</button> 
<button id="dl" onclick="window.location='./view/dashboard/graphs/csv/data.php';"><i class="fa fa-download"></i> Télécharger toutes mes données</button>

<form class="graphSelect" action="" method="POST">

<label for="data">Capteur</label>
<select name="data" class="field selecteur">
    <option value="1">Température</option>
    <option value="2">Luminosite et couleur</option>
    <option value="3">Distance</option>
    <option value="4">Intensite sonore</option>
    <option value="5">Accelerometre</option>
    <option value="6">Gyroscope</option>
    <option value="7">Angle d'euler</option>
    <option value="8">Magnetometre</option>
</select>

<div class="box">
<label for="start">Début des relevés</label>
<input type="date" class="field" name="start" min='2019-09-01' max='<?= date("Y-m-d"); ?>'>
<span class="tooltip">Laisser vide pour afficher toutes les données</span>
</div>

<div class="box">
<label for="end">Fin des relevés</label>
<input type="date" class="field" name="end" min='2019-09-01' max='<?= date("Y-m-d"); ?>'>
<span class="tooltip">Laisser vide pour afficher les données jusqu'à aujourd'hui</span>
</div>
<input type="submit" value="Générer">

</form>

<?php
require_once File::build_path(array("view","dashboard","graphs", "donnees.php"));
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
		integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
		crossorigin="anonymous"></script>

<script type="text/javascript">
	function toggle() {
    	$(".graphSelect").toggle("slow");
	};

</script>