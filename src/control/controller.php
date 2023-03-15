
<script>
    function contactClick(kontaktID) {
        var contact = "";
        
        contact = document.getElementById("contactSelect"+kontaktID).getAttribute("value");  
        document.getElementById("spalter").style.visibility = "visible";
        document.getElementById("h1ToUser").innerHTML = contact;
    }
    
</script>
<?php
    
    class Controller{
        function __construct(){

        }

        function Alert($nachricht){
            echo "<script type='text/javascript'>alert('".$nachricht."');</script>";            
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

        function kontakteBestimmen()
        {
            
            $kontaktanzahl=0;
            for ($i=0; $i < Count($_SESSION['alleBenutzer']); $i++)
            { 
                if($_SESSION['alleBenutzer'][$i]->Vorname != $_SESSION['user'])
                {
                    $_SESSION['kontakte'][$kontaktanzahl] = $_SESSION['alleBenutzer'][$i];
                    
                    $kontaktanzahl++;
                }
                
            }
            
        }

        function kontakteErstellen()
        {
            for ($i=0; $i < Count($_SESSION['kontakte']); $i++)
            { 
                echo '<div id="contactSelect'.$i.'" class="contact" value="'.$_SESSION['kontakte'][$i]->Username.'" onclick="contactClick('.$i.')">';
                $this->Ueberschrift(2,$_SESSION['kontakte'][$i]->Username);
                echo '</div>';
            }

        }
        function msgSenden($msg){
            if (isset($_POST["msgbox"])){
                $nachricht = new Chatnachricht($_SESSION["user"], "Test1", $msg);
                $_SESSION['dbLeser']->NachrichtSenden("freedb_publicchatdb", "nachrichten", $nachricht);
                $this->Alert($nachricht->Nachricht);
            }
        }

        function login($user, $pw){
            if ($_SESSION['dbLeser']->LoginRequest("freedb_publicchatdb", "benutzer", $user, $pw)){
                $_SESSION['user'] = $user;
                header("Refresh:0");
            }
            else {
                $this->Alert("Passwort oder Benutzername falsch!");
            }
        }

        function register($vorname, $nachname, $user, $pw){
            if ($_SESSION['dbLeser']->RegisterRequest("freedb_publicchatdb", "benutzer", $vorname, $nachname, $user, $pw)){
                $_SESSION['user'] = $user;
                header("Refresh:0");
            }
            else {
                $this->Alert("Registrierung fehlgeschlagen!");
            }
        }
}