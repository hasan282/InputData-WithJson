<?php

class Database{
	var $conn;
	var $host = "localhost";
	var $db = "workshop";
	var $user = "root";
	var $pass = "";
	
	public function open(){
		$this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db)
		or die(mysqli_error());
	}
	
	public function execute($sql){
		mysqli_query($this->conn, $sql)
		or die (mysqli_error($this->conn));
	}
	
	public function getAll($sql){
		$datas = Array();
		$query = mysqli_query($this->conn, $sql) or die (mysqli_error($this->conn));
		while($row = mysqli_fetch_assoc($query)){
			$datas[] = $row;
		}
		return $datas;
	}
	
	public function getOneData($sql){
		return null;
	}
	
	public function getLastID(){
		return mysqli_insert_id($this->conn);
	}
}

?>