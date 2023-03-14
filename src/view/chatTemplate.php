<html>
<body>
    <div id="wrapper">
        <section>
            <div id="spaltel">
                
            <?php $_SESSION['controller']->kontakteErstellen() ?>
                
            </div>
            <div id="spalter">
                <section>



                </section>
                <form method="post" class="NachrichtSenden">
                    <input type="text" name="msgbox" id="msgbox" placeholder="Schreib eine Nachricht" />

                </form>

            </div>
        </section>
    </div>
</body>
    
</html>