<!DOCTYPE html>
<html>
<body>
	<?php
		session_unset();
		session_destroy();
		//Check input username in users.txt file
		$h = fopen("/srv/uploads/users.txt", "r");
		$user = $_GET['usr'];
		while(!feof($h)){
			$temp = trim(fgets($h));
			if($user==$temp) {
				session_start();
				$_SESSION['username'] = $user;
				header("Location: home.php");
				break;
			}
		}
		// Go back to previous page if login is not successful
		if($user!=$temp){
			header("Location: login.html");
		}
		fclose($h);
	?>
</body>
</html>
