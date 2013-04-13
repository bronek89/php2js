<?php
	
namespace app;

use app\entity\news;
	
class app {
	public function __construct() {
		$news = new news();
		$news->setTitle("Hello world!");
		
		$comments = $news->getComments();

		console::log($news->getTitle());
		console::log($comments[0]->tableName);
	}
}