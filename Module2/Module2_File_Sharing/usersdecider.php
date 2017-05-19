<?php
	session_start();
	$act = $_POST['act'];
	
	$_SESSION['modifyuser'] = $_POST['user'];
	
	if($act=="Add") {
		header("Location: user_add.php");
		break;
	}
	else if($act=="Remove"){
		header("Location: user_rem.php");
		break;
	}
	else {
		header("Location: login.html");
		break;
	}
?>