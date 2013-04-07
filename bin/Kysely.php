<?php

class Kysely {
	private $lauseke;
	private $tulos;
	private $success;
	private $inserted_id;
	
	public function __construct($sqlString, $param = array(1)) {
		$pdo = $this->init();
		$this->lauseke = $pdo->prepare($sqlString);          
		$this->lauseke->execute($param); 
		$this->success = $this->lauseke->rowCount();
		$this->tulos = $this->lauseke->fetchAll(PDO::FETCH_ASSOC); 
		$this->inserted_id = $pdo->lastInsertId();
	}
	public function wasSuccess() {
		return $this->success;
	}	
	public function getLastID() {
		return $this->inserted_id;
	}
	
	public function getResult() {
		return $this->tulos;	
	}
	public function init() {
		return new PDO('mysql:host='.$this->getInfo()[0].';dbname='.$this->getInfo()[1].'',$this->getInfo()[2],$this->getInfo()[3], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	
	public function getInfo() {
		return array($_SESSION['host'], $_SESSION['database'], $_SESSION['db_user'], $_SESSION['db_pwd']);
	}
	
}
?>
