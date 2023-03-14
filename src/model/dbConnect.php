<?php
    class DBConnect{

        function __construct(){

        }

        function VerbindungAufbauen($datenbank, $tabellenname){
            
            $pdo = new PDO('mysql:host=sql.freedb.tech;dbname='.$datenbank.'', 'freedb_burgi', 'jR53uP&&u4AGH7j');
            $i = 0;
            $sql = "select * from ".$tabellenname;
		    foreach($pdo->query($sql) as $zeile){
                $benutzer = new Benutzer($zeile["Vorname"], $zeile["Nachname"], $zeile["Username"], $zeile["Passwort"]);
                $_SESSION['alleBenutzer'][$i] = $benutzer;
                
                $i++;
		    }
            
            $pdo = null;

        }
        function NachrichtSenden($datenbank, $tabellenname, $vonBenutzer, $anBenutzer, $msg){
            $pdo = new PDO('mysql:host=sql.freedb.tech;dbname='.$datenbank.'', 'freedb_burgi', 'jR53uP&&u4AGH7j');
            $statement = $pdo->prepare("Insert into ".$tabellenname."(vonBenutzer, anBenutzer, Nachricht) values(?, ?, ?)");
            $statement->execute(array($vonBenutzer, $anBenutzer,$msg));
            $pdo = null;
        }

        function LoginRequest($datenbank, $tabellenname, $user, $pw){
            $pdo = new PDO('mysql:host=sql.freedb.tech;dbname='.$datenbank.'', 'freedb_burgi', 'jR53uP&&u4AGH7j');
            $allowed = false;
            foreach($pdo->query("select Username, Passwort from ".$tabellenname." where Username = '".$user."' AND Passwort = '".$pw."'") as $zeile){
                $allowed = true;
		    }
            $pdo = null;
            return $allowed;
        }
        function RegisterRequest($datenbank, $tabellenname, $vorname, $nachname, $user, $pw){
            $pdo = new PDO('mysql:host=sql.freedb.tech;dbname='.$datenbank.'', 'freedb_burgi', 'jR53uP&&u4AGH7j');
            $errors = array();

		    foreach($pdo->query("select Username from ".$tabellenname) as $zeile){
                if ($zeile[0] == $user){
                    $errors[] = "Username is taken!";
                    break;
                }
		    }
            if (strlen($pw) < 8 || strlen($pw) > 16) {
                $errors[] = "Password should be min 8 characters and max 16 characters";
            }
            if (!preg_match("/\d/", $pw)) {
                $errors[] = "Password should contain at least one digit";
            }
            if (!preg_match("/[A-Z]/", $pw)) {
                $errors[] = "Password should contain at least one Capital Letter";
            }
            if (!preg_match("/[a-z]/", $pw)) {
                $errors[] = "Password should contain at least one small Letter";
            }
            if (!preg_match("/\W/", $pw)) {
                $errors[] = "Password should contain at least one special character";
            }
            if (preg_match("/\s/", $pw)) {
                $errors[] = "Password should not contain any blank space";
            }

            if ($errors) {
                foreach ($errors as $error) {
                    echo "<p class='errormsg'>".$error."</p>";
                }
                return false;
            } else {
                $statement = $pdo->prepare("Insert into ".$tabellenname."(Vorname, Nachname, Username, Passwort) values(?, ?, ?, ?)");
                        $statement->execute(array($vorname, $nachname, $user, $pw));
                        $pdo = null;
                        return true;
            }
            
        }



    }
?>