<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
use php2js\NameStack;
	
class ClassMethodNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_ClassMethod $phpnode) {
		$result = new CompilerResult();
		$parent_phpnode = $this->getCompiler()->getNodeStackFront(1);
		
		$result->put("$parent_phpnode->name.prototype.$phpnode->name = ");
		$result->put('function ' . $phpnode->name . '(');
		
		$this->getCompiler()->pushNameStack(new NameStack);
		
		$sub_params = new CompilerResult();
		foreach ($phpnode->params as $param) {
			$sub_params->add($this->getCompiler()->compileNode($param));
		}
		$result->putCollection($sub_params, ",");
		
		$result->put(") { var \$this = this; var self = $parent_phpnode->name; ");
		if ($parent_phpnode->extends) {
			$result->put("var parent = $parent_phpnode->extends;");
		}
		
		$this->getCompiler()->pushNameStack(new NameStack);
		
		foreach ($phpnode->stmts as $stmt) {
			$result->put($this->getCompiler()->compileNode($stmt), ";\n");
		}
		
		$this->getCompiler()->popNameStack();
		
		$result->put('}');
		return $result;
	}
}