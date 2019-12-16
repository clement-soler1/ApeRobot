<?php
    session_start();

    require_once './lib/File.php';
    require File::build_path(array("controller","routeur.php"));
    
?>