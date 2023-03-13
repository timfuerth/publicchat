<?php
    class DBConnect{

        function __construct(){

        }

        function VerbindungAufbauen($datenbank, $tabellenname){
            
            $pdo = new PDO('mysql:host=localhost;dbname='.$datenbank.'', 'root', '');

            $sql = "select * from $tabellenname";
            $statement = $pdo->prepare($sql);
            $statement->execute();

            $pdo = null;

        }
    }
?>