<?php
//include 'db/DAO/DAO_user.php';

  class User {
    var $identification, $name, $last_name, $email, $password, $EafitStudent, $rol;
    
    function __contruct($id, $name, $last_name, $email, $password, $EafitStudent, $rol){
      $this->identification = $id;
       $this->name = $name;
       $this->last_name = $last_name;
       $this->email = $email;
       $this->password = $password;
       $this->EafitStudent = $EafitStudent;
       $this->rol = $rol;
    }
    
    
    /*function read(){
      $this->number = DAO_turn::DAO_read($this->module);
      return $this->number;
    }
    
    function update(){
      return DAO_turn::DAO_update($this->module, $this->number);
    }*/
  }
?>
