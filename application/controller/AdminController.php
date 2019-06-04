<?php
namespace App\Controller;

if(!defined('APP_PATH')){
	die('can not access');
}

require 'application/controller/Controller.php';
use App\Controller\Controller;

class AdminController extends Controller
{
	public function index()
	{
		// load header
		$header = [
			'title' => 'This is Admin page',
			'content' => 'Admin - demo'
		];
		$this->loadHeader($header);

		// load navbar
		$this->loadNav();
		
		// load 1 view
		$this->loadView('application/view/admin/index_view');

		// load footer
		$this->loadFooter();
	}

	public function add()
	{
		// load header
		$header = [
			'title' => 'This is Admin add - page',
			'content' => 'Admin - demo'
		];
		$this->loadHeader($header);

		// load navbar
		$this->loadNav();
		
		// load 1 view
		$this->loadView('application/view/admin/add_view');

		// load footer
		$this->loadFooter();
	}

	public function handleAdd()
	{
		if(isset($_POST['btnAdd'])){

			// lay du lieu tu form gui len
			$username = $_POST['user'] ?? '';
			$username = strip_tags($username);

			$pass = $_POST['password'] ?? '';
			$pass = strip_tags($pass);

			$email = $_POST['email'] ?? '';
			$email = strip_tags($email);

			$phone = $_POST['phone'] ?? '';
			$phone = strip_tags($phone);

			$role = $_POST['role'] ?? '';
			$role = is_numeric($role) ? $role : '';

			$address = $_POST['address'] ?? '';

			// validate du lieu truoc khi insert vao database
			// kiem tra cac du lieu tu form gui len co hop le hay ko (can cu vao trong thiet ke database)
		}
	}
}

$admin = new AdminController;
$m = $_GET['m'] ?? 'index';
$admin->$m();