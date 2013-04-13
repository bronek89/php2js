<?php
	
namespace php2js\Node\Stmt;

use php2js\NodeAbstract;
	
class UseNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_Use $phpnode) {
		foreach ($phpnode->uses as $use) {
			$this->getCompiler()->compileNode($use);
		}
		
		return null;
	}
}