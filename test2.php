<?php 
//	
//	class a {
//		public function baseTest() {
//			console::log("x");
//			console::log(self, parent);
//		}
//	}
//	
//	interface i {}
//	
//	class b extends a implements i {
//		private $title = 'SC';
//		
//		public function getTitle() {
//			return $this->title;
//		}
//
//		public function setTitle($title) {
//			$this->title = $title;
//		}
//
//		public function __construct() {
//			$this->setTitle("Hello!");
//		}
//		
//		public function initTitle($a) {
//			$test = 0;
//			$o = $this;
//			$f = function ($arg) use ($test, $o) {
//				$test = 3;
//				$o->setTitle(self::$state . ' => ' . $o->getTitle() . ': ' . $arg);
//				console::log($this->title);
//			};
//			$f($a);
//		}
//		
//		public function printTitle($a) {
//			console::log($this->title);
//		}
//		
//		public static $state = 0;
//		
//		public static function setState($v) {
//			self::$state = $v;
//		}
//	}
//	
//	$b = new b;
//	$b->initTitle('p');
//	$b->printTitle();
//	
////	setInterval(function () use ($b) {
////		global $window;
////		b::$state ++;
////		$b->printTitle();
////		$window->location->hash = b::$state;
////	
////		$canvas_p = new stdClass();
////		$canvas_p->canvas = "#canv";
////		$canvas_p->background = "#F16529";
////		$canvas = oCanvas::create($canvas_p);
////	}, 1000);
//	
//	$b->baseTest();
//	var_dump($b);
//	
//	$array = [
//		"wonder" => "land",
//	];
//	
//	$array[] = 1;
//	$array['sub'] = array();
//	$array['sub'][0] = 1;
//	
//	foreach ($array as $k => $v) {
//		console::log($k, $v);
//	}
//	
//	console::log(count($array));
//	console::log(($array));
	
use php2js;