<?php
  include 'config/routes.php';

  if( isset($_GET["q"]) && isset($routes[$_GET["q"]]) ){
    $params = (isset($_GET["params"]))?$_GET["params"]:"";
    return calling($routes[$_GET["q"]], $params);
  }else{
    echo "Please specify a valid service!";
    return "Please specify a valid service!";
  }
?>