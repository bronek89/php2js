<?php
	
namespace php2js\Node\Expr;

use php2js\CompilerResult;
use php2js\NodeAbstract;
	
class AssignNode extends NodeAbstract {
	public function compileNode(\PHPParser_Node_Expr_Assign $phpnode) {
		$name = $this->getCompiler()->compileNode($phpnode->var);
		$parent_phpnode = $this->getCompiler()->getNodeStackFront(1);
		
		$result = new CompilerResult();
		
		if ($phpnode->var->getType() == 'Expr_Variable') {
			if (!$parent_phpnode || 
					(in_array($parent_phpnode->getType(), array(
						'Stmt_Function',
						'Stmt_ClassMethod',
						'Stmt_Namespace',
						'Expr_Closure',
					)))) {

				$name_stack = $this->getCompiler()->getNameStackFront();
				$sname = implode('', $name->getLines());
				
				if (!$name_stack->isNameExists($sname)) {
					$result->put('var ');
					$name_stack->addName($sname);
				}

			}
		}
		
		$result->put($name, '=', $this->getCompiler()->compileNode($phpnode->expr));
		return $result;
	}
}