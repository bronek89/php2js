<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class ArrayDimFetchNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_ArrayDimFetch $phpnode) {
		$result = new CompilerResult();
		if (is_null($phpnode->dim)) {
			$result->put($this->getCompiler()->compileNode($phpnode->var), 
					"[count(", $this->getCompiler()->compileNode($phpnode->var), ")]");
		} else {
			$result->put($this->getCompiler()->compileNode($phpnode->var), 
					"[", $this->getCompiler()->getScalarFormater()->format($phpnode->dim), "]");
		}
		return $result;
	}
}