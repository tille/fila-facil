<?php
include 'app/models/user.php';
include 'db/DAO/DAO_user.php';
ob_start();

class user_controller {

  /* if $user_exists == 1 mean that user will be registered
     because there are no users with the same nickname
     the method return 1 when the registration proccess finishied done */
  function register_new_user($p1, $p2, $p3, $p4, $p5, $p6, $p7){   
    $user_exists = DAO_user::DAO_user_exist($p1);

    $ans ='0';
    if( $user_exists == 1 ){
      $registered = DAO_user::DAO_insert_register($p1, $p2, $p3, $p4, $p5, $p6, $p7 );
      if( $registered == 1 )
        $ans = '1';
    }
    
    return $ans;
  }
    
  /* if $valid_user == 1 login is correct
     return a Json filled with the info of the selected user
     return {"identification":-1} if the info doesn't match */
  function login($user_id, $pwd){
    $user = DAO_user::DAO_read_login($user_id, $pwd);
    return $user;
  }
  
  /* didn't return nothing, is always redirecting to 
     views/user/admin.php or views/user/operator.php if the params are valid
     else is redirecting to views/user/login.php with param invalid-login */
  function login_and_redirect($user_id, $pwd){
    $user_json = user_controller::login($user_id, $pwd);
    $params = json_decode($user_json);
    
    $p1 = $params->{'identification'};
    
    if($p1 != -1){
      $p2 = $params->{'name'};
      $p3 = $params->{'last_name'};
      $p4 = $params->{'email'};
      $p7 = $params->{'rol'};
      
      user_controller::fill_sessions($p1, $p2, $p3, $p4, $p7);
      
      if($_SESSION['rol'] == "admin"){
        header('Location: '."http://localhost:8888/ff/app/views/user/admin.php");
      }else if($_SESSION['rol'] == "operario"){
        header('Location: '."http://localhost:8888/ff/app/views/user/operator.php");
      }else{
        header('Location: '."http://localhost:8888/ff/app/views/user/login.php?q=login-invalid");
      }
    }else{
      header('Location: '."http://localhost:8888/ff/app/views/user/login.php?q=login-invalid");
    }
  }
  
  function fill_sessions($id, $name, $surname, $email, $rol){
    session_destroy();
    session_start();
    $_SESSION['id']=$id;
    $_SESSION['name']=$name;
    $_SESSION['surname']=$surname;
    $_SESSION['email']=$email;
    $_SESSION['rol']=$rol;
  }
  
  function register_operator($id, $name, $surname, $email, $pwd){
    $success = user_controller::register_new_user($id, $name, $surname, $email, $pwd, 0, "operario");
    $success_active = DAO_user::DAO_new_active_operator($id);
    return ($success=="1" && $success_active =="1");
  }
  
}

?>