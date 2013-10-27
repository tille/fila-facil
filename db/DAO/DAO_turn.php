<?php

class DAO_turn {
  
  function DAO_new_expected_turn($mod, $user_id){
    $request = DAO_turn::DAO_read($mod)+1;
    
    $con = connect();
    $sql = "INSERT INTO expected_turn VALUES('$mod', '$request', '$user_id');";
    $arr_res = mysql_query($sql);
    mysql_close($con);
    
    $updating_last_request = DAO_turn::DAO_update($mod, $request);
    return $request;
  }
  
  function DAO_read($mod){
    $con = connect();
    $sql = "SELECT last_request FROM turn WHERE module='$mod'";
    $arr_res = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_array($arr_res);
    disconnect($con);
    return $result[0];    
  }
  
  function DAO_read_actual_turn($mod){
    $con = connect();
    $sql = "SELECT number FROM turn WHERE module='$mod'";
    $arr_res = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_array($arr_res);
    disconnect($con);
    return $result[0];    
  }
  
  function DAO_count_module_queue($mod){
    $con = connect();
    $sql = "SELECT COUNT( * ) AS id FROM expected_turn WHERE module='$mod'";
    $arr_res = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_array($arr_res);
    return $result['id'];
  }
  
  // returns 0 if there is not a combination of user/module in expected_turn 
  function DAO_existence_turn( $user, $mod ){
    $con = connect();
    $sql = "SELECT user_id FROM expected_turn WHERE user_id='$user' AND module='$mod' ";
    $arr_res = mysql_query($sql) or die(mysql_error());

    $result = 0;
    if( mysql_num_rows($arr_res) != 0 ) $result = 1;
    disconnect($con);
    return $result;
  }

  function DAO_update($mod, $num){
    $modules = array(
      "admisiones" => 1,
      "caja" => 2,
      "cartera" => 3,
      "certificados" => 4,
      );

    $con = connect();
    $id_mod = $modules[$mod];
    $sql = "UPDATE turn SET last_request='$num' WHERE id='$id_mod'";
    $arr_res = mysql_query($sql);
    mysql_close($con);
  }
  
  function DAO_delete_expected_turn($mod, $turn){
    $con = connect();
    $sql = "DELETE FROM expected_turn WHERE expected_turn='$turn' AND module='$mod'";
    $arr_res = mysql_query($sql) or die(mysql_error());
    disconnect($con);
    return $arr_res;
  }
  
  function DAO_update_actual_turn($mod, $num){
    $modules = array(
      "admisiones" => 1,
      "caja" => 2,
      "cartera" => 3,
      "certificados" => 4,
      );

    $con = connect();
    $id_mod = $modules[$mod];
    $sql = "UPDATE turn SET number='$num' WHERE id='$id_mod'";
    $arr_res = mysql_query($sql);
    mysql_close($con);
    return $num;
  }
}
?>