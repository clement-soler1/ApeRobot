<link rel="stylesheet" type="text/css" href="./view/css/veh.css">

<h1>Modification de Véhicule</h1>
<br>
<br>
<form method="post" action="index.php?">
    <div class="divInput">
        <p>Utilisateur :</p>
        <input type="number" required placeholder="idUtilisateur" name="idu">
    </div>
    <input type="hidden" name="action" value="vehiculeShare">
    <input type="hidden" name="controller" value="vehicule">
    <input type="hidden" name="idv" value="<?php echo $_SESSION['idv']; ?>">
    <div class="divInput">
        <input class="sbmt" type="submit" required value="Créer">
    </div>
</form>