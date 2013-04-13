<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class PropertyPropertyNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_PropertyProperty $phpnode) {
		$parent_phpnode = $this->getCompiler()->getNodeStackFront(2);
		$result = new CompilerResult();
		$result->put("$parent_phpnode->name.prototype.$phpnode->name = ",
			$this->getCompiler()->getScalarFormater()->format($phpnode->default), ";\n");
		return $result;
	}
}