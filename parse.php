<?php

use php2js\Compiler;
$dir = dirname(__FILE__).'/';

require 'lib/bootstrap.php';
$parser = new PHPParser_Parser(new PHPParser_Lexer);
	
$testname = 'classes';

$compiler = new Compiler();
$compiler->setResultDir($dir.'tests/'.$testname.'/build/');

$ritit = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir.'tests/'.$testname.'/source/'), 
		RecursiveIteratorIterator::CHILD_FIRST); 
		
foreach ($ritit as $splFileInfo) { 
	if ($splFileInfo instanceof SplFileInfo) {
		if (!$splFileInfo->isDir()) {
			try {
				$code	 = file_get_contents($splFileInfo->getPathname());
				$stmts	 = $parser->parse($code);

				$compiler->compile($stmts);
			} catch (PHPParser_Error $e) {
				echo 'Parse Error: ', $e->getMessage();
			}
		}
	}
}
	
shell_exec("rm -R ".escapeshellarg($compiler->getResultDir()));
mkdir($compiler->getResultDir());
	
$compiler->store();