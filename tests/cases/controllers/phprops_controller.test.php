<?php 
/* SVN FILE: $Id$ */
/* PhpropsController Test cases generated on: 2010-11-15 13:05:48 : 1289826348*/
App::import('Controller', 'Phprop.Phprops');

class TestPhprops extends PhpropsController {
	var $autoRender = false;
	var $plugin = 'Content';
}

class PhpropsControllerTest extends CakeTestCase {
	var $Phprops = null;

	function startTest() {
		$this->Phprops = new TestPhprops();
		$this->Phprops->constructClasses();
	}

	function testPhpropsControllerInstance() {
		$this->assertTrue(is_a($this->Phprops, 'PhpropsController'));
	}

	function endTest() {
		unset($this->Phprops);
	}
}
?>