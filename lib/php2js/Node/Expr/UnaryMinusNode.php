<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class UnaryMinusNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_UnaryMinus $phpnode) {
		$result = new CompilerResult();
		$result->put('-(', $this->getCompiler()->compileNode($phpnode->expr), ')');
		return $result;
	}
}