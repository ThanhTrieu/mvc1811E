<?php
namespace App\Model;

require 'application/config/database.php';
use App\Config\Database;
// du dung thu vien co san PDO
use \PDO;

class HomeModel extends Database
{
	public function __construct()
	{
		// trieu goi __construct cua lop cha de lay ra bien ket noi
		parent::__construct();
		// ben duoi nay se la cac logic cua __construct lop con ma chung ta can dinh nghia - xu ly
	}

	public function getDataByConditionV4($fDate, $tDate)
	{
		$data = [];
		$sql = "SELECT * FROM bookings AS a WHERE a.booking_date BETWEEN :fd AND :td"; 
		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':fd', $fDate, PDO::PARAM_STR);
			$stmt->bindParam(':td', $tDate, PDO::PARAM_STR);
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					// fetch: tra ve mang don
					// fetchAll : tra ve mang da chieu
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;
	}

	public function getDataByConditionV3($keyword)
	{
		$data = [];
		$key = "%{$keyword}%";

		$sql = "SELECT * FROM customers AS a WHERE a.name_customer LIKE :name OR a.phone LIKE :phone OR a.person_id LIKE :cmnd";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':name', $key, PDO::PARAM_STR);
			$stmt->bindParam(':phone', $key, PDO::PARAM_STR);
			$stmt->bindParam(':cmnd', $key, PDO::PARAM_STR);
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					// fetch: tra ve mang don
					// fetchAll : tra ve mang da chieu
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;
	}

	public function getDataByConditionV2($start, $rows)
	{
		// lay ra 3 dong du lieu tu dong so 2 trong bang room va sap xep lai du lieu theo id giam dan
		$data = [];
		$sql = "SELECT * FROM rooms AS a ORDER BY a.id DESC LIMIT :limted,:rows";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':limted', $start, PDO::PARAM_INT);
			$stmt->bindParam(':rows', $rows, PDO::PARAM_INT);
			// co bao tham so thi can phai kiem tra bay nhieu
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					// fetch: tra ve mang don
					// fetchAll : tra ve mang da chieu
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			// ngat ket noi de co the thuc thi cac ma lenh sql tiep theo neu co
			$stmt->closeCursor();
		} 
		return $data;
	}

	public function getDataByCondition($id = 3)
	{
		$data = [];
		$sql  = "SELECT a.price_room FROM prices AS a 
				 INNER JOIN types AS b ON a.id = b.price_id 
				 INNER JOIN rooms AS c ON b.id = c.type_id 
				 INNER JOIN customers AS d ON c.id = d.room_id 
				 WHERE d.id = :id";
		// :id tham so trong sql string pdo
		$stmt = $this->db->prepare($sql);
		if($stmt){
			// vi trong sql string pdo co tham so truyen vao nen can kiem tra tham do
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			// co bao tham so thi can phai kiem tra bay nhieu
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					// fetch: tra ve mang don
					// fetchAll : tra ve mang da chieu
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
			// ngat ket noi de co the thuc thi cac ma lenh sql tiep theo neu co
			$stmt->closeCursor();
		}
		return $data;
	}

	public function getAllDataByNameTable($nameTable = 'admin')
	{
		// lay toan bo du lieu tu table price trong database
		// viet theo cach truy van csdl theo thu vien pdo
		$data = []; // mot mang du lieu rong doi cho de lay du lieu tu db ve
		// 1 : khai bao cau lenh sql
		$sql = "SELECT * FROM {$nameTable}";
		// 2: su dung ham prepare de thuc thi - kiem tra cau lenh sql
		$stmt = $this->db->prepare($sql);
		if($stmt){
			// cau lenh sql ko co loi
			// thuc thi cau lenh
			if($stmt->execute()){
				// thuc thi thanh cong
				// kiem tra xem bang du lieu co dong du lieu nao ko? neu co thi moi lay ve
				if($stmt->rowCount() > 0){
					// lay du lieu ra
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
					// PDO::FETCH_ASSOC: tra ve mot mang khong tuan  tu voi key cua mang la cac truong nam trong bang du lieu
				}
			}
			// ngat ket noi execute $stmt de co the execute cac stmt moi
			$stmt->closeCursor();
			// vi khong con thuc thi cau lenh nao nua nen thoi
		}
		return $data;
	}

	public function getDallData()
	{

		return [
			[
				'msv' => 113,
				'name' => 'NVA',
				'email' => 'test@gmail.com',
				'address' => 'Ha noi',
				'money' => 1000
			],
			[
				'msv' => 114,
				'name' => 'NVB',
				'email' => 'test123@gmail.com',
				'address' => 'Nam Dinh',
				'money' => 8000
			],
			[
				'msv' => 115,
				'name' => 'NVC',
				'email' => 'test13@gmail.com',
				'address' => 'Hai Duong',
				'money' => 9000
			]
		];
	}
}