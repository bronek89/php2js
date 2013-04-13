<?php
	
namespace php2js\Node\Scalar;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class LNumberNode extends NodeAbstract {
	public function compileNode(\PHPParser_NodeAbstract $phpnode) {
		$result = new CompilerResult();
		$result->put($phpnode->value);
		return $result;
	}
}