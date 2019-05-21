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

	public function getAllDataPrice()
	{
		// lay toan bo du lieu tu table price trong database
		// viet theo cach truy van csdl theo thu vien pdo
		$data = []; // mot mang du lieu rong doi cho de lay du lieu tu db ve
		// 1 : khai bao cau lenh sql
		$sql = "SELECT * FROM prices";
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
			// ngat ket noi 
		}
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