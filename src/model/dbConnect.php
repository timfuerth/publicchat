<?php
    class DBConnect{

        function __construct(){

        }

        function VerbindungAufbauen($datenbank, $tabellenname){
            
            $pdo = new PDO('mysql:host=sql.freedb.tech;dbname='.$datenbank.'', 'freedb_burgi', '2e&uCzAKgnp@Sey');

            $sql = "select * from $tabellenname";
            $statement = $pdo->prepare($sql);
            $statement->execute();

            $pdo = null;

        }
    }
?>