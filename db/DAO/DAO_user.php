<?php

class DAO_user{
  // if user result == 0, mean that there are another user with the same nickname
  function DAO_user_exist($identification){
    $con = connect();
    $sql = "SELECT identification FROM users WHERE identification='$identification'";
    $arr_res = mysql_query($sql) or die(mysql_error());

    $result = 1;
    if( mysql_num_rows($arr_res) == 1 ) $result = 0;    
    disconnect($con);
    return $result;
  }

  function DAO_insert_register($p1, $p2, $p3, $p4, $p5, $p6, $p7){
    $con = connect();
    $p5 = md5($p5);
    $sql = "INSERT INTO users VALUES('$p1', '$p2', '$p3', '$p4', '$p5', '$p6', '$p7');";
    $arr_res = mysql_query($sql);
    mysql_close($con);
    return $arr_res;
  }

  function DAO_read_login($user_id, $pwd){
    $con = connect();
    $sql = "SELECT identification, password FROM users WHERE identification='$user_id' AND password='$pwd' ";
    $arr_res = mysql_query($sql) or die(mysql_error());

    $result = 0;
    if(mysql_num_rows($arr_res) == 1) $result = 1;
    disconnect($con);
    return $result;
  }
}

?>