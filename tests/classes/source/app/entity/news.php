<?php
	
namespace app\entity;
	
class news {
	public $tableName = 'news';
	
	public function getComments() {
		return array(
			0 => new comment
		);
	}
	
	private $id, $title, $date;
	
	public function getTableName() {
		return $this->tableName;
	}

	public function setTableName($tableName) {
		$this->tableName = $tableName;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}
}