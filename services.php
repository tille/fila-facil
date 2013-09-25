<?php
  include 'config/routes.php';
 
  if( isset($_GET["q"]) && isset($routes[$_GET["q"]]) ){
    $params = (isset($_GET["params"]))?$_GET["params"]:"";
    $response = calling($routes[$_GET["q"]], $params);
    if( $response == "" ) echo "Error";
    else echo $response;
  }else{
    echo 'Error';
  }
?>