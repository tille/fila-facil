<?php
  include 'app/models/turn.php';
  
  class turn_controller {
    function get_turn($mod){
      if($mod != "admisiones" && $mod != "caja" && $mod != "cartera" && $mod != "certificados" ) return "";
      $turn = new Turn($mod);
      $turn->read();
      $turn->number++;
      if($turn->update()) return $turn->number;
      else return "";
    }
    
    function parse_model(){
      return 0;
    }
  }
?>