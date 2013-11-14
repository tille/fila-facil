<?php
require_once 'config/gcm.php';
require_once 'db/DAO/DAO_gcm.php';

class gcm_controller {
  
  function send_mobile_message($message, $tag){
    $ids = DAO_gcm::DAO_get_devices();
    $registration_ids = explode(",", $ids);

    //ACÁ ES DONDE SE PUEDEN MANDAR MUCHOS MENSAJES EN EL ARREGLO
    $message = array($tag => $message);
    
    $result = gcm_controller::send_notification($registration_ids, $message);
    return $result;
  }
  
  function send_specific_mobile_message($regId, $requested) {
    if ($requested == "all") {
      $remaining = turn_controller::remaining_turns();
      $actual = turn_controller::get_board();
      $message = array('remaining' => $remaining, 'actual' => $actual);
      return gcm_controller::send_notification(array($regId), $message);
    }
    return "";
  }

  function send_specific_mobile_absence($user, $module) {
    $regId = DAO_gcm::DAO_get_device_by_user($user);
    $message = array('absence' => $module);
    return gcm_controller::send_notification(array($regId), $message);
  }
  
  function send_notification($registatoin_ids, $message) {
    $url = 'https://android.googleapis.com/gcm/send';
    
    $fields = array(
      'registration_ids' => $registatoin_ids,
      'data' => $message,
    );
    
    $headers = array(
      'Authorization: key=' . GOOGLE_API_KEY,
      'Content-Type: application/json'
    );
    
    $ch = curl_init();
    
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
    return $result;
  }
}
?>