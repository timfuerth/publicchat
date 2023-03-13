<script>
    function contactClick() {
        var contact;
        document.getElementById("spalter").style.visibility = "visible";
        contact = document.getElementById("contact").getAttribute('value');
        alert(contact);

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
            echo '<div id="contact" value="'.$name.'" onclick="contactClick()">';
            $this->Ueberschrift(2,$name);
            echo '</div>';

        }
        function msgSenden($msg){
            if (isset($_POST["msgbox"])){
                $msg = $_POST["msgbox"];
                $_SESSION['dbLeser']->NachrichtSenden("freedb_publicchatdb", "nachrichten", $_SESSION['user'], $_SESSION['touser'],$msg);
            }
        }
}