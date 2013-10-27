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
  
  function DAO_set_device($identification, $gcm_regid) {
	$con = connect();
	$sql = "UPDATE users SET gcm_key = '$gcm_regid' WHERE identification = '$identification'";
	$result = mysql_query($sql) or die(mysql_error());
	disconnect($con);
	return $result;
  }
  
  function DAO_user_module($user){
    $con = connect();
    $sql = "SELECT module FROM active_operators WHERE user_id='$user'";
    $arr_res = mysql_query($sql) or die(mysql_error());
    $arr_res = mysql_fetch_array($arr_res);
    disconnect($con);
    return $arr_res['module'];
  }
  
  function DAO_module_operator_exist($mod){
    $con = connect();
    $sql = "SELECT user_id FROM active_operators WHERE module='$mod'";
    $arr_res = mysql_query($sql) or die(mysql_error());
    
    $res = 1;
    if( mysql_num_rows($arr_res) == 1 ) $result = 0;    
    disconnect($con);
    return $res;
  }
  
  function DAO_new_active_operator($user_id, $module){
    $con = connect();
    $sql = "INSERT INTO active_operators VALUES(0, '$user_id', '$module');";
    $res = mysql_query($sql);
    mysql_close($con);
    return $res;
  }
  
  function DAO_insert_register($p1, $p2, $p3, $p4, $p5, $p6, $p7){
	$con = connect();
    $p5 = md5($p5);
    $sql = "INSERT INTO users VALUES('$p1', '$p2', '$p3', '$p4', '$p5', '$p6', '$p7', null);";
    $arr_res = mysql_query($sql);
    mysql_close($con);
    return $arr_res;
  }

  function DAO_read_login($user_id, $pwd){
    $con = connect();
    $sql = "SELECT * FROM users WHERE identification='$user_id' AND password='$pwd'";
    
    // $sql = "SELECT * FROM users WHERE identification='1' AND password='202cb962ac59075b964b07152d234b70'";
    $arr_res = mysql_query($sql);
  
    if(mysql_num_rows($arr_res) == 1){
      $arr_res = mysql_fetch_array($arr_res);
      
      $json_user = array('identification'=>0,'name'=>"", 'last_name'=>"", 'email'=>"", 'Eafit_student'=>0, 'rol'=>"");
      $json_user['identification'] = $arr_res['identification'];
      $json_user['name'] = $arr_res['name'];
      $json_user['last_name'] = $arr_res['last_name'];
      $json_user['email'] = $arr_res['email'];
      $json_user['Eafit_student'] = $arr_res['Eafit_student'];
      $json_user['rol'] = $arr_res['rol'];
      $json_user = json_encode($json_user);
      disconnect($con);
      return $json_user;
      
    }else{
      $json_user = '{"identification":-1}';
      disconnect($con);
      return $json_user;
    }
  }

  function DAO_read_active_operators($state){
    $con = connect();
    $result="";
    $cont = 0;

    if($state == "active"){
      $sql = "SELECT user_id,module FROM active_operators WHERE active = 1";
      $arr_res = mysql_query($sql);
    
      if(mysql_num_rows($arr_res) >= 1){
        while ($arr_res1 = mysql_fetch_array($arr_res)){
          if($cont!=0) $result=$result.",";
          $result = $result.$arr_res1['user_id'].":".$arr_res1['module'];
          $cont +=1;
        } 
      }
    }

    if($state == "inactive"){
      $sql = "SELECT user_id,module FROM active_operators WHERE active = 0";
      $arr_res = mysql_query($sql);

      if(mysql_num_rows($arr_res) >= 1){
        while ($arr_res1 = mysql_fetch_array($arr_res)){ 
          if($cont!=0) $result=$result.",";
          $result = $result.$arr_res1['user_id'].":".$arr_res1['module'];
          $cont +=1;
        }
      }
    }
    disconnect($con);
    return $result;
  }
  
}

?>