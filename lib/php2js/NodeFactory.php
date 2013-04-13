<?php
	
namespace php2js;
	
class NodeFactory {
	/**
	 * @param \PHPParser_Node $phpnode
	 * @return \php2js\NodeAbstract
	 */
	public static function create(\PHPParser_Node $phpnode) {
		$type = $phpnode->getType();
		$class = "\\php2js\\Node\\" . str_replace("_", "\\", $type.'Node');
		$reflection = new \ReflectionClass($class);
		$node = $reflection->newInstance();
		return $node;
	}
}