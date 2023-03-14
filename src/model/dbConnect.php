<?php
    class DBConnect{

        function __construct(){

        }

        function VerbindungAufbauen($datenbank, $tabellenname){
            
            $pdo = new PDO('mysql:host=sql.freedb.tech;dbname='.$datenbank.'', 'freedb_burgi', 'jR53uP&&u4AGH7j');
            $i = 0;
            $sql = "select * from $tabellenname";
		    foreach($pdo->query($sql) as $zeile){
                $benutzer = new Benutzer($zeile["Vorname"], $zeile["Nachname"], $zeile["Username"], $zeile["Passwort"]);
                $_SESSION['alleBenutzer'][$i] = $benutzer;
                $_SESSION['controller']->Alert($_SESSION['alleBenutzer'][$i]->Vorname);
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
            if (strlen($pw) > 5){
                return false;
            }
            $statement = $pdo->prepare("Insert into ".$tabellenname."(Vorname, Nachname, Username, Passwort) values(?, ?, ?, ?)");
            $statement->execute(array($vorname, $nachname, $user, $pw));
            $pdo = null;
            return true;
        }



    }
?>