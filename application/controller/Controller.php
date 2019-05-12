<?php
namespace App\Controller;

if(!defined('APP_PATH')){
	die('can not access');
}

class Controller
{
	protected function loadHeader($header = [])
	{
		$title = $header['title'] ?? '';
		$content = $header['content'] ?? '';
		require 'application/view/commons/header_view.php';
	}

	protected function loadNav()
	{
		require 'application/view/commons/nav_view.php';
	}

	protected function loadView($path, $data = [])
	{
		extract($data);
		// extract : chuyen key cua mang thanh mot bien
		/*
		$arr = [
			'a' => 10,
			'b' => 20
		];
		extract($arr);
		echo $a; // 10
		echo $b; // 20
		*/
		require $path.'.php';
	}
	protected function loadFooter()
	{
		require 'application/view/commons/footer_view.php';
	}
}