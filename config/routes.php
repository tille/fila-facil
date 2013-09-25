<?php
  include 'app/controllers/turn_controller.php';
  include 'app/controllers/user_controller.php';

  $routes = array(
    "get_turn" => 0,
    "register_new_user" => 1,
    "login" => 2,
  );

  function calling($id, $json){
    
    
    if($id==0){
        $params = explode(',',$json);
        var_dump($params);
        turn_controller::get_turn($params[0]);
    }
    if($id==1) {
        $params = json_decode($json);
        $identification = $params->{'identification'};
        $name = $params->{'name'};
        $last_name = $params->{'last_name'};
        $email = $params->{'email'};
        $password = $params->{'password'};
        $EafitStudent = $params->{'EafitStudent'};
        $rol = $params->{'rol'};
       echo $identification;
       echo $name;
       echo $last_name;
       echo $email;
       echo $password;
       echo $EafitStudent;
       echo $rol;
  	user_controller::register_new_user($identification, $name, $last_name, 
           $email, $password, $EafitStudent, $rol);
    }
    if($id==2) {
        $identification = $params[0]; 
        $password = $params[1]; 
        user_controller::login($identification, $password);
    }
  }

   ?>