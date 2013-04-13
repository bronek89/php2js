<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class ArrayNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_Array $phpnode) {
		$result = new CompilerResult();
		$result->put('{');
		$sub_params = new CompilerResult();
		foreach ($phpnode->items as $param) {
			$sub_params->add($this->getCompiler()->compileNode($param));
		}
		$result->putCollection($sub_params, ",");
		$result->put('}');
		return $result;
	}
}