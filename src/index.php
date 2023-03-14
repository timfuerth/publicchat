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

    include_once "view/header.php";
    if (!isset($_SESSION['user'])){
        require "view/login.php";
    }
    else{
        include "view/chatTemplate.php";
    }
    $_SESSION['touser'] = "";

    
    

?>
