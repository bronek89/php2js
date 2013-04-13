<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class BooleanOrNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_BooleanOr $phpnode) {
		$result = new CompilerResult();
		$result->put('(', $this->getCompiler()->compileNode($phpnode->left), 
						' || ', $this->getCompiler()->compileNode($phpnode->right), ')');
		return $result;
	}
}