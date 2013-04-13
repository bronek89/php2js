<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class MethodCallNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_MethodCall $phpnode) {
		$result = new CompilerResult();
		$result->put($this->getCompiler()->compileNode($phpnode->var), '.', $phpnode->name, '(');
		
		$sub = new CompilerResult();
		foreach ($phpnode->args as $arg) {
			$sub->add($this->getCompiler()->compileNode($arg));
		}
		
		$result->putCollection($sub, ",");
		$result->put(")");
		return $result;
	}
}