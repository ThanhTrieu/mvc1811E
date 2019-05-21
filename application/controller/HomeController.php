<?php
namespace App\Controller;

if(!defined('APP_PATH')){
	die('can not access');
}

require 'application/controller/Controller.php';
require 'application/model/Home_model.php';
use App\Controller\Controller;
use App\Model\HomeModel;



class HomeController extends Controller
{
	private $db;
	public function __construct()
	{
		$this->db = new HomeModel;
	}

	public function index()
	{
		$data = [];
		// test
		$db = $this->db->getDallData();

		$dataPrice = $this->db->getAllDataByNameTable('rooms');

		$priceRoom = $this->db->getDataByConditionV3('teo');

		$today = date('Y-m-d'); 
		$week = date('Y-m-d',strtotime('-7days'));

		$test = $this->db->getDataByConditionV4($week, $today);


		$data['name'] = 'Admin';
		$data['info'] = $db;

		// hay xu ly xong toan bo du lieu roi moi load cac view

		// load header
		$header = [
			'title' => 'This is Home page',
			'content' => 'Admin - demo'
		];
		$this->loadHeader($header);

		// load navbar
		$this->loadNav();
		
		// load 1 view
		$this->loadView('application/view/home/index_view', $data);

		// load footer
		$this->loadFooter();
	}
}

$home = new HomeController;
$m = $_GET['m'] ?? 'index';
$home->$m();