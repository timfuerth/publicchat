<?php
    include_once "view/header.php";
    session_start();
    include "view/chatTemplate.php";




    if(!isset($_SESSION['controller'])){
        $_SESSION['controller'] = new Controller();
    }

    $_SESSION['controller']->DBConnect_Erstellen();
?>
