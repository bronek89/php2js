<?php
	
namespace php2js;
	
class Package {
	private $compiler;
	
	/**
	 * @return Compiler
	 */
	public function getCompiler() {
		return $this->compiler;
	}

	public function setCompiler($compiler) {
		$this->compiler = $compiler;
	}
	
	/**
	 * @var CompilerResult
	 */
	private $result;
	
	public function getResult() {
		return $this->result;
	}
	/**
	 * @var CompilerResult
	 */
	private $resultDefinitions;
	
	public function getDefinitionsResult() {
		return $this->resultDefinitions;
	}
	
	private $namedDefinitions = array();
	
	public function addNamedDefinition($name, array $deps, CompilerResult $result) {
		$this->namedDefinitions[$name] = array(
			'deps' => $deps,
			'result' => $result,
			'imploded' => false,
		);
	}
	
	private function implodeDefinition($name) {
		$def = &$this->namedDefinitions[$name];
		if ($def['imploded']) {
			return;
		}
		$def['imploded'] = true;
		
		foreach ($def['deps'] as $dep) {
			$this->implodeDefinition($dep);
		}
		
		$this->getDefinitionsResult()->add($def['result']);
	}

	public function __construct($name = null) {
		$this->name = $name;
		$this->result = new CompilerResult();
		$this->result->setCompiler($this->getCompiler());
		$this->resultDefinitions = new CompilerResult();
		$this->resultDefinitions->setCompiler($this->getCompiler());
	}

	public function getCompilerResult() {
		$result = new CompilerResult();
		
		$result_header = new CompilerResult();
		$result_header->put('//package ', $this->name, "\n");
		//$result_header->put("var requirejs = require('requirejs');\n");
		$result_header->put('define([');
		if ($this->requires) {
			$result_header->put(implode(',', array_map(function ($v) {
				return "'./$v[path]'";
			}, $this->requires)));
		}
		$result_header->put('], function (');
		$result_header->put(implode(',', array_keys($this->requires)));
		$result_header->put(') {');
		$result_header->put(implode(',', array_map(function ($v) {
			$obj = array();
			foreach ($v['objects'] as $o) {
				$obj[] = "$o = $v[package].$o";
			}
			return 'var ' . implode(',', $obj).';';
		}, $this->requires)));
		
		if ($this->returns) {
			$result_header->put('var ' . implode(',', array_map(function ($v) {
				return "$v = {}";
			}, $this->returns)), ';');
		}
		
		$result->put($result_header);
		
		foreach (array_keys($this->namedDefinitions) as $namedDef) {
			$this->implodeDefinition($namedDef);
		}
		
		$result->put($this->resultDefinitions);
		$result->put($this->result);
		
		$result_footer = new CompilerResult();
		$result_footer->put('return {');
		$result_footer->put(implode(',', array_map(function ($v) {
			return "$v: $v";
		}, $this->returns)));
		$result_footer->put('};');
		$result_footer->put('})');
		
		$result->put($result_footer);
		
		return $result;
	}
	
	private $name;
	
	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}
	
	private $requires = array();
	
	public function addRequire(array $require) {
		$object = array_pop($require);
		$package = end($require);
		
		if (!isset($this->requires[$package])) {
			$this->requires[$package] = array(
				'package' => $package,
				'path' => implode('/', $require),
				'objects' => array(),
			);
		} 
		
		$this->requires[$package]['objects'][] = $object;
	}
	
	private $returns = array();
	
	public function addReturn($return) {
		$this->returns[] = $return;
	}
}