<?php
    class DBConnect{
        private $DBPWD = "5PJt8Ay!&KHv?DX";
        private $Host = "mysql:host=sql.freedb.tech";
        private $user = "freedb_burgi";
        function __construct(){

        }

        function VerbindungAufbauen($datenbank, $tabellenname){
            $pdo = new PDO($this->Host.';dbname='.$datenbank.'', $this->user, $this->DBPWD);
            $i = 0;
            $sql = "select * from ".$tabellenname;
		    foreach($pdo->query($sql) as $zeile){
                $benutzer = new Benutzer($zeile["Vorname"], $zeile["Nachname"], $zeile["Username"], $zeile["Passwort"]);
                $_SESSION['alleBenutzer'][$i] = $benutzer;
                
                $i++;
		    }
            
            $pdo = null;

        }
        function NachrichtSenden($datenbank, $tabellenname, $chatnachricht){
            $pdo = new PDO($this->Host.';dbname='.$datenbank.'', $this->user, $this->DBPWD);
            $statement = $pdo->prepare("Insert into ".$tabellenname."(vonBenutzer, anBenutzer, Nachricht) values(?, ?, ?)");
            $statement->execute(array($chatnachricht->vonBenutzer, $chatnachricht->anBenutzer,$chatnachricht->Nachricht));
            $pdo = null;
        }
        function NachrichtenLesen($datenbank, $tabellenname, $user, $touser){
            $pdo = new PDO($this->Host.';dbname='.$datenbank.'', $this->user, $this->DBPWD);

            $sql = "select * from ".$tabellenname;
            $i = 0;
            $ausgabe = array();
		    foreach($pdo->query($sql) as $zeile){
                if (intval($zeile["NID"]) > intval($_SESSION["latmsg"])){
                    $_SESSION["latmsg"] = intval($zeile["NID"]);
                    $ausgabe[$i] = $zeile[1];
                    
                    $i++;
                }
                
		    }
            $pdo = null;
            if (Count($ausgabe) > 0){
                return $ausgabe;
            } 
            else{
                return false;
            }
            
        }
        function LoginRequest($datenbank, $tabellenname, $user, $pw){
            $pdo = new PDO($this->Host.';dbname='.$datenbank, $this->user, $this->DBPWD);
            $allowed = false;
            foreach($pdo->query("select Username, Passwort from ".$tabellenname." where Username = '".$user."' AND Passwort = '".$pw."'") as $zeile){
                $allowed = true;
		    }
            $pdo = null;
            return $allowed;
        }
        function RegisterRequest($datenbank, $tabellenname, $vorname, $nachname, $user, $pw){
            $pdo = new PDO($this->Host.';dbname='.$datenbank.'', $this->user, $this->DBPWD);
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
            //Speichern des Passwort-Hashes:
            // $connection = pg_pconnect("host=sheep port=5432 dbname=mary user=lamb password=foo");
            // if (!$conn) {
            //     echo "An error occurred.\n";
            //     exit;
            // }
            // $query  = sprintf("INSERT INTO ".$tabellenname."(Vorname,Nachname, Username, Passwort) VALUES(".$vorname.",".$nachname.",".$user.",".$pw.");",
            // pg_escape_string($username),
            // password_hash($password, PASSWORD_DEFAULT));
            // $result = pg_query($connection, $query);
            // return true;
            //Ohne Verschlüsselung:
                $statement = $pdo->prepare("Insert into ".$tabellenname."(Vorname, Nachname, Username, Passwort) values(?, ?, ?, ?)");
                $statement->execute(array($vorname, $nachname, $user, $pw));
                $pdo = null;
                return true;
            
            }
            
        }
    }
?>