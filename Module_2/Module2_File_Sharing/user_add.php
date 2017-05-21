<?php
	session_destroy();
	session_start();
	if (isset($_SESSION['modifyuser'])){
		$user=$_SESSION['modifyuser'];
	}
	else {
		header("Location: users.php");
		break;
	}
	$file="/srv/uploads/users.txt";
	$h = fopen($file, "r");

	while(!feof($h)){
		$temp = trim(fgets($h));
		if($user==$temp) {
			$_SESSION['message']= "User already exists";
			header("Location: users.php");
			break;
		}
	}
	fclose($h);
	if($user!=$temp){
		$file = file_put_contents($file, $user.PHP_EOL , FILE_APPEND | LOCK_EX);
		$dir = "/srv/uploads/".$user."/";
		mkdir($dir, 0757);
		$_SESSION['message']= "User has been added successfully";
		header("Location: users.php");
	}
?>