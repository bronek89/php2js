<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class ForeachNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_Foreach $phpnode) {
		$result = new CompilerResult();
		$result->put('_.each(');
		$result->put($this->getCompiler()->compileNode($phpnode->expr), ", function (");
		$result->put($this->getCompiler()->compileNode($phpnode->valueVar), "");
		if ($phpnode->keyVar) {
			$result->put(',', $this->getCompiler()->compileNode($phpnode->keyVar));
		}
		$result->put(') {');
		
		foreach ($phpnode->stmts as $stmt) {
			$result->put($this->getCompiler()->compileNode($stmt), ";", "\n");
		}
		
		$result->put('})');
		return $result;
	}
}