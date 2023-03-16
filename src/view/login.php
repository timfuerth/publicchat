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
            <a href="register.php">zur Registrierung</a>
        </div>
    
        <section>
            <form action="" method="post" class="LoginForm">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="pw" placeholder="Passwort">
                <button type="submit">Login</button>
            </form>
            <?php 
            if (isset($_POST["username"])){
                $_SESSION['controller']->login($_POST["username"], $_POST["pw"]);
            }
            ?>
            
            
        </section>
    </div>
</body>
    
</html>