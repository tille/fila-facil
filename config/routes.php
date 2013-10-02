<?php
  include 'app/controllers/turn_controller.php';
  include 'app/controllers/user_controller.php';
  include 'db/environment.php';

  $routes = array(
    "get_turn" => 0,
    "register" => 1,
    "login" => 2,
    "board_status" => 3,
    "next_turn" => 4,
  );

  // NOTA: recordar validar en cada servicio cuando no le llegan la cantidad de parametros
  // necesarios y validaciones para caracteres especiales y el orden en el que llegan lo parametros
  function calling($id, $json){
      
    if($id==0){ 
      $json = stripslashes($json);
      $params = json_decode($json);

      echo $json;
      $user = $params->{'user'};
      $pwd  = md5( $params->{'pwd'} );
      $mod = $params->{'mod'};
      
      return turn_controller::get_turn($user,$pwd,$mod);
    }
    
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
      
    }

    return "";
  }
   ?>
