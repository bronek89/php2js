<?php
	
namespace php2js\Node\Stmt;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class PropertyNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Stmt_Property $phpnode) {
		$result = new CompilerResult();
		
		if ($phpnode->isStatic()) {
			$result->put("new obj.staticPropertyGroup(");
		} else {
			$result->put("new obj.propertyGroup(");
		}
		
		if ($phpnode->isPrivate()) {
			$result->put('"private"');
		} else if ($phpnode->isPublic()) {
			$result->put('"public"');
		} else if ($phpnode->isProtected()) {
			$result->put('"protected"');
		} else {
			$result->put('"public"');
		}
		
		$result->put(', [');
		
		$sub = new CompilerResult();
		foreach ($phpnode->props as $stmt) {
			$sub->add($this->getCompiler()->compileNode($stmt));
		}
		$result->putCollection($sub, ",");
		$result->put("])");
		
		return $result;
	}
}