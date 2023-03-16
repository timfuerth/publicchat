<?php
include "../model/dbConnect.php";
include "../library/benutzer.php";
include "../library/chatnachricht.php";
include "../control/controller.php";
session_start();
if(!isset($_SESSION['controller'])){
    $_SESSION['controller'] = new Controller();
}

$_SESSION['controller']->DBConnect_Erstellen();
include_once "headerLogin.php";
?>
<html>
    <head>
    <link rel="stylesheet" href="../styles/styles.css">
    </head>
<body>
    <div id="wrapper">
        <div class="ButtonLogin">
            <a href="login.php">zum Login</a>
        </div>
        <section>
            <form action="" method="post" class="LoginForm">
                <input type="text" name="vorname" placeholder="Vorname">
                <input type="text" name="nachname" placeholder="Nachname">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="pw" placeholder="Passwort">
                <?php 
                if (isset($_POST["username"])){
                    $_SESSION['controller']->register($_POST["vorname"], $_POST["nachname"],$_POST["username"], $_POST["pw"]);
                }
                ?>
                <button type="submit">Login</button>
            </form>
            
        </section>
    </div>
</body>
    
</html>