<?php
	
namespace php2js;
	
class PackageManager {
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
	
	private $packages = array(), $active;
	
	/**
	 * @return Package
	 */
	public function getActive() {
		return $this->active;
	}
	
	public function setActive(Package $active) {
		$this->active = $active;
	}

	/**
	 * @param string $name
	 * @return Package
	 */
	public function getPackage($name) {
		if (!isset($this->packages[$name])) {
			$this->packages[$name] = new Package($name);
			$this->packages[$name]->setCompiler($this->compiler);
		}
		return $this->packages[$name];
	}
	
	public function store() {
		foreach ($this->packages as $package) {
			if ($package instanceof Package) {
				$result = $package->getCompilerResult();
				$filename = $this->getCompiler()->getResultDir() . $package->getName() . '.js';
				file_put_contents($filename, implode("\n", $result->getLines()));
			}
		}
	}
}