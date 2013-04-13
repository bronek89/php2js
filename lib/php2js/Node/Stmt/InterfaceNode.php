<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class InterfaceNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_Interface $phpnode) {
		$result = new CompilerResult();
		$result->addLine('' . $phpnode->name . ' = obj.interface([');
		
		$sub = new CompilerResult();
		foreach ($phpnode->stmts as $stmt) {
			$sub->add($this->getCompiler()->compileNode($stmt));
		}
		$result->putCollection($sub, ",");
		
		$result->put('])');
		return $result;
	}
}