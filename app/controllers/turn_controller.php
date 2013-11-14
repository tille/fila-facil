<?php
  include 'app/models/turn.php';
  include 'db/DAO/DAO_turn.php';

  
  class turn_controller {
    
    // ------------- NOTA: cosa fea (no mirar)
      function next_turn_temp($mod){
        
        $actual = DAO_turn::DAO_read_actual_turn($mod);
        if($actual!=0)$insert = turn_controller::insert_history_turn($actual, $mod);
        $deleted = DAO_turn::DAO_delete_expected_turn($mod, $actual);

        if($actual+1 > DAO_turn::DAO_read($mod)){
          // devices board notification
          $actual = turn_controller::get_board();
          $remaining = $remaining = turn_controller::remaining_turns();
          gcm_controller::send_mobile_message($actual, 'actual');
          gcm_controller::send_mobile_message($remaining, 'remaining');

          return -1;
        }
        else {
          $read = DAO_turn::DAO_read_expected_turn($actual+1, $mod);
          $cancelados = 2;
          while ($read == 0) {
            $read = DAO_turn::DAO_read_expected_turn($actual+$cancelados, $mod);
            $cancelados++;
          }
          $result = DAO_turn::DAO_update_actual_turn($mod,$actual+$cancelados-1);
          // devices board notification
          $actual = turn_controller::get_board();
          $remaining = turn_controller::remaining_turns();
          gcm_controller::send_mobile_message($actual, 'actual');
          gcm_controller::send_mobile_message($remaining, 'remaining');

          return $result;
        }
      }
    // ----------------- END
    
    
    function next_turn($user, $pwd, $mod){
      $json_valid_user = user_controller::login($user, $pwd);
      $json_valid_user = stripslashes($json_valid_user);
      $valid_user = json_decode($json_valid_user);
      $user_id = $valid_user->{'identification'};
      if($user_id == -1) return -1;
      
      $actual = DAO_turn::DAO_read_actual_turn($mod);
      if($actual!=0)$insert = turn_controller::insert_history_turn($actual, $mod);
      $deleted = DAO_turn::DAO_delete_expected_turn($mod, $actual);

      if($actual+1 > DAO_turn::DAO_read($mod)){
        // devices board notification
        $actual = turn_controller::get_board();
        $remaining = $remaining = turn_controller::remaining_turns();
        gcm_controller::send_mobile_message($actual, 'actual');
        gcm_controller::send_mobile_message($remaining, 'remaining');
        
        return -1;
      }
      else {
        $read = DAO_turn::DAO_read_expected_turn($actual+1, $mod);
        $cancelados = 2;
        while ($read == 0) {
          $read = DAO_turn::DAO_read_expected_turn($actual+$cancelados, $mod);
          $cancelados++;
        }
        $result = DAO_turn::DAO_update_actual_turn($mod,$actual+$cancelados-1);
        // devices board notification
        $actual = turn_controller::get_board();
        $remaining = turn_controller::remaining_turns();
        gcm_controller::send_mobile_message($actual, 'actual');
        gcm_controller::send_mobile_message($remaining, 'remaining');
        
        return $result;
      }
    }

    function insert_history_turn($turn, $mod){
      $read = DAO_turn::DAO_read_expected_turn($turn, $mod);
      if($read==0)return "no se agrego";
      $mod = $read['module'];
      $expected_turn = $read['expected_turn'];
      $user_id = $read['user_id'];
      $info = $read['Info_Process'];
      $actual_date = date('Y-m-d');
      $final_time = turn_controller::get_time();
      $start_time_array = DAO_turn::DAO_read_start_time($mod);
      $start_time = $start_time_array['start_time'];
      $update_start_time = DAO_turn::DAO_update_start_time($final_time, $mod);
      $insert = DAO_turn::DAO_insert_final_turn($user_id, $expected_turn, $mod, $info, $start_time, $final_time, $actual_date);
      
      return $read;
    }
    
    function get_time(){
      date_default_timezone_set("America/Bogota" ) ; 
      $final_time = date('H:i',time() - 3600*date('I')); 
      return $final_time;
    }

    function get_board() {
      $modules = array('admisiones','caja','cartera','certificados');
      $board = array('admisiones' => 0, 'caja' => 0, 'cartera' => 0, 'certificados' => 0);
      
      for ($i=0 ; $i<4 ; $i++){
        $actual = DAO_turn::DAO_read_actual_turn($modules[$i]);
        $queue = DAO_turn::DAO_count_module_queue($modules[$i]);
        $last_request = DAO_turn::DAO_read($modules[$i]);

        //if( $queue == 0 or $actual == 0 or $last_request-$queue == $actual) $board[$modules[$i]] = -1;
        if( $queue == 0 or $actual == 0 or $last_request + 1 == $actual) $board[$modules[$i]] = -1;
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
    
    function get_user_by_turn($turn, $module){
      $user = DAO_turn::DAO_get_user_by_turn($turn, $module);
      return $user;
    }
    
    function get_turn($user, $pwd, $mod, $info){
      if($mod != "admisiones" && $mod != "caja" && $mod != "cartera" && $mod != "certificados" ) return "";
      $existence_of_request_turn = DAO_turn::DAO_existence_turn($user, $mod);
      // NOTA: reducir estas 4 lineas que estan feas
      $json_valid_user = user_controller::login($user, $pwd);
      $json_valid_user = stripslashes($json_valid_user);
      $valid_user = json_decode($json_valid_user);
      $user_id = $valid_user->{'identification'};
      if( $existence_of_request_turn == 0 && $user_id != -1 ){
        $response = DAO_turn::DAO_new_expected_turn( $mod, $user_id, $info );
        $queue = turn_controller::remaining_turns();
        gcm_controller::send_mobile_message($queue, 'remaining');
        return $response;
      }
      
      return -1;
    }

    function delete_turn($identification, $pwd, $turn, $mod){
      if($mod != "admisiones" && $mod != "caja" && $mod != "cartera" && $mod != "certificados" ) return '-1';
      $json_user_exists = DAO_user::DAO_read_login($identification, $pwd);
      $user_exists = json_decode($json_user_exists);
      $user_id = $user_exists->{'identification'};
      if($user_id == '-1')return '-1';
      $cancel_turn = DAO_turn::DAO_cancel_expected_turn($identification, $mod, $turn);
      if ($cancel_turn == 1) {
        $queue = turn_controller::remaining_turns();
        gcm_controller::send_mobile_message($queue, 'remaining');
      }
      return $cancel_turn;
    }

    function get_info_procedures(){
      $json_user = array('admisiones'=>"",'caja'=>"",'cartera'=>"",'certificados'=>"");
      $modules = array(
        0 => "admisiones",
        1 => "caja",
        2 => "cartera",
        3 => "certificados",
      );
      for($i=0; $i<4; $i++){
        $result = DAO_turn::get_info_procedures($modules[$i]);
        $json_user[$modules[$i]] = utf8_encode($result);
      }
      $json_user = json_encode($json_user);
      return $json_user;
    }
  }
?>