<link rel="stylesheet" type="text/css" href="./view/css/veh.css">

<?php
    $veh = ModelVehicule::getVehicleById($_SESSION['idv']);
?>

<h1>Modification de Véhicule</h1>
<br>
<br>
<form method="post" action="index.php?">
    <div class="divInput">
        <p>Marque :</p>
        <input type="text" required placeholder="Marque" value="<?php echo $veh->getMarque(); ?>" name="marque">
    </div>
    <div class="divInput">
        <p>Modèle :</p>
        <input type="text" required placeholder="Modèle" value="<?php echo $veh->getModele(); ?>" name="modele">
    </div>
    <div class="divInput">
        <p>Couleur :</p>
        <input type="text" required placeholder="Couleur" value="<?php echo $veh->getCouleur(); ?>" name="color">
    </div>
    <div class="divInput">
        <p>Immatriculation :</p>
        <input type="text" required placeholder="AC041YQ" value="<?php echo $veh->getImmatriculation(); ?>" name="immat">
    </div>
    <div class="divInput">
        <p>Surnom :</p>
        <input type="text" required placeholder="Ma voiture" value="<?php echo $veh->getSurnom(); ?>" name="surnom">
    </div>
    <input type="hidden" name="action" value="vehiculeUpdate">
    <input type="hidden" name="controller" value="vehicule">
    <input type="hidden" name="idv" value="<?php echo $_SESSION['idv']; ?>">
    <div class="divInput">
        <input class="sbmt" type="submit" required value="Créer">
    </div>
</form>