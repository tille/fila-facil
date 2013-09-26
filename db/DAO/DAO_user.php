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
    //$sql = "SELECT * FROM users WHERE identification='$user_id' AND password='$pwd'";

    $result = msql_query("SELECT * FROM users");
    $row = msql_fetch_array($result);
    echo var_dump($row);
    
    
    // $sql = "SELECT * FROM users WHERE identification='1' AND password='202cb962ac59075b964b07152d234b70'";
    // $arr_res = mysql_query($sql,$con);
    //     
    // if (!$arr_res) {
    //   echo "esta mierda no dio";
    // }else{
    //   $row = msql_fetch_array($arr_res);
    //   var_dump($row);
    // }
    //     
    // if(mysql_num_rows($arr_res) == 1){
    //   $arr_res = msql_fetch_array($arr_res);
    //   
    //   $json_user = array('identification'=>0,'name'=>"", 'last_name'=>"", 'email'=>"", 'Eafit_student'=>0, 'rol'=>"");
    //   $json_user['identification'] = $arr_res['identification'];
    //   $json_user['name'] = $arr_res['name'];
    //   $json_user['last_name'] = $arr_res['last_name'];
    //   $json_user['email'] = $arr_res['email'];
    //   $json_user['Eafit_student'] = $arr_res['Eafit_student'];
    //   $json_user['rol'] = $arr_res['rol'];
    //   var_dump($json_user);
    //   $json_user = json_encode($json_user);
    //   disconnect($con);
    //   return $json_user;
    // }else{
      $result = '{identification:-1}';
      disconnect($con);
      return $result;
    // }
  }
  
}

?>