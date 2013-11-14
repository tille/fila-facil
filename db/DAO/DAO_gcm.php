<?php
class DAO_gcm{
  // if user result == 0, mean that there are another user with the same nickname
  function DAO_get_devices(){
    $con = connect();
    $result = "";
    
    $sql = "SELECT DISTINCT gcm_key FROM users WHERE gcm_key IS NOT NULL";
    $arr_res = mysql_query($sql) or die(mysql_error());
    
    if (mysql_num_rows($arr_res) == 0) return "";
    $result = mysql_fetch_array($arr_res);
    $result = $result[0];
    while ($key = mysql_fetch_array($arr_res)) {
      $result = $result . "," . $key[0];
    }  
    disconnect($con);
    return $result;
  }

  function DAO_get_device_by_user($user) {
    $con = connect();
    $sql = "SELECT gcm_key FROM users WHERE identification = '$user'";
    $arr_res = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($arr_res) == 0) return "";
    $result = mysql_fetch_array($arr_res);
    disconnect($con);
    return $result[0];
  }
}

?>