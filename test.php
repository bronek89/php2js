<?php
	
	$x = $z = 1;
	class d {
		private $f, $c;
		static $st;
		
		public static function g() {}
		
		public function __construct() {
			$r = (function () {
				
			});
			
			$r();
			
			return $r;
		}
	}
	
	function c() {}
	$closureTest = function () {};
	
	$closureTest(10, $x);
	
	function funcTest() {}
	functTest(10, $z);
	
	$closureTest(10, functTest(10, $z));
	
	2 + (2 - 4);
	
	if (($x && $z) && ($x || $z)) {
	}
	$d = 0;
		$d = new d;
		$d->c->call($a = 2);
		
	$a = function ($abc) {
		return strlen(str_replace('d', 'b', $abc));
	};
	
	d::$st = "x";
	d::g()->b();
	
	$scopetest = 1;
	function scopetest_f() {
		$scopetest = 3;
		console::log($scopetest);
	}
	function scopetest_g() {
		global $scopetest;
		$scopetest = 3;
		console::log($scopetest);
	}
	
	console::log($scopetest);
	scopetest_f();
	console::log($scopetest);