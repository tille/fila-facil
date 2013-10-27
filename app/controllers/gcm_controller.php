<?php
require_once ''; // cargar un dao para gcm

class gcm_controller {
  
  function send_movil_message($message, $tag){
    $registation_ids = ClaseDAO::metodo_jalar_reg_ids(); // se necesita parsear con explode
    
    //ACÁ ES DONDE SE PUEDEN MANDAR MUCHOS MENSAJES EN EL ARREGLO
    $message = array($tag => $message);
    
    $result = gcm_controller::send_notification($registatoin_ids, $message);
    return $result;
  }
  
  /**
  * Sending Push Notification
  */
  function send_notification($registatoin_ids, $message) {
  
    // include config
    // arriba y con require once
    include_once './config/gcm.php';
    
    // Set POST variables
    $url = 'https://android.googleapis.com/gcm/send';
    
    $fields = array(
      'registration_ids' => $registatoin_ids,
      'data' => $message,
    );
    
    $headers = array(
      'Authorization: key=' . GOOGLE_API_KEY,
      'Content-Type: application/json'
    );
    
    // Open connection
    $ch = curl_init();
    
    
    // Set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Disabling SSL Certificate support temporarly
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    
    // Execute post
    $result = curl_exec($ch);
    if ($result === FALSE) {
      die('Curl failed: ' . curl_error($ch));
    }
    
    // Close connection
    curl_close($ch);
    echo $result;
  }
}
?>