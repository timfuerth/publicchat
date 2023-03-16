
<script>
    async function contactClick(kontaktID) {
        var contact = "";
        
        contact = document.getElementById("contactSelect"+kontaktID).getAttribute("value");  
        document.getElementById("spalter").style.visibility = "visible";
        document.getElementById("h1ToUser").innerHTML = contact;
        document.getElementById(Chatverlauf).innerHTML = "";
        
        while (true) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                // console.log('Ready state:', this.readyState);
                if (this.readyState == 4 && this.status == 200) {
                // console.log('Response:', this.responseText);
                const newDiv = document.createElement("div");

                // and give it some content
                const newContent = document.createTextNode("Hi there and greetings!");

                // add the text node to the newly created div
                newDiv.appendChild(newContent);

                // add the newly created element and its content into the DOM
                document.getElementById("spalter").appendChild(newDiv);
                }
            };
            xhttp.open("POST", "control/save_contact.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("contact=" + contact);
            await Sleep(2000);
        }
        
    }
    function Sleep(milliseconds) {
    return new Promise(resolve => setTimeout(resolve, milliseconds));
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
                $nachricht = new Chatnachricht($_SESSION["user"], $_SESSION["toUser"], $msg);
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
                header("Refresh:0", "../index.php");
            }
            else {
                $this->Alert("Registrierung fehlgeschlagen!");
            }
        }
}