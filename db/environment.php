<?php
  // Environment... 1) development, 2) production, 3) test
  $env = 1;

  if( $env == 1 ) include 'development.php';
  if( $env == 2 ) include 'production.php';
  if( $env == 3 ) {}

  function connect(){
    global $server, $username, $password, $db;
    $con = mysql_connect($server, $username, $password);
    mysql_select_db($db);
    return $con;
  }
  
  function disconnect($con){
    mysql_close($con);
  }
  
?>