<?php
session_start();
if (isset($_POST['contact'])) {
  $_SESSION['toUser'] = $_POST['contact'];
  echo "Contact saved to session!";
}
?>
