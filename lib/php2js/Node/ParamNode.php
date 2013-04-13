<?php
	
namespace php2js\Node;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class ParamNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Param $phpnode) {
		$result = new CompilerResult();
		$result->put('$'.$phpnode->name);
		//$result->put('='.$this->getCompiler()->getScalarFormater()->format($phpnode->default));
		
		$name_stack = $this->getCompiler()->getNameStackFront();
		
		$sname = '$'.$phpnode->name;
		if (!$name_stack->isNameExists($sname)) {
			$name_stack->addName($sname);
		}
		
		return $result;
	}
}