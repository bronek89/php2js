<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class NewNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_New $phpnode) {
		$result = new CompilerResult();
		$result->put('new ', $this->getCompiler()->compileNode($phpnode->class), '(');
		
		$sub = new CompilerResult();
		foreach ($phpnode->args as $arg) {
			$sub->put($this->getCompiler()->compileNode($arg));
		}
		
		$result->putCollection($sub, ",");
		$result->put(")");
		return $result;
	}
}