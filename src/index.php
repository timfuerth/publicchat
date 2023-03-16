<?php
    require_once "model/dbConnect.php";
    require_once "library/benutzer.php";
    require_once "library/chatnachricht.php";
    require_once "control/controller.php";
    
    
    session_start();
    
    if(!isset($_SESSION['controller'])){
        $_SESSION['controller'] = new Controller();
    }
    $_SESSION['controller']->DBConnect_Erstellen();
    
    
    include_once "view/header.php";
    if (!isset($_SESSION['user'])){
        header('location: view/login.php');
        
    }
    else{
        $_SESSION['toUser'] = "";
        $_SESSION['controller']->kontakteBestimmen();
        include "view/chatTemplate.php";
       
    }
    
    $_SESSION['toUser'] = "";
    $_SESSION["latmsg"] = 0;
    
?>