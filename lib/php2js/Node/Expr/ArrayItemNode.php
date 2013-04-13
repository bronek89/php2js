<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class ArrayItemNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_ArrayItem $phpnode) {
		$result = new CompilerResult();
		$result->put($this->getCompiler()->getScalarFormater()->format($phpnode->key), 
				": ", $this->getCompiler()->compileNode($phpnode->value));
		return $result;
	}
}