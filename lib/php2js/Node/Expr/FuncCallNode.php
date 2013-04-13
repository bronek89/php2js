<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class FuncCallNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_FuncCall $phpnode) {
		$result = new CompilerResult();
		$result->put($this->getCompiler()->compileNode($phpnode->name), '(');
		
		$sub = new CompilerResult();
		foreach ($phpnode->args as $arg) {
			$sub->add($this->getCompiler()->compileNode($arg));
		}
		
		$result->putCollection($sub, ",");
		$result->put(")");
		return $result;
	}
}