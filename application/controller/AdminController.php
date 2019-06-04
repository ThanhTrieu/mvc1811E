<?php
namespace App\Controller;

if(!defined('APP_PATH')){
	die('can not access');
}

require 'application/controller/Controller.php';
require 'application/model/Admin_model.php';
use App\Controller\Controller;
use App\Model\AdminModel;

class AdminController extends Controller
{
	private $db;
	function __construct()
	{
		$this->db = new AdminModel;
	}

	public function index()
	{
		$data = [];
		$data['infoAdmins'] = $this->db->getAllDataInfoAdmin();
		// echo "<pre>";
		// print_r($data['infoAdmins']);
		// die;

		// load header
		$header = [
			'title' => 'This is Admin page',
			'content' => 'Admin - demo'
		];
		$this->loadHeader($header);

		// load navbar
		$this->loadNav();
		
		// load 1 view
		$this->loadView('application/view/admin/index_view', $data);

		// load footer
		$this->loadFooter();
	}

	public function add()
	{
		$data = [];
		$data['errorAddData'] = $_SESSION['errorsAdd'] ?? [];

		// load header
		$header = [
			'title' => 'This is Admin add - page',
			'content' => 'Admin - demo'
		];
		$this->loadHeader($header);

		// load navbar
		$this->loadNav();
		
		// load 1 view
		$this->loadView('application/view/admin/add_view',$data);

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
			$errorsAdd = validationAddDataAdmin($username, $pass, $email, $phone, $role);

			$flagCheck = true;
			foreach ($errorsAdd as $key => $val) {
				if(!empty($val)){
					$flagCheck = false;
					break;
				}
			}

			if($flagCheck){
				// nguoi dung nhap du lieu hop le - cho add vao db
				// neu ton tai session loi thi xoa di
				if(isset($_SESSION['errorsAdd'])){
					unset($_SESSION['errorsAdd']);
				}
				// kiem tra xem username va email da ton tai trong db hay chua ? Neu chua cho insert neu co ton tai thi bao loi
				$checkAdd = $this->db->checkUsernameAndEmailExits($username, $email);
				if($checkAdd){
					// da ton tai ko cho them moi
					header("Location:?c=admin&m=add&state=fail");
				} else {
					// cho them moi
					$add = $this->db->insertDataAdmin($username, $pass, $email, $role, $phone, $address);
					if($add){
						// them moi thanh cong
						header("Location:?c=admin");
					} else {
						// them moi ko thanh cong
						header("Location:?c=admin&m=add&state=fail");
					}
				}
			} else {
				// nguoi dung nhap sai du lieu - thong bao loi
				// gan loi vao sesssion
				$_SESSION['errorsAdd'] = $errorsAdd;
				// dieu huong ve lai dung form add
				header("Location:?c=admin&m=add&state=err");
			}
		}
	}
}

$admin = new AdminController;
$m = $_GET['m'] ?? 'index';
$admin->$m();