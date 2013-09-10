<?php
  include 'app/controllers/turn_controller.php';

  $routes = array(
    "get_turn" => turn_controller::get_turn(),
  );
?>