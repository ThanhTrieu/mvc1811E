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