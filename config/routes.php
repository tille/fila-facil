<?php
  include 'app/controllers/turn_controller.php';
  include 'app/controllers/user_controller.php';
  include 'db/environment.php';

  $routes = array(
    "get_turn" => 0,
    "register" => 1,
    "login" => 2,
  );

  function calling($id, $json){
      
    if($id==0){ 
      $params = explode(',',$json);
      return turn_controller::get_turn($params[0]);
    }
    
    if($id==1){
        //$json = '{"identification":1037636955,"name":"Stiven","last_name":"Lopera","email":"jlopera8@eafit.edu.co","password":"12345","EafitStudent":1,"rol":"usuario"}';

      $json = stripslashes($json); 
      $params = json_decode($json);

      $identification = $params->{'identification'};
      $name = $params->{'name'};
      $last_name = $params->{'last_name'};
      $email = $params->{'email'};
      $password = $params->{'password'};
      $Eafit_student = $params->{'Eafit_student'};
      $rol = $params->{'rol'};
            
      // echo $identification;
      // echo $name;
      // echo $last_name;
      // echo $email;
      // echo $password;
      // echo $Eafit_student;
      // echo $rol;
      return user_controller::register_new_user($identification, $name, $last_name, $email, $password, $Eafit_student, $rol);
    }
    /*if($id==2) {
        $identification = $params[0]; 
        $password = $params[1]; 
        user_controller::login($identification, $password);
        /*$identification = (isset($_GET["identification"]))?$_GET["identification"]:"";
        $password = (isset($_GET["password"]))?$_GET["password"]:"";
        echo '<h1> ident: '.$identification.' y pass: '.$password.'</h1>';
        return calling2($routes[$_GET["q"]], $identification, $password);
        //params = (isset($_GET["params"]))?$_GET["params"]:"";
       // return calling($routes[$_GET["q"]], $params);
        
    }*/
    return "";
  }
   ?>
