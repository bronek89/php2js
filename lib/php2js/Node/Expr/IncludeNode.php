<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class IncludeNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_Include $phpnode) {
		$result = new CompilerResult();
		$result->put('require(', $this->getCompiler()->compileNode($phpnode->expr), ')');
		return $result;
	}
}