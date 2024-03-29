<?php
  include 'app/controllers/turn_controller.php';
  include 'app/controllers/user_controller.php';
  include 'app/controllers/gcm_controller.php';
  include 'db/environment.php';

  $routes = array(
    "get_turn" => 0,
    "register" => 1,
    "login" => 2,
    "board_status" => 3,
    "next_turn" => 4,
    "remaining_turns" => 5,
    "login_and_redirect" => 6, /* is always redirecting don't return */
    "register_operator" => 7,
    "register_device" => 8,
    "get_operators" => 9,
    "device_message" => 10,
    "change_operator_state" => 11, /* is always redirecting don't return */
    "get_user" => 12,
    "delete_turn" => 13,
    "get_info_procedures" =>14,
    "next_turn_only_user" =>15,
    "user_absence" =>16,
  );

  // NOTA: recordar validar en cada servicio cuando no le llegan la cantidad de parametros
  // necesarios y validaciones para caracteres especiales y el orden en el que llegan lo parametros
  function calling($id, $json){
      
    if($id==0){ 
      $json = stripslashes($json);
      $params = json_decode($json);
      $user = $params->{'user'};
      $pwd  = md5( $params->{'pwd'} );
      $mod = $params->{'mod'};
      $info = $params->{'info'};
      return turn_controller::get_turn($user,$pwd,$mod,$info);
    }
    
    // NOTA: validar que atraves de este servicio no se puedan agregar operarios ni administradores
    if($id==1){
      $json = stripslashes($json); 
      $params = json_decode($json);

      $p1 = $params->{'identification'};
      $p2 = $params->{'name'};
      $p3 = $params->{'last_name'};
      $p4 = $params->{'email'};
      $p5 = $params->{'password'};
      $p6 = $params->{'Eafit_student'};
      $p7 = $params->{'rol'};
        
      return user_controller::register_new_user($p1, $p2, $p3, $p4, $p5, $p6, $p7);
    }
    
    if($id==2) {
      $params = explode(',',$json);
      $user_id = $params[0];
      //$pwd = $params[1];
      $pwd = md5($params[1]);
      
      return user_controller::login($user_id, $pwd);
    }
    
    # NOTA: falta algoritmo para estimar tiempo
    if($id==3)
      return turn_controller::get_board();
      
    if($id==4){
      $json = stripslashes($json);
      $params = json_decode($json);

      $user = $params->{'user'};
      $pwd  = md5( $params->{'pwd'} );
      $mod = $params->{'mod'};
            
      return turn_controller::next_turn($user,$pwd,$mod);
    }

    if($id==5){
      return turn_controller::remaining_turns();
    }
    
    if($id==6){
      $params = explode(',',$json);
      $user_id = $params[0];
      $pwd = md5($params[1]);
      
      return user_controller::login_and_redirect($user_id, $pwd);
    }
    
    // NOTA: validar que lleguen los parametros necesarios en el json
    if($id==7){
      session_start();
      
      if( isset($_SESSION['rol']) && $_SESSION['rol'] == "admin" ){
        $p = explode(',',$json);
        return user_controller::register_operator($p[0], $p[1], $p[2], $p[3], $p[4], $p[5]);
      }
    }
    
    if ($id==8) {
      $json = stripslashes($json); 
      $params = json_decode($json);
      
      $identification = $params->{'identification'};
      $gcm_regid = $params->{'regId'};
      
      return user_controller::set_user_device($identification, $gcm_regid);
    }
    
    if($id==9){
      return user_controller::get_operators();
    }
    
    if($id==10){
      $json = stripslashes($json); 
      $params = json_decode($json);
      
      $regId = $params->{'regId'};
      $requested = $params->{'requested'};
      
      return gcm_controller::send_specific_mobile_message($regId, $requested);
    }
    
    if($id==11){
      $p = explode(',',$json);
      $success = user_controller::change_operator_state($p[0], $p[1]);
      header('Location: '."http://localhost:8888/ff/index.php");
    }
    
    if($id==12){
      $params = explode(',',$json);
      return turn_controller::get_user_by_turn($params[0], $params[1]);
    }
    
    if($id==13){
      $json = stripslashes($json); 
      $params = json_decode($json);
      $user_id = $params->{'identification'};
      $password = $params->{'password'};
      $turn = $params->{'turn'};
      $mod = $params->{'module'};
      $password_md5 = md5($password);
      return turn_controller::delete_turn($user_id, $password_md5, $turn, $mod);
    }

    if($id==14){
      return turn_controller::get_info_procedures();
    }

    // NOTA: pensar en alguna manera de hacerlo mejor con validaciones de user y pwd
    if($id==15){      
      return turn_controller::next_turn_temp($json);
    }
    
    if($id==16){
      $params = explode(',',$json);
      $user_id = $params[0];
      $mod = $params[1];
      gcm_controller::send_specific_mobile_absence($user_id, $mod);
      return user_controller::absence_of_user($user_id);
    }
    // End validaciones necesarias
    
    return "";
  }
   ?>
