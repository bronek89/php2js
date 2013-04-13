<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class NamespaceNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_Namespace $phpnode) {
		$name = implode('/', $phpnode->name->parts);
		$package = $this->getCompiler()->getPackageManager()->getPackage($name);
		$this->getCompiler()->getPackageManager()->setActive($package);
		
		$result = new CompilerResult();
		foreach ($phpnode->stmts as $stmt) {
			$result->put($this->getCompiler()->compileNode($stmt), ";", "\n");
		}
		$package->getResult()->put($result);
		
		return null;
	}
}