<html>
<body>
    <div id="wrapper">
        <section>
            <div id="spaltel">
                
            <?php $_SESSION['controller']->kontakteErstellen() ?>
                
            </div>
            <div id="spalter">
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
        </section>
    </div>
</body>
    
</html>