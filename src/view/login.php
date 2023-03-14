<html>
<body>
    <div id="wrapper">
        <section>
            <form action="" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="pw" placeholder="Passwort">
                <button type="submit">Login</button>
            </form>
            <?php 
            if (isset($_POST["username"])){
                $_SESSION['controller']->login($_POST["username"], $_POST["pw"]);
            }
            ?>
            <a href="view/register.php">Registrieren</a>
        </section>
    </div>
</body>
    
</html>