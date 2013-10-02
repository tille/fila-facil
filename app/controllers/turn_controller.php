<?php
  include 'app/models/turn.php';
  include 'db/DAO/DAO_turn.php';
  
  class turn_controller {
    
    function next_turn($mod){
      $actual = DAO_turn::DAO_read_actual_turn($mod);
      
    }
    
    function get_board() {
      $modules = array('admisiones','caja','cartera','certificados');
      $board = array('admisiones' => 0, 'caja' => 0, 'cartera' => 0, 'certificados' => 0);
      
      for ( $i=0 ; $i<4 ; $i++)
        $board[$modules[$i]] = DAO_turn::DAO_read($modules[$i]);
      
      return json_encode($board);
    }
    
    function get_turn( $user, $pwd, $mod ){
      if($mod != "admisiones" && $mod != "caja" && $mod != "cartera" && $mod != "certificados" ) return "";
      $existence_of_request_turn = DAO_turn::DAO_existence_turn($user, $mod);

      // NOTA: limpiar esto que esta feo
      $json_valid_user = user_controller::login($user, $pwd);
      $json_valid_user = stripslashes($json_valid_user);
      $valid_user = json_decode($json_valid_user);
      $user_id = $valid_user->{'identification'};
      
      if( $existence_of_request_turn == 0 && $user_id != -1 )
        return DAO_turn::DAO_new_expected_turn( $mod, $user_id );

      return "";
    }
  }
?>