<link rel="stylesheet" type="text/css" href="./view/css/acct.css">

<?php

$usr = ModelUser::getUserByEmail($_SESSION['userEmail']);
echo '<div class="account-card">';
    echo '<img class="acctI" src="./view/icons/account_info.png">';
    echo '<h1 class="acct-name">'. ucfirst($usr->getPrenom()) .' '. ucfirst($usr->getNom()) .'</h1>';
    echo '<p class="txtCentered"><b>E-mail : </b>'. $usr->getEmail() .'</p>';
    echo '<p class="txtCentered"><b>Date de Naissance :</b> '. $usr->getDateNaissance() .'</p>';
    echo '<p class="txtCentered"><b>Téléphone :</b> '. $usr->printTel() .'</p>';
    echo '<br>';
    echo '<p class="txtCentered"><b>Véhicules créés</b></p>';
    echo '<p class="txtCentered">AlfaRoméo Mito</p>';
    echo '<br>';
    echo '<p class="txtCentered"><b>Véhicules Accesibles</b></p>';
    echo '<p class="txtCentered">AlfaRoméo Mito</p>';
    echo '<br>';
echo '</div>';
?>

<div class="divDisc">
    <a class="btnDisconnect" href="index.php?controller=user&action=disconnect">Déconnexion</a>
</div>