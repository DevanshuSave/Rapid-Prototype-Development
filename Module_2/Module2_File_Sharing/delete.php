<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./mycss1.css" />
	<title>Delete</title>
</head>
<body>
<?php
session_start();
if (isset($_SESSION['username'])){
	echo "Welcome {$_SESSION['username']}";
}
else
        header("Location: login.html");
?>
<br>
	<?php	
		
		$filename = $_SESSION['filelist'];
		$full_path = sprintf("/srv/uploads/%s/%s", $_SESSION['username'], $filename);
		echo $filename;
		if(is_file($full_path)){
			unlink($full_path);
			unset($_SESSION['filelist']);
			echo " has been deleted successfully.";
			//header("Location: upload_success.html");
		}
		else{
			echo " has not been deleted. Please try again.";
			//header("Location: upload_failure.html");
		}
	?>
	<br>
	<a href="home.php">Go back to home</a>
</body>
</html>
