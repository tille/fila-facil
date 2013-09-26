<?php
include 'app/models/user.php';
include 'db/DAO/DAO_user.php';

class user_controller {

  function register_new_user($identification, $name, $last_name, $email, $password, $Eafit_student, $rol){   
    $user_exist = DAO_user::DAO_user_exist($identification);

    if( $user_exist == 1 ){
      // $user = new User($identification, $name, $last_name, $email, $password, $Eafit_student, $rol);
      $registered = DAO_user::DAO_insert_register($identification, $name, $last_name, $email, $password, $Eafit_student, $rol );

      if( $registered ) $answer = 'usuario registrado';
      else $answer ='error: no se registro el usuario correctamente';      
      return $answer;
      
    }else{
      $answer = 'El usuario ya existe';
      return $answer;
    }
    
  }
}

?>