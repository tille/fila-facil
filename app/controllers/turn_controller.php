<?php
  include 'app/models/turn.php';
  include 'db/DAO/DAO_turn.php';
  
  class turn_controller {
    
    function next_turn($user, $pwd, $mod){
      $json_valid_user = user_controller::login($user, $pwd);
      $json_valid_user = stripslashes($json_valid_user);
      $valid_user = json_decode($json_valid_user);
      $user_id = $valid_user->{'identification'};
      if($user_id == -1) return -1;
      
      $actual = DAO_turn::DAO_read_actual_turn($mod);
      $deleted = DAO_turn::DAO_delete_expected_turn($mod, $actual);
      if( $actual+1 > DAO_turn::DAO_read($mod) ){
		$actual = turn_controller::get_board();
		$remaining = $remaining = turn_controller::remaining_turns();
		gcm_controller::send_mobile_message($actual, 'actual');
		gcm_controller::send_mobile_message($remaining, 'remaining');
        return -1;
      }else{
        $result = DAO_turn::DAO_update_actual_turn($mod,$actual+1);
		$actual = turn_controller::get_board();
		$remaining = turn_controller::remaining_turns();
		gcm_controller::send_mobile_message($actual, 'actual');
		gcm_controller::send_mobile_message($remaining, 'remaining');
		return $result;
      }
    }
    
    function get_board() {
      $modules = array('admisiones','caja','cartera','certificados');
      $board = array('admisiones' => 0, 'caja' => 0, 'cartera' => 0, 'certificados' => 0);
      
      for ( $i=0 ; $i<4 ; $i++){
        $actual = DAO_turn::DAO_read_actual_turn($modules[$i]);
        $queue = DAO_turn::DAO_count_module_queue($modules[$i]);
        $last_request = DAO_turn::DAO_read($modules[$i]);
        if( $queue == 0 or $actual == 0 or $last_request-$queue == $actual ) $board[$modules[$i]] = -1;
        else $board[$modules[$i]] = $actual;
      }
      
      return json_encode($board);
    }
    
    function remaining_turns(){
      $modules = array('admisiones','caja','cartera','certificados');
      $board = array('admisiones' => 0, 'caja' => 0, 'cartera' => 0, 'certificados' => 0);
      
      for ( $i=0 ; $i<4 ; $i++){
        $queue = DAO_turn::DAO_count_module_queue($modules[$i]);
        $board[$modules[$i]] = $queue;
      }
      
      return json_encode($board);
    }
    
    function get_turn( $user, $pwd, $mod ){
      if($mod != "admisiones" && $mod != "caja" && $mod != "cartera" && $mod != "certificados" ) return "";
      $existence_of_request_turn = DAO_turn::DAO_existence_turn($user, $mod);

      // NOTA: reducir estas 4 lineas que estan feas
      $json_valid_user = user_controller::login($user, $pwd);
      $json_valid_user = stripslashes($json_valid_user);
      $valid_user = json_decode($json_valid_user);
      $user_id = $valid_user->{'identification'};
      
      if( $existence_of_request_turn == 0 && $user_id != -1 ){
        $response = DAO_turn::DAO_new_expected_turn( $mod, $user_id );
        $queue = turn_controller::remaining_turns();
        gcm_controller::send_mobile_message($queue, 'remaining');
		return $response;
      }
      
      return -1;
    }
  }
?>