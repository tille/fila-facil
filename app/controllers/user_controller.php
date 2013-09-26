<?php
include 'app/models/user.php';
include 'db/DAO/DAO_user.php'

class user_controller {

  function register_new_user($identification, $name, $last_name, $email, $password, $EafitStudent, $rol){   
    //echo 'Entro register_new user';
    $read = DAO_user::DAO_read_register($identification);
    // echo 'Paso register';

    if( $read == 1){
      // se registra el usuario
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

    /* $user = new User($identification);
    if($user->read_register() == 1){
    // se debe registrar el usuario


$user->name = $name;
$user->last_name = $last_name;
$user->email = $email;
$user->password = $password;
$user->EafitStudent = $EafitStudent;
$user->rol = $rol;

if($user->insert_register()){
$answer = "registro completo";
echo 'Usuario registrado';
return $answer;
}
else {
echo 'El usuario no se registró';

}
}else{
// El usuario ya existe.
$answer = "el usuario ya existe";
echo '<h1>Error'.$answer.'</h1>';
return $answer;
}*/
}

/*function login($identification, $password){
$user = new User1($identification, $password);
if($user->read_login() == -1){
// login correcto. 
return "right login";
}else{
// el usuario no se encuentra registrado
return  "error in login";
}
}
function parse_model(){
return 0;
}*/
}
?>