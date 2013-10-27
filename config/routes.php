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
    "remaining_turns" => 5,
    "login_and_redirect" => 6,
    "register_operator" => 7,
	"register_device" => 8,
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
      
      return turn_controller::get_turn($user,$pwd,$mod);
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

    if($id==5)
      return turn_controller::remaining_turns();
      
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
    
    return "";
  }
   ?>
