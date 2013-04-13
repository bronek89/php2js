<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class ClosureUseNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_ClosureUse $phpnode) {
		$result = new CompilerResult();
		$name_stack = $this->getCompiler()->getNameStackFront();
		
		$sname = '$'.$phpnode->var;
		if (!$name_stack->isNameExists($sname)) {
			$name_stack->addName($sname);
		}
		
		return $result;
	}
}