<?php
	session_start();
	$mysqli = new mysqli('localhost', 'dc', 'dc330', 'news'); 
	if($mysqli->connect_errno) {
		header("Location: NWSlogin.php");
	}
	$email = $_POST['email_address'];
	$pass = $_POST['password'];
	$stmt = $mysqli->prepare("select email_address, password, first_name, last_name from users where email_address = '$email' and password = '$pass';");
	$stmt->execute();
	$stmt->bind_result($email1, $pass1, $fname1, $lname1);
	while($stmt->fetch()){
		if ($email1 == $email && $pass1 == $pass){
			$_SESSION['email']=$email1;
			$_SESSION['fname']=$fname1;
			$_SESSION['lname']=$lname1;
			$stmt->close();
			$mysqli->close();
			header("Location: home.php");
			break;
		}
		else{
			$_SESSION['email']=null;
			echo "Invalid user. Go back.";
			header("Location: NWSlogin.php");
		}
	}
	$stmt->close();
	$mysqli->close();
?>