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
		$result->addLine("$phpnode->name = function () {
	oop.newInstance(this, $phpnode->name);
};
TheClass.\$name = '$phpnode->name';
TheClass.\$base = ");
		
		$deps = array();
		
		if ($phpnode->extends) {
			$result->put($this->getCompiler()->compileNode($phpnode->extends), ';');
			$deps[] = implode('', $phpnode->extends->parts);
		} else {
			$result->put('null;');
		}
		
		$sub = new CompilerResult();
		foreach ($phpnode->stmts as $stmt) {
			$sub->add($this->getCompiler()->compileNode($stmt));
		}
		
		$result->put("TheClass.\$ptt = {");
		$result->putCollection($sub, ",");
		$result->put("};");
			
		if ($phpnode->implements) {
			$sub_impl = new CompilerResult();
			foreach ($phpnode->implements as $extend) {
				$sub_impl->add($this->getCompiler()->compileNode($extend));
				$deps[] = ($this->getCompiler()->compileNode($extend));
			}
			$result->putCollection($sub_impl, ",");
		}
		
		
		$result->put("TheClass.\$int = {");
		$result->putCollection($sub_impl, ",");
		$result->put("};");
		
		$this->getCompiler()->getPackageManager()->getActive()->addNamedDefinition($phpnode->name, $deps, $result);
		
		return null;
	}
}