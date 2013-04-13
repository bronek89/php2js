<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class StaticPropertyFetchNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_StaticPropertyFetch $phpnode) {
		$result = new CompilerResult();
		$result->put($this->getCompiler()->compileNode($phpnode->class), '.', $phpnode->name);
		return $result;
	}
}