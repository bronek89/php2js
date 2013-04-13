<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
use php2js\NameStack;
	
class FunctionNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_Function $phpnode) {
		$package = $this->getCompiler()->getPackageManager()->getActive();
		$package->addReturn($phpnode->name);
		
		$result = new CompilerResult();
		$result->addLine('' . $phpnode->name . ' = function (');
		
		$this->getCompiler()->pushNameStack(new NameStack);
		
		$sub_params = new CompilerResult();
		foreach ($phpnode->params as $param) {
			$sub_params->add($this->getCompiler()->compileNode($param));
		}
		$result->putCollection($sub_params, ",");
		
		$result->put(') {');
		
		foreach ($phpnode->stmts as $stmt) {
			$result->put($this->getCompiler()->compileNode($stmt), ";", "\n");
		}
		
		$this->getCompiler()->popNameStack();
		
		$result->put('}');
		return $result;
	}
}