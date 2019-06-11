<?php 

function validationAddDataAdmin($user, $pass, $email, $phone, $role)
{
	$errors = [];
	$errors['username'] = (empty($user) || strlen($user) > 40) ? 'Vui long nhap username va khong lon 40 ki tu' : '';

	$errors['password'] = (empty($pass) || strlen($pass) > 40) ? 'Vui long nhap password va khong lon hon 40 ki tu' : '';

	$errors['email'] = (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) < 40) ? '' : 'Vui long nhap dinh dang email va nho hon 40 ki tu';

	$errors['phone'] = (empty($phone) || strlen($phone) > 20) ? 'Vui long nhap SDT va khong lon 20 ki tu' : '';

	$errors['role'] = (empty($role)) ? 'Vui long chon quyen tai khoan' : '';

	return $errors;
}

function createLink($data = [])
{
	// tao ra duong link phan trang danh cho controller nao
	/*
	$data = [
		'c' => 'admin',
		'm' => 'index',
		'keyword' => 'adas',
		'page' => 1
	];
	 */
	// tu cai mang data nhu tren chung ta build 1 duong link phan trang dua tren cac thong so do
	// index.php?c=admin&m=index&page=1&keyword=admin
	$link = '';
	foreach ($data as $key => $val) {
		$link .= (empty($link)) ? "?{$key}={$val}" : "&{$key}={$val}";
	}
	return "index.php" . $link;
}

function panigation($link, $totalRecord, $currentpage, $rows, $keyword = '')
{
	// $link : index.php?c=admin&m=index&page={page}&keyword=
	
	// 1 : tinh tong so trang : totolPage
	$totolPage = ceil($totalRecord/$rows);
	//2 : xac dinh lai pham vi cua currentpage
	if($currentpage < 1) {
		$currentpage = 1;
	} elseif($currentpage > $totolPage) {
		$currentpage = $totolPage;
	}
	// 3 : tinh start 
	$start = ($currentpage - 1) * $rows;

	//4: tao template HTML phan trang - su dung component panigation cua bootstrap de lam teamplate
	$html = '';
	$html .= "<nav>";
	$html .= "<ul class='pagination'>";
	if($currentpage > 1 && $currentpage <= $totolPage) {
		// hien nut previous (quay ve trang truoc)
		$html .= "<li class='page-item'>";
		$html .= "<a class='page-link' href='".str_replace('{page}', ($currentpage - 1), $link)."'>Previous</a>";
		$html .= "</li>";
	}
	// tao vong lap hien thi cac trang o giua (tu 1 -> totalpage)
	for($i = 1; $i <= $totolPage; $i++){
		// lam the nao de nguoi dung biet ho dang o trang nao
		if($i == $currentpage){
			// trang hien tai
			$html .= "<li class='page-item active'>";
			$html .= "<a class='page-link'>".$currentpage."</a>";
			$html .= "</li>";
		} else {
			// nhung trang khac
			$html .= "<li class='page-item'>";
			$html .= "<a class='page-link' href='".str_replace('{page}', $i, $link)."'>".$i."</a>";
			$html .= "</li>";
		}
	}
	// xu ly nut next page (sang trang tiep theo)
	if($currentpage < $totolPage && $currentpage >= 1){
		$html .= "<li class='page-item'>";
		$html .= "<a class='page-link' href='".str_replace('{page}', ($currentpage + 1), $link)."'> Next </a>";
		$html .= "</li>";
	}
	$html .= "</ul>";
	$html .= "</nav>";

	return [
		'start' => $start,
		'limit' => $rows,
		'keyword' => $keyword,
		'panigation' => $html
	];
}

