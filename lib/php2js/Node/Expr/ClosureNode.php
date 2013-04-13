<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
use php2js\NameStack;
	
class ClosureNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_Closure $phpnode) {
		$result = new CompilerResult();
		$result->addLine('function (');
		
		$this->getCompiler()->pushNameStack(new NameStack);
		
		foreach ($phpnode->uses as $stmt) {
			$this->getCompiler()->compileNode($stmt);
		}
		
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