<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class ConstFetchNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_ConstFetch $phpnode) {
		$result = new CompilerResult();
		$result->put($this->getCompiler()->compileNode($phpnode->name));
		return $result;
	}
}