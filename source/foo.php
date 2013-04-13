<?php

namespace testspace;

use story\board;

function makefoo() {
	return new foocls();
}

class foocls extends barcls {
	public function test() {
		console::log($this->param);
		return 1;
	}
	
	public static function test_s() {
		return 2;
	}
	
	public static function make() {
		console::log(self::test_s());
		return makefoo();
	}
}

class foocls_ex extends foocls {
	public $param = 10;
	
	public function test() {
		console::log($this->param);
		return 3 + parent::test();
	}
}

$foo = new foocls_ex;
console::log($foo->test());