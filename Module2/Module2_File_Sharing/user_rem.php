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

	$_SESSION['delete']=0;

	while(!feof($h)){
		$temp = trim(fgets($h));
		if($user==$temp) {
			file_put_contents($file,str_replace($user,"",file_get_contents($file)));
			$dir = "/srv/uploads/".$user."/";
			$files = glob($dir . '*', GLOB_MARK);
			foreach ($files as $myfile) {
				if(is_file($dir.$myfile)){
					unlink($dir.$myfile);
				}
			}
			rmdir($dir);
			$_SESSION['message']= "User has been removed successfully";
			$_SESSION['delete']=1;
		}
	}
	if ($_SESSION['delete']==0){
		$_SESSION['message']= "User not found";
	}
	fclose($h);
	header("Location: users.php");
	break;
?>