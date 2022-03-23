<?php 
require_once("../include/initialize.php");
require_once("../include/config.php");

	if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
        header("location: ../index.php");
        exit;
    }
	if ($_SESSION["user_type"] == "user") {
		header("location: ../index.php");
        exit;
	}


if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") {
	$content='main.php';
	$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
	switch ($view) {
		case 'dashboard' :
			$title="Dashboard - Pre-admission";	
			$content='main.php';	
			$dashboard='active';	
			break;
		case 'application' :
			$title="Application - Pre-admission";	
			$content='application.php';	
			$application='active';	
			break;
		case 'interview' :
			$title="Interview - Pre-admission";	
			$content='interview.php';	
			$interview='active';	
			break;
		case 'qualified' :
			$title="Qualified - Pre-admission";	
			$content='qualified.php';	
			$qualified='active';	
			break;
		case 'setting' :
			$title="Setting - Pre-admission";	
			$content='setting.php';	
			$setting='active';	
			break;

		default :
			$title="Dashboard - Pre-admission";	
			$content ='main.php';	
			$dashboard='active';	
	}
	require_once("template/admin_tmp.php");
}
elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "interviewer") {
	$content='main.php';
	$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
	switch ($view) {
		case 'dashboard' :
			$title="Dashboard - Pre-admission";	
			$content='main.php';	
			$dashboard='active';	
			break;
		case 'application' :
			$title="Application - Pre-admission";	
			$content='application.php';	
			$application='active';	
			break;
		case 'interview' :
			$title="Interview - Pre-admission";	
			$content='interview.php';	
			$interview='active';	
			break;
		default :
			$title="Dashboard - Pre-admission";	
			$content ='main.php';	
			$dashboard='active';	
	}
	require_once("template/admin_tmp.php");
}
elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admission officer") {
	$content='main.php';
	$view = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
	switch ($view) {
		case 'dashboard' :
			$title="Dashboard - Pre-admission";	
			$content='main.php';	
			$dashboard='active';	
			break;
		case 'application' :
			$title="Application - Pre-admission";	
			$content='application.php';	
			$application='active';	
			break;
		case 'interview' :
			$title="Interview - Pre-admission";	
			$content='interview.php';	
			$interview='active';	
			break;
		case 'prequalified' :
			$title="Pre-qualified - Pre-admission";	
			$content='prequalified.php';	
			$prequalified='active';	
			break;
		case 'qualified' :
			$title="Qualified - Pre-admission";	
			$content='qualified.php';	
			$qualified='active';	
			break;
		case 'setting' :
			$title="Setting - Pre-admission";	
			$content='setting.php';	
			$setting='active';	
			break;
		case 'new_application' :
			$title='New application - Pre-admission';
			$content='tab/new_application.php';
			$interview='active';
			break;

		default :
			$title="Dashboard - Pre-admission";	
			$content ='main.php';	
			$dashboard='active';	
	}
	require_once("template/admin_tmp.php");
}
?>