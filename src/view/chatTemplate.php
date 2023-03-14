<html>
<body>
    <div id="wrapper">
        <section>
            <div id="spaltel">
                
            <?php $_SESSION['controller']->kontakteErstellen() ?>
                
            </div>
            <div id="spalter">
                <form method="post">
                    <input type="text" name="msgbox" id="msgbox" placeholder="..." />

                </form>

            </div>
        </section>
    </div>
</body>
    
</html>