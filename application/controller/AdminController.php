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
		if(isset($_POST[''])){

		}
	}
}

$admin = new AdminController;
$m = $_GET['m'] ?? 'index';
$admin->$m();