<?php
	session_start();
	$_SESSION['yesorno']=1;
	$mysqli = new mysqli('localhost', 'dc', 'dc330', 'news'); 
	if($mysqli->connect_errno) {
		header("Location: NWSlogin.php");
	}
	$email = $_POST['email_address'];
	$pass = $_POST['password'];
	
	
	//Check if user exists in the database
	$stmt = $mysqli->prepare("select email_address from users where email_address = '$email'");
	$stmt->execute();
	$stmt->bind_result($email1);

	if ($email1 == $email){
		$_SESSION['message']="User already exists";
		$stmt->close();
		header("Location: NWScreateAccount.php");
		break;
	}
	else {
		$mysqli1 = new mysqli('localhost', 'dc', 'dc330', 'news');
		
		$stmt1 = $mysqli1->prepare("insert into users (email_address, password, first_name, last_name, location, info) values(?,?,?,?,?,?)");
		if(!$stmt1){
			printf("Query Prep Failed: %s\n", $mysqli1->error);
		exit;
}
		$stmt1->bind_param('ssssss', $_POST['email_address'],$_POST['password'],$_POST['first_name'],$_POST['last_name'],$_POST['location'],$_POST['info']);
		//$stmt1->execute();

		if ($stmt1->execute() === TRUE) {
			$_SESSION['message']="New user created";
		} 
		else {
			$_SESSION['message']="User could not be created";
		}

		echo $_SESSION['message'];
		$mysqli1->commit();
		$stmt1->close();
		$mysqli1->close();
	}
	header("Location: NWScreateAccount.php");
?>