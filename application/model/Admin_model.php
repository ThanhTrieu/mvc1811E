<?php
namespace App\Model;

require 'application/config/database.php';
use App\Config\Database;
// du dung thu vien co san PDO
use \PDO;

class AdminModel extends Database
{
	public function __construct()
	{
		// trieu goi __construct cua lop cha de lay ra bien ket noi
		parent::__construct();
		// ben duoi nay se la cac logic cua __construct lop con ma chung ta can dinh nghia - xu ly
	}

	public function getAllDataInfoAdmin()
	{
		$data = [];
		$sql = "SELECT * FROM admin";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;
	}

	public function insertDataAdmin($username, $pass, $email, $role, $phone, $address)
	{
		$flagAdd = false;
		$status = 1;
		$created_at = date('Y-m-d H:i:s');
		$updated_at = null;

		$sql = "INSERT INTO admin(username, password, email, role, status, phone, address, created_at, updated_at) VALUES(:username, :password, :email, :role, :status, :phone, :address, :created_at, :updated_at)";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->bindParam(':password', $pass, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':role', $role, PDO::PARAM_INT);
			$stmt->bindParam(':status', $status, PDO::PARAM_INT);
			$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
			$stmt->bindParam(':address', $address, PDO::PARAM_STR);
			$stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
			$stmt->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
			//$created_at = date('Y-m-d H:i:s');
			//$updated_at = null;

			if($stmt->execute()){
				$flagAdd = true;
			}
			$stmt->closeCursor();
		}
		return $flagAdd;	
	}

	public function checkUsernameAndEmailExits($user, $email)
	{
		// kiem tra username va email co ton tai trong db hay ko?
		$checkFlag = false;
		$sql = "SELECT * FROM admin AS a WHERE a.username = :username OR a.email = :email LIMIT 1";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':username', $user, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$checkFlag = true;
				}
			}
			$stmt->closeCursor();
		}
		return $checkFlag;
	}
}