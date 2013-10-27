<?php
  include 'config/routes.php';
 
  if( isset($_REQUEST["q"]) && isset($routes[$_REQUEST["q"]]) ){
    $params = (isset($_REQUEST["params"]))?$_REQUEST["params"]:"";
    $response = calling($routes[$_REQUEST["q"]], $params);    
    if( $response == "" ) echo "Error: Empty response";
    else echo $response;
  }else{
    echo 'Service error: Please specify a service';
  }
?>