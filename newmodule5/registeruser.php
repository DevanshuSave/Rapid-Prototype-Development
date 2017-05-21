<!DOCTYPE html>
<?php
require 'database.php';
session_start();
?>
<head>
<title>Register for Calendar!</title>
</head>
<body>
<!--<form name=user" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
	<p>
		<label for="newuser">Username:</label><br>
		<input type="text" name="newuser" id="newuser"/>
	<br>
		<label for="newpass">Password:</label>
		<input type="password" name="newpass" id="newpass"/>
	<br>
		<label for="repeatpass">Retype Password:</label>
		<input type="password" name="repeatpass" id="repeatpass"/>
	<br>
		<input type="submit" name="submitnewuser" value="Register!"/>
	</p>
-->
<?php
if(isset($_POST['newuser'])){
	$username = $_POST['newuser'];
	$password = $_POST['newpass'];
	$repeated = $_POST['repeatpass'];
	$stmt1 = $mysqli->prepare("select count(*) from users where username like '$username'");
	if(!$stmt1){
		printf("Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt1->execute();
	$stmt1->bind_result($number);
	$stmt1->fetch();
	$stmt1->close();
	if($number > 0){
		printf("That username is taken\n");
	}
	else{
		if(strcmp($password, $repeated) == 0){
			$stmt = $mysqli->prepare("insert into users(username, password) values(?, ?)");
			if(!stmt){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
			$encrypted = crypt($password, 'pwd');
			$stmt->bind_param('ss', $username, $encrypted);
			$stmt->execute();
			$stmt->close();
			header("Location: calendar.php");
		}
	}
}
?>
</body>
</html>