<?php
if(file_exists('route/web.php')){
	
	define('APP_PATH', 'index.php');

	require 'route/web.php';
} else {
	die('Website dang duoc nang cap, vui long quay lai sau');
}