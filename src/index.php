<?php
    
    //Datenbankverbindung:
    include "model/dbConnect.php";
    //Klassen:
    //include "library/gast.php";
    //include "library/gaestebuch.php";
    //Controller:
    include "control/controller.php";
    include "control/ausgabefunktionen.php";

    //View:
    include_once "view/header.php";
    session_start();
    include "view/chatTemplate.php";




    if(!isset($_SESSION['controller'])){
        $_SESSION['controller'] = new Controller();
    }

    $_SESSION['controller']->DBConnect_Erstellen();
?>
