<?php
	
namespace php2js;
	
class NameStack {
	private $names = array();
	
	public function addName($name) {
		$this->names[] = $name;
	}
	
	public function isNameExists($name) {
		return in_array($name, $this->names);
	}
}