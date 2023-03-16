<?php
require_once "../model/dbConnect.php";
require_once "../library/chatnachricht.php";
session_start();
if (isset($_POST['contact'])) {
  $_SESSION['toUser'] = $_POST['contact'];
  $msg = msgEmpfangen();
  if($msg != false){
    echo $msg;
  } 
  
}
function msgEmpfangen(){
  $return = $_SESSION['dbLeser']->NachrichtenLesen("freedb_publicchatdb", "nachrichten", "test", "test");
  if ($return != false){
      $nachricht = new Chatnachricht($_SESSION["user"], $_SESSION["toUser"], $return);
      return $nachricht->Nachricht;
  }
  return false;
}
?>
