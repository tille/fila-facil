<?php
  include 'app/controllers/turn_controller.php';

  $routes = array(
    "get_turn" => 0,
  );

  function calling($id, $params){
    $params = explode(',',$params);
    if($id==0) return turn_controller::get_turn($params[0]);
    return "";
  }
?>