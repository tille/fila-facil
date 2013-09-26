<?php

include 'app/models/user.php';
include 'db/DAO/DAO_user.php'

class user_controller {

  function register_new_user($identification, $name, $last_name, $email, $password, $EafitStudent, $rol){   
    //echo 'Entro register_new user';
    $read = DAO_user::DAO_read_register($identification);
    // echo 'Paso register';

    if( $read == 1){
      $user = new User($identification, $name, $last_name, $email, $password, $EafitStudent, $rol);
      if(DAO_user::DAO_insert_register($user->identification, $user->name, $user->last_name, $user->email,
      $user->password, $user->EafitStudent, $user->rol)){

        $answer = 'usuario registrado';
        echo $answer;
        return $answer; 
      }  else {
        $answer ='error: no se registro el usuario correctamente';
        echo $answer;
        return $answer;
      }
    }else{
      $answer = 'el usuario ya existe';
      echo $answer;
      return $answer;

    }
  }
}

?>