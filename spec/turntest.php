<?php

require_once '../app/models/turn.php';
require_once '../db/DAO/DAO_turn.php';

class TurnTest extends PHPUnit_Framework_TestCase {
	public function testRead(){
		$mock = $this->getMock('DAO_turn', array('DAO_read'));
		$mock->expects($this->any())
		     ->method('DAO_read')
     		 ->will($this->returnValue(1));
     	$test = new Turn('Caja');
     	$this->number = $mock->DAO_read('Caja');
    	$this->assertGreaterThanOrEqual(0, $this->number);

 	}
}




?>
