
<script>
    async function contactClick(kontaktID) {
        var contact = "";
        
        contact = document.getElementById("contactSelect"+kontaktID).getAttribute("value");  
        document.getElementById("spalter").style.visibility = "visible";
        document.getElementById("h1ToUser").innerHTML = contact;
        document.getElementById("Chatverlauf").innerHTML = "";
        
        while (true) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                // console.log('Ready state:', this.readyState);
                if (this.readyState == 4 && this.status == 200) {
                // console.log('Response:', this.responseText);
                const newDiv = document.createElement("div");

                

                
                const aktuelleNachrichten = this.responseText.split("<br>");
                aktuelleNachrichten.forEach(element => {
                    const newContent = document.createTextNode(this.responseText);
                    newDiv.appendChild(newContent);
                });
                

                // add the newly created element and its content into the DOM
                document.getElementById("Chatverlauf").appendChild(newDiv);
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
        public $name = "test";
        function __construct(){

        }

        function Alert($nachricht){
            echo "<script type='text/javascript'>alert('".$nachricht."');</script>";            
        }

        function DBConnect_Erstellen(){
            if(!isset($_SESSION['dbLeser'])){
                $_SESSION['dbLeser'] = new DBConnect();
                $_SESSION['dbLeser']->VerbindungAufbauen("timfuerth_dbschule", "benutzer");
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

        function kontakteErstellen(){
            if(isset($_SESSION['kontakte'])){
                for ($i=0; $i < Count($_SESSION['kontakte']); $i++)
                { 
                    echo '<div id="contactSelect'.$i.'" class="contact" value="'.$_SESSION['kontakte'][$i]->Username.'" onclick="contactClick('.$i.')">';
                    $this->Ueberschrift(2,$_SESSION['kontakte'][$i]->Username);
                    echo '</div>';
                }
            }
            else{
                $this->Alert("Noch kein Kontakt vorhanden");
            }
            
            

        }
        function msgSenden($msg){
            if (isset($_POST["msgbox"])){
                $nachricht = new Chatnachricht($_SESSION["user"], $_SESSION["toUser"], $msg);
                $_SESSION['dbLeser']->NachrichtSenden("timfuerth_dbschule", "nachrichten", $nachricht);
                $this->Alert($nachricht->Nachricht);
            }
        }
        function msgEmpfangen(){
            $return = $_SESSION['dbLeser']->NachrichtEmpfangen("timfuerth_dbschule", "nachrichten", "test", "test");
            if ($return != false){
                $nachricht = new Chatnachricht($_SESSION["user"], $_SESSION["toUser"], $return);
                return $nachricht;
            }
            return false;
        }
        function login($user, $pw){
            if ($_SESSION['dbLeser']->LoginRequest("timfuerth_dbschule", "benutzer", $user, $pw)){
                $_SESSION['user'] = $user;
                header('location: ../index.php');
            }
            else {
                $this->Alert("Passwort oder Benutzername falsch!");
            }
        }

        function register($vorname, $nachname, $user, $pw){
            if ($_SESSION['dbLeser']->RegisterRequest("timfuerth_dbschule", "benutzer", $vorname, $nachname, $user, $pw)){
                $_SESSION['user'] = $user;
                header('location: ../index.php');
            }
            else {
                $this->Alert("Registrierung fehlgeschlagen!");
            }
        }
}