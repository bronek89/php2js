<?php
	
namespace php2js;
	
class CompilerResult {
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
	
	public function add(CompilerResult $result) {
		foreach ($result->getLines() as $line) {
			$this->addLine($line);
		}
	}
	
	public function __construct($line = null) {
		if (!is_null($line)) {
			$this->addLine($line);
		}
	}
	
	public function putCollection(CompilerResult $collection, $glue) {
		$result = array();
		
		foreach ($collection->getLines() as $line) {
			$result[] = $line;
		}
		
		$this->addToCurrentLine(implode($glue, $result));
	}
	
	public function put() {
		$result = array();
		
		foreach (func_get_args() as $arg) {
			if ($arg instanceof CompilerResult) {
				$result[] = implode("\n", $arg->getLines());
			} else if (is_scalar($arg)) {
				$result[] = $arg;
			}
		}
		
		$this->addToCurrentLine(implode("", $result));
	}
	
	private $lines = array();
	
	public function getLines() {
		return $this->lines;
	}

	public function addLine($line) {
		$this->lines[] = $line;
	}

	public function addToCurrentLine($content) {
		if ($this->lines) {
			$this->lines[count($this->lines) - 1] .= $content;
		} else {
			$this->addLine($content);
		}
	}
	
	public function __toString() {
		return implode("", $this->getLines());
	}
}