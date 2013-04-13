<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class IfNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_If $phpnode) {
		$result = new CompilerResult();
		$result->put('if (', $this->getCompiler()->compileNode($phpnode->cond), ') {', "\n");
		
		foreach ($phpnode->stmts as $stmt) {
			$result->put($this->getCompiler()->compileNode($stmt), ";", "\n");
		}
		
		$result->put("\n", '}');
		return $result;
	}
}