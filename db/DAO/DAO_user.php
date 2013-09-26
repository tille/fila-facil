<?php
// include 'db/environment.php';

class DAO_user{
  // Consulta en la base de datos si existe el usuario que se desea registrar. 
  // Returna 0 si el registro existe, de otro modo returna 1.

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

  function DAO_insert_register($identification, $name, $last_name, $email, $password, $EafitStudent, $rol){
    $con = connect();
    $sql = "INSERT INTO users VALUES('$identification', '$name', '$last_name', '$email', '$password', '$EafitStudent', '$rol');";
    $arr_res = mysql_query($sql);
    mysql_close($con);
    return $arr_res;
  }
  
  function DAO_read_login($identification, $password){
    $con = connect();   // ¿Por qué llama la función directamente?
    $sql = "SELECT identification, password FROM person WHERE identification='$identification' AND password='$password' ";
    $arr_res = mysql_query($sql) or die(mysql_error());
    if(mysql_num_rows($arr_res) > 0){
      // El usuario ya se encuentra registrado.
      disconnect($con);
      return $result = -1;
    }else{
      // El usuario no se encuentra registrado.
      disconnect($con);
      return 1;
    }


  }
}
?>