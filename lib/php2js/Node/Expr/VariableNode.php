<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class VariableNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_Variable $phpnode) {
		$result = new CompilerResult();
		$result->put('$'.$phpnode->name);
		return $result;
	}
}