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

	public function delete()
	{
		if(isset($_POST['btnDelete'])){
			$idAdmin = $_POST['idAdmin'] ?? '';
			$idAdmin = is_numeric($idAdmin) ? $idAdmin : 0;

			$del = $this->db->deleteAdminById($idAdmin);
			if($del){
				header('Location:?c=admin&state=oke');
			} else {
				header('Location:?c=admin&state=fail');
			}
		}
	}

	public function handleEdit()
	{
		if(isset($_POST['btnEdit'])){
			// lay cac du lieu tu form gui len
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

			$status = $_POST['status'] ?? '';
			$status = is_numeric($status) ? $status : '';

			$id = $_GET['id'] ?? '';
			$id = is_numeric($id) ? $id : 0;

			// validate du lieu truoc khi update
			// de cho cac ban ve lam
			
			// kiem tra xem nguoi dung thay doi username hoac email da ton tai trong db hay chua?
			// neu da ton tai khong cho sua - update theo gia tri day
			// nguoc lai cho sua - update theo gia tri do
			$checkEdit = $this->db->checkEditUserEmailAdmin($username, $email, $id);
			if($checkEdit){
				// khong cho update
				header("Location:?c=admin&m=edit&state=err&id=".$id);
			} else {
				// cho update
				$up = $this->db->updateDataAdminById($username, $pass, $email, $phone, $role, $address, $status, $id);
				if($up){
					// update thanh cong
					header("Location:?c=admin&state=success");
				} else {
					// update ko thanh cong
					header("Location:?c=admin&m=edit&state=fail&id=".$id);
				}
			}
		}
	}

	public function edit()
	{
		$id = $_GET['id'] ?? '';
		$id = is_numeric($id) ? $id : 0;

		// lay thong tin cua user admin do thong qua id cua no
		$data = [];
		$infoAdmin = $this->db->getInfoDataById($id);
		$data['info'] = $infoAdmin;
		
		// load header
		$header = [
			'title' => 'This is Admin page',
			'content' => 'Admin - demo'
		];
		$this->loadHeader($header);

		// load navbar
		$this->loadNav();

		if($infoAdmin){
			$this->loadView('application/view/admin/edit_view', $data);
		} else {
			$this->loadView('application/view/admin/notfound_view');
		}

		// load footer
		$this->loadFooter();
	}

	public function index()
	{
		$data = [];
		$keyword = $_GET['keyword'] ?? '';
		$keyword = strip_tags($keyword);
		$page = $_GET['page'] ?? '';
		$page = (is_numeric($page) && $page > 0) ? $page : 1;

		$arrayLinks = [
			'c' => 'admin',
			'm' => 'index',
			'page' => '{page}',
			'keyword' => $keyword
		];

		$strLink = createLink($arrayLinks);

		//$data['infoAdmins'] = $this->db->getAllDataInfoAdmin($keyword);
		$infoAdmins = $this->db->getAllDataInfoAdmin($keyword);
		$data['keyword'] = $keyword;
		$totRecord = count($infoAdmins);

		// goi ham phan trang
		$arrPanigation = panigation($strLink, $totRecord, $page, 1, $keyword);

		$data['infoAdmins'] = $this->db->getDataInfoAdminByPage($arrPanigation['start'], $arrPanigation['limit'], $arrPanigation['keyword']);

		// hien thi phan trang ra ngoai view html
		$data['panigation'] = $arrPanigation['panigation'];

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