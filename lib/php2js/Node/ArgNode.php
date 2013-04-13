<?php
	
namespace php2js\Node;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class ArgNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Arg $phpnode) {
		$result = new CompilerResult();
		$result->put($this->getCompiler()->compileNode($phpnode->value));
		return $result;
	}
}