<?php
    session_start();
    include "model/dbConnect.php";
    include "library/benutzer.php";
    include "library/chatnachricht.php";
    include "control/ausgabefunktionen.php";
    include "control/controller.php";
    



    if(!isset($_SESSION['controller'])){
        $_SESSION['controller'] = new Controller();
    }

    $_SESSION['controller']->DBConnect_Erstellen();

    $_SESSION['user'] = "BURGI";
    $_SESSION['touser'] = "";

    include_once "view/header.php";
    include "view/chatTemplate.php";

?>
