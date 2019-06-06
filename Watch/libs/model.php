<?php
class Libs_Model{
    public $host = DB_HOST;
	public $dbname = DB_DATA;
	public $user = DB_USER;
	public $pass = DB_PASS;

	public $db = null;

	public function getConnection(){
		try {
			$this->db = new PDO("mysql:host=".$this->host.";
                dbname=".$this->dbname.";charset=UTF8",
                $this->user,$this->pass);
		} catch (PDOException $ex) {
			die("Lỗi: ".$ex->getMessage());
		}
		return $this->db;
	}
}

