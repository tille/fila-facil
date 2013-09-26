<?php
  include 'db/environment.php';
  
  class DAO_turn {

    function DAO_read($mod){
      $con = connect();
      $sql = "SELECT number FROM turn WHERE module='$mod'";
      $arr_res = mysql_query($sql);
      $result = mysql_fetch_array($arr_res);
      disconnect($con);
      return $result[0];
    }

    function DAO_update($mod, $num){
      $modules = array(
        "admisiones" => 1,
        "caja" => 2,
        "cartera" => 3,
        "certificados" => 4,
      );

      if( isset($modules[$mod]) ){
        $con = connect();
        $id_mod = $modules[$mod];
        $sql = "UPDATE turn SET module='$mod',number='$num' WHERE id='$id_mod'";
        $arr_res = mysql_query($sql);
        mysql_close($con);
        return $arr_res;
      }else{
        return 0;
      }
    }
  }
?>