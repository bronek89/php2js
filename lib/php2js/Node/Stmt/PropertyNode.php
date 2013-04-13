<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class PropertyNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_Property $phpnode) {
		$result = new CompilerResult();
		
		foreach ($phpnode->props as $stmt) {
			$statement = $this->getCompiler()->compileNode($stmt);
			$result->put($statement);
		}
		
		return $result;
	}
}