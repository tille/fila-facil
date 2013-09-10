<?php
  include 'config/routes.php';
  
  if( isset($_GET["q"]) && isset($routes[$_GET["q"]]) ){
    return $routes[$_GET["q"]];
  }else{
    return "please specify a valid service!";
  }
?>