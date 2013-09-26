<?php
  include 'app/models/turn.php';
  include 'db/DAO/DAO_turn.php';
  
  class turn_controller {
    function get_turn($mod){
      if($mod != "admisiones" && $mod != "caja" && $mod != "cartera" && $mod != "certificados" ) return "";
      $turn = new Turn($mod);
      $turn->read();
      $turn->number++;
      if($turn->update()) return $turn->number;
      else return "";
    }
    
    function get_board() {
      $modules = array('admisiones','caja','cartera','certificados');
      $board = array('admisiones' => 0, 'caja' => 0, 'cartera' => 0, 'certificados' => 0);
      
      for ( $i=0 ; $i<4 ; $i++)
        $board[$modules[$i]] = DAO_turn::DAO_read($modules[$i]);
      
      return json_encode($board);
    }
  }
?>