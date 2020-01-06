<link rel="stylesheet" type="text/css" href="./view/css/veh.css">

<div class="vehContainerMain">

    <br><br><br><br><br>
    <?php
        $veh = ModelVehicule::getVehicleById($_SESSION['idv']);

        echo '<div class="centeredCard">';
            echo '<h1 class="txtCentered">'. $veh->getSurnom() .'</h1>';
        echo '</div>';
        echo '<div class="centeredCard2">';

            echo '<p class="txtCentered"><b>Marque : </b>'. $veh->getMarque() .'</p>';
            echo '<p class="txtCentered"><b>Modèle : </b>'. $veh->getModele() .'</p>';
            echo '<p class="txtCentered"><b>Couleur : </b>'. $veh->getCouleur() .'</p>';
            echo '<br>';
            echo '<p class="txtCentered"><b>Immatriculation : </b>'. $veh->printImmat() .'</p>';
            echo '<br>';
            echo '<p class="txtCentered"><b>Personnes autorisées :</b></p>';
            echo '<p class="txtCentered">'. $veh->printAuthorizedPerson() .'</p>';
        echo '</div>';

        echo '<div class="divBtn">';
        if ($veh->getIdCreateur() == $_SESSION['userID']) {
            echo '<a class="btnPartager">Partager</a>';
            echo '<a class="btnUpdate">Modifier</a>';
            echo '<a class="btnDelete">Supprimer</a>';
        };
        echo '<a class="btnNew">Nouveau</a>';


        echo '</div>';
    ?>



</div>