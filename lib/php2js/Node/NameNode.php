<?php
	
namespace php2js\Node;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class NameNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Name $phpnode) {
		$result = new CompilerResult();
		
		$sub = new CompilerResult();
		foreach ($phpnode->parts as $part) {
			$sub->addLine($part);
		}
		$result->putCollection($sub, "_");
		
		return $result;
	}
}