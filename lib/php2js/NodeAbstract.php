<?php
	
namespace php2js;
	
class NodeAbstract {
	/**
	 * @var Compiler
	 */
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

	/**
	 * @param \PHPParser_Node $phpnode
	 * @return \php2js\CompilerResult
	 */
	public function compileNode(\PHPParser_Node $phpnode) {
		return new CompilerResult("/** unsupported code **/");
	}

	/**
	 * @param \PHPParser_Node $phpnode
	 * @return \php2js\CompilerResult
	 */
	public function compileNodeChildren(\PHPParser_Node $phpnode) {
		$result = new CompilerResult();
		
		foreach ($phpnode as $childphpnode) {
			$result->add($this->getCompiler()->compileNode($childphpnode));
		}
		
		return $result;
	}
}