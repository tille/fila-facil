<?php
  include 'config/routes.php';
  
  if( isset($_GET["q"]) && isset($routes[$_GET["q"]]) ){
      $service = $routes[$_GET["q"]];
      if($service == 0){
        echo '<h1>El servicio es '.$service.'</h1>';
        $params = (isset($_GET["params"]))?$_GET["params"]:"";
        //echo '<h1>El servicio es '.$params.'</h1>';
        return calling($routes[$_GET["q"]], $params);
        
      }else if ($service == 1) {
        echo '<h1>El servicio es '.$service.'</h1>';
       //$json = '{"identification":1037636955,"name":"Stiven","last_name":"Lopera",
         // "email":"jlopera8@eafit.edu.co","password":"12345","EafitStudent":1,"rol":"usuario"}';
       $json = (isset($_GET["params"]))?$_GET["params"]:"";
        return calling($service,$json);
        
      }else if ($service == 2) {
        echo '<h1>El servicio es '.$service.'</h1>';
        $identification = (isset($_GET["identification"]))?$_GET["identification"]:"";
        $password = (isset($_GET["password"]))?$_GET["password"]:"";
        echo '<h1> ident: '.$identification.' y pass: '.$password.'</h1>';
        return calling2($routes[$_GET["q"]], $identification, $password);
        //params = (isset($_GET["params"]))?$_GET["params"]:"";
       // return calling($routes[$_GET["q"]], $params);
        
      }else {
        echo "is not available service";
        return "is not available service";
      }
  }else{
    echo "Please specify a valid service!";
    return "Please specify a valid service!";
  }
?>