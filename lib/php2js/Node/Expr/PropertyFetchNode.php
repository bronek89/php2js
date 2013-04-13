<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class PropertyFetchNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_PropertyFetch $phpnode) {
		$result = new CompilerResult();
		$result->put($this->getCompiler()->compileNode($phpnode->var), '.', $phpnode->name);
		return $result;
	}
}