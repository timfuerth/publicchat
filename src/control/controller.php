<script>
    function contactClick() {
        document.getElementById("spalter").style.visibility = "visible";
        <?php
            //$_SESSION['touser'] = $_GET["contact"];
            
        ?>
    }
</script>
<?php
    class Controller{
        function __construct(){

        }

        function DBConnect_Erstellen(){
            if(!isset($_SESSION['dbLeser'])){
                $_SESSION['dbLeser'] = new DBConnect();
                $_SESSION['dbLeser']->VerbindungAufbauen("freedb_publicchatdb", "benutzer");
            }
        }

        function Ueberschrift($rang, $ueberschrift){
                    echo "<h".$rang." class='ueberschrift'>".$ueberschrift."</h".$rang.">";
        }

        function InputFeldErstellen($feldBeschreibung, $type, $name){
            echo '<label for="'.$name.'">'.$feldBeschreibung.'</label>';
            echo '<input type="'.$type.'" id="'.$name.'" name="'.$name.'">';
        }

        function contactErstellen($name){
            echo "<div class='contact' onclick='contactClick()'>";
            $this->Ueberschrift(2,$name);
            echo "</div>";

        }
        function msgSenden($msg){
            if (isset($_POST["msgbox"])){
                $msg = $_POST["msgbox"];
                $_SESSION['dbLeser']->NachrichtSenden("freedb_publicchatdb", "nachrichten", $_SESSION['user'], $_SESSION['touser'],$msg);
            }
        }
}