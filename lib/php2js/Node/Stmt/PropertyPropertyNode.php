<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class PropertyPropertyNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_PropertyProperty $phpnode) {
		$result = new CompilerResult();
		$result->put("new obj.property('$phpnode->name', ",
			$this->getCompiler()->getScalarFormater()->format($phpnode->default), ")");
		return $result;
	}
}