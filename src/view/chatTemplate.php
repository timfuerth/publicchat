<html>
<body>
    <div id="wrapper">
        <div id="spaltel">
            
        <?php $_SESSION['controller']->kontakteErstellen() ?>
            
        </div>
        <div id="spalter">
            <div id="Chatverlauf">
                <p>Chatnachricht</p>
            </div>
            <form method="post" class="NachrichtSenden">
                <input type="text" name="msgbox" id="msgbox" placeholder="Schreib eine Nachricht" />
                <input type="submit" value="Senden">
            </form>
            <?php 
            if (isset($_POST["msgbox"])){
                $_SESSION['controller']->msgSenden($_POST["msgbox"]);
            }

            ?>
        </div>
    </div>
</body>
    
</html>