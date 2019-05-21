<?php 
namespace App\Config;

if(!defined('APP_PATH')){
	die('can not access');
}

// du dung thu vien co san PDO
use \PDO;

class Database
{
	protected $db;

	public function __construct()
	{
		// tao ra bien ket noi de cho cac class model ke thua su dung
		$this->db = $this->connection();
	}

	public function __destruct()
	{
		// ngat ket noi toi db
		$this->db = null;
	}

	private function connection()
	{
		try {
		    $dbh = new PDO('mysql:host=localhost;dbname=lphp1811e;charset=utf8', 'root', ''); 

		    return $dbh;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}
}