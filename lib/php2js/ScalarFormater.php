<?php
	
namespace php2js;
	
class ScalarFormater {
	private $compiler;
	
	/**
	 * @return Compiler
	 */
	public function getCompiler() {
		return $this->compiler;
	}

	public function setCompiler($compiler) {
		$this->compiler = $compiler;
	}
	
	public function format($mValue) {
		if ($mValue instanceof \PHPParser_Node) {
			return $this->getCompiler()->compileNode($mValue);
		} else if (is_null($mValue)) {
			return 'null';
		} else if (is_string($mValue)) {
			return '"'.$mValue.'"';
		} else {
			return $mValue;
		}
	}
}