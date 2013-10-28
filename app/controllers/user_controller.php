<?php
include 'app/models/user.php';
include 'db/DAO/DAO_user.php';
ob_start();

class user_controller {

  /* if $user_exists == 1 mean that user will be registered
     because there are no users with the same nickname
     the method return 1 when the registration proccess finish done */
  function register_new_user($p1, $p2, $p3, $p4, $p5, $p6, $p7){   
    $user_exists = DAO_user::DAO_user_exist($p1);
    
    $ans ='0';
    if( $user_exists == 1 ){
      $registered = DAO_user::DAO_insert_register($p1, $p2, $p3, $p4, $p5, $p6, $p7);
      if( $registered == 1 )
        $ans = '1';
    }
    
    return $ans;
  }
  
  function set_user_device($identification, $gcm_regid) {
    $res = DAO_user::DAO_set_device($identification, $gcm_regid);
    return $res;
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
      
      user_controller::fill_sessions($p1, $p2, $p3, $p4, $p7, $p8);
      
      if($_SESSION['rol'] == "admin"){
        header('Location: '."http://localhost:8888/ff/app/views/user/admin.php");
      }else if($_SESSION['rol'] == "operario"){
        $success = user_controller::change_operator_state($p1,1);
        header('Location: '."http://localhost:8888/ff/app/views/user/operator.php");
      }else{
        header('Location: '."http://localhost:8888/ff/app/views/user/login.php?q=login-invalid");
      }
    }else{
      header('Location: '."http://localhost:8888/ff/app/views/user/login.php?q=login-invalid");
    }
  }
  
  function fill_sessions($id, $name, $surname, $email, $rol, $password){
    session_destroy();
    session_start();
    $_SESSION['id']=$id;
    $_SESSION['name']=$name;
    $_SESSION['surname']=$surname;
    $_SESSION['email']=$email;
    $_SESSION['rol']=$rol;
  }
  
  function register_operator($id, $name, $surname, $email, $pwd, $module){
    $valid = DAO_user::DAO_module_operator_exist($module);
    if($valid != 1) return 0;
    $success = user_controller::register_new_user($id, $name, $surname, $email, $pwd, 0, "operario");
    $success_active = DAO_user::DAO_new_active_operator($id, $module);
    return ($success=="1" && $success_active =="1");
  }
  
  function get_operators(){
    $operators_active = DAO_user::DAO_read_active_operators("active");
    $operators_inactive = DAO_user::DAO_read_active_operators("inactive");
    return $operators_inactive."?".$operators_active;
  }
  
  function change_operator_state($user_id, $active){
    $success = DAO_user::DAO_change_state($user_id, $active);
    return $success;
  }
}

?>