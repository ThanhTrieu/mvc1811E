<?php
namespace App\Controller;

if(!defined('APP_PATH')){
	die('can not access');
}

class LoginController
{
	public function handle()
	{
		if(isset($_POST['btnLogin'])){
			echo "<pre>";
			print_r($_POST);
		}
	}
}

$login = new LoginController;
$m = $_GET['m'] ?? 'index';
$login->$m();