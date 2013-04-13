<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class GlobalNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_Global $phpnode) {
		$result = new CompilerResult();
		$name_stack = $this->getCompiler()->getNameStackFront();
		
		foreach ($phpnode->vars as $part) {
			$sname = implode('', $this->getCompiler()->compileNode($part)->getLines());
			if (!$name_stack->isNameExists($sname)) {
				$name_stack->addName($sname);
			}
		}
		
		return $result;
	}
}