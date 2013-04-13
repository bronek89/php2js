<?php
	
namespace php2js\Node\Stmt;

use php2js\NodeAbstract;
	
class UseUseNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_UseUse $phpnode) {
		$package = $this->getCompiler()->getPackageManager()->getActive();
		$package->addRequire($phpnode->name->parts);
		return null;
	}
}