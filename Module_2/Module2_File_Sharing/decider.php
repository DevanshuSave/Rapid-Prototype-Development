<?php
	session_start();
	if (isset($_SESSION['username'])){
		echo "Welcome {$_SESSION['username']}";
	}
	else
        header("Location: login.html");
	
	$next = $_GET['page'];
	$_SESSION['filelist'] = $_GET['filelist'];
	
	if($next=="view") {
		header("Location: view.php");
		break;
	}
	else if($next=="delete"){
		header("Location: delete.php");
		break;
	}
	else if($next=="download"){
		header("Location: download.php");
		break;
	}
	else {
		header("Location: login.html");
		break;
	}
?>