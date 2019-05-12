<?php
namespace App\Model;

class HomeModel 
{
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