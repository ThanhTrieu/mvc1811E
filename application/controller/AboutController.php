<?php
namespace App\Controller;

require 'application/controller/Controller.php';
use App\Controller\Controller;

if(!defined('APP_PATH')){
	die('can not access');
}

class AboutController extends Controller
{
	public function index()
	{
		// load header
		$header = [
			'title' => 'This is About page',
			'content' => 'Admin - demo'
		];
		$this->loadHeader($header);

		// load navbar
		$this->loadNav();
		
		// load 1 view
		$data = [];
		$data['age'] = 20;

		$this->loadView('application/view/about/index_view', $data);

		// load footer
		$this->loadFooter();
	}
}


$about = new AboutController;
$m = $_GET['m'] ?? 'index';
$about->$m();