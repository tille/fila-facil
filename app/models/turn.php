<?php
  class Turn {
    var $module, $number = null;
    
    function Turn($mod){
      $this->module = $mod;
    }
    
    function read(){
      $this->number = DAO_turn::DAO_read($this->module);
      return $this->number;
    }
    
    function update(){
      return DAO_turn::DAO_update($this->module, $this->number);
    }
  }
?>