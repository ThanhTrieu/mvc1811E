<?php

if(!defined('APP_PATH')){
	die('can not access');
}

/**
 * 
 */
class Route
{
	public function home()
	{
		//http://localhost:90/mvc1811e/?c=home
		//http://localhost:90/mvc1811e
		//echo "This is route - home";
		// dieu duong vao controller home
		require 'application/controller/HomeController.php';
	}

	public function cart()
	{
		//http://localhost:90/mvc1811e/?c=cart
		echo "This is route - cart";
	}

	public function login()
	{
		require 'application/controller/LoginController.php';
	}

	public function about()
	{
		require 'application/controller/AboutController.php';
	}

	public function __call($req, $res)
	{
		echo "Not found method";
	}
}

$route = new Route;
$c  = $_GET['c'] ?? 'home';
// $c = isset($_GET['c']) ? $_GET['c'] : 'home';
$route->$c();