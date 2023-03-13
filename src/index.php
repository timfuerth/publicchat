<?php

    //Datenbankverbindung:
    include "model/dbConnect.php";
    //Klassen:
    //include "library/gast.php";
    //include "library/gaestebuch.php";
    //Controller:
    include "control/ausgabefunktionen.php";
    include "control/controller.php";

    session_start();
    //View:
    include_once "view/header.php";
    include "view/chatTemplate.php";




    if(!isset($_SESSION['controller'])){
        $_SESSION['controller'] = new Controller();
    }

    $_SESSION['controller']->DBConnect_Erstellen();

    $_SESSION['user'] = "BURGI";
    $_SESSION['touser'] = "";

?>
