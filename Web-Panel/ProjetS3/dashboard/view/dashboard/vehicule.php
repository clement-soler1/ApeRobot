<link rel="stylesheet" type="text/css" href="./view/css/veh.css">

<div class="vehContainerMain">

    <br><br><br><br><br>
    <?php
        if (isset($_SESSION['idv'])) {
            $veh = ModelVehicule::getVehicleById($_SESSION['idv']);

            echo '<div class="centeredCard">';
            echo '<h1 class="txtCentered">' . htmlspecialchars($veh->getSurnom()) . '</h1>';
            echo '</div>';
            echo '<div class="centeredCard2">';

            echo '<p class="txtCentered"><b>Marque : </b>' . htmlspecialchars($veh->getMarque()) . '</p>';
            echo '<p class="txtCentered"><b>Modèle : </b>' . htmlspecialchars($veh->getModele()) . '</p>';
            echo '<p class="txtCentered"><b>Couleur : </b>' . htmlspecialchars($veh->getCouleur()) . '</p>';
            echo '<br>';
            echo '<p class="txtCentered"><b>Immatriculation : </b>' . htmlspecialchars($veh->printImmat()) . '</p>';
            echo '<br>';
            echo '<p class="txtCentered"><b>Personnes autorisées :</b></p>';
            echo '<p class="txtCentered">' . htmlspecialchars($veh->printAuthorizedPerson()) . '</p>';
            echo '</div>';

            echo '<div class="divBtn">';
            if ($veh->getIdCreateur() == $_SESSION['userID']) {
                echo '<a class="btnPartager" href="./index.php?controller=vehicule&action=share">Partager</a>';
                echo '<a class="btnUpdate" href="./index.php?controller=vehicule&action=update">Modifier</a>';
                echo '<a class="btnDelete" href="./index.php?controller=vehicule&action=delete&idv='. $_SESSION['idv'] .'">Supprimer</a>';
            };
            echo '<a class="btnNew" href="./index.php?controller=vehicule&action=createVehicule">Nouveau</a>';


            echo '</div>';
        } else {
            echo '<h1>Vouys n\'avez aucuns véhicule !</h1>';
            echo '<br>';
            echo '<div class="divBtn">';
            echo '<a class="btnNew" href="./index.php?controller=vehicule&action=createVehicule">Nouveau</a>';
            echo '</div>';

        }
    ?>



</div>