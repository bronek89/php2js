<?php
	
namespace php2js;

class Compiler {
	/**
	 * @param array $nodes
	 * @return \php2js\CompilerResult
	 */
	public function compile(array $nodes) {
		$this->header = new CompilerResult();
		$this->footer = new CompilerResult();
		
		$this->pushNameStack(new NameStack());
		
		$compilerResult = new CompilerResult();
		$compilerResult->setCompiler($this);
		
		foreach ($nodes as $node) {
			$sub = $this->compileNode($node);
			if (!is_null($sub)) {
				$compilerResult->put($sub, ';', "\n");
			}
		}
		
		$finalResult = new CompilerResult();
		
		$finalResult->add($this->getHeader());
		$finalResult->add($compilerResult);
		$finalResult->add($this->getFooter());
		
		return $finalResult;
	}
	
	public function store() {
		$this->getPackageManager()->store();
	}
	
	private $aNodeStack = array();
	
	public function pushNodeStack(\PHPParser_Node $phpnode) {
		$this->aNodeStack[] = $phpnode;
	}
	
	public function popNodeStack() {
		return array_pop($this->aNodeStack);
	}
	
	/**
	 * @param int $index
	 * @return \PHPParser_Node
	 */
	public function getNodeStackFront($index = 0) {
		return $this->aNodeStack[count($this->aNodeStack) - ($index+1)];
	}
	
	private $aNameStack = array();
	
	public function pushNameStack(NameStack $stack) {
		$this->aNameStack[] = $stack;
	}
	
	public function popNameStack() {
		return array_pop($this->aNameStack);
	}
	
	/**
	 * @param int $index
	 * @return NameStack
	 */
	public function getNameStackFront($index = 0) {
		return $this->aNameStack[count($this->aNameStack) - ($index+1)];
	}
	
	private $scalarFormater;
	
	/**
	 * @return ScalarFormater
	 */
	public function getScalarFormater() {
		return $this->scalarFormater;
	}
	
	public function __construct() {
		$this->packageManager = new PackageManager();
		$this->packageManager->setCompiler($this);
		
		$this->scalarFormater = new ScalarFormater();
		$this->scalarFormater->setCompiler($this);
	}
	
	private $header, $footer;
	
	/**
	 * @return CompilerResult
	 */
	public function getHeader() {
		return $this->header;
	}

	public function setHeader($header) {
		$this->header = $header;
	}

	/**
	 * @return CompilerResult
	 */
	public function getFooter() {
		return $this->footer;
	}

	public function setFooter($footer) {
		$this->footer = $footer;
	}
	
	private $packageManager;
	
	/**
	 * @return PackageManager
	 */
	public function getPackageManager() {
		return $this->packageManager;
	}

	/**
	 * @param \PHPParser_Node $phpnode
	 * @param \php2js\CompilerResult $compilerResult
	 * @return \php2js\CompilerResult
	 */
	public function compileNode(\PHPParser_Node $phpnode) {
		$node = NodeFactory::create($phpnode);
		$node->setCompiler($this);
		$this->pushNodeStack($phpnode);
		$res = $node->compileNode($phpnode);
		$this->popNodeStack();
		return $res;
	}
	
	private $resultDir;
	
	public function getResultDir() {
		return $this->resultDir;
	}

	public function setResultDir($resultDir) {
		$this->resultDir = $resultDir;
	}
}