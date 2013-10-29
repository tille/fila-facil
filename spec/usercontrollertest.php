<?php

require_once '../app/controllers/user_controller.php';
require_once '../db/DAO/DAO_user.php';
require_once '../app/models/user.php';
require_once '../db/DAO/DAO_user.php';



class UserControllerTest extends PHPUnit_Framework_TestCase {
    
    public function testInsertRegisterUserAcceptedAndUserExistAccepted(){
    	$exist = $this->getMock('DAO_user', array('DAO_user_exist'));
		$exist->expects($this->any())
     		->method('DAO_user_exist')
     		->will($this->returnValue(1));

     	$register = $this->getMock('DAO_user', array('DAO_insert_register'));
		$register->expects($this->any())
     		->method('DAO_insert_register')
     		->will($this->returnValue(1));

     	$user_exist = $exist->DAO_user_exist('1');
     	$ans = '0';
     	if( $user_exist == 1 ){
     		$registered = $register->DAO_insert_register('1','1','1','1','1','1','1');
     		if($registered == 1)$ans = '1';
     	}
     	$this->assertEquals(1, $ans);
    }

    public function testInsertRegisterUserFailAndUserExistAccepted(){
    	$exist = $this->getMock('DAO_user', array('DAO_user_exist'));
		$exist->expects($this->any())
     		->method('DAO_user_exist')
     		->will($this->returnValue(1));

     	$register = $this->getMock('DAO_user', array('DAO_insert_register'));
		$register->expects($this->any())
     		->method('DAO_insert_register')
     		->will($this->returnValue(0));

     	$user_exist = $exist->DAO_user_exist('1');
     	$ans = '0';
     	if( $user_exist == 1 ){
     		$registered = $register->DAO_insert_register('1','1','1','1','1','1','1');
     		if($registered == 1)$ans = '1';
     	}
     	$this->assertEquals(0, $ans);
    }

    public function testUserExistFail(){
    	$exist = $this->getMock('DAO_user', array('DAO_user_exist'));
		$exist->expects($this->any())
     		->method('DAO_user_exist')
     		->will($this->returnValue(0));

     	$register = $this->getMock('DAO_user', array('DAO_insert_register'));
		$register->expects($this->any())
     		->method('DAO_insert_register')
     		->will($this->returnValue(1));

     	$user_exist = $exist->DAO_user_exist('1');
     	$ans = '0';
     	if( $user_exist == 1 ){
     		$registered = $register->DAO_insert_register('1','1','1','1','1','1','1');
     		if($registered == 1)$ans = '1';
     	}
     	$this->assertEquals(0, $ans);
    }

    public function testLoginFail(){
      $json_user = array('identification'=>0,'name'=>"", 'last_name'=>"", 'email'=>"", 'Eafit_student'=>0, 'rol'=>"");
      $json_user['identification'] = '-1';
      $json_user['name'] = 'Carmen';
      $json_user = json_encode($json_user);
    	$exist = $this->getMock('user_controller', array('login'));
		$exist->expects($this->any())
     		->method('login')
     		->will($this->returnValue($json_user));	
      $user_json = $exist->login('1', '1');
      $ans = '0';
      $params = json_decode($user_json);	
      $p1 = $params->{'identification'};	
      if($p1 != -1) $ans = '1';	
      $this->assertEquals(0, $ans);	

    }

    public function testLoginAccepted(){
      $json_user = array('identification'=>0,'name'=>"", 'last_name'=>"", 'email'=>"", 'Eafit_student'=>0, 'rol'=>"");
      $json_user['identification'] = '1';
      $json_user['name'] = 'Carmen';
      $json_user = json_encode($json_user);
    	$exist = $this->getMock('user_controller', array('login'));
		$exist->expects($this->any())
     		->method('login')
     		->will($this->returnValue($json_user));	
      $user_json = $exist->login('1', '1');
      $ans = '0';
      $params = json_decode($user_json);	
      $p1 = $params->{'identification'};	
      if($p1 != -1) $ans = '1';	
      $this->assertEquals(1, $ans);	
    }       
}




?>
