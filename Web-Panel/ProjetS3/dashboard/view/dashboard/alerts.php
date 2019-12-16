<link rel="stylesheet" type="text/css" href="./view/css/alerte.css">

<div class="alertContainerMain">    
<?php 

foreach ($tabAlerts as $alert) {
    $alert->afficher();
}

?>
</div>