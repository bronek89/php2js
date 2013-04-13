<?php
	
namespace php2js\Node\Scalar;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class StringNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Scalar_String $phpnode) {
		$result = new CompilerResult();
		$result->put("'$phpnode->value'");
		return $result;
	}
}