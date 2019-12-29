<link rel="stylesheet" type="text/css" href="./view/css/alerte.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<?php
    if (isset($_REQUEST['page'])) {
        $page = $_REQUEST['page'];
    } else {
        $page = 1;
    }
    if (isset($_REQUEST['odr'])){
        $_SESSION['order'] = $_REQUEST['odr'];
    } else {
        $_SESSION['order'] = 1;
    }
?>

<form action="" method="post" name="form" id="form">
    <label for="odr">Trier par</label>
    <select name="odr" onchange=document.form.submit(); id="ordre">
        <option value="1">Date</option>
        <option value="2">Niveau d'alerte</option>
        <option value="3">Type d'alerte</option>
    </select>
</form>

	<?php

        $no_of_records_per_page = 5;
        $offset = ($page - 1) * $no_of_records_per_page;

        $tabAlerts = ModelAlerte::selectAlertByVehicle($_SESSION['idv'], $offset, $no_of_records_per_page, $_SESSION['order']);
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        foreach ($tabAlerts as $alert) {
		    $alert->afficher();
		}
    ?>

    <script type="text/javascript">
    document.getElementById('ordre').value = '<?= $_REQUEST['odr'] ?>';
    </script>

    <ul id="pagination">
        <li id="menu-pagination" class="<?php if($page == 1){ echo 'disabled'; } ?>"><a href="?controller=dashboard&action=alert&page=1&odr=<?= $_SESSION['order'] ?>"><i class="material-icons">first_page</i></a></li>
        <li id="menu-pagination" class="<?php if($page <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($page <= 1){ echo '#'; } else { echo "?controller=dashboard&action=alert&page=".($page - 1) . "&odr=" . $_SESSION['order']; } ?>"><i class="material-icons">navigate_before</i></a>
        </li>
        <li id="menu-pagination" class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?controller=dashboard&action=alert&page=".($page + 1). "&odr=" . $_SESSION['order']; } ?>"><i class="material-icons">navigate_next</i></a>
        </li>
        <li id="menu-pagination" class="<?php if($page == $total_pages){ echo 'disabled'; } ?>"><a href="?controller=dashboard&action=alert&page=<?= $total_pages ?>&odr=<?= $_SESSION['order'] ?>"><i class="material-icons">last_page</i></a></li>
    </ul>
</div>
