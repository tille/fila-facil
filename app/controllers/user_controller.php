<?php
include 'app/models/user.php';
include 'db/DAO/DAO_user.php';

class user_controller {

  /* if $user_exists == 1 mean that user will be registered
     because there are no users with the same nickname
     the method return 1 when the registration proccess finishied done */
  function register_new_user($p1, $p2, $p3, $p4, $p5, $p6, $p7){   
    $user_exists = DAO_user::DAO_user_exist($p1);

    if( $user_exists == 1 ){
      $registered = DAO_user::DAO_insert_register($p1, $p2, $p3, $p4, $p5, $p6, $p7 );
      if( $registered == 1 ) $ans = '1';
      else $ans ='0';      
    }else $ans = '0';
    
    return $ans;
  }
    
  // if $valid_user == 1 login is correct
  // return a Json with the selected user or error if the info doesn't match
  function login($user_id, $pwd){
    $user = DAO_user::DAO_read_login($user_id, $pwd);
    // if($user == 1) return "1";
    // return "0";
    return "0";
  }
  
}

?>