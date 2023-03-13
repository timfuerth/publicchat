<?php
    
    include "model/dbConnect.php";
    include "library/benutzer.php";
    include "library/chatnachricht.php";
    include "control/ausgabefunktionen.php";
    include "control/controller.php";
    
    session_start();


    if(!isset($_SESSION['controller'])){
        $_SESSION['controller'] = new Controller();
    }

    $_SESSION['controller']->DBConnect_Erstellen();

    $_SESSION['user'] = "BURGI";
    $_SESSION['touser'] = "";

    include_once "view/header.php";
    include "view/chatTemplate.php";

?>
