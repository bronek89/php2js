<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class ClassNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_Class $phpnode) {
		$package = $this->getCompiler()->getPackageManager()->getActive();
		$package->addReturn($phpnode->name);
		
		$result = new CompilerResult();
//		$result->addLine('' . $phpnode->name . ' = obj.class([');
		$result->addLine("$phpnode->name = function () {if (typeof this.__construct !== 'undefined') {this.__construct()}};");
		
		$deps = array();
		
		if ($phpnode->extends) {
			$baseClass = $this->getCompiler()->compileNode($phpnode->extends);
			$result->put("$phpnode->name.protoype = obj.clone($baseClass.prototye);");
			$deps[] = implode('', $phpnode->extends->parts);
		}
		
		foreach ($phpnode->stmts as $stmt) {
			$statement = $this->getCompiler()->compileNode($stmt);
			$result->put($statement, ";\n");
		}
		
		if ($phpnode->implements) {
			$sub_impl = new CompilerResult();
			foreach ($phpnode->implements as $extend) {
				$sub_impl->add($this->getCompiler()->compileNode($extend));
				$deps[] = ($this->getCompiler()->compileNode($extend));
			}
			$result->putCollection($sub_impl, ",");
		
			$result->put("$phpnode->name.__implements =  = {");
			$result->putCollection($sub_impl, ",");
			$result->put("};");
		}
		
		$this->getCompiler()->getPackageManager()->getActive()->addNamedDefinition($phpnode->name, $deps, $result);
		
		return null;
	}
}