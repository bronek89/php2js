<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class ReturnNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_Return $phpnode) {
		$result = new CompilerResult();
		$result->put('return (', $this->getCompiler()->compileNode($phpnode->expr), ')');
		return $result;
	}
}