<?php
  ob_start(); 
  session_start();
  $id = $_SESSION['id'];
  $pwd = $_SESSION['password'];
  session_destroy();
  $success = header('Location: '."http://filafacil.herokuapp.com/services.php?q=change_operator_state&params=".$id.",0");
?>