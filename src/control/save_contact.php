<?php
require_once "../model/dbConnect.php";
require_once "../library/chatnachricht.php";
session_start();
if (isset($_POST['contact'])) {
  $_SESSION['toUser'] = $_POST['contact'];
  $msg = msgEmpfangen();
  if($msg != false){
    foreach ($msg as $message) { 
      echo $message."<br>";
    }
  }
  
}
function msgEmpfangen(){
  $nachrichtenListe = array();
  $return = $_SESSION['dbLeser']->NachrichtenLesen("timfuerth_dbschule", "nachrichten", "test", "test");
  if ($return != false){
    foreach ($return as $message) {
      $nachricht = new Chatnachricht($_SESSION["user"], $_SESSION["toUser"], $message);
      array_push($nachrichtenListe, $nachricht->Nachricht);
    }
      
    return $nachrichtenListe;
  }
  return false;
}
?>
