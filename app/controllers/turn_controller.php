<?php
  include 'app/models/turn.php';
  
  class turn_controller {
    function get_turn($mod){
      $turn = new Turn($mod);
      $turn->read();
      $turn->number++;
      if($turn->update()){
        echo 'is awesome when it works.. now I have a new idea in my mind, which includes guns and Php lovers<br>';
        echo '<h1>Your new turn for '.$mod.': '.$turn->number.'</h1>';
        return $turn->number;
      }else{
        echo 'an epic horse with 5 legs appears... and the update query is not working!';
      }
    }
    
    function parse_model(){
      return 0;
    }
  }
?>