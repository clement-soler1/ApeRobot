<link rel="stylesheet" type="text/css" href="./view/css/veh.css">

<h1>Création de Véhicule</h1>
<br>
<br>
<form method="post" action="index.php?">
    <div class="divInput">
        <p>Marque :</p>
        <input type="text" required placeholder="Marque" name="marque">
    </div>
    <div class="divInput">
        <p>Modèle :</p>
        <input type="text" required placeholder="Modèle" name="modele">
    </div>
    <div class="divInput">
        <p>Couleur :</p>
        <input type="text" required placeholder="Couleur" name="color">
    </div>
    <div class="divInput">
        <p>Immatriculation :</p>
        <input type="text" required placeholder="AC041YQ" name="immat">
    </div>
    <div class="divInput">
        <p>Surnom :</p>
        <input type="text" required placeholder="Ma voiture" name="surnom">
    </div>
    <input type="hidden" name="action" value="vehiculeCreated">
    <input type="hidden" name="controller" value="vehicule">
    <input type="hidden" name="idc" value="<?php echo $_SESSION['userID']; ?>">
    <div class="divInput">
        <input class="sbmt" type="submit" required value="Créer">
    </div>
</form>